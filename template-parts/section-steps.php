<?php
/**
 * Section 5 — "Sending Money Home in 5 Simple Steps."
 *
 * @package Paymerch
 */

$pm_custom_photo = paymerch_get( 'steps_photo' ) !== paymerch_asset( 'img/onmobile.png' );
?>
<section class="pm-steps" id="steps">
	<div class="pm-wrap pm-steps__wrap">
		<h2 class="pm-steps__title"><?php paymerch_field( 'steps_title' ); ?></h2>

		<div class="pm-steps__body">
			<div class="pm-steps__art" aria-hidden="true">
				<?php paymerch_img( 'marca-verde.png', '', 'pm-steps__mark' ); ?>
				<?php if ( $pm_custom_photo ) : ?>
					<div class="pm-steps__couple"><?php paymerch_image( 'steps_photo', '' ); ?></div>
				<?php else : ?>
					<picture class="pm-steps__couple">
						<source srcset="<?php echo esc_url( paymerch_asset( 'img/onmobile.webp' ) ); ?>" type="image/webp">
						<?php paymerch_img( 'onmobile.png', '' ); ?>
					</picture>
				<?php endif; ?>
			</div>

			<ol class="pm-steps__list">
				<?php for ( $pm_i = 1; $pm_i <= 5; $pm_i++ ) : ?>
					<?php if ( '' === trim( paymerch_get( "step{$pm_i}_title" ) ) ) { continue; } ?>
					<li class="pm-step">
						<span class="pm-step__num"><?php echo (int) $pm_i; ?></span>
						<div class="pm-step__body">
							<h3 class="pm-step__title"><?php paymerch_field( "step{$pm_i}_title" ); ?></h3>
							<p class="pm-step__text"><?php paymerch_field( "step{$pm_i}_text" ); ?></p>
							<?php if ( 1 === $pm_i ) : ?>
								<div class="pm-step__download">
									<?php if ( '' !== paymerch_get( 'qr_image' ) ) { paymerch_image( 'qr_image', __( 'QR code to download the Paymerch app', 'paymerch' ), 'pm-step__qr' ); } ?>
									<div class="pm-step__badges">
										<a href="<?php echo esc_url( paymerch_get( 'play_store_url' ) ); ?>" target="_blank" rel="noopener">
											<?php paymerch_img( 'badge-google-play-es.png', __( 'Get it on Google Play', 'paymerch' ) ); ?>
										</a>
										<a href="<?php echo esc_url( paymerch_get( 'app_store_url' ) ); ?>" target="_blank" rel="noopener">
											<?php paymerch_img( 'badge-app-store-es.png', __( 'Download on the App Store', 'paymerch' ) ); ?>
										</a>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</li>
				<?php endfor; ?>
			</ol>
		</div>
	</div>
</section>
