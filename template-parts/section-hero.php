<?php
/**
 * Section 1 — Hero: headline + CTA on the left, the whole phone (a working
 * transfer calculator) on the right with two floating highlight chips.
 *
 * @package Paymerch
 */
?>
<section class="pm-hero" id="hero">
	<div class="pm-wrap pm-hero__wrap">
		<?php paymerch_image( 'hero_mark', '', 'pm-hero__mark', array( 'loading' => 'eager' ) ); ?>

		<div class="pm-hero__content">
			<h1 class="pm-hero__title"><?php paymerch_field( 'hero_title' ); ?></h1>
			<p class="pm-hero__text"><?php paymerch_field( 'hero_text' ); ?></p>
			<a class="pm-btn pm-btn--hero" href="<?php echo esc_url( paymerch_get( 'hero_cta_url' ) ); ?>">
				<span><?php paymerch_field( 'hero_cta' ); ?></span>
				<?php paymerch_icon( 'icon-chevron', 'pm-btn__chev' ); ?>
			</a>
		</div>

		<div class="pm-hero__stage">
			<div class="pm-phone pm-hero__phone">
				<?php paymerch_img( 'phone-frame.png', '', 'pm-phone__frame', array( 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?>
				<?php get_template_part( 'template-parts/phone-screen', null, array( 'variant' => 'hero' ) ); ?>

				<?php if ( '' !== trim( paymerch_get( 'chip1_big' ) ) ) : ?>
					<div class="pm-chip pm-chip--corridors" aria-hidden="true">
						<span class="pm-chip__flags">
							<img src="<?php echo esc_url( paymerch_flag_url( 'mx' ) ); ?>" alt="" width="80" height="60" loading="lazy">
							<img src="<?php echo esc_url( paymerch_flag_url( 'co' ) ); ?>" alt="" width="80" height="60" loading="lazy">
						</span>
						<span class="pm-chip__txt"><small><?php paymerch_field( 'chip1_small' ); ?></small><b><?php paymerch_field( 'chip1_big' ); ?></b></span>
					</div>
				<?php endif; ?>
				<?php if ( '' !== trim( paymerch_get( 'chip2_big' ) ) ) : ?>
					<div class="pm-chip pm-chip--fee" aria-hidden="true">
						<span class="pm-chip__ico"><?php paymerch_field( 'chip2_icon' ); ?></span>
						<span class="pm-chip__txt"><small><?php paymerch_field( 'chip2_small' ); ?></small><b><?php paymerch_field( 'chip2_big' ); ?></b></span>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="pm-hero__stores">
			<a href="<?php echo esc_url( paymerch_get( 'play_store_url' ) ); ?>" target="_blank" rel="noopener">
				<?php paymerch_img( 'badge-google-play-es.png', __( 'Get it on Google Play', 'paymerch' ) ); ?>
			</a>
			<?php if ( '' !== paymerch_get( 'qr_image' ) ) { paymerch_image( 'qr_image', __( 'QR code to download the Paymerch app', 'paymerch' ), 'pm-hero__qr' ); } ?>
			<a href="<?php echo esc_url( paymerch_get( 'app_store_url' ) ); ?>" target="_blank" rel="noopener">
				<?php paymerch_img( 'badge-app-store-es.png', __( 'Download on the App Store', 'paymerch' ) ); ?>
			</a>
		</div>
	</div>
</section>
