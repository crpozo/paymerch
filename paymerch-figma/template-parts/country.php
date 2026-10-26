<?php
/**
 * Country landing (Figma: Colombia Landing Page / Mexico Landing Page).
 *
 * Args: country — "colombia" or "mexico".
 *
 * @package Paymerch_Figma
 */

$pmf_key = ( isset( $args['country'] ) && 'mexico' === $args['country'] ) ? 'mexico' : 'colombia';

$pmf_countries = array(
	'colombia' => array(
		'name'     => __( 'Colombia', 'paymerch-figma' ),
		'corridor' => 'COP',
		'badge'    => __( 'SEND MONEY TO COLOMBIA', 'paymerch-figma' ),
		'title'    => __( 'Make your money move to Colombia.', 'paymerch-figma' ),
		'text'     => __( 'Sending money from the U.S. to Colombia starts with knowing the numbers. Review the applicable fee, exchange rate, and amount your recipient is expected to receive before you confirm.', 'paymerch-figma' ),
		'networks' => __( 'Supported Colombian banks and payment networks.', 'paymerch-figma' ),
		'photo'    => array( 'editorial-co.jpg', '50% 50%' ),
		// file, width, height (as placed in Figma), extra class.
		'banks'    => array(
			array( 'bancolombia.png', 'Bancolombia', 204.255, 48, '' ),
			array( 'davivienda.png', 'Davivienda', 210, 24, '' ),
			array( 'nequi.png', 'Nequi', 166, 87, '' ),
			array( 'daviplata.png', 'DaviPlata', 159, 125, '' ),
			array( 'banco-de-bogota.png', 'Banco de Bogotá', 231, 43, '' ),
		),
		'clarity'  => __( "Know what you're paying, understand the exchange rate, and explore how your money can reach your recipient in Colombia.", 'paymerch-figma' ),
		'delivery' => __( 'Explore the supported delivery methods available for transfers to Colombia.', 'paymerch-figma' ),
		'beyond'   => __( 'The exchange rate also affects how much your recipient receives. Review the transfer details together so you can make a more informed decision before sending money to Colombia.', 'paymerch-figma' ),
		'early'    => __( 'Make your next move toward Colombia.', 'paymerch-figma' ),
	),
	'mexico'   => array(
		'name'     => __( 'Mexico', 'paymerch-figma' ),
		'corridor' => 'MXN',
		'badge'    => __( 'SEND MONEY TO MEXICO', 'paymerch-figma' ),
		'title'    => __( 'Make your money move to Mexico.', 'paymerch-figma' ),
		'text'     => __( 'Sending money from the U.S. to Mexico starts with knowing the numbers. Review the applicable fee, exchange rate, and amount your recipient is expected to receive before you confirm.', 'paymerch-figma' ),
		'networks' => __( 'Supported Mexican banks and payment networks.', 'paymerch-figma' ),
		'photo'    => array( 'editorial-mx.jpg', '50% 41.95%' ),
		'banks'    => array(
			array( 'bbva.png', 'BBVA', 84, 25, '' ),
			array( 'bancoppel.png', 'BanCoppel', 144, 25, '' ),
			array( 'banorte.png', 'Banorte', 161, 20, '' ),
			array( 'santander.png', 'Santander', 170, 60, '' ),
			array( 'banco-azteca.png', 'Banco Azteca', 141, 57, '' ),
			array( 'oxxo.png', 'OXXO', 78, 40, 'pm-banks__logo--mirror' ),
			array( 'spei.png', 'SPEI', 98, 33, '' ),
		),
		'clarity'  => __( "Know what you're paying, understand the exchange rate, and explore how your money can reach your recipient in Mexico.", 'paymerch-figma' ),
		'delivery' => __( 'Explore the supported delivery methods available for transfers to Mexico.', 'paymerch-figma' ),
		'beyond'   => __( 'The exchange rate also affects how much your recipient receives. Review the transfer details together so you can make a more informed decision before sending money to Mexico.', 'paymerch-figma' ),
		'early'    => __( 'Make your next move toward Mexico.', 'paymerch-figma' ),
	),
);
$pmf_c = $pmf_countries[ $pmf_key ];

$pmf_advantages = array(
	array( 'percent.svg', 14.8333, 14.8333, __( 'Know', 'paymerch-figma' ) . '<br>' . __( 'the rate', 'paymerch-figma' ), __( 'Review the exchange rate shown for your transfer before confirming.', 'paymerch-figma' ) ),
	array( 'clock.svg', 17.8, 20.8, __( 'See what', 'paymerch-figma' ) . '<br>' . __( 'arrives', 'paymerch-figma' ), __( 'Check the expected amount your recipient will receive.', 'paymerch-figma' ) ),
	array( 'check.svg', 18.15, 18.15, __( 'Choose your delivery option', 'paymerch-figma' ), $pmf_c['delivery'] ),
);

get_template_part(
	'template-parts/hero-sage',
	null,
	array(
		'badge' => $pmf_c['badge'],
		'title' => $pmf_c['title'],
		'text'  => $pmf_c['text'],
		'wide'  => true,
	)
);
?>

<!-- Explore available delivery options (bank carousel) -->
<section class="pm-banks pm-banks--<?php echo esc_attr( $pmf_key ); ?>">
	<div class="pm-container">
		<h2 class="pm-h2 pm-banks__title"><?php esc_html_e( 'Explore available delivery options', 'paymerch-figma' ); ?></h2>
		<p class="pm-lead pm-banks__lead"><?php echo esc_html( $pmf_c['networks'] ); ?></p>
	</div>
	<div class="pm-banks__carousel" data-pm-carousel>
		<button class="pm-banks__arrow pm-banks__arrow--prev" type="button" data-pm-prev aria-label="<?php esc_attr_e( 'Previous', 'paymerch-figma' ); ?>">
			<img src="<?php echo esc_url( pmf_asset( 'img/icons/chevron-left.svg' ) ); ?>" alt="" width="45" height="45">
		</button>
		<ul class="pm-banks__track" data-pm-track>
			<?php foreach ( $pmf_c['banks'] as $pmf_bank ) : ?>
				<li class="pm-banks__item">
					<img class="pm-banks__logo <?php echo esc_attr( $pmf_bank[4] ); ?>" src="<?php echo esc_url( pmf_asset( 'img/banks/' . $pmf_bank[0] ) ); ?>" alt="<?php echo esc_attr( $pmf_bank[1] ); ?>" width="<?php echo esc_attr( $pmf_bank[2] ); ?>" height="<?php echo esc_attr( $pmf_bank[3] ); ?>" loading="lazy">
				</li>
			<?php endforeach; ?>
		</ul>
		<button class="pm-banks__arrow pm-banks__arrow--next" type="button" data-pm-next aria-label="<?php esc_attr_e( 'Next', 'paymerch-figma' ); ?>">
			<img src="<?php echo esc_url( pmf_asset( 'img/icons/chevron-right.svg' ) ); ?>" alt="" width="45" height="45">
		</button>
	</div>
</section>

<img class="pm-editorial" src="<?php echo esc_url( pmf_asset( 'img/' . $pmf_c['photo'][0] ) ); ?>" alt="" width="1440" height="320" loading="lazy" style="object-position: <?php echo esc_attr( $pmf_c['photo'][1] ); ?>">

<!-- More clarity with every transfer (Benefits / How it works tabs) -->
<section class="pm-clarity">
	<div class="pm-container">
		<div class="pm-tabs" role="tablist" aria-label="<?php esc_attr_e( 'More clarity with every transfer', 'paymerch-figma' ); ?>" data-pm-tabs>
			<button class="pm-tabs__tab" type="button" role="tab" id="pm-tab-benefits" aria-controls="pm-panel-benefits" aria-selected="true"><?php esc_html_e( 'Benefits', 'paymerch-figma' ); ?></button>
			<button class="pm-tabs__tab" type="button" role="tab" id="pm-tab-how" aria-controls="pm-panel-how" aria-selected="false" tabindex="-1"><?php esc_html_e( 'How it works', 'paymerch-figma' ); ?></button>
		</div>
		<h2 class="pm-h2 pm-clarity__title"><?php esc_html_e( 'More clarity with every transfer.', 'paymerch-figma' ); ?></h2>
		<p class="pm-lead pm-clarity__lead"><?php echo esc_html( $pmf_c['clarity'] ); ?></p>

		<div class="pm-clarity__panel" role="tabpanel" id="pm-panel-benefits" aria-labelledby="pm-tab-benefits">
			<ul class="pm-adv">
				<?php foreach ( $pmf_advantages as $pmf_a ) : ?>
					<li class="pm-adv__card">
						<span class="pm-adv__icon"><img src="<?php echo esc_url( pmf_asset( 'img/icons/' . $pmf_a[0] ) ); ?>" alt="" width="<?php echo esc_attr( $pmf_a[1] ); ?>" height="<?php echo esc_attr( $pmf_a[2] ); ?>"></span>
						<h3 class="pm-adv__title"><?php echo wp_kses( $pmf_a[3], array( 'br' => array() ) ); ?></h3>
						<p class="pm-adv__text"><?php echo esc_html( $pmf_a[4] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="pm-clarity__panel" role="tabpanel" id="pm-panel-how" aria-labelledby="pm-tab-how" hidden>
			<?php get_template_part( 'template-parts/how-it-works', null, array( 'class' => 'pm-howto--cards' ) ); ?>
		</div>

		<a class="pm-btn pm-btn--lime pm-clarity__btn" href="#calculator"><?php esc_html_e( 'Calculate your transfer', 'paymerch-figma' ); ?></a>
	</div>
</section>

<!-- Look beyond the transfer fee (calculator + copy) -->
<section class="pm-beyond" id="calculator">
	<div class="pm-beyond__inner">
		<div class="pm-beyond__card" aria-hidden="true"></div>
		<div class="pm-beyond__calc"><?php pmf_calculator( 'card', $pmf_c['corridor'] ); ?></div>
		<div class="pm-beyond__copy">
			<h2 class="pm-h2 pm-h2--hakter"><?php esc_html_e( 'Look beyond the transfer fee.', 'paymerch-figma' ); ?></h2>
			<p class="pm-lead"><?php echo esc_html( $pmf_c['beyond'] ); ?></p>
			<a class="pm-btn pm-btn--lime pm-beyond__btn" href="#calculator" data-pm-focus-calc><?php esc_html_e( 'Calculate your transfer', 'paymerch-figma' ); ?></a>
		</div>
	</div>
</section>

<?php
get_template_part(
	'template-parts/early-access',
	null,
	array(
		'title' => $pmf_c['early'],
		'text'  => __( 'Sign up for Paymerch updates and information about access availability.', 'paymerch-figma' ),
	)
);
