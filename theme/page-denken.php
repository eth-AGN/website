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


    <div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if (!is_tag()): ?>
			<div class="wordcloud" data-wordcloud-list="
				<?php
				// $cat = get_category_by_slug('denken');
				$tags = get_topic_tags();
				$data = array();
				foreach ($tags as $tag) {
					$tag_link = get_tag_link($tag->term_id);
					$data[] = [$tag->name, $tag->count, ['href' => $tag_link]];
				}
				echo htmlspecialchars(json_encode($data));
				?>
			"></div>
        <?php endif; ?>

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