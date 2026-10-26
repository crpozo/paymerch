<?php
/**
 * Template Name: Send Abroad (International Payments)
 *
 * Figma: Page 2 → International Payments.
 *
 * @package Paymerch_Figma
 */

get_header();

get_template_part(
	'template-parts/hero-sage',
	null,
	array(
		'badge'     => __( 'INTERNATIONAL TRANSFERS', 'paymerch-figma' ),
		'title'     => __( 'Make every dollar count.', 'paymerch-figma' ),
		'text'      => __( 'Sending money abroad is about more than the amount you transfer. See the applicable fee, exchange rate, and expected amount your recipient will receive when sending from the U.S. to Mexico or Colombia.', 'paymerch-figma' ),
		'calc_href' => home_url( '/#top' ),
	)
);

$pmf_destinations = array(
	array( 'mexico', 'mexico.jpg', 'flag-mx.png', __( 'Send money to Mexico', 'paymerch-figma' ), __( 'Explore available delivery options to supported Mexican banks and payment networks.', 'paymerch-figma' ), 'arrow-circle-md.svg', 50.9986 ),
	array( 'colombia', 'colombia.jpg', 'flag-co.png', __( 'Send money to Colombia', 'paymerch-figma' ), __( 'Explore available delivery options to supported Colombian banks and payment networks.', 'paymerch-figma' ), 'arrow-circle-lg.svg', 53.1285 ),
);

$pmf_benefits = array(
	array( __( 'See the exchange rate', 'paymerch-figma' ), __( 'Review the rate shown for your transfer before confirming.', 'paymerch-figma' ) ),
	array( __( 'Understand the cost', 'paymerch-figma' ), __( 'Check the applicable fee and see how much your recipient is expected to receive.', 'paymerch-figma' ) ),
	array( __( 'Explore delivery options', 'paymerch-figma' ), __( 'Find the available delivery methods for your destination.', 'paymerch-figma' ) ),
);
?>

<!-- Where are you sending money? (cards overlap the dark section below) -->
<section class="pm-where" id="destinations">
	<div class="pm-container">
		<h2 class="pm-h2 pm-where__title"><?php esc_html_e( 'Where are you', 'paymerch-figma' ); ?><br><?php esc_html_e( 'sending money?', 'paymerch-figma' ); ?></h2>
		<p class="pm-lead pm-where__lead"><?php esc_html_e( 'Choose your destination to explore available transfer and delivery options.', 'paymerch-figma' ); ?></p>
		<div class="pm-where__cards">
			<?php foreach ( $pmf_destinations as $pmf_d ) : ?>
				<a class="pm-where-card pm-where-card--<?php echo esc_attr( $pmf_d[0] ); ?>" href="<?php echo esc_url( pmf_page_url( $pmf_d[0] ) ); ?>">
					<img class="pm-where-card__img" src="<?php echo esc_url( pmf_asset( 'img/' . $pmf_d[1] ) ); ?>" alt="" width="571" height="418" loading="lazy">
					<span class="pm-where-card__panel">
						<img class="pm-where-card__flag" src="<?php echo esc_url( pmf_asset( 'img/' . $pmf_d[2] ) ); ?>" alt="" width="50" height="50" loading="lazy">
						<span class="pm-where-card__name"><?php echo esc_html( $pmf_d[3] ); ?></span>
						<span class="pm-where-card__text"><?php echo esc_html( $pmf_d[4] ); ?></span>
						<img class="pm-where-card__arrow" src="<?php echo esc_url( pmf_asset( 'img/' . $pmf_d[5] ) ); ?>" alt="" width="<?php echo esc_attr( $pmf_d[6] ); ?>" height="<?php echo esc_attr( $pmf_d[6] ); ?>">
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Know the details. Make your move. -->
<section class="pm-details">
	<div class="pm-container">
		<h2 class="pm-h2 pm-details__title"><?php esc_html_e( 'Know the details.', 'paymerch-figma' ); ?><br><?php esc_html_e( 'Make your move.', 'paymerch-figma' ); ?></h2>
		<ul class="pm-details__list">
			<?php foreach ( $pmf_benefits as $pmf_i => $pmf_b ) : ?>
				<li class="pm-pillar">
					<span class="pm-pillar__label"><?php echo esc_html( sprintf( /* translators: %d: number */ __( 'Benefit %d', 'paymerch-figma' ), $pmf_i + 1 ) ); ?></span>
					<h3 class="pm-pillar__title"><?php echo esc_html( $pmf_b[0] ); ?></h3>
					<p class="pm-pillar__text"><?php echo esc_html( $pmf_b[1] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<!-- From your account to theirs -->
<section class="pm-flow">
	<div class="pm-container">
		<h2 class="pm-h2 pm-flow__title"><?php esc_html_e( 'From your', 'paymerch-figma' ); ?><br><?php esc_html_e( 'account to theirs.', 'paymerch-figma' ); ?></h2>
		<?php get_template_part( 'template-parts/how-it-works', null, array( 'class' => 'pm-flow__list' ) ); ?>
		<a class="pm-btn pm-flow__btn" href="<?php echo esc_url( home_url( '/#top' ) ); ?>"><?php esc_html_e( 'Calculate your transfer', 'paymerch-figma' ); ?></a>
	</div>
</section>

<!-- Clear information. Support when you need it. -->
<section class="pm-help">
	<div class="pm-help__inner">
		<div class="pm-help__card" aria-hidden="true"></div>
		<img class="pm-help__lock" src="<?php echo esc_url( pmf_asset( 'img/lock.png' ) ); ?>" alt="" width="544" height="544" loading="lazy">
		<div class="pm-help__copy">
			<h2 class="pm-h2 pm-h2--hakter"><?php esc_html_e( 'Clear information. Support when you need it.', 'paymerch-figma' ); ?></h2>
			<p class="pm-lead"><?php esc_html_e( "Explore Paymerch's security information and available support options before making your transfer.", 'paymerch-figma' ); ?></p>
			<a class="pm-btn pm-btn--lime pm-security__btn" href="<?php echo esc_url( get_theme_mod( 'pmf_security_url', '#' ) ); ?>"><?php esc_html_e( 'Explore security and support', 'paymerch-figma' ); ?></a>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/early-access' );

get_footer();
