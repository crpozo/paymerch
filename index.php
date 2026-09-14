<?php
/**
 * Generic fallback template (blog index, archives, search).
 *
 * @package Paymerch
 */

get_header();
?>
<div class="pm-inner">
	<div class="pm-inner__wrap">
		<?php if ( have_posts() ) : ?>
			<?php if ( ! is_singular() ) : ?>
				<h1 class="pm-inner__title"><?php echo is_home() ? esc_html( get_bloginfo( 'name' ) ) : wp_kses_post( get_the_archive_title() ); ?></h1>
			<?php endif; ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'pm-entry' ); ?>>
					<h2 class="pm-entry__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="pm-entry__content"><?php is_singular() ? the_content() : the_excerpt(); ?></div>
				</article>
			<?php endwhile; ?>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<h1 class="pm-inner__title"><?php esc_html_e( 'Nothing found', 'paymerch' ); ?></h1>
		<?php endif; ?>
	</div>
</div>
<?php
get_footer();
