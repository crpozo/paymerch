<?php
/**
 * Section 2 — "See Exactly What Arrives Before You Tap Send."
 *
 * @package Paymerch
 */
?>
<section class="pm-see" id="see-exactly">
	<div class="pm-wrap pm-see__wrap">
		<div class="pm-see__phone pm-phone">
			<?php paymerch_img( 'phone-frame.png', '', 'pm-phone__frame' ); ?>
			<?php get_template_part( 'template-parts/phone-screen', null, array( 'variant' => 'app' ) ); ?>
		</div>

		<div class="pm-see__content">
			<h2 class="pm-see__title"><?php paymerch_field( 'see_title' ); ?></h2>
			<p class="pm-see__text"><?php paymerch_field( 'see_text' ); ?></p>
			<a class="pm-btn pm-btn--see" href="<?php echo esc_url( paymerch_get( 'see_cta_url' ) ); ?>">
				<strong><?php paymerch_field( 'see_cta' ); ?></strong>
				<?php paymerch_icon( 'icon-chevron', 'pm-btn__chev pm-btn__chev--sm' ); ?>
			</a>
		</div>
	</div>
</section>
