<?php
/**
 * Site footer.
 *
 * @package Paymerch
 */

$pm_socials = array(
	'facebook'  => array( 'Facebook', paymerch_get( 'social_facebook' ) ),
	'twitter'   => array( 'Twitter', paymerch_get( 'social_twitter' ) ),
	'instagram' => array( 'Instagram', paymerch_get( 'social_instagram' ) ),
	'linkedin'  => array( 'LinkedIn', paymerch_get( 'social_linkedin' ) ),
	'whatsapp'  => array( 'WhatsApp', paymerch_get( 'social_whatsapp' ) ),
);
?>
	</main>

	<footer class="pm-footer" id="footer">
		<div class="pm-wrap pm-footer__wrap">
			<?php paymerch_img( 'footer.png', '', 'pm-footer__watermark' ); ?>

			<a class="pm-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php paymerch_img( 'logo-blanco.png', get_bloginfo( 'name' ) ); ?>
			</a>

			<ul class="pm-footer__social">
				<?php foreach ( $pm_socials as $pm_key => $pm_social ) : ?>
					<?php if ( '' === trim( (string) $pm_social[1] ) ) { continue; } ?>
					<li>
						<a href="<?php echo esc_url( $pm_social[1] ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $pm_social[0] ); ?>">
							<?php paymerch_icon( 'icon-' . $pm_key, 'pm-footer__icon', true ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="pm-footer__info">
				<div class="pm-footer__block pm-footer__block--wide">
					<h4><?php paymerch_field( 'hq_title' ); ?></h4>
					<p><?php paymerch_field( 'hq_address' ); ?></p>
					<p><?php paymerch_field( 'hq_entity' ); ?></p>
				</div>
				<div class="pm-footer__block">
					<h4><?php paymerch_field( 'support_label' ); ?></h4>
					<p><a href="mailto:<?php echo esc_attr( paymerch_get( 'support_email' ) ); ?>"><?php paymerch_field( 'support_email' ); ?></a></p>
				</div>
				<div class="pm-footer__block">
					<h4><?php paymerch_field( 'hours_label' ); ?></h4>
					<p><?php paymerch_field( 'support_hours' ); ?></p>
				</div>
			</div>

			<hr class="pm-footer__rule">

			<nav class="pm-footer__legal" aria-label="<?php esc_attr_e( 'Legal', 'paymerch' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'legal',
						'container'      => false,
						'menu_class'     => 'pm-footer__legal-list',
						'depth'          => 1,
						'fallback_cb'    => 'paymerch_legal_fallback',
					)
				);
				?>
			</nav>
		</div>
	</footer>
</div><!-- .pm-site -->

<?php wp_footer(); ?>
</body>
</html>
