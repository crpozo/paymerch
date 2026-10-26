"""Export the local WordPress preview (docker/) as a static site for GitHub Pages.

Usage (with `docker compose up -d` running in docker/):
    python tools/export_static.py            # writes ./preview
    python tools/export_static.py --base http://localhost:8080 --out preview

Every page in PAGES is saved as <slug>/index.html. Same-origin assets (theme
CSS/JS/images, WordPress core scripts) are downloaded next to them and all
links are rewritten to relative paths, so the site works from any sub-path
(e.g. https://<user>.github.io/<repo>/). Links to pages that are not exported
become "#". Forms are disabled because there is no PHP on GitHub Pages.
"""

import argparse
import os
import posixpath
import re
import shutil
import sys
import urllib.parse
import urllib.request

PAGES = ["/", "/send-abroad/", "/mexico/", "/colombia/", "/us-wallet/"]

ATTR_RE = re.compile(r'''(?P<attr>\b(?:src|href|action|content|data-src))=(?P<q>["'])(?P<url>.*?)(?P=q)''', re.I)
SRCSET_RE = re.compile(r'''\bsrcset=(?P<q>["'])(?P<val>.*?)(?P=q)''', re.I)
CSS_URL_RE = re.compile(r'''url\(\s*(?P<q>["']?)(?P<url>[^"')]+)(?P=q)\s*\)''')
# Data attributes holding JSON with escaped URLs (the calculator flags).
JSON_URL_RE = re.compile(r'(https?:\\?/\\?/[^"&]+?\.(?:png|jpe?g|svg|webp))')


def fetch(url):
    req = urllib.request.Request(url, headers={"User-Agent": "paymerch-static-export"})
    with urllib.request.urlopen(req, timeout=30) as resp:
        return resp.read(), resp.headers.get_content_type()


class Exporter:
    def __init__(self, base, out):
        self.base = base.rstrip("/")
        self.host = urllib.parse.urlsplit(self.base).netloc
        self.out = out
        self.assets = {}  # site path -> local relative path (from out root)

    # --- helpers -----------------------------------------------------------
    def site_path(self, url, current):
        """Absolute site path for a same-origin URL, else None."""
        if not url or url.startswith(("#", "data:", "mailto:", "tel:", "javascript:")):
            return None
        absolute = urllib.parse.urljoin(current, url.replace("\\/", "/"))
        parts = urllib.parse.urlsplit(absolute)
        if parts.netloc != self.host:
            return None
        return parts.path or "/"

    @staticmethod
    def rel(from_file, to_file):
        return posixpath.relpath(to_file, posixpath.dirname(from_file) or ".")

    def page_file(self, path):
        return "index.html" if path == "/" else path.strip("/") + "/index.html"

    def asset(self, path):
        """Download a same-origin asset once; return its local path."""
        if path in self.assets:
            return self.assets[path]
        local = path.lstrip("/")
        self.assets[path] = local
        data, ctype = fetch(self.base + path)
        if ctype == "text/css":
            data = self.rewrite_css(data.decode("utf-8"), self.base + path, local).encode("utf-8")
        dest = os.path.join(self.out, *local.split("/"))
        os.makedirs(os.path.dirname(dest), exist_ok=True)
        with open(dest, "wb") as fh:
            fh.write(data)
        return local

    def target(self, url, current_url, current_file, is_link):
        path = self.site_path(url, current_url)
        if path is None:
            return url
        fragment = urllib.parse.urlsplit(url).fragment
        if path in PAGES:
            target = self.rel(current_file, self.page_file(path))
            if target.endswith("index.html"):
                target = target[: -len("index.html")] or "./"
            return target + ("#" + fragment if fragment else "")
        if is_link and not posixpath.splitext(path)[1]:
            return "#"  # admin, feeds, pages we don't export
        try:
            return self.rel(current_file, self.asset(path))
        except Exception as exc:  # noqa: BLE001 - keep exporting, report at the end
            print(f"  ! {path}: {exc}", file=sys.stderr)
            return "#"

    # --- rewriting ---------------------------------------------------------
    def rewrite_css(self, css, css_url, css_file):
        def repl(m):
            return f'url("{self.target(m.group("url"), css_url, css_file, False)}")'

        return CSS_URL_RE.sub(repl, css)

    def rewrite_html(self, html, page_url, page_file):
        # WordPress emoji loader (fetches a script from the local server at runtime).
        html = re.sub(r'<script[^>]*>[^<]*_wpemojiSettings.*?</script>\s*', "", html, flags=re.S)
        html = re.sub(r'<script[^>]*id=["\']wp-emoji-[^>]*>.*?</script>\s*', "", html, flags=re.S)
        # WordPress head noise that points at endpoints GitHub Pages can't serve.
        html = re.sub(r'<link[^>]+rel=["\'](?:alternate|EditURI|https://api\.w\.org/|shortlink|pingback)["\'][^>]*>\s*', "", html)

        def attr(m):
            name, q, url = m.group("attr"), m.group("q"), m.group("url")
            if name.lower() == "content" and not url.startswith(("http", "/")):
                return m.group(0)
            new = self.target(url, page_url, page_file, name.lower() in ("href", "action"))
            return f"{name}={q}{new}{q}"

        def srcset(m):
            q, val = m.group("q"), m.group("val")
            items = []
            for item in val.split(","):
                bits = item.strip().split()
                if bits:
                    bits[0] = self.target(bits[0], page_url, page_file, False)
                    items.append(" ".join(bits))
            return f"srcset={q}{', '.join(items)}{q}"

        def json_url(m):
            new = self.target(m.group(1).replace("\\/", "/"), page_url, page_file, False)
            return new.replace("/", "\\/")

        html = ATTR_RE.sub(attr, html)
        html = SRCSET_RE.sub(srcset, html)
        html = re.sub(r"<style[^>]*>.*?</style>", lambda m: self.rewrite_css(m.group(0), page_url, page_file), html, flags=re.S)
        html = re.sub(r'data-corridors="[^"]*"', lambda m: JSON_URL_RE.sub(json_url, m.group(0)), html)
        # No PHP on Pages: keep forms visible but inert.
        html = re.sub(r"<form\b(?![^>]*data-pm-calc)", '<form onsubmit="return false"', html)
        return html

    def run(self):
        if os.path.isdir(self.out):
            shutil.rmtree(self.out)
        os.makedirs(self.out)
        for path in PAGES:
            url = self.base + path
            print(f"page {path}")
            html, _ = fetch(url)
            file = self.page_file(path)
            out_html = self.rewrite_html(html.decode("utf-8"), url, file)
            dest = os.path.join(self.out, *file.split("/"))
            os.makedirs(os.path.dirname(dest), exist_ok=True)
            with open(dest, "w", encoding="utf-8", newline="\n") as fh:
                fh.write(out_html)
        # GitHub Pages: serve folders that start with "_" and skip Jekyll.
        open(os.path.join(self.out, ".nojekyll"), "w").close()
        print(f"{len(PAGES)} pages, {len(self.assets)} assets -> {self.out}")


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument("--base", default="http://localhost:8080")
    ap.add_argument("--out", default=os.path.join(os.path.dirname(os.path.dirname(os.path.abspath(__file__))), "preview"))
    args = ap.parse_args()
    Exporter(args.base, args.out).run()


if __name__ == "__main__":
    main()
