<?php
/**
 * Template Name: Legal document
 * Template Post Type: page
 *
 * Reading layout for the Terms, Privacy and Refund pages: title band, an
 * "On this page" index built from the H2 headings, a readable text column and
 * links to the other legal documents.
 *
 * @package Paymerch
 */

get_header();

while ( have_posts() ) :
	the_post();
	list( $pm_content, $pm_toc ) = paymerch_legal_prepare( apply_filters( 'the_content', get_the_content() ) );
	$pm_email                    = paymerch_get( 'support_email' );
	?>
	<div class="pm-legal">
		<header class="pm-legal__head">
			<div class="pm-legal__wrap">
				<p class="pm-legal__eyebrow"><?php esc_html_e( 'Legal', 'paymerch' ); ?></p>
				<h1 class="pm-legal__title"><?php the_title(); ?></h1>
				<p class="pm-legal__meta">
					<?php echo esc_html( paymerch_get( 'hq_title' ) ? 'Paymerch LLC' : get_bloginfo( 'name' ) ); ?>
					<span aria-hidden="true">·</span>
					<?php esc_html_e( 'Questions?', 'paymerch' ); ?>
					<a href="mailto:<?php echo esc_attr( $pm_email ); ?>"><?php echo esc_html( $pm_email ); ?></a>
				</p>
			</div>
		</header>

		<div class="pm-legal__wrap pm-legal__grid">
			<?php if ( $pm_toc ) : ?>
				<details class="pm-legal__toc" open>
					<summary><?php esc_html_e( 'On this page', 'paymerch' ); ?></summary>
					<ul>
						<?php foreach ( $pm_toc as $pm_item ) : ?>
							<li><a href="#<?php echo esc_attr( $pm_item['id'] ); ?>"><?php echo esc_html( $pm_item['text'] ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</details>
			<?php endif; ?>

			<article class="pm-legal__body">
				<?php echo $pm_content; // phpcs:ignore WordPress.Security.EscapeOutput -- filtered post content. ?>
			</article>
		</div>

		<?php $pm_others = paymerch_legal_links( get_post_field( 'post_name' ) ); ?>
		<?php if ( $pm_others ) : ?>
			<nav class="pm-legal__docs" aria-label="<?php esc_attr_e( 'Other legal documents', 'paymerch' ); ?>">
				<div class="pm-legal__wrap">
					<p class="pm-legal__docs-title"><?php esc_html_e( 'Other legal documents', 'paymerch' ); ?></p>
					<ul>
						<?php foreach ( $pm_others as $pm_doc ) : ?>
							<li>
								<a href="<?php echo esc_url( $pm_doc['url'] ); ?>">
									<span><?php echo esc_html( $pm_doc['label'] ); ?></span>
									<?php paymerch_icon( 'icon-small-chevron', 'pm-legal__docs-chev' ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</nav>
		<?php endif; ?>
	</div>
	<?php
endwhile;

get_footer();
