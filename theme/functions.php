<?php
/**
 * Agn_Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Agn_Theme
 */

if ( ! function_exists( 'agn_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function agn_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Agn_Theme, use a find and replace
		 * to change 'agn-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'agn-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'agn-theme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'agn_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'agn_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function agn_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'agn_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'agn_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function agn_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'agn-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'agn-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'agn_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function agn_theme_scripts() {

	// Loads required CSS header only.
	wp_enqueue_style( 'agn-theme-style', get_stylesheet_uri() );

	// Loads bundled frontend CSS.
	wp_enqueue_style( 'agn-theme-frontend-styles', get_stylesheet_directory_uri() . '/public/frontend.css' );

	wp_enqueue_script( 'agn-theme-frontend-scripts', get_template_directory_uri() . '/public/frontend-bundle.js', array(), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'agn_theme_scripts' );


function compile_post_type_labels($singular = 'Post', $plural = 'Posts') {
	$p_lower = strtolower($plural);
	$s_lower = strtolower($singular);
	
	return [
        'name' => $plural,
        'singular_name' => $singular,
        'add_new_item' => "New $singular",
        'edit_item' => "Edit $singular",
        'view_item' => "View $singular",
        'view_items' => "View $plural",
        'search_items' => "Search $plural",
        'not_found' => "No $p_lower found",
        'not_found_in_trash' => "No $p_lower found in trash",
        'parent_item_colon' => "Parent $singular",
        'all_items' => "All $plural",
        'archives' => "$singular Archives",
        'attributes' => "$singular Attributes",
        'insert_into_item' => "Insert into $s_lower",
        'uploaded_to_this_item' => "Uploaded to this $s_lower",
    ];
}

function event_meta_box(WP_Post $post) {
	add_meta_box('event_meta', 'Event Details', function() use ($post) {
		$field_name = 'event_date';
		$field_value = get_the_date('Y-m-d', $post);
		wp_nonce_field('event_nonce', 'event_nonce');
		?>
		<table class="form-table">
            <tr>
                <th> <label for="<?php echo $field_name; ?>">Event Date</label></th>
                <td>
                    <input id="<?php echo $field_name; ?>"
                           name="<?php echo $field_name; ?>"
                           type="date"
                           value="<?php echo $field_value; ?>"
                    />
                </td>
            </tr>
		</table>
		<?php
	});
}

add_action('init', function() {
	$type = 'event';
	$labels = compile_post_type_labels('Event', 'Events');

	$supports = ['title', 'editor', 'author', 'thumbnail', 'revisions', 'page-attributes'];

	$arguments = [
		'has_archive' => true,
		'taxonomies' => ['post_tag', 'category'],
		'register_meta_box_cb' => 'event_meta_box',
		'public' => true,
		'show_in_rest' => true,
		'supports' => $supports,
		'description' => 'Posts for the Handeln page.',
		'labels' => $labels
	];
	register_post_type($type, $arguments);
});

// save metadata
add_action('save_post', function($post_id){
    $post = get_post($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $field_name = 'event_date';

    // Do not save meta for a revision or on autosave
    if ( $post->post_type != 'event' || $is_revision )
        return;

    // Do not save meta if fields are not present,
    // like during a restore.
    if( !isset($_POST[$field_name]) )
        return;

    // Secure with nonce field check
    if( ! check_admin_referer('event_nonce', 'event_nonce') )
        return;

    // Clean up data
    $field_value = trim($_POST[$field_name]);

    // Do the update
	update_post_meta($post_id, $field_name, $field_value);
});

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


function get_tags_by_category($category) {
	global $wpdb;

	$cat = get_category($category);
	$tags = $wpdb->get_results
	("
		SELECT tag.term_id as term_id, tag.name as name, COUNT(post.id) as count
		FROM
			(
				SELECT p.ID as ID
				FROM
					wp_posts p
					JOIN wp_term_relationships ts ON ts.object_ID = p.ID
					JOIN wp_term_taxonomy tt ON tt.term_taxonomy_id = ts.term_taxonomy_id
					JOIN wp_terms cat ON cat.term_id = tt.term_id
				WHERE
					tt.taxonomy = 'category' AND cat.term_id = $cat->term_id
			) as post
			JOIN wp_term_relationships ts ON ts.object_ID = post.ID
			JOIN wp_term_taxonomy tt ON tt.term_taxonomy_id = ts.term_taxonomy_id
			JOIN wp_terms tag ON tag.term_id = tt.term_id
		WHERE
			tt.taxonomy = 'post_tag'
		GROUP BY term_id
		ORDER BY count DESC
	");
	return $tags;
}