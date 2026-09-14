<?php
/**
 * Site header: logo + navigation pill (absolutely positioned over the hero).
 *
 * @package Paymerch
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
<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'paymerch' ); ?></a>

<div class="pm-site">
	<header class="pm-header" id="top">
		<div class="pm-wrap pm-header__inner">
			<a class="pm-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php
				if ( has_custom_logo() ) {
					$logo_id = get_theme_mod( 'custom_logo' );
					echo wp_get_attachment_image( $logo_id, 'full', false, array( 'class' => 'pm-logo__img', 'alt' => get_bloginfo( 'name' ) ) );
				} else {
					paymerch_img( 'logo-color.png', get_bloginfo( 'name' ), 'pm-logo__img', array( 'loading' => 'eager' ) );
				}
				?>
			</a>

			<button class="pm-nav-toggle" type="button" aria-expanded="false" aria-controls="pm-nav">
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'paymerch' ); ?></span>
				<span class="pm-nav-toggle__bar" aria-hidden="true"></span>
			</button>

			<nav id="pm-nav" class="pm-nav" aria-label="<?php esc_attr_e( 'Primary', 'paymerch' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'pm-nav__list',
						'depth'          => 1,
						'fallback_cb'    => 'paymerch_nav_fallback',
					)
				);
				?>
			</nav>
		</div>
	</header>

	<main id="main" class="pm-main">
