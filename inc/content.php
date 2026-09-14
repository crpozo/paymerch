<?php
/**
 * Editable content registry.
 *
 * Every text, link and image on the landing page is declared here once. The
 * Customizer (inc/customizer.php) builds its panel from this list and the
 * templates read values with paymerch_get() / paymerch_field() / paymerch_image().
 *
 * Field types: text, html (inline <strong>/<br>/<em> allowed), textarea,
 * url, email, number, image (default = file inside assets/img).
 *
 * @package Paymerch
 */

defined( 'ABSPATH' ) || exit;

/**
 * Sections (in Customizer order) => fields.
 */
function paymerch_content_sections() {
	return array(
		'header'     => array(
			'title'  => __( '1. Header & navigation', 'paymerch' ),
			'intro'  => __( 'Upload the logo under Site Identity. Assign a menu under Menus → "Primary Menu" to replace these links.', 'paymerch' ),
			'fields' => array(
				'nav_1' => array( 'label' => __( 'Link 1', 'paymerch' ), 'type' => 'text', 'default' => 'International Payments' ),
				'nav_2' => array( 'label' => __( 'Link 2', 'paymerch' ), 'type' => 'text', 'default' => 'Payments P2P' ),
				'nav_3' => array( 'label' => __( 'Link 3', 'paymerch' ), 'type' => 'text', 'default' => 'Rewards' ),
				'nav_4' => array( 'label' => __( 'Link 4', 'paymerch' ), 'type' => 'text', 'default' => 'How it works' ),
				'nav_5' => array( 'label' => __( 'Link 5', 'paymerch' ), 'type' => 'text', 'default' => 'Help' ),
			),
		),
		'hero'       => array(
			'title'  => __( '2. Hero', 'paymerch' ),
			'fields' => array(
				'hero_title'     => array( 'label' => __( 'Headline (use <strong> for bold, <br> for line breaks)', 'paymerch' ), 'type' => 'html', 'default' => 'Moving <strong>Money</strong><br>Home Should Feel<br>as <strong>Close as Family.</strong>' ),
				'hero_text'      => array( 'label' => __( 'Paragraph', 'paymerch' ), 'type' => 'textarea', 'default' => 'Send support, celebrate milestones, and stay connected with the people who matter most—instantly from your phone.' ),
				'hero_cta'       => array( 'label' => __( 'Button text', 'paymerch' ), 'type' => 'text', 'default' => 'Join the Early Access Waitlist' ),
				'hero_cta_url'   => array( 'label' => __( 'Button link', 'paymerch' ), 'type' => 'url', 'default' => '#waitlist' ),
				'chip1_small'    => array( 'label' => __( 'Left chip — small text', 'paymerch' ), 'type' => 'text', 'default' => 'Send to' ),
				'chip1_big'      => array( 'label' => __( 'Left chip — bold text', 'paymerch' ), 'type' => 'text', 'default' => 'Mexico & Colombia' ),
				'chip2_icon'     => array( 'label' => __( 'Right chip — icon text', 'paymerch' ), 'type' => 'text', 'default' => '$0' ),
				'chip2_small'    => array( 'label' => __( 'Right chip — small text', 'paymerch' ), 'type' => 'text', 'default' => 'Transfer fee' ),
				'chip2_big'      => array( 'label' => __( 'Right chip — bold text', 'paymerch' ), 'type' => 'text', 'default' => 'Launch offer' ),
				'hero_mark'      => array( 'label' => __( 'Decorative purple shape', 'paymerch' ), 'type' => 'image', 'default' => 'marca-morada.png' ),
			),
		),
		'calculator' => array(
			'title'  => __( '3. Phone calculator', 'paymerch' ),
			'intro'  => __( 'Rates come live from the market feed; fill MXN/COP only to force a rate.', 'paymerch' ),
			'fields' => array(
				'default_amount' => array( 'label' => __( 'Starting amount (USD)', 'paymerch' ), 'type' => 'number', 'default' => '1500' ),
				'transfer_fee'   => array( 'label' => __( 'Transfer fee (USD)', 'paymerch' ), 'type' => 'number', 'default' => '0' ),
				'rate_mxn'       => array( 'label' => __( 'Override rate: 1 USD = … MXN (empty = live)', 'paymerch' ), 'type' => 'number', 'default' => '' ),
				'rate_cop'       => array( 'label' => __( 'Override rate: 1 USD = … COP (empty = live)', 'paymerch' ), 'type' => 'number', 'default' => '' ),
				'calc_rate_label'    => array( 'label' => __( 'Rate label', 'paymerch' ), 'type' => 'text', 'default' => 'Guaranteed Exchange Rate:' ),
				'calc_send_label'    => array( 'label' => __( '"You send" label', 'paymerch' ), 'type' => 'text', 'default' => 'You send exactly' ),
				'calc_receive_label' => array( 'label' => __( '"They receive" label', 'paymerch' ), 'type' => 'text', 'default' => 'They receive' ),
				'calc_fee_label'     => array( 'label' => __( 'Fee row label', 'paymerch' ), 'type' => 'text', 'default' => 'Transfer Fee' ),
				'calc_fee_note'      => array( 'label' => __( 'Fee note', 'paymerch' ), 'type' => 'text', 'default' => '(Launch Offer)' ),
				'calc_arrival_label' => array( 'label' => __( 'Arrival label', 'paymerch' ), 'type' => 'text', 'default' => 'Estimated Arrival' ),
				'calc_arrival_value' => array( 'label' => __( 'Arrival value', 'paymerch' ), 'type' => 'text', 'default' => 'Today - 5 – 15 Minutes' ),
				'calc_breakdown_label' => array( 'label' => __( 'Breakdown label', 'paymerch' ), 'type' => 'text', 'default' => 'Desglose simple' ),
				'calc_breakdown_value' => array( 'label' => __( 'Breakdown value', 'paymerch' ), 'type' => 'text', 'default' => 'Transfer Fee:' ),
				'calc_cta'           => array( 'label' => __( 'Screen button text', 'paymerch' ), 'type' => 'text', 'default' => 'Get early access' ),
				'calc_cta_url'       => array( 'label' => __( 'Screen button link', 'paymerch' ), 'type' => 'url', 'default' => '#waitlist' ),
				'app_store_url'      => array( 'label' => __( 'App Store URL', 'paymerch' ), 'type' => 'url', 'default' => '#' ),
				'play_store_url'     => array( 'label' => __( 'Google Play URL', 'paymerch' ), 'type' => 'url', 'default' => '#' ),
				'qr_image'           => array( 'label' => __( 'QR code image', 'paymerch' ), 'type' => 'image', 'default' => 'qr.png' ),
			),
		),
		'see'        => array(
			'title'  => __( '4. See Exactly What Arrives', 'paymerch' ),
			'fields' => array(
				'see_title'   => array( 'label' => __( 'Headline', 'paymerch' ), 'type' => 'html', 'default' => 'See Exactly <strong>What Arrives</strong><br>Before You Tap Send.' ),
				'see_text'    => array( 'label' => __( 'Paragraph', 'paymerch' ), 'type' => 'textarea', 'default' => 'No hidden markups, no unexpected fees deducted at pickup. What you see on this screen is the exact amount delivered home.' ),
				'see_cta'     => array( 'label' => __( 'Button text', 'paymerch' ), 'type' => 'text', 'default' => 'Lock In Your First Free Transfer' ),
				'see_cta_url' => array( 'label' => __( 'Button link', 'paymerch' ), 'type' => 'url', 'default' => '#waitlist' ),
			),
		),
		'protected'  => array(
			'title'  => __( '5. Protected at Every Step', 'paymerch' ),
			'fields' => array(
				'protected_title'   => array( 'label' => __( 'Headline', 'paymerch' ), 'type' => 'html', 'default' => '<strong>Your Hard-Earned Money</strong>,<br>Protected at Every Step' ),
				'protected_text'    => array( 'label' => __( 'Paragraph', 'paymerch' ), 'type' => 'textarea', 'default' => "Moving money across borders shouldn't feel risky. We operate with full regulatory backing to keep you safe from fraud, scams, and errors." ),
				'protected_cta'     => array( 'label' => __( 'Button text', 'paymerch' ), 'type' => 'html', 'default' => 'Review our full regulatory licenses<br>and compliance framework' ),
				'protected_cta_url' => array( 'label' => __( 'Button link', 'paymerch' ), 'type' => 'url', 'default' => '#' ),
				'card1_title'       => array( 'label' => __( 'Card 1 — title', 'paymerch' ), 'type' => 'text', 'default' => 'Scam & Fraud Prevention' ),
				'card1_text'        => array( 'label' => __( 'Card 1 — text', 'paymerch' ), 'type' => 'textarea', 'default' => 'Active monitoring on every transfer to ensure your funds reach only the hands you intended.' ),
				'card2_title'       => array( 'label' => __( 'Card 2 — title', 'paymerch' ), 'type' => 'text', 'default' => 'Real Human Support' ),
				'card2_text'        => array( 'label' => __( 'Card 2 — text', 'paymerch' ), 'type' => 'textarea', 'default' => 'Have a question or an issue? Speak directly with a real support specialist, not a scripted loop.' ),
				'card3_title'       => array( 'label' => __( 'Card 3 — title', 'paymerch' ), 'type' => 'text', 'default' => '100% Regulated Infrastructure' ),
				'card3_text'        => array( 'label' => __( 'Card 3 — text', 'paymerch' ), 'type' => 'textarea', 'default' => 'We partner with licensed, established financial institutions to keep every transaction compliant with U.S. federal and state standards.' ),
			),
		),
		'rails'      => array(
			'title'  => __( '6. Local Rails (corridors)', 'paymerch' ),
			'fields' => array(
				'rails_title'     => array( 'label' => __( 'Headline', 'paymerch' ), 'type' => 'html', 'default' => 'Local <strong>Rails</strong>' ),
				'rail1_name'      => array( 'label' => __( 'Corridor 1 — country', 'paymerch' ), 'type' => 'text', 'default' => 'México' ),
				'rail1_label'     => array( 'label' => __( 'Corridor 1 — small label', 'paymerch' ), 'type' => 'text', 'default' => 'CORRIDOR' ),
				'rail1_photo'     => array( 'label' => __( 'Corridor 1 — photo', 'paymerch' ), 'type' => 'image', 'default' => 'mexico.jpg' ),
				'rail1_flag'      => array( 'label' => __( 'Corridor 1 — flag', 'paymerch' ), 'type' => 'image', 'default' => 'flag-mx-big.png' ),
				'rail1_title'     => array( 'label' => __( 'Corridor 1 — expanded headline', 'paymerch' ), 'type' => 'html', 'default' => 'Instant Transfers <strong class="pm-green">to Mexico,</strong><br>Direct to Trusted Accounts.' ),
				'rail1_text'      => array( 'label' => __( 'Corridor 1 — expanded paragraph', 'paymerch' ), 'type' => 'textarea', 'default' => 'Send straight to personal checking accounts via SPEI or pick up cash at major retail networks nationwide.' ),
				'rail1_item1'     => array( 'label' => __( 'Corridor 1 — option 1 (shows bank logos)', 'paymerch' ), 'type' => 'text', 'default' => 'Direct Bank Deposit (SPEI Rails)' ),
				'rail1_item2'     => array( 'label' => __( 'Corridor 1 — option 2', 'paymerch' ), 'type' => 'text', 'default' => 'Nationwide Cash Pickup' ),
				'rail1_note'      => array( 'label' => __( 'Corridor 1 — bottom note', 'paymerch' ), 'type' => 'text', 'default' => 'Funds usually arrive within 5 minutes.' ),
				'rail2_name'      => array( 'label' => __( 'Corridor 2 — country', 'paymerch' ), 'type' => 'text', 'default' => 'Colombia' ),
				'rail2_label'     => array( 'label' => __( 'Corridor 2 — small label', 'paymerch' ), 'type' => 'text', 'default' => 'CORRIDOR' ),
				'rail2_photo'     => array( 'label' => __( 'Corridor 2 — photo', 'paymerch' ), 'type' => 'image', 'default' => 'colombia.jpg' ),
				'rail2_flag'      => array( 'label' => __( 'Corridor 2 — flag', 'paymerch' ), 'type' => 'image', 'default' => 'flag-co-big.png' ),
				'rail2_title'     => array( 'label' => __( 'Corridor 2 — expanded headline', 'paymerch' ), 'type' => 'html', 'default' => 'Instant Transfers <strong class="pm-green">to Colombia,</strong><br>Direct to Trusted Accounts.' ),
				'rail2_text'      => array( 'label' => __( 'Corridor 2 — expanded paragraph', 'paymerch' ), 'type' => 'textarea', 'default' => 'Send straight to personal savings accounts or pick up cash at major retail networks nationwide.' ),
				'rail2_item1'     => array( 'label' => __( 'Corridor 2 — option 1', 'paymerch' ), 'type' => 'text', 'default' => 'Direct Bank Deposit' ),
				'rail2_item2'     => array( 'label' => __( 'Corridor 2 — option 2', 'paymerch' ), 'type' => 'text', 'default' => 'Nationwide Cash Pickup' ),
				'rail2_note'      => array( 'label' => __( 'Corridor 2 — bottom note', 'paymerch' ), 'type' => 'text', 'default' => 'Funds usually arrive within minutes.' ),
			),
		),
		'steps'      => array(
			'title'  => __( '7. 5 Simple Steps', 'paymerch' ),
			'fields' => array(
				'steps_title'  => array( 'label' => __( 'Headline', 'paymerch' ), 'type' => 'html', 'default' => 'Sending Money Home <strong>in 5 Simple Steps.</strong>' ),
				'steps_photo'  => array( 'label' => __( 'Photo', 'paymerch' ), 'type' => 'image', 'default' => 'onmobile.png' ),
				'step1_title'  => array( 'label' => __( 'Step 1 — title', 'paymerch' ), 'type' => 'text', 'default' => 'Download the App.' ),
				'step1_text'   => array( 'label' => __( 'Step 1 — text', 'paymerch' ), 'type' => 'textarea', 'default' => 'Get the mobile app to get started right from your phone.' ),
				'step2_title'  => array( 'label' => __( 'Step 2 — title', 'paymerch' ), 'type' => 'text', 'default' => 'Register Your Profile.' ),
				'step2_text'   => array( 'label' => __( 'Step 2 — text', 'paymerch' ), 'type' => 'textarea', 'default' => 'Quick identity verification to protect your account and keep bad actors out.' ),
				'step3_title'  => array( 'label' => __( 'Step 3 — title', 'paymerch' ), 'type' => 'text', 'default' => 'Link Your Funding Source.' ),
				'step3_text'   => array( 'label' => __( 'Step 3 — text', 'paymerch' ), 'type' => 'textarea', 'default' => 'Connect your U.S. checking account or debit card safely through bank-level encryption.' ),
				'step4_title'  => array( 'label' => __( 'Step 4 — title', 'paymerch' ), 'type' => 'text', 'default' => 'Add Your Recipient.' ),
				'step4_text'   => array( 'label' => __( 'Step 4 — text', 'paymerch' ), 'type' => 'textarea', 'default' => 'Choose a family member or friend and enter their local account or pickup details.' ),
				'step5_title'  => array( 'label' => __( 'Step 5 — title', 'paymerch' ), 'type' => 'text', 'default' => 'Confirm & Track Delivery.' ),
				'step5_text'   => array( 'label' => __( 'Step 5 — text', 'paymerch' ), 'type' => 'textarea', 'default' => 'Review the guaranteed numbers, tap send, and get real-time status updates until it arrives.' ),
			),
		),
		'built'      => array(
			'title'  => __( '8. Built for Your Phone (waitlist)', 'paymerch' ),
			'fields' => array(
				'built_title'       => array( 'label' => __( 'Headline', 'paymerch' ), 'type' => 'html', 'default' => '<strong class="pm-green">Built for</strong> Your Phone.' ),
				'built_sub'         => array( 'label' => __( 'Sub-headline', 'paymerch' ), 'type' => 'html', 'default' => 'Coming Soon to <strong>iOS and Android.</strong>' ),
				'built_text'        => array( 'label' => __( 'Paragraph', 'paymerch' ), 'type' => 'textarea', 'default' => 'We are putting the final touches on our mobile platform with our banking partners.' ),
				'built_text_strong' => array( 'label' => __( 'Bold paragraph', 'paymerch' ), 'type' => 'textarea', 'default' => 'Sign up today to secure your first fee-free transfer on launch day.' ),
				'waitlist_placeholder' => array( 'label' => __( 'Input placeholder', 'paymerch' ), 'type' => 'text', 'default' => 'Enter your email or phone' ),
				'waitlist_button'   => array( 'label' => __( 'Button text', 'paymerch' ), 'type' => 'text', 'default' => 'Join the Waitlist' ),
				'built_phone'       => array( 'label' => __( 'Phone image', 'paymerch' ), 'type' => 'image', 'default' => 'celular-2.png' ),
			),
		),
		'builtby'    => array(
			'title'  => __( '9. Built by Real People (contact)', 'paymerch' ),
			'fields' => array(
				'builtby_title'  => array( 'label' => __( 'Headline', 'paymerch' ), 'type' => 'html', 'default' => 'Built by <strong>Real People</strong> <strong class="pm-green">Who</strong><br><strong class="pm-green">Understand</strong> the Value<br>of Every Dollar' ),
				'builtby_text'   => array( 'label' => __( 'Paragraph', 'paymerch' ), 'type' => 'textarea', 'default' => 'Paymerch was founded to give hardworking senders in the United States complete sovereignty over how their capital moves home. No hidden deductions, no red tape.' ),
				'builtby_photo'  => array( 'label' => __( 'Background photo', 'paymerch' ), 'type' => 'image', 'default' => 'mujer.jpg' ),
				'contact_title'  => array( 'label' => __( 'Form title', 'paymerch' ), 'type' => 'text', 'default' => 'Send Us a Direct Message' ),
				'contact_sub'    => array( 'label' => __( 'Form subtitle', 'paymerch' ), 'type' => 'text', 'default' => 'Our compliance and customer team replies in less than 24 hours.' ),
				'contact_button' => array( 'label' => __( 'Form button', 'paymerch' ), 'type' => 'text', 'default' => 'Send Message' ),
				'notify_email'   => array( 'label' => __( 'Email that receives waitlist & contact submissions', 'paymerch' ), 'type' => 'email', 'default' => '' ),
			),
		),
		'footer'     => array(
			'title'  => __( '10. Footer', 'paymerch' ),
			'intro'  => __( 'Legal links come from the pages created by the theme (Pages → Terms, Privacy, Refund); assign a menu under Menus → "Footer Legal Links" to change them.', 'paymerch' ),
			'fields' => array(
				'hq_title'         => array( 'label' => __( 'Headquarters title', 'paymerch' ), 'type' => 'text', 'default' => 'Paymerch LLC Headquarters' ),
				'hq_address'       => array( 'label' => __( 'Address', 'paymerch' ), 'type' => 'text', 'default' => '1209 Orange Street, Wilmington, New Castle County, DE 19801, United States' ),
				'hq_entity'        => array( 'label' => __( 'Registered entity line', 'paymerch' ), 'type' => 'text', 'default' => 'U.S. Registered Entity #7489201' ),
				'support_label'    => array( 'label' => __( 'Support email label', 'paymerch' ), 'type' => 'text', 'default' => 'Direct Compliance & Support Email:' ),
				'support_email'    => array( 'label' => __( 'Support email', 'paymerch' ), 'type' => 'email', 'default' => 'support@paymerch.us' ),
				'hours_label'      => array( 'label' => __( 'Hours label', 'paymerch' ), 'type' => 'text', 'default' => 'Operating Support Hours' ),
				'support_hours'    => array( 'label' => __( 'Support hours', 'paymerch' ), 'type' => 'text', 'default' => 'Monday – Sunday (7:00 AM – 10:00 PM EST)' ),
				'social_facebook'  => array( 'label' => 'Facebook', 'type' => 'url', 'default' => '#' ),
				'social_twitter'   => array( 'label' => 'Twitter / X', 'type' => 'url', 'default' => '#' ),
				'social_instagram' => array( 'label' => 'Instagram', 'type' => 'url', 'default' => '#' ),
				'social_linkedin'  => array( 'label' => 'LinkedIn', 'type' => 'url', 'default' => '#' ),
				'social_whatsapp'  => array( 'label' => 'WhatsApp', 'type' => 'url', 'default' => '#' ),
			),
		),
	);
}

/**
 * Flat key => field definition (cached).
 */
function paymerch_field_def( $key ) {
	static $flat = null;
	if ( null === $flat ) {
		$flat = array();
		foreach ( paymerch_content_sections() as $section ) {
			foreach ( $section['fields'] as $id => $field ) {
				$flat[ $id ] = $field;
			}
		}
		// Runtime default that can't live in the static table.
		if ( '' === $flat['notify_email']['default'] ) {
			$flat['notify_email']['default'] = get_option( 'admin_email' );
		}
	}
	return isset( $flat[ $key ] ) ? $flat[ $key ] : null;
}

/**
 * Sanitizer callback name for a field type.
 */
function paymerch_sanitizer_for( $type ) {
	switch ( $type ) {
		case 'html':
			return 'paymerch_sanitize_html';
		case 'textarea':
			return 'paymerch_sanitize_textarea';
		case 'url':
			return 'paymerch_sanitize_url';
		case 'email':
			return 'sanitize_email';
		case 'number':
			return 'paymerch_sanitize_number';
		case 'image':
			return 'esc_url_raw';
		default:
			return 'sanitize_text_field';
	}
}

function paymerch_sanitize_html( $value ) {
	return wp_kses( (string) $value, paymerch_allowed_inline() );
}

function paymerch_sanitize_textarea( $value ) {
	return wp_kses( (string) $value, paymerch_allowed_inline() );
}

/** Non-negative decimal number, stored as a string ('' allowed). */
function paymerch_sanitize_number( $value ) {
	$value = trim( str_replace( ',', '', (string) $value ) );
	if ( '' === $value ) {
		return '';
	}
	return is_numeric( $value ) ? (string) max( 0, (float) $value ) : '';
}

/** Allow "#" anchors as well as real URLs. */
function paymerch_sanitize_url( $value ) {
	$value = trim( (string) $value );
	if ( '' === $value || 0 === strpos( $value, '#' ) ) {
		return $value;
	}
	return esc_url_raw( $value );
}
