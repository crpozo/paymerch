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
