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

<hr class="is-black">

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="header-container">
        <header class="entry-header">
            <div class="entry-title">
                <h2>
                    <?php the_title() ?>
                </h2>
                <p class="entry-date">
                    <?php echo $date; ?>
                </p>
                <p class="entry-location">
                    <?php echo $location; ?>
                </p>
            </div>

            <div class="actions">
                <a class="action has-plus button is-white is-rounded" target="_blank" ref="noopener noreferrer"
                <?php
                $date_obj = DateTime::createFromFormat('d/m/Y H:i', $date);
                $gcal_query = http_build_query(array(
                    'text' => get_the_title(),
                    'date' => $date_obj->format('Ymd').'/'.($date_obj->format('Ymd') + 1),
                    'details' => 'Event website: '.get_permalink(),
                    'location' => $location
                ));
                echo 'href="https://calendar.google.com/calendar/r/eventedit?'.$gcal_query.'"';
                ?>
                >
                    add to calendar
                </a>
                <a class="action button is-white is-rounded" target="_blank" ref="noopener noreferrer"
                <?php
                echo 'href="https://www.google.com/maps/search/'.urlencode($location).'"';
                ?>
                >
                    find location
                </a>
                <button class="action has-plus is-white is-rounded" style="visibility: hidden;">
                    add a new comment
                </button>
                <button class="action is-rounded is-white" style="visibility: hidden;">
                    read all
                </button>
            </div>
        </header>
    </div>

    <div class="content-container">
        <div class="entry-content">
            <?php
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'agn-theme' ),
                'after'  => '</div>',
            ) );
            ?>
        </div><!-- .entry-content -->
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
