<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Agn_Theme
 */

function is_wissen() {
	$cat = null;
	if ($_GET['cat']) {
		$cat = $_GET['cat'];
	} else if (!is_home() && count(get_the_category()) > 0) {
		$cat = get_the_category()[0]->slug;
	}
	return is_page_template( 'page-wissen.php') || is_category('wissen') || $cat == 'wissen';
}

function is_denken() {
	$cat = null;
	if ($_GET['cat']) {
		$cat = $_GET['cat'];
	}
	return is_page_template( 'page-denken.php' ) || is_bbpress() || $cat == 'denken';
}

function is_handeln() {
	$cat = null;
	if ($_GET['cat']) {
		$cat = $_GET['cat'];
	} else if (!is_home() && count(get_the_category()) > 0) {
		$cat = get_the_category()[0]->slug;
	}
	return is_page_template('paged_handeln.php') || is_category('handeln') || $cat == 'handeln';
}

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