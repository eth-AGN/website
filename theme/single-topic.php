<?php

/**
 * Single Topic
 *
 * @package bbPress
 * @subpackage Theme
 */

get_header(); ?>

	<?php do_action( 'bbp_before_main_content' ); ?>

	<?php do_action( 'bbp_template_notices' ); ?>

	<?php if ( bbp_user_can_view_forum( array( 'forum_id' => bbp_get_topic_forum_id() ) ) ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

            <div id="bbp-topic-wrapper-<?php bbp_topic_id(); ?>" class="bbp-topic-wrapper denken__post">
                <header class="denken__post-header">
                    <p>
                        <?php bbp_topic_author(); ?> on
                        <?php bbp_topic_post_date(); ?>
                    </p>
                    <h1 class="entry-title"><?php bbp_topic_title(); ?></h1>


										<p class="tags is-black">
												<?php
												$tags = bbp_get_topic_tags();
												$tags = array_map(function($tag) {
														$url = get_tag_link($tag);
														return "<a class=\"is-black\" href=\"$url?cat=handeln\">$tag->name</a>";
												}, $tags);
												echo join(' | ', $tags);
												?>
										</p>
                </header>

                <?php bbp_get_template_part( 'content', 'single-topic' ); ?>

			</div><!-- #bbp-topic-wrapper-<?php bbp_topic_id(); ?> -->

		<?php endwhile; ?>

	<?php elseif ( bbp_is_forum_private( bbp_get_topic_forum_id(), false ) ) : ?>

		<?php bbp_get_template_part( 'feedback', 'no-access' ); ?>

	<?php endif; ?>

	<?php do_action( 'bbp_after_main_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer();
