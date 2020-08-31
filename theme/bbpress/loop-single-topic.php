<?php

/**
 * Topics Loop - Single
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>

<a id="bbp-topic-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?> href="<?php bbp_topic_permalink(); ?>">
    <div class="bbp-topic-started-by">
        started by <?php echo bbp_get_topic_author(); ?>
    </div>
    <div class="bbp-topic-last-update">
        updated <?php echo bbp_get_topic_last_active_time(bbp_get_topic_id()) ?>
        by
        <?php echo get_the_author_meta('display_name', get_post_field( 'post_author', bbp_get_topic_last_active_id() ));?>
    </div>

    <h2 class="bbp-topic-title">
        <?php bbp_topic_title(); ?>
    </h2>


    <div class="bbp-topic-description">
        <?php bbp_topic_excerpt(); ?>
    </div>
        
</a><!-- #bbp-topic-<?php bbp_topic_id(); ?> -->
