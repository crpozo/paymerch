<?php
/**
 * Early access block: indigo card over the photo of a man with his phone.
 * Used by the home page, Send Abroad and the country pages.
 *
 * Args: title, text (optional, default to the home page copy).
 *
 * @package Paymerch_Figma
 */

$pmf_args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'title' => __( 'Ready to make your next move?', 'paymerch-figma' ),
		'text'  => __( 'Sign up for Paymerch updates and be among the first to hear about product news and access availability.', 'paymerch-figma' ),
	)
);
?>
<section class="pm-early" id="early-access">
	<img class="pm-early__photo" src="<?php echo esc_url( pmf_asset( 'img/early-access-man.png' ) ); ?>" alt="<?php esc_attr_e( 'Man smiling at his phone', 'paymerch-figma' ); ?>" width="1672" height="941" loading="lazy">
	<div class="pm-early__card">
		<p class="pm-eyebrow"><?php esc_html_e( 'EARLY ACCESS', 'paymerch-figma' ); ?></p>
		<h2 class="pm-h2 pm-early__title"><?php echo esc_html( $pmf_args['title'] ); ?></h2>
		<p class="pm-lead pm-early__text"><?php echo esc_html( $pmf_args['text'] ); ?></p>
		<form class="pm-early__form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="pmf_waitlist">
			<?php wp_nonce_field( 'pmf_waitlist', 'pmf_nonce' ); ?>
			<label class="screen-reader-text" for="pm-early-contact"><?php esc_html_e( 'Email or phone number', 'paymerch-figma' ); ?></label>
			<input class="pm-input" id="pm-early-contact" name="contact" type="text" required autocomplete="email" placeholder="<?php esc_attr_e( 'Email or phone number', 'paymerch-figma' ); ?>">
			<button class="pm-btn pm-btn--lime pm-early__btn" type="submit"><?php esc_html_e( 'Get early access', 'paymerch-figma' ); ?></button>
			<?php pmf_waitlist_message( 'pm-early__msg' ); ?>
		</form>
	</div>
</section>
