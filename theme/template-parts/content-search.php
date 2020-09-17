<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agn_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->
