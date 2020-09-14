<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

do_action( 'bbp_template_before_replies_loop' ); ?>

<ul class="denken__post-replies">

	<?php while ( bbp_replies() ) : bbp_the_reply(); ?>

		<?php bbp_get_template_part( 'loop', 'single-reply' ); ?>

	<?php endwhile; ?>

</ul><!-- #topic-<?php bbp_topic_id(); ?>-replies -->

<?php do_action( 'bbp_template_after_replies_loop' );
