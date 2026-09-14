<?php
/**
 * Waitlist + contact forms.
 *
 * Submissions go through admin-post.php, are stored as a private "Lead" post
 * type (wp-admin → Leads) and emailed to the notification address set in the
 * Customizer. No third-party plugin required.
 *
 * @package Paymerch
 */

defined( 'ABSPATH' ) || exit;

/**
 * Lead post type (admin only).
 */
function paymerch_register_lead_cpt() {
	register_post_type(
		'pm_lead',
		array(
			'labels'          => array(
				'name'          => __( 'Leads', 'paymerch' ),
				'singular_name' => __( 'Lead', 'paymerch' ),
				'menu_name'     => __( 'Leads', 'paymerch' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'menu_icon'       => 'dashicons-email-alt',
			'menu_position'   => 25,
			'supports'        => array( 'title', 'editor' ),
			'capability_type' => 'post',
			'map_meta_cap'    => true,
			'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
		)
	);
}
add_action( 'init', 'paymerch_register_lead_cpt' );

/**
 * Extra admin columns for leads.
 */
function paymerch_lead_columns( $columns ) {
	return array(
		'cb'      => $columns['cb'],
		'title'   => __( 'Contact', 'paymerch' ),
		'pm_type' => __( 'Type', 'paymerch' ),
		'date'    => $columns['date'],
	);
}
add_filter( 'manage_pm_lead_posts_columns', 'paymerch_lead_columns' );

function paymerch_lead_column_content( $column, $post_id ) {
	if ( 'pm_type' === $column ) {
		echo esc_html( ucfirst( (string) get_post_meta( $post_id, '_pm_type', true ) ) );
	}
}
add_action( 'manage_pm_lead_posts_custom_column', 'paymerch_lead_column_content', 10, 2 );

/**
 * Shared: bounce back to the referring page with a status flag and anchor.
 */
function paymerch_form_redirect( $status, $anchor ) {
	$back = wp_get_referer();
	if ( ! $back ) {
		$back = home_url( '/' );
	}
	$back = remove_query_arg( 'pm', $back );
	$back = strtok( $back, '#' );
	wp_safe_redirect( add_query_arg( 'pm', $status, $back ) . '#' . $anchor );
	exit;
}

/**
 * Shared: store + notify.
 */
function paymerch_store_lead( $type, $title, $body, $meta ) {
	$post_id = wp_insert_post(
		array(
			'post_type'    => 'pm_lead',
			'post_status'  => 'private',
			'post_title'   => $title,
			'post_content' => $body,
		),
		true
	);
	if ( ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, '_pm_type', $type );
		foreach ( $meta as $key => $value ) {
			update_post_meta( $post_id, '_pm_' . $key, $value );
		}
	}

	$to = sanitize_email( paymerch_get( 'notify_email' ) );
	if ( $to ) {
		$subject = sprintf(
			/* translators: 1: site name, 2: form type */
			__( '[%1$s] New %2$s submission', 'paymerch' ),
			wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ),
			$type
		);
		wp_mail( $to, $subject, $body );
	}
}

/**
 * Waitlist: single "email or phone" field.
 */
function paymerch_handle_waitlist() {
	if ( ! isset( $_POST['pm_waitlist_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['pm_waitlist_nonce'] ) ), 'pm_waitlist' ) ) {
		paymerch_form_redirect( 'waitlist-error', 'waitlist' );
	}
	if ( ! empty( $_POST['pm_website'] ) ) { // Honeypot.
		paymerch_form_redirect( 'waitlist-ok', 'waitlist' );
	}
	$contact = isset( $_POST['pm_contact'] ) ? sanitize_text_field( wp_unslash( $_POST['pm_contact'] ) ) : '';
	$is_mail = is_email( $contact );
	$is_tel  = (bool) preg_match( '/^\+?[0-9 ()\-.]{7,20}$/', $contact );
	if ( ! $is_mail && ! $is_tel ) {
		paymerch_form_redirect( 'waitlist-invalid', 'waitlist' );
	}

	paymerch_store_lead(
		'waitlist',
		$contact,
		sprintf( "Waitlist signup\nContact: %s\nSource: %s", $contact, esc_url_raw( wp_get_referer() ) ),
		array( 'contact' => $contact )
	);
	paymerch_form_redirect( 'waitlist-ok', 'waitlist' );
}
add_action( 'admin_post_nopriv_paymerch_waitlist', 'paymerch_handle_waitlist' );
add_action( 'admin_post_paymerch_waitlist', 'paymerch_handle_waitlist' );

/**
 * Contact: name, email, message.
 */
function paymerch_handle_contact() {
	if ( ! isset( $_POST['pm_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['pm_contact_nonce'] ) ), 'pm_contact' ) ) {
		paymerch_form_redirect( 'contact-error', 'contact' );
	}
	if ( ! empty( $_POST['pm_website'] ) ) {
		paymerch_form_redirect( 'contact-ok', 'contact' );
	}
	$name    = isset( $_POST['pm_name'] ) ? sanitize_text_field( wp_unslash( $_POST['pm_name'] ) ) : '';
	$email   = isset( $_POST['pm_email'] ) ? sanitize_email( wp_unslash( $_POST['pm_email'] ) ) : '';
	$message = isset( $_POST['pm_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['pm_message'] ) ) : '';

	if ( '' === $name || ! is_email( $email ) || '' === $message ) {
		paymerch_form_redirect( 'contact-invalid', 'contact' );
	}

	paymerch_store_lead(
		'contact',
		$name . ' – ' . $email,
		sprintf( "Contact message\nName: %s\nEmail: %s\n\n%s", $name, $email, $message ),
		array(
			'name'  => $name,
			'email' => $email,
		)
	);
	paymerch_form_redirect( 'contact-ok', 'contact' );
}
add_action( 'admin_post_nopriv_paymerch_contact', 'paymerch_handle_contact' );
add_action( 'admin_post_paymerch_contact', 'paymerch_handle_contact' );

/**
 * Status message for a form, read from ?pm=... after the redirect.
 *
 * @param string $prefix 'waitlist' or 'contact'.
 */
function paymerch_form_notice( $prefix ) {
	$status = isset( $_GET['pm'] ) ? sanitize_key( wp_unslash( $_GET['pm'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display only.
	if ( 0 !== strpos( $status, $prefix . '-' ) ) {
		return;
	}
	$messages = array(
		'waitlist-ok'      => array( 'ok', __( 'You are on the list! We will email you on launch day.', 'paymerch' ) ),
		'waitlist-invalid' => array( 'error', __( 'Please enter a valid email address or phone number.', 'paymerch' ) ),
		'waitlist-error'   => array( 'error', __( 'Something went wrong. Please try again.', 'paymerch' ) ),
		'contact-ok'       => array( 'ok', __( 'Message sent. Our team replies in less than 24 hours.', 'paymerch' ) ),
		'contact-invalid'  => array( 'error', __( 'Please fill in your name, a valid email and a message.', 'paymerch' ) ),
		'contact-error'    => array( 'error', __( 'Something went wrong. Please try again.', 'paymerch' ) ),
	);
	if ( ! isset( $messages[ $status ] ) ) {
		return;
	}
	printf(
		'<p class="pm-form__notice pm-form__notice--%s" role="status">%s</p>',
		esc_attr( $messages[ $status ][0] ),
		esc_html( $messages[ $status ][1] )
	);
}
