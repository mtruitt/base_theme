<?php
/**
 * sfbase functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sfbase
 */

if ( ! function_exists( 'sfbase_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sfbase_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on sfbase, use a find and replace
		 * to change 'sfbase' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sfbase', get_template_directory() . '/languages' );

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

		// Register Custom Navigation Walker
		require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary-nav' => esc_html__( 'Primary Menu', 'sfbase' ),
			'secondary-nav' => esc_html__( 'Secpmdary Menu', 'sfbase' ),
			'mobile-nav' => esc_html__( 'Mobile Menu', 'sfbase' ),
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
		add_theme_support( 'custom-background', apply_filters( 'sfbase_custom_background_args', array(
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
add_action( 'after_setup_theme', 'sfbase_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
add_action( 'widgets_init', 'sfbase_widgets_init' );
function sfbase_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sfbase' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'sfbase' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Alert Bar', 'sfbase' ),
		'id'            => 'alert',
		'description'   => esc_html__( 'Add a text widget with content to display alert on all pages.  Delete text widget to remove alert and green bar.', 'sfbase' ),
		'before_widget' => '<div id="%1$s" class="text-center %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="sr-only">',
		'after_title'   => '</div>',

	) );
}


/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'sfbase_scripts' );
function sfbase_scripts() {

    // Styles - Slick Slider, Bootstrap, Custom Styles
	//wp_enqueue_style('sf-styles', get_template_directory_uri() . '/css/prefixed/style.css');
	wp_enqueue_style('slick-styles', get_template_directory_uri() . '/css/slick.css');
	wp_enqueue_style('slick-theme', get_template_directory_uri() . '/css/slick-theme.css');
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;700;800&display=swap', [], null );//change or remove as necessary
    wp_enqueue_style('sf-styles', get_template_directory_uri() . '/css/style.css');
    //wp_enqueue_style('sf-styles', get_template_directory_uri() . '/dest/style.css');


    // Scripts - Jquery 3.3.1, Bootstrap 4.2.1, Custom Script
    wp_enqueue_script('sf-jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', array(), '', true);
    wp_enqueue_script('popper', '/js/bootstrap/popper.min.js', array(), '', true);
	wp_enqueue_script('bootstrap', '/js/bootstrap/bootstrap.min.js', array(), '', true);
	wp_enqueue_script('slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '', true);
    wp_enqueue_script('sf-custom', get_template_directory_uri() . '/js/custom.js', array(), '', true);
    // Fonts - Font Awesome
    wp_enqueue_script('font-awesome-5', 'https://kit.fontawesome.com/71099f277e.js');

}

/**
 * Custom Login Page Styles
 */
add_action( 'login_enqueue_scripts', 'sfbase_login_stylesheet' );
function sfbase_login_stylesheet() {

    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/style-login.css' );

}

/*
 * Change link URL for logo on login page - defaults to Wordpress and we change to site home page
 *
 */
add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) {
    return '/';
}
/**
 * Custom Theme Admin Styles
 */

add_action('admin_init', 'additional_admin_color_schemes');
function additional_admin_color_schemes() {
	//Get the theme directory
	$theme_dir = get_template_directory_uri();

	//sfbase
	wp_admin_css_color( 'sfbase', __( 'sfbase' ),
	  $theme_dir . '/admin-colors/sfbase/colors.css',
	  array( '#1a4956', '#236476', '#7baf3d', '#cfe0da' )
	);
}

/**
 * Set new default admin color to match custom color scheme
 */
add_action('user_register', 'set_default_admin_color');
function set_default_admin_color($user_id) {
    $args = array(
        'ID' => $user_id,
        'admin_color' => 'sfbase'
    );
    wp_update_user( $args );
}


/**
 * Rename original default color scheme to avoid confusion for new users
 */
function rename_fresh_color_scheme() {
	global $_wp_admin_css_colors;
	$color_name = $_wp_admin_css_colors['fresh']->name;

	if( $color_name == 'Default' ) {
	  $_wp_admin_css_colors['fresh']->name = 'Fresh';
	}
	return $_wp_admin_css_colors;
  }
  add_filter('admin_init', 'rename_fresh_color_scheme');

/**
 * Create custom image sizes
 */

function custom_image_sizes()
{
    add_image_size('background-image', 1920); // 1920 pixels wide
}

add_action('after_setup_theme', 'custom_image_sizes');


/**
 * Create Options Page for ACF
 */
if( function_exists('acf_add_options_page') ) {

	// add parent
   $parent = acf_add_options_page(array(
	   'page_title' 	=> 'Your Site Settings',
	   'menu_title' 	=> 'Your Site Settings',
	   'redirect' 		=> false
   ));

}
// Import select site styles into the Wordpress WYSIWYG
add_action( 'admin_init', 'add_editor_theme_styles' );
function add_editor_theme_styles() {
	add_editor_style( get_stylesheet_directory_uri() . '/css/custom-editor-style.css' );
  }


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

/**
 * Register Bootstrap paging element
 */
require_once('wp-bootstrap4-pagination.php');

/**
 * Add SVG support.
 */
add_action('upload_mimes', 'add_file_types_to_uploads');
function add_file_types_to_uploads($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);
    return $file_types;
}

/**
 * ADMIN CSS TO MAKE HOMEPAGE SITE BUILDER LOOK A BIT NICER
 */
add_action('admin_head', 'my_custom_admin_css');
function my_custom_admin_css() {
    echo '
		<style>
		/* ACF UI tweaks */
    .acf-flexible-content .layout .acf-fc-layout-handle {
			background-color: #adadad;
			color: #fff;
			padding: 1rem;
			font-size: 1.5rem;
		}
		.acf-flexible-content .layout .acf-fc-layout-order {
			font-size: 1.25rem;
			width: 30px;
			height: 30px;
			border-radius: 50%;
			line-height: 30px;
		}
		.acf-flexible-content .layout .acf-icon.small,
		.acf-flexible-content .layout .acf-icon.-small {
			width: 22px;
			height: 22px;
			line-height: 22px;
			font-size: 16px;
		}
		</style>
  ';
}


