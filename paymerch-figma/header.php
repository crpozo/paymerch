<?php
/**
 * Site header (Paymerch/Navigation): logo, main navigation, language, log in
 * and the "Get early access" pill. Transparent over the hero on the front page.
 *
 * @package Paymerch_Figma
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text pm-skip" href="#main"><?php esc_html_e( 'Skip to content', 'paymerch-figma' ); ?></a>

<?php
$pmf_variant = pmf_variant();
$pmf_header  = 'pm-header pm-header--' . $pmf_variant . ( in_array( $pmf_variant, array( 'home', 'sage' ), true ) ? ' pm-header--overlay' : '' );
?>
<header class="<?php echo esc_attr( $pmf_header ); ?>">
	<div class="pm-container pm-header__inner">
		<a class="pm-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<?php if ( has_custom_logo() ) : ?>
				<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, array( 'class' => 'pm-logo__custom', 'alt' => '' ) ); ?>
			<?php else : ?>
				<img class="pm-logo__mark" src="<?php echo esc_url( pmf_asset( 'img/logo-mark.svg' ) ); ?>" alt="" width="34.5043" height="34">
				<img class="pm-logo__word" src="<?php echo esc_url( pmf_asset( 'wallet' === $pmf_variant ? 'img/logo-wordmark-light.svg' : 'img/logo-wordmark.svg' ) ); ?>" alt="" width="115.382" height="14.2543">
			<?php endif; ?>
		</a>

		<button class="pm-menu-toggle" type="button" aria-expanded="false" aria-controls="pm-menu" data-pm-menu-toggle>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'paymerch-figma' ); ?></span>
			<span class="pm-menu-toggle__bar" aria-hidden="true"></span>
		</button>

		<div class="pm-menu" id="pm-menu">
			<nav class="pm-nav" aria-label="<?php esc_attr_e( 'Main', 'paymerch-figma' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'pm-nav__list',
						'depth'          => 1,
						'fallback_cb'    => 'pmf_nav_fallback',
					)
				);
				?>
			</nav>

			<div class="pm-header__right">
				<span class="pm-lang">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-current="true">EN</a> | <a href="<?php echo esc_url( get_theme_mod( 'pmf_es_url', '#' ) ); ?>" hreflang="es">ES</a>
				</span>
				<a class="pm-header__login" href="<?php echo esc_url( get_theme_mod( 'pmf_login_url', '#' ) ); ?>"><?php esc_html_e( 'LOG IN', 'paymerch-figma' ); ?></a>
				<a class="pm-btn pm-btn--lime pm-header__cta" href="<?php echo esc_url( home_url( '/#early-access' ) ); ?>"><?php esc_html_e( 'GET EARLY ACCESS', 'paymerch-figma' ); ?></a>
			</div>
		</div>
	</div>
</header>

<main id="main" class="pm-main">
