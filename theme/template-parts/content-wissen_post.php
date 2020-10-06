<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agn_Theme
 */
global $wp;
$current_url = home_url(add_query_arg(array(), $wp->request));
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

    <p class="tags">
    <?php
        $tags = get_the_tags();
        $tags = array_map(function($tag) {
            $url = get_tag_link($tag);
            return "<a href=\"$url?cat=wissen\">$tag->name</a>";
        }, $tags);
        echo join(' | ', $tags);
        ?>
    </p>
    

    <div class="actions">
        <?php if (get_field('is_public') || is_user_logged_in()): ?>
            <a class="button is-rounded is-green" href="<?php the_field('source_url') ?>" target="_blank">
                link to source
            </a>
        <?php else: ?>
            <a class="button is-rounded is-green" href="<?php echo wp_login_url($current_url) ?>">
                login to view source
            </a>
        <?php endif; ?>
        <a class="button is-rounded is-white" style="display: none">
            add a comment
        </a>
        <a class="button is-rounded is-white" style="display: none">
            read comments
        </a>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->
