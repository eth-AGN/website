<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>

<li id="post-<?php bbp_reply_id(); ?>" <?php bbp_reply_class(0, array('denken__reply')); ?> >
	<span class="denken__reply-meta">
		<?php bbp_reply_author(); ?>
		<?php bbp_reply_post_date(); ?>
	</span><!-- .bbp-meta -->

	<span class="denken__reply-content">

		<?php bbp_reply_content(); ?>

	</span><!-- .bbp-reply-content -->
</li><!-- .reply -->
