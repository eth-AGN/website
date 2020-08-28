<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Agn_Theme
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			if (in_category('wissen')) {
				get_template_part('template-parts/content', 'wissen_post');
			} elseif (in_category('denken')) {
				get_template_part('template-parts/content', 'denken_post');
			} elseif (in_category('handeln')) {
				get_template_part('template-parts/content', 'handeln_post');
			} else {
				get_template_part( 'template-parts/content', get_post_type() );
			}

			// the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
