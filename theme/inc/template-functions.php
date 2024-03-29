<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Agn_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function agn_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if (is_wissen()) $classes[] = 'category-wissen';
	if (is_denken()) $classes[] = 'category-denken';
	if (is_handeln()) $classes[] = 'category-handeln';

	if (is_search()) {
		$classes[] = 'category-'.$_GET['cat'];
	}

	return $classes;
}
add_filter( 'body_class', 'agn_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function agn_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'agn_theme_pingback_header' );

function agn_get_the_area() {
	if (is_wissen()) return 'wissen';
	else if (is_denken()) return 'denken';
	else if (is_handeln()) return 'handeln';
	else return '';
}

function agn_get_parent_archive_url() {
	return '/'.agn_get_the_area();
}