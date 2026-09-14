<?php
/**
 * Section 3 — "Your Hard-Earned Money, Protected at Every Step"
 *
 * @package Paymerch
 */

$pm_icons = array( 1 => 'icon-shield', 2 => 'icon-headset', 3 => 'icon-badge' );
?>
<section class="pm-protected" id="protected">
	<div class="pm-wrap pm-protected__wrap">
		<div class="pm-protected__content">
			<h2 class="pm-protected__title"><?php paymerch_field( 'protected_title' ); ?></h2>
			<p class="pm-protected__text"><?php paymerch_field( 'protected_text' ); ?></p>
			<a class="pm-btn pm-btn--protected" href="<?php echo esc_url( paymerch_get( 'protected_cta_url' ) ); ?>">
				<strong><?php paymerch_field( 'protected_cta' ); ?></strong>
				<?php paymerch_icon( 'icon-chevron', 'pm-btn__chev' ); ?>
			</a>
		</div>

		<ul class="pm-cards">
			<?php foreach ( $pm_icons as $pm_i => $pm_icon ) : ?>
				<?php if ( '' === trim( paymerch_get( "card{$pm_i}_title" ) ) ) { continue; } ?>
				<li class="pm-card pm-card--<?php echo (int) $pm_i; ?>">
					<span class="pm-card__icon"><?php paymerch_icon( $pm_icon ); ?></span>
					<h3 class="pm-card__title"><?php paymerch_field( "card{$pm_i}_title" ); ?></h3>
					<p class="pm-card__text"><?php paymerch_field( "card{$pm_i}_text" ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
