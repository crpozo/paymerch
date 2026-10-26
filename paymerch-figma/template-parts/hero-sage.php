<?php
/**
 * Centered sage hero (Send Abroad, Mexico, Colombia): badge, headline,
 * paragraph and two buttons over the green brand shape.
 *
 * Args: badge, title, text, wide (bool, 653px headline instead of 545px),
 * calc_href.
 *
 * @package Paymerch_Figma
 */

$pmf_args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'badge'     => '',
		'title'     => '',
		'text'      => '',
		'wide'      => false,
		'calc_href' => '#calculator',
	)
);
?>
<section class="pm-shero">
	<img class="pm-shero__shape" src="<?php echo esc_url( pmf_asset( 'img/hero-shape-green.svg' ) ); ?>" alt="" width="769" height="928.466" aria-hidden="true">
	<div class="pm-container pm-shero__inner">
		<p class="pm-badge"><span class="pm-badge__dot" aria-hidden="true"></span><?php echo esc_html( $pmf_args['badge'] ); ?></p>
		<h1 class="pm-shero__title<?php echo $pmf_args['wide'] ? ' pm-shero__title--wide' : ''; ?>"><?php echo esc_html( $pmf_args['title'] ); ?></h1>
		<p class="pm-shero__text"><?php echo esc_html( $pmf_args['text'] ); ?></p>
		<div class="pm-shero__actions">
			<a class="pm-btn pm-btn--pill pm-btn--indigo-lime" href="<?php echo esc_url( $pmf_args['calc_href'] ); ?>"><?php esc_html_e( 'Calculate your transfer', 'paymerch-figma' ); ?></a>
			<a class="pm-btn pm-btn--pill pm-btn--lavender" href="<?php echo esc_url( pmf_page_url( 'international', '#destinations' ) ); ?>"><?php esc_html_e( 'Explore destinations', 'paymerch-figma' ); ?></a>
		</div>
	</div>
</section>
