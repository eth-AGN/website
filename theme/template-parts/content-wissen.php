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
		<div class="scroll-container">
			<span class="scroll-wrapper">
				<span data-auto-scroll><?php the_title() ?></span>
			</span>
		</div>

		<div class="scroll-container">
			<span class="scroll-wrapper">
				<span data-auto-scroll><?php the_field('author') ?></span>
			</span>
		</div>

		<div class="scroll-container">
			<span class="scroll-wrapper">
				<span data-auto-scroll><?php the_field('format') ?></span>
			</span>
		</div>

		<div class="scroll-container">
			<span class="scroll-wrapper">
				<span data-auto-scroll><?php the_field('published_at') ?></span>
			</span>
		</div>

		<div class="scroll-container">
			<span class="scroll-wrapper">
				<span data-auto-scroll><?php the_field('publisher') ?></span>
			</span>
		</div>
	</a>

</article><!-- #post-<?php the_ID(); ?> -->
