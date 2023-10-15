<?php
/**
 * Poisk functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Poisk
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function poisk_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Poisk, use a find and replace
		* to change 'poisk' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'poisk', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'poisk' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'poisk_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'poisk_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function poisk_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'poisk_content_width', 640 );
}
add_action( 'after_setup_theme', 'poisk_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function poisk_widgets_footer() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer - левый блок', 'poisk' ),
			'id'            => 'footer-left',
			'description'   => esc_html__( 'Виджеты нижней части сайта.', 'poisk' ),
			'before_widget' => '<div id="%1$s" class="widget widget-footer %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
}

add_action( 'widgets_init', 'poisk_widgets_footer');

/**
 * Enqueue scripts and styles.
 */
function poisk_scripts() {
	wp_enqueue_style( 'poisk-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'poisk-style', 'rtl', 'replace' );

	wp_enqueue_script( 'poisk-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'poisk_scripts' );

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

// function add_open_post_link($content) {
//     if (!is_single()) {
//         $footer = $content . '<a class="button" href="' . the_permalink() . '">Открыть
//                         <svg width="20px" height="20px" viewBox="0 0 28 28">
//                          <path class="button-icon" fill="currentColor" d="M28,8V7.382l-0.553-0.276C27.356,7.061,25.187,6,21,6c-2.728,0-4.224,0.454-5,0.831
//                             C15.224,6.454,13.728,6,11,6C6.812,6,4.644,7.061,4.553,7.105L4,7.382V9H3v16h10v1h6v-1h10V8H28z M26,8.685v12.914
//                             C24.925,21.308,23.255,21,21,21c-1.841,0-3.122,0.207-4,0.457V8.569C17.516,8.349,18.696,8,21,8C23.522,8,25.197,8.421,26,8.685z
//                              M6,8.686C6.806,8.42,8.479,8,11,8c2.325,0,3.506,0.355,4,0.562v12.895C14.122,21.207,12.841,21,11,21c-2.255,0-3.925,0.308-5,0.599
//                             V8.686z"/>
//                          </svg>
//                         </a>';
//         return $footer;
//     }
//     elseif (is_home() || is_front_page()) {
//         return '123';
//     }
// }
//
// add_filter('the_content', 'add_open_post_link');

function add_open_article_button( $content ) {
    if ( is_home() || is_archive() ) { // Проверяем, что мы находимся на странице со списком записей
        $button_html = '<a href="' . get_permalink() . '" class="button">Открыть
                                               <svg width="20px" height="20px" viewBox="0 0 28 28">
                                                <path class="button-icon" fill="currentColor" d="M28,8V7.382l-0.553-0.276C27.356,7.061,25.187,6,21,6c-2.728,0-4.224,0.454-5,0.831
                                                   C15.224,6.454,13.728,6,11,6C6.812,6,4.644,7.061,4.553,7.105L4,7.382V9H3v16h10v1h6v-1h10V8H28z M26,8.685v12.914
                                                   C24.925,21.308,23.255,21,21,21c-1.841,0-3.122,0.207-4,0.457V8.569C17.516,8.349,18.696,8,21,8C23.522,8,25.197,8.421,26,8.685z
                                                    M6,8.686C6.806,8.42,8.479,8,11,8c2.325,0,3.506,0.355,4,0.562v12.895C14.122,21.207,12.841,21,11,21c-2.255,0-3.925,0.308-5,0.599
                                                   V8.686z"/>
                                                </svg>
                                               </a>';
        $content .= $button_html;
    }
    return $content;
}

add_filter( 'the_content', 'add_open_article_button' );

function add_divider_between_posts($content) {
    if (is_home() || is_archive() || is_search()) {
        $content .= '<hr class="articles-divider">';
    }
    return $content;
}

add_filter('the_content', 'add_divider_between_posts');

add_filter( 'the_content_more_link', '__return_empty_string' );