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
	<div class="wissen__entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<p class="entry-title">', '</p>' );
		else :
			the_title( '<p class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></p>' );
        endif;

        the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'agn-theme' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );
                
        if ( 'post' === get_post_type() ) :
            ?>
            <p>
                <?php agn_theme_posted_on(); ?>
            </p>
            <p>
                <?php agn_theme_posted_by(); ?>
            </p>
            
        <?php endif; ?>
	</div><!-- .entry-header -->


	<div class="entry-content">
		<?php
		

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'agn-theme' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<!-- <footer class="entry-footer">
		<?php agn_theme_entry_footer(); ?>
	</footer> -->
    <!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
