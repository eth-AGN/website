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
				$cat = get_category_by_slug('denken');
				$tags = get_tags_by_category($cat);
				$data = array();
				foreach ($tags as $tag) {
					$tag_link = get_tag_link($tag->term_id) . '?cat=' . $cat->term_id;
					array_push($data, [$tag->name, $tag->count, ['href' => $tag_link]]);
				}
				echo htmlspecialchars(json_encode($data));
				?>
			"></div>
        <?php endif; ?>

        <?php
        $forum_id = get_posts(array('post_type' => 'forum'))[0]->ID;
        echo do_shortcode("[bbp-single-forum id=\"$forum_id\"]");
        ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();