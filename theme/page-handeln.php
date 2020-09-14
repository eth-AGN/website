<?php
/**
 * Template Name: HandelnPage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agn_Theme
 */

query_posts(array('category_name' => 'handeln'));
get_header();
?>

    <div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

            <div class="handeln__posts-container">
                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();

                    /*
                    * Include the Post-Type-specific template for the content.
                    * If you want to override this in a child theme, then include a file
                    * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                    */
                    get_template_part( 'template-parts/content-handeln', get_post_type() );

                endwhile;

                the_posts_navigation();
                ?>
            </div>
        <?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();