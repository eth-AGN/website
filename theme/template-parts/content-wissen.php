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
	<a class="wissen__post-entry" href="<?php the_permalink(); ?>">
		<span class="scroll-wrapper">
			<span><?php the_title() ?></span>
		</span>
		<span class="scroll-wrapper">
			<span><?php the_field('author') ?></span>
		</span>
		<span class="scroll-wrapper">
			<span><?php the_field('format') ?></span>
		</span>
		<span class="scroll-wrapper">
			<span><?php the_field('published_at') ?></span>
		</span>
		<span class="scroll-wrapper">
			<span><?php the_field('publisher') ?></span>
		</span>
	</a>

</article><!-- #post-<?php the_ID(); ?> -->
