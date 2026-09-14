<?php
/**
 * Legal documents shipped with the theme (Terms, Privacy, Refund & Cancellation).
 *
 * The HTML of each document lives in /legal. On theme activation (and when the
 * bundled version changes) a published Page is created for every document using
 * the "Legal document" template. Pages that already have real content are never
 * overwritten, so edits made in wp-admin → Pages are kept.
 *
 * @package Paymerch
 */

defined( 'ABSPATH' ) || exit;

define( 'PAYMERCH_LEGAL_VERSION', '1' );

/**
 * Document registry: slug => title (page H1), footer label, bundled file.
 */
function paymerch_legal_docs() {
	return array(
		'terms-and-conditions'           => array(
			'title' => 'Customer Terms and Conditions',
			'label' => __( 'Terms and Conditions', 'paymerch' ),
			'file'  => 'terms-and-conditions.html',
		),
		'privacy-policy'                 => array(
			'title' => 'Customer Privacy Policy',
			'label' => __( 'Privacy Policy', 'paymerch' ),
			'file'  => 'privacy-policy.html',
		),
		'refund-and-cancellation-policy' => array(
			'title' => 'Customer Refund and Cancellation Policy',
			'label' => __( 'Refund and Cancellation Policy', 'paymerch' ),
			'file'  => 'refund-and-cancellation-policy.html',
		),
	);
}

/**
 * True for pages that only hold placeholder text (safe to replace).
 *
 * @param WP_Post $page Page.
 */
function paymerch_legal_is_placeholder( $page ) {
	$text = trim( wp_strip_all_tags( $page->post_content ) );
	if ( '' === $text || 'Sample legal page.' === $text ) {
		return true;
	}
	// WordPress' auto-generated "Privacy Policy" draft.
	return 'draft' === $page->post_status && false !== strpos( $page->post_content, 'Suggested text:' );
}

/**
 * Create / refresh the legal pages.
 */
function paymerch_legal_install() {
	foreach ( paymerch_legal_docs() as $slug => $doc ) {
		$file = PAYMERCH_DIR . '/legal/' . $doc['file'];
		if ( ! file_exists( $file ) ) {
			continue;
		}
		$args = array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => $doc['title'],
			'post_name'    => $slug,
			'post_content' => file_get_contents( $file ), // phpcs:ignore WordPress.WP.AlternativeFunctions
			'meta_input'   => array( '_wp_page_template' => 'page-templates/legal.php' ),
		);
		$page = get_page_by_path( $slug, OBJECT, 'page' );
		if ( ! $page ) {
			$id = wp_insert_post( $args, true );
		} elseif ( paymerch_legal_is_placeholder( $page ) ) {
			$args['ID'] = $page->ID;
			$id         = wp_update_post( $args, true );
		} else {
			$id = $page->ID;
		}
		if ( $id && ! is_wp_error( $id ) && ! get_page_template_slug( $id ) ) {
			update_post_meta( $id, '_wp_page_template', 'page-templates/legal.php' );
		}
		if ( 'privacy-policy' === $slug && $id && ! is_wp_error( $id ) ) {
			update_option( 'wp_page_for_privacy_policy', (int) $id );
		}
	}
	update_option( 'paymerch_legal_version', PAYMERCH_LEGAL_VERSION );
}
add_action( 'after_switch_theme', 'paymerch_legal_install' );

/**
 * Re-run after a theme update that ships new document versions.
 */
function paymerch_legal_maybe_update() {
	if ( get_option( 'paymerch_legal_version' ) !== PAYMERCH_LEGAL_VERSION && current_user_can( 'edit_pages' ) ) {
		paymerch_legal_install();
	}
}
add_action( 'admin_init', 'paymerch_legal_maybe_update' );

/**
 * Published legal pages as links (label + URL), optionally without one slug.
 *
 * @param string $exclude Slug to leave out (the current page).
 * @return array[]
 */
function paymerch_legal_links( $exclude = '' ) {
	$links = array();
	foreach ( paymerch_legal_docs() as $slug => $doc ) {
		if ( $slug === $exclude ) {
			continue;
		}
		$page = get_page_by_path( $slug, OBJECT, 'page' );
		if ( $page && 'publish' === $page->post_status ) {
			$links[] = array(
				'label' => $doc['label'],
				'url'   => get_permalink( $page ),
			);
		}
	}
	return $links;
}

/**
 * Give every H2 an id and return the "On this page" index.
 *
 * @param string $html Filtered page content.
 * @return array { 0: html with ids, 1: array of [ 'id', 'text' ] }
 */
function paymerch_legal_prepare( $html ) {
	$toc  = array();
	$used = array();
	$html = preg_replace_callback(
		'#<h2([^>]*)>(.*?)</h2>#is',
		function ( $m ) use ( &$toc, &$used ) {
			$text = trim( wp_strip_all_tags( $m[2] ) );
			$id   = 'section-' . sanitize_title( preg_replace( '/^\d+\.\s*/', '', $text ) );
			$base = $id;
			$n    = 2;
			while ( isset( $used[ $id ] ) ) {
				$id = $base . '-' . $n++;
			}
			$used[ $id ] = true;
			$toc[]       = array(
				'id'   => $id,
				'text' => $text,
			);
			$attrs = preg_replace( '/\sid="[^"]*"/', '', $m[1] );
			return '<h2 id="' . esc_attr( $id ) . '"' . $attrs . '>' . $m[2] . '</h2>';
		},
		$html
	);
	return array( $html, $toc );
}
