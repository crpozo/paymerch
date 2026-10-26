<?php
/**
 * Paymerch (Figma) theme bootstrap.
 *
 * @package Paymerch_Figma
 */

defined( 'ABSPATH' ) || exit;

define( 'PMF_VERSION', '2.0.0' );
define( 'PMF_DIR', get_template_directory() );
define( 'PMF_URI', get_template_directory_uri() );

/**
 * Theme supports and menus.
 */
function pmf_setup() {
	load_theme_textdomain( 'paymerch-figma', PMF_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 34,
			'width'       => 159,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Header navigation', 'paymerch-figma' ),
			'legal'   => __( 'Footer legal links', 'paymerch-figma' ),
		)
	);
}
add_action( 'after_setup_theme', 'pmf_setup' );

/**
 * URL of a file in assets/.
 *
 * @param string $path Path relative to assets/.
 * @return string
 */
function pmf_asset( $path ) {
	return PMF_URI . '/assets/' . ltrim( $path, '/' );
}

/**
 * Fonts: Inter + Outfit from Google Fonts; Archivo (expanded) stands in for the
 * licensed display faces Brakle and Hakter until their files are added to
 * assets/fonts/ (see pmf_display_font_faces()).
 */
function pmf_enqueue_assets() {
	wp_enqueue_style(
		'paymerch-figma-fonts',
		'https://fonts.googleapis.com/css2?family=Archivo:wdth,wght@62..125,500..800&family=Inter:wght@400;600;700&family=Outfit:wght@700&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'paymerch-figma', get_stylesheet_uri(), array( 'paymerch-figma-fonts' ), PMF_VERSION );
	wp_enqueue_script( 'paymerch-figma', pmf_asset( 'js/main.js' ), array(), PMF_VERSION, array( 'strategy' => 'defer' ) );
}
add_action( 'wp_enqueue_scripts', 'pmf_enqueue_assets' );

/**
 * Preconnect to Google Fonts.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array
 */
function pmf_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'pmf_resource_hints', 10, 2 );

/**
 * @font-face for the design's licensed display fonts. Drop the files into
 * assets/fonts/ with these names (.woff2 and/or .woff) and they are used
 * automatically: brakle-medium, hakter-extrabold. Each file is the only cut
 * of its family, so it is declared for every weight (no faux bold).
 */
function pmf_display_font_faces() {
	$faces = array(
		'Brakle' => array( 'brakle-medium', '100 900' ),
		'Hakter' => array( 'hakter-extrabold', '100 900' ),
	);
	$css   = '';
	foreach ( $faces as $family => $face ) {
		$src = array();
		foreach ( array( 'woff2', 'woff' ) as $ext ) {
			if ( file_exists( PMF_DIR . "/assets/fonts/{$face[0]}.{$ext}" ) ) {
				$src[] = sprintf( 'url("%s") format("%s")', esc_url( pmf_asset( "fonts/{$face[0]}.{$ext}" ) ), $ext );
			}
		}
		if ( $src ) {
			$css .= sprintf( '@font-face{font-family:"%s";src:%s;font-weight:%s;font-style:normal;font-display:swap}', $family, implode( ',', $src ), $face[1] );
		}
	}
	if ( $css ) {
		echo '<style id="paymerch-figma-display-fonts">' . $css . "</style>\n"; // phpcs:ignore WordPress.Security.EscapeOutput -- built from theme files only.
	}
}
add_action( 'wp_head', 'pmf_display_font_faces', 5 );

/**
 * Customizer: links and exchange rates used by the landing page.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function pmf_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'pmf_landing',
		array(
			'title'    => __( 'Paymerch landing', 'paymerch-figma' ),
			'priority' => 30,
		)
	);

	$settings = array(
		'pmf_login_url'    => array( __( 'Log in URL', 'paymerch-figma' ), '#', 'esc_url_raw', 'url' ),
		'pmf_es_url'       => array( __( 'Spanish site URL', 'paymerch-figma' ), '#', 'esc_url_raw', 'url' ),
		'pmf_security_url' => array( __( 'Security & support URL', 'paymerch-figma' ), '#', 'esc_url_raw', 'url' ),
		'pmf_play_url'     => array( __( 'Google Play URL', 'paymerch-figma' ), '#', 'esc_url_raw', 'url' ),
		'pmf_rate_mxn'     => array( __( 'Rate: 1 USD = … MXN', 'paymerch-figma' ), '19.42', 'pmf_sanitize_rate', 'text' ),
		'pmf_rate_cop'     => array( __( 'Rate: 1 USD = … COP', 'paymerch-figma' ), '3950.00', 'pmf_sanitize_rate', 'text' ),
		'pmf_fee'          => array( __( 'Transfer fee (USD)', 'paymerch-figma' ), '0.00', 'pmf_sanitize_rate', 'text' ),
	);

	foreach ( $settings as $id => $s ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $s[1],
				'sanitize_callback' => $s[2],
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $s[0],
				'section' => 'pmf_landing',
				'type'    => $s[3],
			)
		);
	}
}
add_action( 'customize_register', 'pmf_customize_register' );

/**
 * @param string $value Raw rate.
 * @return string
 */
function pmf_sanitize_rate( $value ) {
	$value = (float) str_replace( ',', '', (string) $value );
	return $value >= 0 ? number_format( $value, 2, '.', '' ) : '0.00';
}

/**
 * Theme mod with the defaults registered above.
 *
 * @param string $key Setting id without the pmf_ prefix.
 * @return string
 */
function pmf_opt( $key ) {
	$defaults = array(
		'rate_mxn' => '19.42',
		'rate_cop' => '3950.00',
		'fee'      => '0.00',
	);
	return (string) get_theme_mod( 'pmf_' . $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '#' );
}

/**
 * Transfer calculator (Paymerch/Calculator component). The swap button
 * switches the destination corridor between Mexico (MXN) and Colombia (COP).
 *
 * @param string $modifier Optional BEM modifier: "muted" (grey surface) or "card" (shadow, compact).
 * @param string $corridor Destination shown first: MXN or COP.
 */
function pmf_calculator( $modifier = '', $corridor = 'MXN' ) {
	$fee       = (float) pmf_opt( 'fee' );
	$corridors = array(
		'MXN' => array(
			'rate'     => (float) pmf_opt( 'rate_mxn' ),
			'flag'     => pmf_asset( 'img/flag-mx.png' ),
			'country'  => __( 'Mexico', 'paymerch-figma' ),
			'delivery' => __( 'ARRIVES VIA SPEI / DIRECT BANK NETWORK IN < 5 MINUTES', 'paymerch-figma' ),
		),
		'COP' => array(
			'rate'     => (float) pmf_opt( 'rate_cop' ),
			'flag'     => pmf_asset( 'img/flag-co.png' ),
			'country'  => __( 'Colombia', 'paymerch-figma' ),
			'delivery' => __( 'ARRIVES VIA DIRECT BANK NETWORK IN COLOMBIA', 'paymerch-figma' ),
		),
	);
	static $n = 0;
	$uid      = 'pm-calc-' . ( ++$n );
	$send     = 1000;
	$corridor = isset( $corridors[ $corridor ] ) ? $corridor : 'MXN';
	$rate     = $corridors[ $corridor ]['rate'];
	$class    = 'pm-calc' . ( $modifier ? ' pm-calc--' . sanitize_html_class( $modifier ) : '' );
	?>
	<form class="<?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $uid ); ?>" data-pm-calc data-corridor="<?php echo esc_attr( $corridor ); ?>" data-fee="<?php echo esc_attr( $fee ); ?>" data-corridors="<?php echo esc_attr( wp_json_encode( $corridors ) ); ?>">
		<h2 class="pm-calc__title"><?php esc_html_e( 'Calculate your transfer', 'paymerch-figma' ); ?></h2>

		<div class="pm-calc__row">
			<label class="pm-calc__label" for="<?php echo esc_attr( $uid ); ?>-send"><?php esc_html_e( 'YOU SEND', 'paymerch-figma' ); ?></label>
			<span class="pm-calc__offer"><?php echo esc_html( sprintf( /* translators: %s: fee */ __( '$%s LAUNCH OFFER', 'paymerch-figma' ), number_format( $fee, 2 ) ) ); ?></span>
		</div>
		<div class="pm-calc__field">
			<input class="pm-calc__amount" id="<?php echo esc_attr( $uid ); ?>-send" type="text" inputmode="decimal" autocomplete="off" value="<?php echo esc_attr( number_format( $send ) ); ?>" data-pm-send>
			<img class="pm-calc__flag" src="<?php echo esc_url( pmf_asset( 'img/flag-us.png' ) ); ?>" alt="" width="25" height="25">
			<span class="pm-calc__ccy">USD</span>
		</div>

		<p class="pm-calc__fee"><?php echo esc_html( sprintf( /* translators: %s: fee */ __( '→ FEE: $%s', 'paymerch-figma' ), number_format( $fee, 2 ) ) ); ?></p>
		<div class="pm-calc__rate">
			<div>
				<p class="pm-calc__rate-value" data-pm-rate><?php echo esc_html( '1 USD = ' . number_format( $rate, 2 ) . ' ' . $corridor ); ?></p>
				<p class="pm-calc__rate-note"><?php esc_html_e( 'REAL MID-MARKET RATE LOCK GUARANTEE', 'paymerch-figma' ); ?></p>
			</div>
			<button class="pm-calc__toggle" type="button" data-pm-toggle aria-label="<?php esc_attr_e( 'Switch destination currency', 'paymerch-figma' ); ?>">
				<img src="<?php echo esc_url( pmf_asset( 'img/icon-swap.svg' ) ); ?>" alt="" width="13.35" height="14.85">
			</button>
		</div>

		<label class="pm-calc__label" for="<?php echo esc_attr( $uid ); ?>-receive"><?php esc_html_e( 'RECIPIENT GETS', 'paymerch-figma' ); ?></label>
		<div class="pm-calc__field">
			<input class="pm-calc__amount" id="<?php echo esc_attr( $uid ); ?>-receive" type="text" inputmode="decimal" autocomplete="off" value="<?php echo esc_attr( number_format( max( 0, $send - $fee ) * $rate, 2 ) ); ?>" data-pm-receive>
			<img class="pm-calc__flag" src="<?php echo esc_url( $corridors[ $corridor ]['flag'] ); ?>" alt="" width="25" height="25" data-pm-flag>
			<span class="pm-calc__ccy" data-pm-ccy><?php echo esc_html( $corridor ); ?></span>
		</div>

		<p class="pm-calc__delivery" data-pm-delivery>ϟ&nbsp; <?php echo esc_html( $corridors[ $corridor ]['delivery'] ); ?></p>

		<a class="pm-btn pm-btn--lime pm-calc__cta" href="#early-access"><?php esc_html_e( 'LOCK IN ZERO-FEE TRANSFER', 'paymerch-figma' ); ?></a>
	</form>
	<?php
}

/**
 * Landing pages shipped with the theme (Figma "Page 2"): key => template, slug, title.
 *
 * @return array
 */
function pmf_landing_pages() {
	return array(
		'international' => array( 'page-templates/international.php', 'send-abroad', __( 'Send Abroad', 'paymerch-figma' ) ),
		'mexico'        => array( 'page-templates/mexico.php', 'mexico', __( 'Send Money to Mexico', 'paymerch-figma' ) ),
		'colombia'      => array( 'page-templates/colombia.php', 'colombia', __( 'Send Money to Colombia', 'paymerch-figma' ) ),
		'wallet'        => array( 'page-templates/wallet.php', 'us-wallet', __( 'US Wallet (P2P)', 'paymerch-figma' ) ),
	);
}

/**
 * Creates the landing pages (once) when the theme is activated. Existing pages
 * already using a template are left alone.
 */
function pmf_create_landing_pages() {
	foreach ( pmf_landing_pages() as $key => $page ) {
		if ( pmf_page_id( $key ) ) {
			continue;
		}
		wp_insert_post(
			array(
				'post_type'     => 'page',
				'post_status'   => 'publish',
				'post_title'    => $page[2],
				'post_name'     => $page[1],
				'page_template' => $page[0],
			)
		);
	}
}
add_action( 'after_switch_theme', 'pmf_create_landing_pages' );

/**
 * ID of the published page using a landing template.
 *
 * @param string $key Key from pmf_landing_pages().
 * @return int
 */
function pmf_page_id( $key ) {
	static $cache = array();
	$pages        = pmf_landing_pages();
	if ( ! isset( $pages[ $key ] ) ) {
		return 0;
	}
	if ( isset( $cache[ $key ] ) ) {
		return $cache[ $key ];
	}
	$found = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery -- small, cached lookup.
			'meta_value'     => $pages[ $key ][0], // phpcs:ignore WordPress.DB.SlowDBQuery
		)
	);
	$cache[ $key ] = $found ? (int) $found[0] : 0;
	return $cache[ $key ];
}

/**
 * URL of a landing page, or of a front-page anchor when the page doesn't exist.
 *
 * @param string $key    Key from pmf_landing_pages().
 * @param string $anchor Optional #fragment.
 * @return string
 */
function pmf_page_url( $key, $anchor = '' ) {
	$id  = pmf_page_id( $key );
	$url = $id ? get_permalink( $id ) : home_url( '/' );
	return $url . $anchor;
}

/**
 * Which header/footer design the current view uses:
 * home (lavender hero), sage (international + country pages), wallet (dark), default.
 *
 * @return string
 */
function pmf_variant() {
	if ( is_front_page() || is_home() ) {
		return 'home';
	}
	if ( is_page_template( 'page-templates/wallet.php' ) ) {
		return 'wallet';
	}
	foreach ( array( 'international', 'mexico', 'colombia' ) as $key ) {
		if ( is_page_template( 'page-templates/' . $key . '.php' ) ) {
			return 'sage';
		}
	}
	return 'default';
}

/**
 * @param array $classes Body classes.
 * @return array
 */
function pmf_body_class( $classes ) {
	$classes[] = 'pm-variant-' . pmf_variant();
	return $classes;
}
add_filter( 'body_class', 'pmf_body_class' );

/**
 * Header navigation fallback (no menu assigned in Appearance → Menus).
 */
function pmf_nav_fallback() {
	$items = array(
		array( pmf_page_url( 'international' ), __( 'SEND ABROAD', 'paymerch-figma' ), is_page_template( 'page-templates/international.php' ) ),
		array( pmf_page_url( 'wallet' ), __( 'US WALLET (P2P)', 'paymerch-figma' ), is_page_template( 'page-templates/wallet.php' ) ),
		array( home_url( '/#how-it-works' ), __( 'HOW IT WORKS & SAFETY', 'paymerch-figma' ), false ),
		array( '#footer', __( 'HELP', 'paymerch-figma' ), false ),
	);
	echo '<ul class="pm-nav__list">';
	foreach ( $items as $item ) {
		printf( '<li><a href="%s"%s>%s</a></li>', esc_url( $item[0] ), $item[2] ? ' aria-current="page"' : '', esc_html( $item[1] ) );
	}
	echo '</ul>';
}

/**
 * Footer legal links fallback.
 */
function pmf_legal_fallback() {
	$items = array(
		__( 'TERMS', 'paymerch-figma' )    => '#',
		__( 'PRIVACY', 'paymerch-figma' )  => get_privacy_policy_url() ? get_privacy_policy_url() : '#',
		__( 'SECURITY', 'paymerch-figma' ) => '#',
	);
	echo '<ul class="pm-footer__legal">';
	foreach ( $items as $label => $url ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Status line under a waitlist form after it was submitted (?waitlist=…).
 *
 * @param string $class CSS class of the message.
 */
function pmf_waitlist_message( $class ) {
	$status = isset( $_GET['waitlist'] ) ? sanitize_key( wp_unslash( $_GET['waitlist'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification -- display only.
	if ( 'ok' === $status ) {
		printf( '<p class="%s" role="status">%s</p>', esc_attr( $class ), esc_html__( "Thanks! You're on the list.", 'paymerch-figma' ) );
	} elseif ( $status ) {
		printf( '<p class="%s" role="alert">%s</p>', esc_attr( $class ), esc_html__( 'Please enter a valid email or phone number.', 'paymerch-figma' ) );
	}
}

/**
 * Early-access (waitlist) form handler: e-mails the site admin.
 */
function pmf_handle_waitlist() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = remove_query_arg( 'waitlist', $back );

	if ( ! isset( $_POST['pmf_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['pmf_nonce'] ) ), 'pmf_waitlist' ) ) {
		wp_safe_redirect( add_query_arg( 'waitlist', 'error', $back ) . '#early-access' );
		exit;
	}

	$contact = isset( $_POST['contact'] ) ? sanitize_text_field( wp_unslash( $_POST['contact'] ) ) : '';
	if ( '' === $contact || ( ! is_email( $contact ) && ! preg_match( '/^\+?[0-9\s().-]{7,20}$/', $contact ) ) ) {
		wp_safe_redirect( add_query_arg( 'waitlist', 'invalid', $back ) . '#early-access' );
		exit;
	}

	wp_mail(
		get_option( 'admin_email' ),
		sprintf( /* translators: %s: site name */ __( '[%s] New early-access sign-up', 'paymerch-figma' ), get_bloginfo( 'name' ) ),
		sprintf( /* translators: %s: e-mail or phone */ __( "Contact: %s\n", 'paymerch-figma' ), $contact )
	);

	wp_safe_redirect( add_query_arg( 'waitlist', 'ok', $back ) . '#early-access' );
	exit;
}
add_action( 'admin_post_nopriv_pmf_waitlist', 'pmf_handle_waitlist' );
add_action( 'admin_post_pmf_waitlist', 'pmf_handle_waitlist' );
