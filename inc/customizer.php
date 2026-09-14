<?php
/**
 * Customizer: Appearance → Customize → Paymerch.
 * Built entirely from the registry in inc/content.php.
 *
 * @package Paymerch
 */

defined( 'ABSPATH' ) || exit;

function paymerch_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'paymerch',
		array(
			'title'       => __( 'Paymerch — Edit content', 'paymerch' ),
			'description' => __( 'Every text, link and image of the landing page, section by section. Changes show in the preview on the right; click Publish to go live.', 'paymerch' ),
			'priority'    => 10,
		)
	);

	$priority = 10;
	foreach ( paymerch_content_sections() as $section_id => $section ) {
		$wp_customize->add_section(
			'paymerch_' . $section_id,
			array(
				'title'       => $section['title'],
				'description' => isset( $section['intro'] ) ? $section['intro'] : '',
				'panel'       => 'paymerch',
				'priority'    => $priority++,
			)
		);

		foreach ( $section['fields'] as $key => $field ) {
			$setting_id = 'paymerch_' . $key;
			$default    = $field['default'];
			if ( 'image' === $field['type'] && '' !== $default ) {
				$default = paymerch_asset( 'img/' . $default );
			}

			$wp_customize->add_setting(
				$setting_id,
				array(
					'default'           => $default,
					'sanitize_callback' => paymerch_sanitizer_for( $field['type'] ),
					'transport'         => 'refresh',
				)
			);

			if ( 'image' === $field['type'] ) {
				$wp_customize->add_control(
					new WP_Customize_Image_Control(
						$wp_customize,
						$setting_id,
						array(
							'label'   => $field['label'],
							'section' => 'paymerch_' . $section_id,
						)
					)
				);
				continue;
			}

			$control = array(
				'label'   => $field['label'],
				'section' => 'paymerch_' . $section_id,
				'type'    => in_array( $field['type'], array( 'textarea', 'url', 'email', 'number' ), true ) ? $field['type'] : ( 'html' === $field['type'] ? 'textarea' : 'text' ),
			);
			if ( 'number' === $field['type'] ) {
				$control['input_attrs'] = array(
					'min'  => 0,
					'step' => '0.01',
				);
			}
			if ( 'url' === $field['type'] ) {
				$control['type'] = 'text'; // "text" accepts #anchors; the url input type rejects them.
			}
			$wp_customize->add_control( $setting_id, $control );
		}
	}
}
add_action( 'customize_register', 'paymerch_customize_register' );
