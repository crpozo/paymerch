<?php
/**
 * Front page: the landing page, section by section.
 * All copy and images are edited in Appearance → Customize → Paymerch.
 *
 * @package Paymerch
 */

get_header();

get_template_part( 'template-parts/section', 'hero' );
get_template_part( 'template-parts/section', 'see-exactly' );
get_template_part( 'template-parts/section', 'protected' );
get_template_part( 'template-parts/section', 'rails' );
get_template_part( 'template-parts/section', 'steps' );
get_template_part( 'template-parts/section', 'built-for-phone' );
get_template_part( 'template-parts/section', 'built-by' );

get_footer();
