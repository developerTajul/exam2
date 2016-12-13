<?php
/**
 * Second Exam functions and definitions.
 *
 * @package Second_Exam
 */

if ( ! function_exists( 'secondexam_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function secondexam_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Second Exam, use a find and replace
	 * to change 'secondexam' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'secondexam', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'secondexam' ),
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
	add_theme_support( 'custom-background', apply_filters( 'secondexam_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


	register_post_type('services', array(
		'label'		=> 'Services',
		'labels'	=> array(
			'name'	=> 'Services',
			'add_new'	=> 'Add New Service',
			'add_new_item'	=> 'Add New Service'
			),
		'public'	=> true,
		'suppors'	=> array('title', 'editor', 'thumbnail')
	));

	register_taxonomy('service_cat', 'services', array(
		'label'		=> 'Types',
		'labels'	=> array(
				'name'	=> 'Types',
				'add_new'	=> 'Add New Type',
				'add_new_item' => 'Add New Type'
			),
		'public'	=> true,
		'hierarchical'	=> true
	));

}
endif;
add_action( 'after_setup_theme', 'secondexam_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function secondexam_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'secondexam_content_width', 640 );
}
add_action( 'after_setup_theme', 'secondexam_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function secondexam_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'secondexam' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'secondexam' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'secondexam_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function secondexam_scripts() {
	wp_enqueue_style('exam-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', array(), '1.0.1', 'all');
	wp_enqueue_style('exam-font-awesome', get_template_directory_uri().'/css/font-awesome.min.css', array(), '1.0.2', 'all');

	wp_enqueue_style( 'secondexam-style', get_stylesheet_uri() );



	wp_enqueue_script( 'secondexam-navigation', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '2.0.1', true );

	wp_enqueue_script( 'secondexam-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'secondexam-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'secondexam_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';




/**
 * Get the bootstrap!
 */
if ( file_exists(  __DIR__ . '/libs/cmb2/init.php' ) ) {
  require_once  __DIR__ . '/libs/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/libs/CMB2/init.php' ) ) {
  require_once  __DIR__ . '/libs/CMB2/init.php';
}




add_action( 'cmb2_admin_init', 'cmb2_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function cmb2_sample_metaboxes() {

    

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'test_metabox',
        'title'         => __( 'Test Metabox', 'cmb2' ),
        'object_types'  => array( 'page', 'services'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    // Regular text field
    $cmb->add_field( array(
        'name'       => __( 'Icon Name', 'cmb2' ),
        'desc'       => __( 'field description (optional)', 'cmb2' ),
        'id'         => 'icon_service',
        'type'       => 'text',
        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
        // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
        // 'on_front'        => false, // Optionally designate a field to wp-admin only
        // 'repeatable'      => true,
    ) );



    // Add other metaboxes as needed

}


