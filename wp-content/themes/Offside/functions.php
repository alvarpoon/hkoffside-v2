<?php
/**
 * margot functions and definitions
 *
 * @package margot
 * @since margot 1.0
 */

/* Setup
 =================================================================================================== */

if (is_admin() && isset($_GET['activated']) && $pagenow == "themes.php") {
	header('Location: ' . admin_url() . 'themes.php?page=options-framework');
}

if (!isset($content_width)) $content_width = 718; /* pixels */

if (!function_exists('margot_setup')):
	function margot_setup() {
		// Translation
		load_theme_textdomain('margot', get_template_directory() . '/inc/languages');
		$locale = get_locale();
		$locale_file = get_template_directory() . "/inc/languages/$locale.php";
		if (is_readable($locale_file)) require_once ($locale_file);
		// Supported functions
		if (function_exists('add_theme_support')) {
			add_theme_support('automatic-feed-links'); // Add posts and comments RSS feed links to head
			add_theme_support('post-thumbnails'); // Support for Post Thumbnails
			add_theme_support('menus'); // Support for Menus
			add_theme_support('post-formats', array('gallery','video','audio')); // Posts Formats
		}
		// Register Menus
		register_nav_menus(array('logo-menu' => __('Logo Menu', 'margot') ));
		register_nav_menus(array('top-menu' => __('Header Menu', 'margot') ));
		register_nav_menus(array('footer-menu' => __('Footer Menu', 'margot') ));
 
	}
endif; // margot_setup
add_action('after_setup_theme', 'margot_setup');


// IMG Thumbnails
add_image_size('mrg_featured_xl', 750, 550, true);
add_image_size('mrg_featured_l', 380, 520, true);
add_image_size('mrg_featured_m', 380, 260, true);

add_image_size('mrg_carousel', 270, 400, true);

add_image_size('mrg_posts_square', 360, 360, true);
add_image_size('mrg_posts_header', 1140, 500, true);


/* Register widgetized area
 =================================================================================================== */

function margot_widgets_init() {
	
	register_sidebar(array(
		'name' => __('Sidebar (Default for all Pages)', 'margot') ,
		'id' => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="unroll"><h3 class="widget-title pretitle"><span>',
		'after_title' => '</span></h3></div>',
	));
	
	register_sidebar(array(
		'name' => __('Single Posts Sidebar', 'margot') ,
		'id' => 'single-post-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="unroll"><h3 class="widget-title pretitle"><span>',
		'after_title' => '</span></h3></div>',
	));
	
	register_sidebar(array(
		'name' => __('Pages Sidebar', 'margot') ,
		'id' => 'page-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="unroll"><h3 class="widget-title pretitle"><span>',
		'after_title' => '</span></h3></div>',
	));
	
	register_sidebar(array(
		'name' => __('Blog Sidebar', 'margot') ,
		'id' => 'blog-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="unroll"><h3 class="widget-title pretitle"><span>',
		'after_title' => '</span></h3></div>',
	));
	
	register_sidebar(array(
		'name' => __('Contact Page Sidebar', 'margot') ,
		'id' => 'contact-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="unroll"><h3 class="widget-title pretitle"><span>',
		'after_title' => '</span></h3></div>',
	));
	
	register_sidebar(array(
		'name' => __('Footer First-Column', 'margot') ,
		'id' => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => __('Footer Second-Column', 'margot') ,
		'id' => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => __('Footer Third-Column', 'margot') ,
		'id' => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

}
add_action('widgets_init', 'margot_widgets_init');

/* Load scripts and styles
 =================================================================================================== */
function margot_scripts() {
	global $wp_styles;
	/* * Load Fonts */
	wp_enqueue_style( 'GoogleFonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Roboto:400,100,300,500,700', array() , '1.2', 'all');
	/* * Load CSS */
	wp_enqueue_style('Bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array() , '3.0.3', 'all');
	wp_enqueue_style('Lib', get_template_directory_uri() . '/css/lib.css', array() , '1.4', 'all');
	wp_enqueue_style('Style', get_template_directory_uri() . '/css/main.css', array() , '1.4', 'all');
	wp_enqueue_style('Responsive', get_template_directory_uri() . '/css/responsive.css', array() , '1.4', 'all');
	if (of_get_option('set_boxed', false) && of_get_option('set_bg', false)) { 
		wp_enqueue_style('Boxed', get_template_directory_uri() . '/css/boxed.css', array() , '1.4', 'all');
	}
	/* * Load Javascript */
	wp_enqueue_script('jquery', false, null, null, true);
	wp_enqueue_script('Lib', get_template_directory_uri() . '/js/lib.js', array('jquery') , '1.4', true);

	if ("loadmore" == of_get_option('st_nav', 'prevnext')) { 
		wp_enqueue_script('Infinite-Scroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery') , '3.1.3', false); 
	}
	wp_enqueue_script('Init', get_template_directory_uri() . '/js/init.js', array('jquery') , '1.4', true);
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	$margot_params = array( //JS Vars
		'loadingimg' => get_template_directory_uri() . '/img/ajax-loader.gif',
		'loadmsg' => __('Loading posts...', 'margot'),
		'nomsg' => __('No posts', 'margot')
	);
	wp_localize_script('Init', 'mrgvars', $margot_params);
}
add_action('wp_enqueue_scripts', 'margot_scripts');

/* Comments Options
 =================================================================================================== */
function margot_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;
?>

<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>

		<?php echo get_avatar($comment, '100'); ?>

		<div class="single-comment">
			<?php comment_text() ?>
			<div class="comment-meta"><span class="ccauthor"><?php comment_author_link(); ?></span> / <time class="date" datetime="<?php comment_time('c'); ?>"><?php comment_date('F j, Y'); ?></time>
			<span class="cc-reply btn-icon"><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'] ))); ?></span>

			<?php if ($comment->comment_parent != '0'): ?> <a href="<?php $commentparent = get_comment($comment->comment_parent);
		$commentparentpage = get_page_of_comment($commentparent);
		echo htmlspecialchars(get_comment_link($commentparent, array(
			'page' => $commentparentpage
		))) ?>">(<?php _e('in reply to', 'margot') ?> <?php echo $commentparent->comment_author; ?>)</a> <?php
	endif; ?>

			</div>
		</div>

<?php
}

/* Custom body class
 =================================================================================================== */
function margot_body_class( $mrgclass ) {

	global $post;
	
	if ( is_page() && !is_archive() && !is_home() ) {
		$mrgclass[] = 'mrg-page';
	}

	if ( of_get_option('set_boxed', false) && of_get_option('set_bg', false) ) {
		$mrgclass[] = 'mrg-boxed';
	}

	if ( !of_get_option('set_bg', false) ) {
		$mrgclass[] = 'mrg-wide';
	}

	if ( is_page_template( 'page-fullwidth.php' ) || is_attachment() || is_single() && get_post_meta($post->ID, 'margot_meta_sidebar', true) ) {
		$mrgclass[] = 'page-full';
	}

	if ( of_get_option('sticky_menu', true) && is_admin_bar_showing() ) {
		$mrgclass[] = 'sticky-nav extra-top';
	}
	elseif ( of_get_option('sticky_menu', true) ) {
		$mrgclass[] = 'sticky-nav';
	}

	return $mrgclass;
}
add_filter( 'body_class', 'margot_body_class' );


/* Custom post class
 =================================================================================================== */

function margot_post_class( $mrgclass ) {
	global $post;

	if ( !has_post_thumbnail() && !has_post_format('') ) {
		$mrgclass[] = 'no-thumb';
	}

	if ( !is_home() && !is_archive() && of_get_option('en_dropcaps', true) ) {
		$mrgclass[] = 'mrg-dropc';
	}

	if ( !is_home() && !is_archive() && !of_get_option('full_title', true) && !get_post_meta($post->ID, 'margot_meta_sidebar', true) && !is_page_template( 'page-fullwidth.php' ) ) {
		$mrgclass[] = 'col-md-8 col-feed mrg-int-header';
	}
	else if (!is_home() && !is_archive()) {
		$mrgclass[] = 'mrg-full-header';
	}

	return $mrgclass;
}
add_filter( 'post_class', 'margot_post_class' );


/* Custon excerpt
 =================================================================================================== */
function margot_extrdph($length) {
	if (is_page()) {
		return 30;
	} else {
		return 44;
	}
}

function margot_extrmoredph($more) {
	return '...';
}

function wpe_excerpt($length_callback, $more_callback) {
	global $post;
	if (function_exists($length_callback)) {
		add_filter('excerpt_length', $length_callback);
	}
	if (function_exists($more_callback)) {
		add_filter('excerpt_more', $more_callback);
	}
	$output = get_the_excerpt();
	$output = apply_filters('wptexturize', $output);
	$output = apply_filters('convert_chars', $output);
	echo $output;
}

/* Menu tweaks
 =================================================================================================== */

add_filter('wp_nav_menu_items', 'margot_home_link', 10, 2);
function margot_home_link($items, $args) {
	
	if (is_home()) {
		$class = 'class="home-menu current current-menu-item"';
	} else {
		$class = 'class="home-menu"';
	}
	$homeMenuItem = "<li $class >" . $args->before . '<a href="' . home_url('/') . '" title="主頁">' . $args->link_before . '主頁' . $args->link_after . '</a>' . $args->after . "</li>";
	$items = $homeMenuItem . $items;
	return $items;
}

/* Post Views
 =================================================================================================== */
function margot_getPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if ($count == '') {
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0";
	}
	return $count;
}
function margot_setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if ($count == '') {
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	} else {
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}

/* Options Framework
 =================================================================================================== */

if (!function_exists('of_get_option')) {
	function of_get_option($name, $default = false) {
		$optionsframework_settings = get_option('optionsframework');
		// Gets the unique option id
		$option_name = $optionsframework_settings['id'];
		
		if (get_option($option_name)) {
			$options = get_option($option_name);
		}
		
		if (isset($options[$name])) {
			return $options[$name];
		} else {
			return $default;
		}
	}
}

if (!function_exists('optionsframework_init')) {
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/admin/');
	require_once dirname(__FILE__) . '/inc/admin/options-framework.php';
}


add_filter('widget_text', 'do_shortcode');
add_action('init', 'register_shortcodes');

require (get_template_directory() . '/inc/template-tags.php'); // Custom Template Tags
require (get_template_directory() . '/inc/widgets.php'); // Load Sidebar Widgets
require (get_template_directory() . '/inc/category-color.php'); // Category Colors
require (get_template_directory() . '/inc/gallery.php'); // Custom Gallery
require (get_template_directory() . '/inc/stylevar.php'); // Dynamic Style
require (get_template_directory() . '/inc/metabox.php'); // Metabox
include (get_template_directory() . '/inc/shortcodes/shortcodes.php'); // Shortcodes