<?php
/**
 * Section 6 — "Built for Your Phone." Waitlist form and the two store badges
 * (coming soon) in one column on the purple band; the phone on the right.
 *
 * @package Paymerch
 */
?>
<section class="pm-built" id="waitlist">
	<div class="pm-wrap pm-built__wrap">
		<div class="pm-built__head">
			<h2 class="pm-built__title"><?php paymerch_field( 'built_title' ); ?></h2>
			<p class="pm-built__sub"><?php paymerch_field( 'built_sub' ); ?></p>
		</div>

		<div class="pm-built__band">
			<p class="pm-built__text"><?php paymerch_field( 'built_text' ); ?></p>
			<p class="pm-built__text pm-built__text--strong"><?php paymerch_field( 'built_text_strong' ); ?></p>

			<form class="pm-waitlist" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="paymerch_waitlist">
				<?php wp_nonce_field( 'pm_waitlist', 'pm_waitlist_nonce' ); ?>
				<label class="screen-reader-text" for="pm-waitlist-contact"><?php esc_html_e( 'Email or phone number', 'paymerch' ); ?></label>
				<input class="pm-waitlist__input" id="pm-waitlist-contact" type="text" name="pm_contact" placeholder="<?php echo esc_attr( paymerch_get( 'waitlist_placeholder' ) ); ?>" autocomplete="email" required>
				<input class="pm-hp" type="text" name="pm_website" tabindex="-1" autocomplete="off" aria-hidden="true">
				<button class="pm-waitlist__btn" type="submit"><?php paymerch_field( 'waitlist_button' ); ?></button>
			</form>
			<?php paymerch_form_notice( 'waitlist' ); ?>

			<div class="pm-built__stores">
				<a class="pm-built__badge" href="<?php echo esc_url( paymerch_get( 'play_store_url' ) ); ?>" target="_blank" rel="noopener">
					<?php paymerch_img( 'play-store.png', __( 'Coming soon on Google Play', 'paymerch' ) ); ?>
				</a>
				<a class="pm-built__badge" href="<?php echo esc_url( paymerch_get( 'app_store_url' ) ); ?>" target="_blank" rel="noopener">
					<?php paymerch_img( 'app-store.png', __( 'Coming soon on the App Store', 'paymerch' ) ); ?>
				</a>
			</div>
		</div>

		<div class="pm-built__phone" aria-hidden="true">
			<?php paymerch_image( 'built_phone', '' ); ?>
		</div>
	</div>
</section>
