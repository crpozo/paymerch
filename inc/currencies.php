<?php
/**
 * Currency catalog + exchange rates for the phone calculator (Wise-style picker).
 *
 * Rates are mid-market, USD based. They come from the free open.er-api.com feed
 * (cached 6 h in a transient) and fall back to the table below when the feed is
 * unreachable. The MXN / COP Customizer fields override the feed when set.
 *
 * @package Paymerch
 */

defined( 'ABSPATH' ) || exit;

/**
 * code => array( name, country/search terms, ISO-3166 alpha-2 for the flag, fallback rate per 1 USD )
 */
function paymerch_currency_catalog() {
	return array(
		'USD' => array( 'United States dollar', 'United States, USA, America', 'us', 1 ),
		'MXN' => array( 'Mexican peso', 'Mexico, México', 'mx', 17.2 ),
		'COP' => array( 'Colombian peso', 'Colombia', 'co', 4150 ),
		'EUR' => array( 'Euro', 'Europe, Spain, Germany, France, Italy, Portugal, Netherlands, Ireland', 'eu', 0.92 ),
		'GBP' => array( 'British pound', 'United Kingdom, England, Britain', 'gb', 0.78 ),
		'CAD' => array( 'Canadian dollar', 'Canada', 'ca', 1.36 ),
		'AED' => array( 'United Arab Emirates dirham', 'United Arab Emirates, Dubai', 'ae', 3.67 ),
		'ARS' => array( 'Argentine peso', 'Argentina', 'ar', 980 ),
		'AUD' => array( 'Australian dollar', 'Australia', 'au', 1.5 ),
		'BDT' => array( 'Bangladeshi taka', 'Bangladesh', 'bd', 119 ),
		'BGN' => array( 'Bulgarian lev', 'Bulgaria', 'bg', 1.8 ),
		'BOB' => array( 'Bolivian boliviano', 'Bolivia', 'bo', 6.9 ),
		'BRL' => array( 'Brazilian real', 'Brazil, Brasil', 'br', 5.4 ),
		'CHF' => array( 'Swiss franc', 'Switzerland', 'ch', 0.86 ),
		'CLP' => array( 'Chilean peso', 'Chile', 'cl', 930 ),
		'CNY' => array( 'Chinese yuan', 'China', 'cn', 7.2 ),
		'CRC' => array( 'Costa Rican colón', 'Costa Rica', 'cr', 520 ),
		'CZK' => array( 'Czech koruna', 'Czech Republic, Czechia', 'cz', 23 ),
		'DKK' => array( 'Danish krone', 'Denmark', 'dk', 6.9 ),
		'DOP' => array( 'Dominican peso', 'Dominican Republic', 'do', 59 ),
		'EGP' => array( 'Egyptian pound', 'Egypt', 'eg', 48 ),
		'GTQ' => array( 'Guatemalan quetzal', 'Guatemala', 'gt', 7.7 ),
		'HKD' => array( 'Hong Kong dollar', 'Hong Kong', 'hk', 7.8 ),
		'HNL' => array( 'Honduran lempira', 'Honduras', 'hn', 25 ),
		'HUF' => array( 'Hungarian forint', 'Hungary', 'hu', 360 ),
		'IDR' => array( 'Indonesian rupiah', 'Indonesia', 'id', 15800 ),
		'ILS' => array( 'Israeli new shekel', 'Israel', 'il', 3.7 ),
		'INR' => array( 'Indian rupee', 'India', 'in', 84 ),
		'JMD' => array( 'Jamaican dollar', 'Jamaica', 'jm', 157 ),
		'JPY' => array( 'Japanese yen', 'Japan', 'jp', 150 ),
		'KES' => array( 'Kenyan shilling', 'Kenya', 'ke', 129 ),
		'KRW' => array( 'South Korean won', 'South Korea, Korea', 'kr', 1370 ),
		'MAD' => array( 'Moroccan dirham', 'Morocco', 'ma', 9.9 ),
		'MYR' => array( 'Malaysian ringgit', 'Malaysia', 'my', 4.4 ),
		'NGN' => array( 'Nigerian naira', 'Nigeria', 'ng', 1550 ),
		'NIO' => array( 'Nicaraguan córdoba', 'Nicaragua', 'ni', 36.8 ),
		'NOK' => array( 'Norwegian krone', 'Norway', 'no', 10.6 ),
		'NZD' => array( 'New Zealand dollar', 'New Zealand', 'nz', 1.64 ),
		'PAB' => array( 'Panamanian balboa', 'Panama, Panamá', 'pa', 1 ),
		'PEN' => array( 'Peruvian sol', 'Peru, Perú', 'pe', 3.75 ),
		'PHP' => array( 'Philippine peso', 'Philippines', 'ph', 56 ),
		'PKR' => array( 'Pakistani rupee', 'Pakistan', 'pk', 278 ),
		'PLN' => array( 'Polish złoty', 'Poland', 'pl', 3.9 ),
		'PYG' => array( 'Paraguayan guaraní', 'Paraguay', 'py', 7600 ),
		'RON' => array( 'Romanian leu', 'Romania', 'ro', 4.6 ),
		'SAR' => array( 'Saudi riyal', 'Saudi Arabia', 'sa', 3.75 ),
		'SEK' => array( 'Swedish krona', 'Sweden', 'se', 10.4 ),
		'SGD' => array( 'Singapore dollar', 'Singapore', 'sg', 1.33 ),
		'THB' => array( 'Thai baht', 'Thailand', 'th', 34 ),
		'TRY' => array( 'Turkish lira', 'Turkey, Türkiye', 'tr', 34 ),
		'TTD' => array( 'Trinidad and Tobago dollar', 'Trinidad and Tobago', 'tt', 6.8 ),
		'TWD' => array( 'New Taiwan dollar', 'Taiwan', 'tw', 32 ),
		'UAH' => array( 'Ukrainian hryvnia', 'Ukraine', 'ua', 41 ),
		'UYU' => array( 'Uruguayan peso', 'Uruguay', 'uy', 41 ),
		'VND' => array( 'Vietnamese dong', 'Vietnam, Viet Nam', 'vn', 25000 ),
		'ZAR' => array( 'South African rand', 'South Africa', 'za', 18 ),
	);
}

/** Shown first in the picker, in this order. */
function paymerch_popular_currencies() {
	return array( 'USD', 'MXN', 'COP', 'EUR', 'GBP', 'CAD' );
}

/** Public feed used for live mid-market rates (USD base, JSON). */
function paymerch_rates_feed_url() {
	return 'https://open.er-api.com/v6/latest/USD';
}

/**
 * Mid-market rates per 1 USD for every catalog currency.
 * Feed (cached) → fallback table → Customizer overrides for MXN / COP.
 */
function paymerch_rates() {
	$catalog = paymerch_currency_catalog();
	$rates   = array();
	foreach ( $catalog as $code => $c ) {
		$rates[ $code ] = (float) $c[3];
	}

	$live = get_transient( 'paymerch_rates' );
	if ( false === $live ) {
		$live     = array();
		$response = wp_remote_get( paymerch_rates_feed_url(), array( 'timeout' => 5 ) );
		if ( ! is_wp_error( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) {
			$data = json_decode( wp_remote_retrieve_body( $response ), true );
			if ( ! empty( $data['rates'] ) && is_array( $data['rates'] ) ) {
				$live = array_map( 'floatval', $data['rates'] );
			}
		}
		set_transient( 'paymerch_rates', $live, $live ? 6 * HOUR_IN_SECONDS : 15 * MINUTE_IN_SECONDS );
	}
	foreach ( $rates as $code => $rate ) {
		if ( ! empty( $live[ $code ] ) && $live[ $code ] > 0 ) {
			$rates[ $code ] = (float) $live[ $code ];
		}
	}

	foreach ( paymerch_manual_rates() as $code => $manual ) {
		$rates[ $code ] = $manual;
	}
	return $rates;
}

/** Customizer overrides (code => rate); these win over the live feed, server- and client-side. */
function paymerch_manual_rates() {
	$manual = array();
	foreach ( array( 'MXN' => 'rate_mxn', 'COP' => 'rate_cop' ) as $code => $key ) {
		$rate = (float) paymerch_get( $key );
		if ( $rate > 0 ) {
			$manual[ $code ] = $rate;
		}
	}
	return $manual;
}

/** Round flag image for a currency (flagcdn.com, free CDN). */
function paymerch_flag_url( $cc ) {
	return 'https://flagcdn.com/w80/' . rawurlencode( strtolower( $cc ) ) . '.png';
}

/**
 * Everything the calculator needs, in the order the picker shows it.
 *
 * @return array { currencies: array[], popular: string[], send: string, receive: string, feed: string }
 */
function paymerch_calc_currencies() {
	$rates  = paymerch_rates();
	$manual = paymerch_manual_rates();
	$list   = array();
	foreach ( paymerch_currency_catalog() as $code => $c ) {
		$list[] = array(
			'code'    => $code,
			'name'    => $c[0],
			'country' => $c[1],
			'cc'      => $c[2],
			'flag'    => paymerch_flag_url( $c[2] ),
			'rate'    => $rates[ $code ],
			'locked'  => isset( $manual[ $code ] ),
		);
	}
	usort(
		$list,
		function ( $a, $b ) {
			return strcmp( $a['code'], $b['code'] );
		}
	);
	return array(
		'currencies' => $list,
		'popular'    => paymerch_popular_currencies(),
		'send'       => 'USD',
		'receive'    => 'MXN',
		'feed'       => paymerch_rates_feed_url(),
	);
}
