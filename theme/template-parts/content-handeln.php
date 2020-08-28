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

	<?php agn_theme_post_thumbnail(); ?>

</article><!-- #post-<?php the_ID(); ?> -->
