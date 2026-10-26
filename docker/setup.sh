#!/bin/sh
# Installs WordPress (first run only), activates the Paymerch Figma theme and
# creates its landing pages. Run by the "setup" service in docker-compose.yml.
set -e

# Wait until the wordpress container has copied core files into the volume.
i=0
until [ -f /var/www/html/wp-config.php ]; do
	i=$((i + 1))
	[ "$i" -gt 60 ] && echo "wp-config.php not found" && exit 1
	sleep 2
done

if ! wp core is-installed 2>/dev/null; then
	wp core install \
		--url="http://localhost:8080" \
		--title="Paymerch" \
		--admin_user=admin \
		--admin_password=admin \
		--admin_email=admin@example.com \
		--skip-email
fi

wp rewrite structure '/%postname%/' --hard
wp theme activate paymerch-figma
wp eval 'pmf_create_landing_pages();'
wp post list --post_type=page --fields=ID,post_title,post_name --format=table

echo "Listo: http://localhost:8080  (admin: http://localhost:8080/wp-admin  admin / admin)"
