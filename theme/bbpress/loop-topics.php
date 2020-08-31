<?php

/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

do_action( 'bbp_template_before_topics_loop' ); ?>


<?php while ( bbp_topics() ) : bbp_the_topic(); ?>

    <?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

<?php endwhile; ?>


<?php do_action( 'bbp_template_after_topics_loop' );
