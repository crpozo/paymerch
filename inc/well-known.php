<?php
/**
 * App deep links: serve /.well-known/assetlinks.json (Android App Links) and
 * /.well-known/apple-app-site-association (iOS Universal Links).
 *
 * The files live in /well-known inside the theme and are served by WordPress
 * itself, so they work on any host without touching the web root. If the host
 * already has a real /.well-known/ folder with these files, the web server
 * answers first and this code is never reached.
 *
 * To update them: replace the files in /well-known and bump PAYMERCH_VERSION.
 *
 * @package Paymerch
 */

defined( 'ABSPATH' ) || exit;

/** Public file name => array( theme file, content type ). */
function paymerch_well_known_files() {
	return array(
		'assetlinks.json'            => array( 'assetlinks.json', 'application/json' ),
		'apple-app-site-association' => array( 'apple-app-site-association', 'application/json' ),
	);
}

/**
 * Answer the request before WordPress routes it (works with or without pretty permalinks).
 */
function paymerch_serve_well_known() {
	$path = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	if ( ! preg_match( '#^/\.well-known/([a-z\-]+(?:\.json)?)$#', (string) $path, $m ) ) {
		return;
	}
	$files = paymerch_well_known_files();
	if ( ! isset( $files[ $m[1] ] ) ) {
		return;
	}
	$file = PAYMERCH_DIR . '/well-known/' . $files[ $m[1] ][0];
	if ( ! is_readable( $file ) ) {
		return;
	}
	nocache_headers();
	status_header( 200 );
	header( 'Content-Type: ' . $files[ $m[1] ][1] . '; charset=utf-8' );
	header( 'Access-Control-Allow-Origin: *' );
	header( 'Cache-Control: public, max-age=3600' );
	readfile( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	exit;
}
add_action( 'init', 'paymerch_serve_well_known', 0 );

/**
 * Also write the files physically to ABSPATH/.well-known/ so they are served
 * even when the web server answers /.well-known/ before WordPress (cPanel's
 * AutoSSL rule, hosts that exclude dotfolders from the WordPress rewrite…).
 * Runs on theme activation and on each admin page load until the copies match.
 */
function paymerch_publish_well_known() {
	$dir = ABSPATH . '.well-known';
	$ok  = true;
	if ( ! is_dir( $dir ) && ! wp_mkdir_p( $dir ) ) {
		update_option( 'paymerch_well_known_status', 'error: cannot create ' . $dir );
		return;
	}
	foreach ( paymerch_well_known_files() as $public => $conf ) {
		$src = PAYMERCH_DIR . '/well-known/' . $conf[0];
		$dst = $dir . '/' . $public;
		if ( ! is_readable( $src ) ) {
			continue;
		}
		if ( ! file_exists( $dst ) || md5_file( $src ) !== md5_file( $dst ) ) {
			$ok = ( false !== file_put_contents( $dst, file_get_contents( $src ) ) ) && $ok; // phpcs:ignore WordPress.WP.AlternativeFunctions
		}
	}
	$htaccess = "# Paymerch app deep links\nRequire all granted\n<Files \"apple-app-site-association\">\n\tForceType application/json\n</Files>\n<Files \"assetlinks.json\">\n\tForceType application/json\n</Files>\n";
	if ( ! file_exists( $dir . '/.htaccess' ) || file_get_contents( $dir . '/.htaccess' ) !== $htaccess ) { // phpcs:ignore WordPress.WP.AlternativeFunctions
		file_put_contents( $dir . '/.htaccess', $htaccess ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	}
	update_option( 'paymerch_well_known_status', $ok ? 'ok:' . PAYMERCH_VERSION : 'error: write failed in ' . $dir );
}
add_action( 'after_switch_theme', 'paymerch_publish_well_known' );

function paymerch_maybe_publish_well_known() {
	if ( current_user_can( 'manage_options' ) && get_option( 'paymerch_well_known_status' ) !== 'ok:' . PAYMERCH_VERSION ) {
		paymerch_publish_well_known();
	}
}
add_action( 'admin_init', 'paymerch_maybe_publish_well_known' );

/** Admin notice with the result, so the site owner can confirm without FTP. */
function paymerch_well_known_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$status = (string) get_option( 'paymerch_well_known_status' );
	if ( 0 === strpos( $status, 'ok:' ) ) {
		$screen = get_current_screen();
		if ( ! $screen || ! in_array( $screen->id, array( 'themes', 'dashboard' ), true ) ) {
			return;
		}
		printf(
			'<div class="notice notice-success is-dismissible"><p>%s <a href="%s" target="_blank" rel="noopener">assetlinks.json</a> · <a href="%s" target="_blank" rel="noopener">apple-app-site-association</a></p></div>',
			esc_html__( 'Paymerch: app deep-link files are published in /.well-known/.', 'paymerch' ),
			esc_url( home_url( '/.well-known/assetlinks.json' ) ),
			esc_url( home_url( '/.well-known/apple-app-site-association' ) )
		);
	} elseif ( '' !== $status ) {
		printf( '<div class="notice notice-error"><p>%s %s</p></div>', esc_html__( 'Paymerch could not write the /.well-known/ files:', 'paymerch' ), esc_html( $status ) );
	}
}
add_action( 'admin_notices', 'paymerch_well_known_notice' );
