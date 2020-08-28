<?php
/**
 * The template for displaying posts in the category "wissen"
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agn_Theme
 */

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


		<?php if ( have_posts() ) : ?>

			<header class="page-header">
			<h1 class="page-title">
				<?php
				if (is_tag()) {
					echo $wp_query->query_vars['tag'];
				} else {
					echo single_cat_title('', false);
				}
				?>
			</h1>
			<?php
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
            </header><!-- .page-header -->


			<div class="denken__posts-container magic-grid" data-magic-grid>
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content-denken', get_post_type() );

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