<?php
/**
 * Static pages created in wp-admin → Pages (use the "Legal document" template
 * for long documents with an index).
 *
 * @package Paymerch
 */

get_header();
?>
<div class="pm-inner">
	<div class="pm-inner__wrap">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'pm-entry' ); ?>>
				<h1 class="pm-inner__title"><?php the_title(); ?></h1>
				<div class="pm-entry__content"><?php the_content(); ?></div>
			</article>
		<?php endwhile; ?>
	</div>
</div>
<?php
get_footer();
