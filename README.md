# Paymerch — WordPress theme

Landing page theme for Paymerch: hero with a live transfer calculator
(Wise-style currency picker), corridors, 5 steps, waitlist and contact forms,
and the legal pages. **Every text, link and image is editable in WordPress**;
no page builder or plugins are required.

## Install

1. Download this repository as a zip (Code → Download ZIP) or run
   `git clone https://github.com/crpozo/paymerch.git` inside `wp-content/themes/`.
   For the upload route, zip the theme folder so that `style.css` sits at the
   root of the zip, then use **Appearance → Themes → Add New → Upload Theme**.
2. Activate **Paymerch**. The landing page is the theme's `front-page.php`, so it
   shows on the home URL regardless of the *Reading* settings. The three legal
   pages are created automatically.

## Editing the content (for the client)

Go to **Appearance → Customize → Paymerch — Edit content**. It is organised in
the same order as the page:

1. Header & navigation (logo is under *Site Identity*)
2. Hero (headline, paragraph, button, floating chips, decorative shape)
3. Phone calculator (starting amount, fee, rate overrides, every label, store links, QR)
4. See Exactly What Arrives
5. Protected at Every Step (headline, button, the three cards)
6. Local Rails (both corridors: country, photo, flag, expanded text, options, note)
7. 5 Simple Steps (photo, each step)
8. Built for Your Phone (texts, form placeholder/button, phone image)
9. Built by Real People (headline, background photo, contact form texts, notification e-mail)
10. Footer (address, support e-mail, hours, social links)

Headline fields accept `<strong>…</strong>` for bold, `<br>` for a line break and
`<strong class="pm-green">…</strong>` for the green accent. Leave a card, step,
chip or social link empty to hide it. Changes preview live; click **Publish**.

* **Menus** — *Appearance → Menus*: assign a menu to *Primary Menu (header pill)*
  or *Footer Legal Links* to replace the default links.
* **Legal pages** — *Pages → Customer Terms and Conditions / Privacy Policy /
  Refund and Cancellation Policy*. Edit them like any page; they use the
  **Legal document** template (title band, "On this page" index).
* **Leads** — every waitlist and contact submission is stored under *Leads* and
  e-mailed to the address set in section 9 (default: contact@paymerch.us).

## Phone calculator

Both phones show a working transfer calculator modelled on Wise's: type what you
send or what they receive, and tap either currency pill to open the picker —
search by currency or country, "Popular currencies" then "All currencies"
(≈55 currencies, round flags from flagcdn.com, check on the selected one;
keyboard ↑/↓, Enter, Esc). Rates are mid-market per 1 USD from the free
open.er-api.com feed (cached 6 h server-side, refreshed client-side), falling
back to the table in `inc/currencies.php` when the feed is unreachable. The
MXN / COP fields in the Customizer override the feed (leave empty for live).

## Fonts

The design uses Helvetica Neue LT Std (Light / Roman / Medium). The theme ships
the **Medium** cut (`assets/fonts/helveticaneuemed-webfont.woff2`). Regular and
Light fall back to the locally installed *Helvetica Neue* (macOS / iOS) and then
Arial. To ship them as web fonts, drop the files into `assets/fonts/` using one
of these base names — they are picked up automatically:

| Weight | Base name (add `.woff2` / `.woff` / `.ttf`) |
| ------ | ------------------------------------------- |
| 300    | `helveticaneue-light-webfont`               |
| 400    | `helveticaneue-regular-webfont`             |
| 700    | `helveticaneue-bold-webfont`                |

## How the layout scales

Layout: `1rem = 10px` on a 1920 px viewport; the root font-size is
`viewport width / 192` (capped at 10 px), so positions in `assets/css/main.css`
equal the original mockup value ÷ 10 and the page always fills the width. Tall
sections compress their vertical rhythm with `clamp(min, 100vh, mockup)` so each
fits one screen. Type and controls use fluid tokens in `:root` (`--t-*`,
`--ctl-*`, `--gap-*`) with px floors and caps; controls keep a ≥ 44 px touch
target. Below 900 px the stylesheet switches to a stacked mobile layout.

## Structure

```
paymerch/
├── style.css                theme header
├── functions.php            setup, assets, @font-face, menu fallbacks
├── front-page.php           landing page (sections below)
├── header.php / footer.php
├── index.php / page.php     inner pages
├── inc/content.php          ← registry of every editable field (defaults = the design copy)
├── inc/customizer.php       builds the Customizer panel from the registry
├── inc/helpers.php          paymerch_get(), paymerch_field(), paymerch_image(), icons, fonts
├── inc/currencies.php       currency catalog + live rates
├── inc/forms.php            waitlist + contact handlers, "Leads" post type
├── inc/legal.php            creates the legal pages, footer links, page index
├── page-templates/legal.php "Legal document" template
├── legal/                   Terms, Privacy, Refund & Cancellation (HTML)
├── template-parts/          one file per section + phone-screen.php (the calculator)
└── assets/css · js · fonts · img
```

## Notes for the client

* The Privacy Policy still contains drafting notes in sections 6, 12 and 15
  ("Customers must tailor this section…") — they come from the source document.
* The Terms are governed by Georgia law while the footer address is in Delaware;
  the documents' phone number (+1 505 630-0042) is not shown in the footer.
* Flags (flagcdn.com) and rates (open.er-api.com) are free external services.
