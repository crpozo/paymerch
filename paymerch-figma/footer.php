<?php
/**
 * Site footer (09 Footer): logo, four link columns, regulatory notice and
 * copyright row.
 *
 * @package Paymerch_Figma
 */

$pmf_columns = array(
	__( 'PRODUCTS & UTILITY', 'paymerch-figma' ) => array(
		__( 'Remittances (LatAm)', 'paymerch-figma' ),
		__( 'Digital Wallet (US)', 'paymerch-figma' ),
		__( 'P2P Transfers', 'paymerch-figma' ),
		__( 'Business Portal', 'paymerch-figma' ),
	),
	__( 'RAILS & NETWORKS', 'paymerch-figma' )   => array(
		__( 'SPEI Integration', 'paymerch-figma' ),
		__( 'ACH Direct Clearing', 'paymerch-figma' ),
		__( 'Local Banking Hubs', 'paymerch-figma' ),
		__( 'Infrastructure Status', 'paymerch-figma' ),
	),
	__( 'COMPANY & LEGAL', 'paymerch-figma' )    => array(
		__( 'About Paymerch', 'paymerch-figma' ),
		__( 'Compliance & Licensing', 'paymerch-figma' ),
		__( 'Regulatory Framework', 'paymerch-figma' ),
		__( 'Privacy & Trust', 'paymerch-figma' ),
	),
);
?>
</main>

<?php if ( in_array( pmf_variant(), array( 'sage', 'wallet' ), true ) ) : ?>
<footer class="pm-sfooter<?php echo 'wallet' === pmf_variant() ? ' pm-sfooter--tall' : ''; ?>" id="footer">
	<div class="pm-container pm-sfooter__grid">
		<div class="pm-sfooter__brand">
			<a class="pm-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				<img class="pm-logo__mark" src="<?php echo esc_url( pmf_asset( 'img/logo-mark.svg' ) ); ?>" alt="" width="34.5043" height="34">
				<img class="pm-logo__word" src="<?php echo esc_url( pmf_asset( 'img/logo-wordmark-light.svg' ) ); ?>" alt="" width="115.382" height="14.2543">
			</a>
			<p class="pm-sfooter__about"><?php esc_html_e( 'A new standard for cross-border transfers between the United States and Mexico. Transparent, fast, and built for families.', 'paymerch-figma' ); ?></p>
		</div>
		<div class="pm-sfooter__col">
			<h2 class="pm-sfooter__heading"><?php esc_html_e( 'Company', 'paymerch-figma' ); ?></h2>
			<ul>
				<li><a href="#"><?php esc_html_e( 'About', 'paymerch-figma' ); ?></a></li>
				<li><a href="#"><?php esc_html_e( 'Careers', 'paymerch-figma' ); ?></a></li>
				<li><a href="#"><?php esc_html_e( 'Press', 'paymerch-figma' ); ?></a></li>
			</ul>
		</div>
		<div class="pm-sfooter__col">
			<h2 class="pm-sfooter__heading"><?php esc_html_e( 'Legal', 'paymerch-figma' ); ?></h2>
			<ul>
				<li><a href="<?php echo esc_url( get_privacy_policy_url() ? get_privacy_policy_url() : '#' ); ?>"><?php esc_html_e( 'Privacy Policy', 'paymerch-figma' ); ?></a></li>
				<li><a href="#"><?php esc_html_e( 'Terms of Service', 'paymerch-figma' ); ?></a></li>
				<li><a href="#"><?php esc_html_e( 'Compliance', 'paymerch-figma' ); ?></a></li>
			</ul>
		</div>
	</div>
	<div class="pm-container">
		<hr class="pm-sfooter__rule">
		<p class="pm-sfooter__small"><?php echo esc_html( sprintf( /* translators: %s: year */ __( '© %s Paymerch, Inc. All rights reserved.', 'paymerch-figma' ), wp_date( 'Y' ) ) ); ?></p>
		<p class="pm-sfooter__small pm-sfooter__notice"><?php esc_html_e( "Paymerch is a financial technology company, not a bank. Banking services provided by our FDIC-insured partner institutions. Transfers are subject to availability and may take longer than expected due to factors outside of Paymerch's control. The 1% federal cash remittance excise tax exemption applies only to eligible digital transfers processed through network channels.", 'paymerch-figma' ); ?></p>
	</div>
</footer>
<?php else : ?>
<footer class="pm-footer" id="footer">
	<div class="pm-container">
		<a class="pm-logo pm-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<img class="pm-logo__mark" src="<?php echo esc_url( pmf_asset( 'img/logo-mark.svg' ) ); ?>" alt="" width="34.5043" height="34">
			<img class="pm-logo__word" src="<?php echo esc_url( pmf_asset( 'img/logo-wordmark-light.svg' ) ); ?>" alt="" width="115.382" height="14.2543">
		</a>

		<div class="pm-footer__cols">
			<?php foreach ( $pmf_columns as $pmf_title => $pmf_links ) : ?>
				<div class="pm-footer__col">
					<h2 class="pm-footer__heading"><?php echo esc_html( $pmf_title ); ?></h2>
					<ul class="pm-footer__links">
						<?php foreach ( $pmf_links as $pmf_link ) : ?>
							<li><a href="#"><?php echo esc_html( $pmf_link ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>

			<div class="pm-footer__col pm-footer__col--support">
				<h2 class="pm-footer__heading"><?php esc_html_e( 'OPERATIONAL SUPPORT', 'paymerch-figma' ); ?></h2>
				<div class="pm-footer__office">
					<p class="pm-footer__office-name"><?php esc_html_e( 'Quito Technical Hub', 'paymerch-figma' ); ?></p>
					<p class="pm-footer__office-text">Av. Amazonas N32-154 y Eloy Alfaro.</p>
				</div>
				<div class="pm-footer__office">
					<p class="pm-footer__office-name"><?php esc_html_e( 'U.S. Operations', 'paymerch-figma' ); ?></p>
					<p class="pm-footer__office-text"><a href="mailto:support@paymerch.us">support@paymerch.us</a></p>
				</div>
			</div>
		</div>

		<hr class="pm-footer__rule">

		<p class="pm-footer__notice"><?php esc_html_e( 'PAYMERCH IS A FINANCIAL TECHNOLOGY PLATFORM, NOT A BANK. BANKING SERVICES PROVIDED BY LICENSED FDIC-INSURED PARTNERS. CROSS-BORDER TRANSMISSION SERVICES ARE PROVIDED THROUGH LICENSED MONEY TRANSMITTER PARTNERS IN ACCORDANCE WITH ALL FEDERAL AND STATE REGULATIONS. REGISTERED WITH FINCEN AS A MONEY SERVICES BUSINESS (MSB).', 'paymerch-figma' ); ?></p>

		<div class="pm-footer__bottom">
			<p class="pm-footer__copy">
				<img src="<?php echo esc_url( pmf_asset( 'img/footer-logo-mark.svg' ) ); ?>" alt="" width="20" height="20">
				<?php echo esc_html( sprintf( /* translators: %s: year */ __( '© %s PAYMERCH INC. ALL RIGHTS RESERVED.', 'paymerch-figma' ), wp_date( 'Y' ) ) ); ?>
			</p>
			<nav aria-label="<?php esc_attr_e( 'Legal', 'paymerch-figma' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'legal',
						'container'      => false,
						'menu_class'     => 'pm-footer__legal',
						'depth'          => 1,
						'fallback_cb'    => 'pmf_legal_fallback',
					)
				);
				?>
			</nav>
		</div>
	</div>
</footer>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
