<?php
/**
 * Template Name: DenkenPage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agn_Theme
 */

// query_posts(array('category_name' => 'denken'));

get_header();
?>
	<div class="global-tags">
		<p class="global-tags-display"></p>
		<p class="global-tags-status"></p>
	</div>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			if (!is_tag()) {
				display_global_wordcloud();
			}
			?>

			<?php
			// this way, the forum can be filtered by tags
			bbpress()->current_forum_id = get_forum_id_by_name('denken');
			bbp_get_template_part( 'content',  'single-forum' );
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();