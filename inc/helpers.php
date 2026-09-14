<?php
/**
 * Small template helpers: assets, images, inline SVG icons, settings, fonts.
 *
 * @package Paymerch
 */

defined( 'ABSPATH' ) || exit;

/**
 * URL of a file inside /assets.
 */
function paymerch_asset( $relative ) {
	return PAYMERCH_URI . '/assets/' . ltrim( $relative, '/' );
}

/**
 * Print an <img> for a theme image, with intrinsic width/height.
 *
 * @param string $file  File name inside assets/img.
 * @param string $alt   Alt text ('' for decorative images).
 * @param string $class CSS class(es).
 * @param array  $attrs Extra attributes (e.g. array( 'loading' => 'eager' )).
 */
function paymerch_img( $file, $alt = '', $class = '', $attrs = array() ) {
	$path = PAYMERCH_DIR . '/assets/img/' . $file;
	$size = file_exists( $path ) ? wp_getimagesize( $path ) : false;

	$attributes = array_merge(
		array(
			'src'      => paymerch_asset( 'img/' . $file ),
			'alt'      => $alt,
			'class'    => $class,
			'loading'  => 'lazy',
			'decoding' => 'async',
		),
		$attrs
	);
	if ( $size ) {
		$attributes['width']  = $size[0];
		$attributes['height'] = $size[1];
	}
	if ( '' === $alt ) {
		$attributes['aria-hidden'] = 'true';
	}
	paymerch_print_img( $attributes );
}

/**
 * Print an <img> from an attribute list (values escaped here).
 */
function paymerch_print_img( $attributes ) {
	$html = '<img';
	foreach ( $attributes as $key => $value ) {
		if ( '' === $value && 'alt' !== $key ) {
			continue;
		}
		$html .= ' ' . $key . '="' . esc_attr( $value ) . '"';
	}
	echo $html . '>'; // phpcs:ignore WordPress.Security.EscapeOutput -- attributes escaped above.
}

/**
 * Print an image that editors can replace in the Customizer.
 *
 * @param string $key      Content field key (type "image"); its default is a theme file.
 * @param string $alt      Alt text.
 * @param string $class    CSS class(es).
 * @param array  $attrs    Extra attributes.
 */
function paymerch_image( $key, $alt = '', $class = '', $attrs = array() ) {
	$field   = paymerch_field_def( $key );
	$default = $field ? $field['default'] : '';
	$url     = paymerch_get( $key );

	if ( '' === $url || $url === $default || $url === paymerch_asset( 'img/' . $default ) ) {
		paymerch_img( $default, $alt, $class, $attrs );
		return;
	}
	$attributes = array_merge(
		array(
			'src'      => $url,
			'alt'      => $alt,
			'class'    => $class,
			'loading'  => 'lazy',
			'decoding' => 'async',
		),
		$attrs
	);
	$id = attachment_url_to_postid( $url );
	if ( $id ) {
		$meta = wp_get_attachment_metadata( $id );
		if ( ! empty( $meta['width'] ) ) {
			$attributes['width']  = $meta['width'];
			$attributes['height'] = $meta['height'];
		}
	}
	if ( '' === $alt ) {
		$attributes['aria-hidden'] = 'true';
	}
	paymerch_print_img( $attributes );
}

/**
 * Print an inline SVG icon from assets/img/icons/{name}.svg.
 *
 * @param string $name    Icon file name without extension.
 * @param string $class   CSS class for the <svg>.
 * @param bool   $current Replace white/black fills with currentColor (for social icons).
 */
function paymerch_icon( $name, $class = '', $current = false ) {
	static $cache = array();
	if ( ! isset( $cache[ $name ] ) ) {
		$file           = PAYMERCH_DIR . '/assets/img/icons/' . $name . '.svg';
		$cache[ $name ] = file_exists( $file ) ? file_get_contents( $file ) : ''; // phpcs:ignore WordPress.WP.AlternativeFunctions
	}
	$svg = $cache[ $name ];
	if ( '' === $svg ) {
		return;
	}
	if ( $current ) {
		$svg = str_replace( array( '#ffffff', '#000000' ), 'currentColor', $svg );
	}
	$svg = preg_replace( '/<svg /', '<svg class="' . esc_attr( $class ) . '" aria-hidden="true" focusable="false" ', $svg, 1 );
	echo $svg; // phpcs:ignore WordPress.Security.EscapeOutput -- static theme file.
}

/**
 * Allowed inline markup in editable headlines/paragraphs.
 */
function paymerch_allowed_inline() {
	return array(
		'br'     => array( 'class' => array() ),
		'strong' => array( 'class' => array() ),
		'b'      => array( 'class' => array() ),
		'em'     => array( 'class' => array() ),
		'span'   => array( 'class' => array() ),
		'a'      => array(
			'href'   => array(),
			'target' => array(),
			'rel'    => array(),
		),
	);
}

/**
 * Print a string that may contain inline emphasis / line breaks.
 */
function paymerch_text( $text ) {
	echo wp_kses( $text, paymerch_allowed_inline() );
}

/**
 * Read a content/setting field (theme mod with its default from inc/content.php).
 */
function paymerch_get( $key ) {
	$field   = paymerch_field_def( $key );
	$default = $field ? $field['default'] : '';
	if ( $field && 'image' === $field['type'] ) {
		$default = '' === $default ? '' : paymerch_asset( 'img/' . $default );
	}
	$value = get_theme_mod( 'paymerch_' . $key, $default );
	return is_string( $value ) ? $value : $default;
}

/**
 * Print a field. Type decides the escaping: html → inline markup allowed,
 * textarea → paragraphs with line breaks, everything else → plain text.
 */
function paymerch_field( $key ) {
	$field = paymerch_field_def( $key );
	$value = paymerch_get( $key );
	if ( ! $field ) {
		echo esc_html( $value );
		return;
	}
	switch ( $field['type'] ) {
		case 'html':
			paymerch_text( $value );
			break;
		case 'textarea':
			echo nl2br( wp_kses( $value, paymerch_allowed_inline() ) );
			break;
		default:
			echo esc_html( $value );
	}
}

/**
 * Money with two decimals and thousands separators: 25800 → "25,800.00".
 */
function paymerch_money( $amount ) {
	return number_format( (float) $amount, 2, '.', ',' );
}

/** Transfer fee in USD. */
function paymerch_calc_fee() {
	return max( 0, (float) paymerch_get( 'transfer_fee' ) );
}

/** Amount pre-filled in "You send exactly". */
function paymerch_calc_amount() {
	return max( 0, (float) paymerch_get( 'default_amount' ) );
}

/**
 * Build the @font-face CSS.
 *
 * Only the Medium cut (helveticaneuemed-webfont.woff2) ships with the theme.
 * Drop the Regular/Light/Bold cuts into assets/fonts using any of the file
 * names listed below and they are picked up automatically; otherwise the
 * browser falls back to the locally installed Helvetica Neue and then Arial.
 */
function paymerch_font_face_css() {
	$dir = PAYMERCH_DIR . '/assets/fonts/';
	$uri = paymerch_asset( 'fonts/' );

	$faces = array(
		300 => array(
			'files'  => array( 'helveticaneue-light-webfont', 'helveticaneuelt-webfont', 'helveticaneuelight-webfont', 'helveticaneue_light-webfont' ),
			'locals' => array( 'Helvetica Neue Light', 'HelveticaNeue-Light', 'HelveticaNeueLTStd-Lt' ),
		),
		400 => array(
			'files'  => array( 'helveticaneue-regular-webfont', 'helveticaneue-webfont', 'helveticaneueroman-webfont', 'helveticaneue_regular-webfont' ),
			'locals' => array( 'Helvetica Neue', 'HelveticaNeue', 'HelveticaNeueLTStd-Roman' ),
		),
		500 => array(
			'files'  => array( 'helveticaneuemed-webfont', 'helveticaneue-medium-webfont', 'helveticaneuemedium-webfont' ),
			'locals' => array( 'Helvetica Neue Medium', 'HelveticaNeue-Medium', 'HelveticaNeueLTStd-Md' ),
		),
		700 => array(
			'files'  => array( 'helvetica_neu_bold-webfont', 'helveticaneue-bold-webfont', 'helveticaneuebold-webfont' ),
			'locals' => array( 'Helvetica Neue Bold', 'HelveticaNeue-Bold' ),
		),
	);

	$css = '';
	foreach ( $faces as $weight => $face ) {
		$sources = array();
		foreach ( $face['files'] as $base ) {
			foreach ( array( 'woff2', 'woff', 'ttf' ) as $ext ) {
				if ( file_exists( $dir . $base . '.' . $ext ) ) {
					$format    = 'ttf' === $ext ? 'truetype' : $ext;
					$sources[] = sprintf( "url('%s%s.%s') format('%s')", $uri, $base, $ext, $format );
				}
			}
			if ( $sources ) {
				break;
			}
		}
		foreach ( $face['locals'] as $local ) {
			$sources[] = "local('" . $local . "')";
		}
		$css .= "@font-face{font-family:'Helvetica Neue LT';font-style:normal;font-weight:{$weight};font-display:swap;src:" . implode( ',', $sources ) . "}\n";
	}
	return $css;
}
