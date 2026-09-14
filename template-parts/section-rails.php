<?php
/**
 * Section 4 — "Local Rails": two corridor cards. Hovering / tapping a card
 * expands it. Bank logos (assets/img/bank-*.png) show under option 1 of
 * corridor 1; replace the files to change them.
 *
 * @package Paymerch
 */

$pm_bank_logos = array(
	'bank-bbva.png'      => 'BBVA',
	'bank-banorte.png'   => 'Banorte',
	'bank-santander.png' => 'Santander',
	'bank-azteca.png'    => 'Banco Azteca',
	'bank-bancoppel.png' => 'BanCoppel',
);
$pm_rails      = array(
	array( 'id' => 'mexico', 'n' => 1, 'logos' => $pm_bank_logos ),
	array( 'id' => 'colombia', 'n' => 2, 'logos' => array() ),
);
?>
<section class="pm-rails" id="local-rails">
	<div class="pm-wrap pm-rails__wrap">
		<h2 class="pm-rails__title"><?php paymerch_field( 'rails_title' ); ?></h2>

		<div class="pm-rails__grid" data-rails>
			<?php foreach ( $pm_rails as $pm_rail ) : ?>
				<?php $pm_n = $pm_rail['n']; ?>
				<article class="pm-rail pm-rail--<?php echo esc_attr( $pm_rail['id'] ); ?>" data-rail>
					<div class="pm-rail__media">
						<?php paymerch_image( "rail{$pm_n}_photo", '', 'pm-rail__photo' ); ?>
						<div class="pm-rail__shade" aria-hidden="true"></div>

						<div class="pm-rail__detail">
							<h3 class="pm-rail__heading"><?php paymerch_field( "rail{$pm_n}_title" ); ?></h3>
							<p class="pm-rail__text"><?php paymerch_field( "rail{$pm_n}_text" ); ?></p>

							<ul class="pm-acc">
								<?php foreach ( array( 1, 2 ) as $pm_j ) : ?>
									<?php if ( '' === trim( paymerch_get( "rail{$pm_n}_item{$pm_j}" ) ) ) { continue; } ?>
									<li class="pm-acc__item<?php echo 1 === $pm_j ? ' is-open' : ''; ?>">
										<button class="pm-acc__btn" type="button" aria-expanded="<?php echo 1 === $pm_j ? 'true' : 'false'; ?>" data-acc>
											<span><?php paymerch_field( "rail{$pm_n}_item{$pm_j}" ); ?></span>
											<?php paymerch_icon( 'icon-caret', 'pm-acc__caret' ); ?>
										</button>
										<div class="pm-acc__panel">
											<div>
												<?php if ( 1 === $pm_j && $pm_rail['logos'] ) : ?>
													<div class="pm-acc__logos">
														<?php foreach ( $pm_rail['logos'] as $pm_file => $pm_alt ) : ?>
															<?php paymerch_img( $pm_file, $pm_alt, 'pm-acc__logo pm-acc__logo--' . sanitize_html_class( str_replace( array( 'bank-', '.png' ), '', $pm_file ) ) ); ?>
														<?php endforeach; ?>
													</div>
												<?php endif; ?>
											</div>
										</div>
									</li>
								<?php endforeach; ?>
							</ul>

							<p class="pm-rail__note"><?php paymerch_field( "rail{$pm_n}_note" ); ?></p>
						</div>
					</div>

					<button class="pm-rail__toggle" type="button" aria-expanded="false" data-rail-toggle>
						<span class="screen-reader-text">
							<?php
							/* translators: %s: corridor name */
							printf( esc_html__( 'Show %s corridor details', 'paymerch' ), esc_html( paymerch_get( "rail{$pm_n}_name" ) ) );
							?>
						</span>
					</button>

					<div class="pm-rail__label">
						<?php paymerch_image( "rail{$pm_n}_flag", '', 'pm-rail__flag' ); ?>
						<div class="pm-rail__name">
							<strong><?php paymerch_field( "rail{$pm_n}_name" ); ?></strong>
							<span><?php paymerch_field( "rail{$pm_n}_label" ); ?></span>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
