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
    <header class="bbp-topic-header">
        <div class="bbp-topic-author is-white">
            by <?php echo bbp_get_topic_author(); ?>,
            <!-- <?php bbp_topic_post_date(null, true) ?> -->
            last active <?php echo bbp_get_topic_last_active_time(bbp_get_topic_id()) ?>
        </div>

        <h2 class="bbp-topic-title">
            <?php bbp_topic_title(); ?>
        </h2>
    </header>


    <div class="bbp-topic-description">
        <?php bbp_topic_excerpt(bbp_get_topic_id(), 400); ?>
    </div>
        
</a><!-- #bbp-topic-<?php bbp_topic_id(); ?> -->
