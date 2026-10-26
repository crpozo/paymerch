<?php
/**
 * Main template. On the front page / posts page it renders the Paymerch "Home"
 * landing from Figma; everywhere else it is the standard content loop.
 *
 * @package Paymerch_Figma
 */

get_header();

if ( is_front_page() || is_home() ) :
	?>

	<!-- 02 Hero and transfer calculator -->
	<section class="pm-hero" id="top">
		<img class="pm-hero__shape" src="<?php echo esc_url( pmf_asset( 'img/hero-shape.svg' ) ); ?>" alt="" width="769" height="928.466" aria-hidden="true">
		<div class="pm-container pm-hero__inner">
			<div class="pm-hero__content">
				<p class="pm-badge"><span class="pm-badge__dot" aria-hidden="true"></span><?php esc_html_e( 'YOUR MONEY, YOUR MOVE', 'paymerch-figma' ); ?></p>
				<h1 class="pm-hero__title"><?php esc_html_e( 'Make the smart move with your money.', 'paymerch-figma' ); ?></h1>
				<p class="pm-hero__text"><?php esc_html_e( 'Send money from the U.S. to Mexico or Colombia with a clearer view of the fees, exchange rate, and amount your recipient will receive.', 'paymerch-figma' ); ?></p>
				<a class="pm-btn pm-btn--lime pm-hero__btn" href="#how-it-works"><?php esc_html_e( 'SEE HOW IT WORKS', 'paymerch-figma' ); ?></a>
			</div>
			<img class="pm-hero__photo" src="<?php echo esc_url( pmf_asset( 'img/hero-woman.png' ) ); ?>" alt="<?php esc_attr_e( 'Smiling woman holding her phone', 'paymerch-figma' ); ?>" width="539" height="673" fetchpriority="high">
			<div class="pm-hero__calc">
				<?php pmf_calculator(); ?>
			</div>
		</div>
	</section>

	<!-- Make your money go further -->
	<section class="pm-further">
		<div class="pm-container">
			<h2 class="pm-h2 pm-further__title"><?php esc_html_e( 'Make your money go further.', 'paymerch-figma' ); ?></h2>
			<p class="pm-lead pm-further__lead"><?php esc_html_e( 'Every dollar counts. Know the numbers before you send, so you can make a more informed decision about your transfer.', 'paymerch-figma' ); ?></p>
			<ul class="pm-bands">
				<li class="pm-band pm-band--mint">
					<h3 class="pm-band__title"><?php esc_html_e( "Know what you'll pay", 'paymerch-figma' ); ?></h3>
					<p class="pm-band__text"><?php esc_html_e( 'Review the applicable transfer fee before confirming your transaction.', 'paymerch-figma' ); ?></p>
				</li>
				<li class="pm-band pm-band--indigo">
					<h3 class="pm-band__title"><?php esc_html_e( "See what they'll receive", 'paymerch-figma' ); ?></h3>
					<p class="pm-band__text"><?php esc_html_e( 'Check the exchange rate and the amount your recipient is expected to receive.', 'paymerch-figma' ); ?></p>
				</li>
				<li class="pm-band pm-band--lavender">
					<h3 class="pm-band__title"><?php esc_html_e( 'Choose how it gets there', 'paymerch-figma' ); ?></h3>
					<p class="pm-band__text"><?php esc_html_e( 'Explore available delivery options to supported banks and payment networks in Mexico and Colombia.', 'paymerch-figma' ); ?></p>
				</li>
			</ul>
		</div>
	</section>

	<!-- Destinations -->
	<section class="pm-dest" id="destinations">
		<div class="pm-dest__inner">
			<div class="pm-dest__intro">
				<h2 class="pm-h2 pm-h2--hakter"><?php esc_html_e( 'Wherever they are, make your move.', 'paymerch-figma' ); ?></h2>
				<p class="pm-lead"><?php esc_html_e( 'Every dollar counts. Know the numbers before you send, so you can make a more informed decision about your transfer.', 'paymerch-figma' ); ?></p>
			</div>
			<div class="pm-dest__cards">
				<a class="pm-dest-card pm-dest-card--left" href="<?php echo esc_url( pmf_page_url( 'mexico' ) ); ?>">
					<img class="pm-dest-card__img" src="<?php echo esc_url( pmf_asset( 'img/mexico.jpg' ) ); ?>" alt="" width="387" height="385" loading="lazy">
					<span class="pm-dest-card__panel">
						<img class="pm-dest-card__flag" src="<?php echo esc_url( pmf_asset( 'img/flag-mx.png' ) ); ?>" alt="" width="40" height="40" loading="lazy">
						<span class="pm-dest-card__name"><?php esc_html_e( 'Mexico', 'paymerch-figma' ); ?></span>
						<span class="pm-dest-card__text"><?php esc_html_e( 'Explore Mexico transfers.', 'paymerch-figma' ); ?></span>
						<img class="pm-dest-card__arrow" src="<?php echo esc_url( pmf_asset( 'img/arrow-circle.svg' ) ); ?>" alt="" width="42" height="42">
					</span>
				</a>
				<a class="pm-dest-card pm-dest-card--right" href="<?php echo esc_url( pmf_page_url( 'colombia' ) ); ?>">
					<img class="pm-dest-card__img" src="<?php echo esc_url( pmf_asset( 'img/colombia.jpg' ) ); ?>" alt="" width="387" height="385" loading="lazy">
					<span class="pm-dest-card__panel">
						<img class="pm-dest-card__flag" src="<?php echo esc_url( pmf_asset( 'img/flag-co.png' ) ); ?>" alt="" width="40" height="40" loading="lazy">
						<span class="pm-dest-card__name"><?php esc_html_e( 'Colombia', 'paymerch-figma' ); ?></span>
						<span class="pm-dest-card__text"><?php esc_html_e( 'Explore Colombia transfers.', 'paymerch-figma' ); ?></span>
						<img class="pm-dest-card__arrow" src="<?php echo esc_url( pmf_asset( 'img/arrow-circle.svg' ) ); ?>" alt="" width="42" height="42">
					</span>
				</a>
			</div>
		</div>
	</section>

	<!-- See the numbers before you send -->
	<section class="pm-numbers">
		<div class="pm-container">
			<h2 class="pm-h2 pm-numbers__title"><?php esc_html_e( 'See the numbers', 'paymerch-figma' ); ?><br><?php esc_html_e( 'before you send.', 'paymerch-figma' ); ?></h2>
			<div class="pm-numbers__card">
				<?php pmf_calculator( 'muted' ); ?>
				<div class="pm-numbers__copy">
					<p class="pm-lead"><?php esc_html_e( 'Enter your transfer amount to review the applicable fee, exchange rate, and amount your recipient is expected to receive.', 'paymerch-figma' ); ?></p>
					<a class="pm-btn pm-btn--indigo" href="#top"><?php esc_html_e( 'Calculate your transfer', 'paymerch-figma' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<!-- Three steps -->
	<section class="pm-steps" id="how-it-works">
		<img class="pm-steps__people" src="<?php echo esc_url( pmf_asset( 'img/steps-people.png' ) ); ?>" alt="<?php esc_attr_e( 'Two friends looking at a phone together', 'paymerch-figma' ); ?>" width="858" height="572" loading="lazy">
		<div class="pm-steps__inner">
			<h2 class="pm-h2 pm-steps__title"><?php esc_html_e( 'A smarter way to send starts with three steps.', 'paymerch-figma' ); ?></h2>
			<ol class="pm-steps__list">
				<?php
				$pmf_steps = array(
					array( 'icon-link.svg', 16.1902, 10.8569, __( 'Enter your transfer', 'paymerch-figma' ), __( 'Choose your destination and enter the amount you want to send.', 'paymerch-figma' ) ),
					array( 'icon-lock.svg', 10.5333, 13.2, __( 'Review the details', 'paymerch-figma' ), __( 'Guaranteed interbank exchange rates with zero buy/sell spread. Transparency by design.', 'paymerch-figma' ) ),
					array( 'icon-userplus.svg', 16.35, 14.85, __( 'Confirm your transfer', 'paymerch-figma' ), __( 'Review your information and follow the steps to submit your transaction.', 'paymerch-figma' ) ),
				);
				foreach ( $pmf_steps as $pmf_i => $pmf_step ) :
					?>
					<li class="pm-step">
						<span class="pm-step__num"><?php echo esc_html( sprintf( '%02d', $pmf_i + 1 ) ); ?></span>
						<span class="pm-step__head">
							<span class="pm-step__icon"><img src="<?php echo esc_url( pmf_asset( 'img/' . $pmf_step[0] ) ); ?>" alt="" width="<?php echo esc_attr( $pmf_step[1] ); ?>" height="<?php echo esc_attr( $pmf_step[2] ); ?>"></span>
							<span class="pm-step__title"><?php echo esc_html( $pmf_step[3] ); ?></span>
						</span>
						<span class="pm-step__text"><?php echo esc_html( $pmf_step[4] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<!-- Confidence / security -->
	<section class="pm-security">
		<div class="pm-security__inner">
			<div class="pm-security__copy">
				<h2 class="pm-h2 pm-h2--hakter"><?php esc_html_e( 'Confidence starts with knowing more.', 'paymerch-figma' ); ?></h2>
				<p class="pm-lead"><?php esc_html_e( 'Learn how Paymerch approaches account security and transaction protection, and find out what support is available when you need it.', 'paymerch-figma' ); ?></p>
				<a class="pm-btn pm-btn--lime pm-security__btn" href="<?php echo esc_url( get_theme_mod( 'pmf_security_url', '#' ) ); ?>"><?php esc_html_e( 'Explore security and support', 'paymerch-figma' ); ?></a>
			</div>
			<img class="pm-security__media" src="<?php echo esc_url( pmf_asset( 'img/face-id.png' ) ); ?>" alt="" width="410" height="410" loading="lazy">
		</div>
	</section>

	<!-- Early access -->
	<?php get_template_part( 'template-parts/early-access' ); ?>

	<?php
else :
	?>
	<div class="pm-container pm-content">
		<?php if ( have_posts() ) : ?>
			<?php if ( ! is_singular() ) : ?>
				<h1 class="pm-h2 pm-content__title"><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>
			<?php endif; ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'pm-entry' ); ?>>
					<?php if ( is_singular() ) : ?>
						<h1 class="pm-h2 pm-content__title"><?php the_title(); ?></h1>
						<div class="pm-entry__content"><?php the_content(); ?></div>
					<?php else : ?>
						<h2 class="pm-entry__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="pm-entry__content"><?php the_excerpt(); ?></div>
					<?php endif; ?>
				</article>
			<?php endwhile; ?>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<h1 class="pm-h2 pm-content__title"><?php esc_html_e( 'Nothing found', 'paymerch-figma' ); ?></h1>
		<?php endif; ?>
	</div>
	<?php
endif;

get_footer();
