<?php
/**
 * The app screen drawn inside the phone frames (hero + "See exactly").
 *
 * A working transfer calculator in the spirit of Wise: type what you send (or
 * what they receive) and pick either currency from a searchable list. Rates,
 * fee, starting amount and every label come from Appearance → Customize →
 * Paymerch → Phone calculator.
 *
 * Sizes use container-query units (cqw) so the same markup scales with the
 * width of the screen it is placed in.
 *
 * @package Paymerch
 * @var array $args { 'variant' => 'hero'|'app' }
 */

$pm_variant = isset( $args['variant'] ) ? $args['variant'] : 'hero';
$pm_is_app  = 'app' === $pm_variant;
$pm_id      = wp_unique_id( 'pm-calc-' );
$pm_cur     = paymerch_calc_currencies();
$pm_by_code = array_column( $pm_cur['currencies'], null, 'code' );
$pm_send    = $pm_by_code[ $pm_cur['send'] ];
$pm_recv    = $pm_by_code[ $pm_cur['receive'] ];
$pm_fee     = paymerch_calc_fee();
$pm_amount  = paymerch_calc_amount();
$pm_receive = max( 0, $pm_amount - $pm_fee ) * $pm_recv['rate'] / $pm_send['rate'];
$pm_caret   = '<svg class="pm-screen__caret" viewBox="0 0 16 10" aria-hidden="true" focusable="false"><path d="M1.5 1.8 8 8.2l6.5-6.4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
?>
<div class="pm-screen pm-screen--<?php echo esc_attr( $pm_variant ); ?>" data-calc data-fee="<?php echo esc_attr( $pm_fee ); ?>" data-currencies="<?php echo esc_attr( wp_json_encode( $pm_cur ) ); ?>">
	<?php if ( $pm_is_app ) : ?>
		<div class="pm-screen__bar" aria-hidden="true">
			<?php paymerch_img( 'logo-blanco.png', '', 'pm-screen__logo' ); ?>
		</div>
	<?php endif; ?>
	<div class="pm-screen__island" aria-hidden="true"></div>

	<div class="pm-screen__rate">
		<div class="pm-screen__rate-label"><?php paymerch_field( 'calc_rate_label' ); ?></div>
		<div class="pm-screen__rate-value" data-calc-rate aria-live="polite"><?php echo esc_html( '1 ' . $pm_send['code'] . ' = ' . paymerch_money( $pm_recv['rate'] / $pm_send['rate'] ) . ' ' . $pm_recv['code'] ); ?></div>
	</div>

	<div class="pm-screen__hr"></div>

	<div class="pm-screen__row">
		<div class="pm-screen__cur">
			<label class="pm-screen__label" for="<?php echo esc_attr( $pm_id ); ?>-send"><?php paymerch_field( 'calc_send_label' ); ?></label>
			<button type="button" class="pm-screen__pill" data-picker-open="send" aria-haspopup="dialog" aria-expanded="false" aria-controls="<?php echo esc_attr( $pm_id ); ?>-picker">
				<img class="pm-screen__flag" src="<?php echo esc_url( $pm_send['flag'] ); ?>" alt="" width="80" height="60" data-pill-flag>
				<span data-pill-code><?php echo esc_html( $pm_send['code'] ); ?></span>
				<?php echo $pm_caret; // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG. ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Change the currency you send', 'paymerch' ); ?></span>
			</button>
		</div>
		<input class="pm-screen__amount" id="<?php echo esc_attr( $pm_id ); ?>-send" type="text" inputmode="decimal" autocomplete="off" spellcheck="false" maxlength="13" value="<?php echo esc_attr( paymerch_money( $pm_amount ) ); ?>" data-calc-send>
	</div>

	<div class="pm-screen__fee">
		<span><?php paymerch_field( 'calc_fee_label' ); ?></span>
		<span class="pm-screen__fee-val"><b data-calc-fee>$<?php echo esc_html( paymerch_money( $pm_fee ) ); ?></b><small><?php paymerch_field( 'calc_fee_note' ); ?></small></span>
	</div>

	<div class="pm-screen__row pm-screen__row--receive">
		<div class="pm-screen__cur">
			<label class="pm-screen__label" for="<?php echo esc_attr( $pm_id ); ?>-receive"><?php paymerch_field( 'calc_receive_label' ); ?></label>
			<button type="button" class="pm-screen__pill" data-picker-open="receive" aria-haspopup="dialog" aria-expanded="false" aria-controls="<?php echo esc_attr( $pm_id ); ?>-picker">
				<img class="pm-screen__flag" src="<?php echo esc_url( $pm_recv['flag'] ); ?>" alt="" width="80" height="60" data-pill-flag>
				<span data-pill-code><?php echo esc_html( $pm_recv['code'] ); ?></span>
				<?php echo $pm_caret; // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG. ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Change the currency they receive', 'paymerch' ); ?></span>
			</button>
		</div>
		<input class="pm-screen__amount" id="<?php echo esc_attr( $pm_id ); ?>-receive" type="text" inputmode="decimal" autocomplete="off" spellcheck="false" maxlength="18" value="<?php echo esc_attr( paymerch_money( $pm_receive ) ); ?>" data-calc-receive>
	</div>

	<div class="pm-screen__hr pm-screen__hr--bottom"></div>

	<div class="pm-screen__details">
		<div class="pm-screen__detail">
			<span class="pm-screen__ico" aria-hidden="true">
				<svg viewBox="0 0 24 24"><path d="M13.5 2 5 13.5h6L10.5 22 19 10.5h-6L13.5 2z" fill="none" stroke="#000" stroke-width="1.7" stroke-linejoin="round"/></svg>
			</span>
			<div class="pm-screen__txt">
				<div class="pm-screen__sub"><?php paymerch_field( 'calc_arrival_label' ); ?></div>
				<div class="pm-screen__val"><?php paymerch_field( 'calc_arrival_value' ); ?></div>
			</div>
		</div>
		<div class="pm-screen__detail">
			<span class="pm-screen__ico" aria-hidden="true">
				<svg viewBox="0 0 24 24"><path d="M6 2.5h12v19l-2-1.5-2 1.5-2-1.5-2 1.5-2-1.5-2 1.5v-19z" fill="none" stroke="#000" stroke-width="1.6" stroke-linejoin="round"/><path d="M9 7.5h6M9 11h6M9 14.5h4" stroke="#000" stroke-width="1.6" stroke-linecap="round"/></svg>
			</span>
			<div class="pm-screen__txt">
				<div class="pm-screen__sub"><?php paymerch_field( 'calc_breakdown_label' ); ?></div>
				<div class="pm-screen__val"><?php paymerch_field( 'calc_breakdown_value' ); ?></div>
			</div>
			<div class="pm-screen__fee2"><b data-calc-fee="short">$<?php echo esc_html( paymerch_money( $pm_fee ) ); ?></b><small><?php paymerch_field( 'calc_fee_note' ); ?></small></div>
		</div>
	</div>

	<a class="pm-screen__cta" href="<?php echo esc_url( paymerch_get( 'calc_cta_url' ) ); ?>"><?php paymerch_field( 'calc_cta' ); ?></a>
	<div class="pm-screen__home" aria-hidden="true"></div>

	<div class="pm-picker" id="<?php echo esc_attr( $pm_id ); ?>-picker" role="dialog" aria-labelledby="<?php echo esc_attr( $pm_id ); ?>-picker-title" hidden data-picker>
		<div class="pm-picker__head">
			<p class="pm-picker__title" id="<?php echo esc_attr( $pm_id ); ?>-picker-title"><?php esc_html_e( 'Choose a currency', 'paymerch' ); ?></p>
			<button type="button" class="pm-picker__close" data-picker-close aria-label="<?php esc_attr_e( 'Close', 'paymerch' ); ?>">
				<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M6 6l12 12M18 6 6 18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
			</button>
		</div>
		<div class="pm-picker__search">
			<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><circle cx="10.5" cy="10.5" r="6.5" fill="none" stroke="currentColor" stroke-width="2"/><path d="m15.5 15.5 5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
			<input type="search" placeholder="<?php esc_attr_e( 'Type a currency / country', 'paymerch' ); ?>" aria-label="<?php esc_attr_e( 'Search currencies', 'paymerch' ); ?>" autocomplete="off" spellcheck="false" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-controls="<?php echo esc_attr( $pm_id ); ?>-list" data-picker-search>
		</div>
		<div class="pm-picker__scroll">
			<ul class="pm-picker__list" id="<?php echo esc_attr( $pm_id ); ?>-list" role="listbox" aria-label="<?php esc_attr_e( 'Currencies', 'paymerch' ); ?>" data-picker-list data-popular="<?php esc_attr_e( 'Popular currencies', 'paymerch' ); ?>" data-all="<?php esc_attr_e( 'All currencies', 'paymerch' ); ?>"></ul>
			<p class="pm-picker__empty" data-picker-empty hidden><?php esc_html_e( 'No currency or country matches that search.', 'paymerch' ); ?></p>
		</div>
	</div>
</div>
