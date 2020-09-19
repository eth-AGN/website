<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agn_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>">

		<header class="entry-header">
			<h2 class="entry-title">
				<?php the_title() ?>
			</h2>
			<p class="entry-date">
				<?php echo get_field('event_date', get_the_ID()); ?>
			</p>
			<p class="entry-location">
				<?php echo get_field('location', get_the_ID()); ?>
			</p>
		</header>

		<div class="thumb">
			<?php the_post_thumbnail(); ?>
		</div>

		<div class="schraffur">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/agn-schraffuren/festival-past.svg" alt="Schraffur" />
		</div>
	</a>
</article><!-- #post-<?php the_ID(); ?> -->
