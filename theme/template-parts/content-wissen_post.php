<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agn_Theme
 */

$date = get_field('event_date');
$location = get_field('location');
?>

<hr class="is-white">

<article id="post-<?php the_ID(); ?>" <?php post_class('wissen__post'); ?>>
    <div class="header-container">
        <header class="entry-header">
            <div class="entry-header-item"><span><?php the_title() ?></span></div>
            <div class="entry-header-item"><span><?php the_field('author') ?></span></div>
            <div class="entry-header-item"><span><?php the_field('format') ?></span></div>
            <div class="entry-header-item"><span><?php the_field('published_at') ?></span></div>
            <div class="entry-header-item"><span><?php the_field('publisher') ?></span></div>
        </header>
    </div>

    <div class="content-container is-white">
        <div class="entry-content">
            <?php
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'agn-theme' ),
                'after'  => '</div>',
            ) );
            ?>
            <p class="author-description">
                <?php the_field('author_description'); ?>
            </p>
        </div><!-- .entry-content -->
    </div>

    
    <?php the_tags('<p class="tags">',' | ', '</p>'); ?>
    

    <div class="actions">
        <a class="button is-rounded is-green" href="<?php the_field('source_url') ?>" target="_blank">
            link to source
        </a>
        <a class="button is-rounded is-white" style="visibility: hidden;">
            add a comment
        </a>
        <a class="button is-rounded is-white" style="visibility: hidden;">
            read comments
        </a>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->
