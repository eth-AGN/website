<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agn_Theme
 */

$format = get_field('format');
$current_date = new DateTime();
$event_date = DateTime::createFromFormat('d/m/Y H:i', get_field('event_date'));

$time_pos = 'present';
if ($event_date) {
	if ($current_date > $event_date) {
		$time_pos = 'past';
	} else if ($current_date < $event_date) {
		$time_pos = 'future';
	}
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>">

		<header class="entry-header">
			<h2 class="entry-title">
				<?php the_title() ?>
			</h2>
			<p class="entry-date">
				<?php the_field('display_date'); ?>
			</p>
			<p class="entry-location">
				<?php the_field('location'); ?>
			</p>
		</header>

		<div class="thumb">
			<?php the_post_thumbnail(); ?>
		</div>

		<div class="schraffur">
			<img src="<?php echo get_template_directory_uri()."/assets/img/agn-schraffuren/$format-$time_pos.svg"; ?>" alt="Schraffur" />
		</div>
	</a>
</article><!-- #post-<?php the_ID(); ?> -->
