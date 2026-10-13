<?php
/**
 * Paymerch theme bootstrap.
 *
 * @package Paymerch
 */

defined( 'ABSPATH' ) || exit;

define( 'PAYMERCH_VERSION', '1.1.1' );
define( 'PAYMERCH_DIR', get_template_directory() );
define( 'PAYMERCH_URI', get_template_directory_uri() );

require PAYMERCH_DIR . '/inc/helpers.php';
require PAYMERCH_DIR . '/inc/content.php';
require PAYMERCH_DIR . '/inc/currencies.php';
require PAYMERCH_DIR . '/inc/customizer.php';
require PAYMERCH_DIR . '/inc/forms.php';
require PAYMERCH_DIR . '/inc/legal.php';
require PAYMERCH_DIR . '/inc/well-known.php';

/**
 * Theme supports, menus, text domain.
 */
function paymerch_setup() {
	load_theme_textdomain( 'paymerch', PAYMERCH_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 363,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu (header pill)', 'paymerch' ),
			'legal'   => __( 'Footer Legal Links', 'paymerch' ),
		)
	);
}
add_action( 'after_setup_theme', 'paymerch_setup' );

/**
 * Front-end assets.
 */
function paymerch_enqueue_assets() {
	wp_enqueue_style( 'paymerch-main', PAYMERCH_URI . '/assets/css/main.css', array(), PAYMERCH_VERSION );
	wp_enqueue_script( 'paymerch-main', PAYMERCH_URI . '/assets/js/main.js', array(), PAYMERCH_VERSION, array( 'strategy' => 'defer' ) );
}
add_action( 'wp_enqueue_scripts', 'paymerch_enqueue_assets' );

/**
 * @font-face declarations, printed early so the browser starts fetching fonts
 * before the main stylesheet is parsed. See inc/helpers.php.
 */
function paymerch_print_font_faces() {
	echo "<style id=\"paymerch-fonts\">\n" . paymerch_font_face_css() . "\n</style>\n"; // phpcs:ignore WordPress.Security.EscapeOutput -- generated CSS from theme files only.
}
add_action( 'wp_head', 'paymerch_print_font_faces', 1 );

/**
 * Preload the heaviest above-the-fold assets.
 */
function paymerch_preload_hero_assets() {
	if ( ! is_front_page() ) {
		return;
	}
	printf( '<link rel="preload" as="image" href="%s">' . "\n", esc_url( paymerch_asset( 'img/phone-frame.png' ) ) );
	printf( '<link rel="preload" as="font" type="font/woff2" crossorigin href="%s">' . "\n", esc_url( paymerch_asset( 'fonts/helveticaneuemed-webfont.woff2' ) ) );
}
add_action( 'wp_head', 'paymerch_preload_hero_assets', 2 );

/**
 * Fallback for the primary menu when none is assigned (Appearance → Menus).
 */
function paymerch_nav_fallback() {
	$items = array(
		'#hero'        => paymerch_get( 'nav_1' ),
		'#see-exactly' => paymerch_get( 'nav_2' ),
		'#waitlist'    => paymerch_get( 'nav_3' ),
		'#steps'       => paymerch_get( 'nav_4' ),
		'#contact'     => paymerch_get( 'nav_5' ),
	);
	echo '<ul class="pm-nav__list">';
	foreach ( $items as $href => $label ) {
		if ( '' === trim( (string) $label ) ) {
			continue;
		}
		printf( '<li class="menu-item"><a href="%s">%s</a></li>', esc_url( home_url( '/' ) . $href ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Fallback for the footer legal menu: the legal documents shipped with the
 * theme (see inc/legal.php), linked to their published pages.
 */
function paymerch_legal_fallback() {
	$links = paymerch_legal_links();
	if ( ! $links ) {
		return;
	}
	echo '<ul class="pm-footer__legal-list">';
	foreach ( $links as $link ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $link['url'] ), esc_html( $link['label'] ) );
	}
	echo '</ul>';
}

/**
 * Body class helpers.
 */
function paymerch_body_class( $classes ) {
	$classes[] = is_front_page() ? 'pm-is-front' : 'pm-is-inner';
	return $classes;
}
add_filter( 'body_class', 'paymerch_body_class' );
