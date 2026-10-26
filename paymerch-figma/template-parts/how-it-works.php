<?php
/**
 * The three transfer steps (numbered indigo ellipse, title, text). Shown in
 * "From your account to theirs" (Send Abroad) and in the "How it works" tab
 * of the country pages.
 *
 * Args: class (list class).
 *
 * @package Paymerch_Figma
 */

$pmf_args  = wp_parse_args( isset( $args ) ? $args : array(), array( 'class' => '' ) );
$pmf_steps = array(
	array( __( 'Set up your transfer', 'paymerch-figma' ), __( 'Choose your destination and enter the amount you want to send.', 'paymerch-figma' ), 'step-circle.svg', 51 ),
	array( __( 'Add recipient details', 'paymerch-figma' ), __( 'Provide the information required for your selected delivery method.', 'paymerch-figma' ), 'step-circle.svg', 51 ),
	array( __( 'Review and confirm', 'paymerch-figma' ), __( 'Check your transfer details before submitting your transaction.', 'paymerch-figma' ), 'step-circle-alt.svg', 51.15 ),
);
?>
<ol class="pm-howto <?php echo esc_attr( $pmf_args['class'] ); ?>">
	<?php foreach ( $pmf_steps as $pmf_i => $pmf_step ) : ?>
		<li class="pm-howto__step">
			<span class="pm-howto__num">
				<img src="<?php echo esc_url( pmf_asset( 'img/icons/' . $pmf_step[2] ) ); ?>" alt="" width="<?php echo esc_attr( $pmf_step[3] ); ?>" height="45">
				<span><?php echo esc_html( $pmf_i + 1 ); ?></span>
			</span>
			<h3 class="pm-howto__title"><?php echo esc_html( $pmf_step[0] ); ?></h3>
			<p class="pm-howto__text"><?php echo esc_html( $pmf_step[1] ); ?></p>
		</li>
	<?php endforeach; ?>
</ol>
