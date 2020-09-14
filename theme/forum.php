<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agn_Theme
 */

// query_posts(array('category_name' => 'denken'));

get_header();
?>


    <div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php do_action( 'bbp_before_main_content' ); ?>

            <?php do_action( 'bbp_template_notices' ); ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <?php if ( bbp_user_can_view_forum() ) : ?>

                    <div id="forum-<?php bbp_forum_id(); ?>" class="bbp-forum-content">
                        <h1 class="entry-title"><?php bbp_forum_title(); ?></h1>
                        <div class="entry-content">

                            <?php bbp_get_template_part( 'content', 'single-forum' ); ?>

                        </div>
                    </div><!-- #forum-<?php bbp_forum_id(); ?> -->

                <?php else : // Forum exists, user no access ?>

                    <?php bbp_get_template_part( 'feedback', 'no-access' ); ?>

                <?php endif; ?>

            <?php endwhile; ?>

            <?php do_action( 'bbp_after_main_content' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();