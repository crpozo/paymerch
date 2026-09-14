<?php
/**
 * Section 7 — "Built by Real People Who Understand the Value of Every Dollar" + contact form.
 *
 * @package Paymerch
 */
?>
<section class="pm-builtby" id="contact">
	<div class="pm-builtby__bg" aria-hidden="true">
		<?php paymerch_image( 'builtby_photo', '', 'pm-builtby__photo' ); ?>
	</div>

	<div class="pm-wrap pm-builtby__wrap">
		<div class="pm-builtby__content">
			<h2 class="pm-builtby__title"><?php paymerch_field( 'builtby_title' ); ?></h2>
			<p class="pm-builtby__text"><?php paymerch_field( 'builtby_text' ); ?></p>
		</div>

		<div class="pm-contact">
			<h3 class="pm-contact__title"><?php paymerch_field( 'contact_title' ); ?></h3>
			<p class="pm-contact__sub"><?php paymerch_field( 'contact_sub' ); ?></p>

			<form class="pm-contact__form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="paymerch_contact">
				<?php wp_nonce_field( 'pm_contact', 'pm_contact_nonce' ); ?>
				<div class="pm-contact__row">
					<label class="screen-reader-text" for="pm-contact-name"><?php esc_html_e( 'Full Name', 'paymerch' ); ?></label>
					<input class="pm-contact__input" id="pm-contact-name" type="text" name="pm_name" placeholder="<?php esc_attr_e( 'Full Name', 'paymerch' ); ?>" autocomplete="name" required>
					<label class="screen-reader-text" for="pm-contact-email"><?php esc_html_e( 'Email Address', 'paymerch' ); ?></label>
					<input class="pm-contact__input" id="pm-contact-email" type="email" name="pm_email" placeholder="<?php esc_attr_e( 'Email Address', 'paymerch' ); ?>" autocomplete="email" required>
				</div>
				<label class="screen-reader-text" for="pm-contact-message"><?php esc_html_e( 'Message', 'paymerch' ); ?></label>
				<textarea class="pm-contact__input pm-contact__textarea" id="pm-contact-message" name="pm_message" placeholder="<?php esc_attr_e( 'Message', 'paymerch' ); ?>" required></textarea>
				<input class="pm-hp" type="text" name="pm_website" tabindex="-1" autocomplete="off" aria-hidden="true">
				<div class="pm-contact__actions">
					<?php paymerch_form_notice( 'contact' ); ?>
					<button class="pm-contact__btn" type="submit"><?php paymerch_field( 'contact_button' ); ?></button>
				</div>
			</form>
		</div>
	</div>
</section>
