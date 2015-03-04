<?php
/**
 * Template tags for Margot
 *
 * @package margot
 * @since margot 1.0
 */

/* Post Header
 =================================================================================================== */

if ( ! function_exists( 'margot_post_head' ) ) :
function margot_post_head() {
	global $post;

	$caption = isset(get_post(get_post_thumbnail_id())->post_excerpt) ? get_post(get_post_thumbnail_id())->post_excerpt : '';
	$post_image = !of_get_option('full_title', true) && !get_post_meta($post->ID, 'margot_meta_sidebar', true) ? get_the_post_thumbnail($post->ID, 'mrg_featured_xl') : get_the_post_thumbnail($post->ID, 'mrg_posts_header');

	if ( has_post_thumbnail() && !has_post_format(array( 'video', 'audio' )) ) {
		printf( '%1$s %2$s <div class="mrg-chroma"></div> <div class="mrg-caption">%3$s</div>',
			$post_image,
			margot_category_style(),
			$caption
		);
	}

}
endif;

/* Share Buttons
 =================================================================================================== */

if ( ! function_exists( 'margot_sharebt' ) ) :
function margot_sharebt() {
	if( of_get_option('share_buttons', true) ) {
		printf( '<a class="share-tw icon-twitter" href="https://twitter.com/share?url=%1$s&text=%2$s">%3$s</a><a class="share-fb icon-facebook" href="http://www.facebook.com/share.php?u=%1$s">%4$s</a>',
			esc_url( get_permalink() ),
			esc_html( get_the_title() ),
			__('Tweet', 'margot'),
			__('Share', 'margot')
		);
	}
}
endif;

/* Author Social Links
 =================================================================================================== */

if ( ! function_exists( 'margot_author_icons' ) ) :
function margot_author_icons() {

	$user_id = get_the_author_meta('ID');
	$twitter_author = get_user_meta ($user_id , 'twitter', true);
	$facebook_author = get_user_meta ($user_id , 'facebook', true);
	$gplus_author = get_user_meta ($user_id , 'gplus', true);
	$output = "";

	if ($twitter_author){
		$output .= '<a class="icon-twitter" href="'.esc_url($twitter_author).'" target="_blank"></a>';
	}
	if ($facebook_author){
		$output .= '<a class="icon-facebook" href="'.esc_url($facebook_author).'" target="_blank"></a>';
	}
	if ($gplus_author){
		$output .= '<a class="icon-googlepl" href="'.esc_url($gplus_author).'" target="_blank"></a>';
	}

	echo $output;

}
endif;

add_filter('user_contactmethods', 'margot_contactmethods');
function margot_contactmethods($user_contactmethods) {
	unset($user_contactmethods['yim']);
	unset($user_contactmethods['aim']);
	unset($user_contactmethods['jabber']);
	$user_contactmethods['twitter'] = 'Twitter URL';
	$user_contactmethods['facebook'] = 'Facebook URL';
	$user_contactmethods['gplus'] = 'Google Plus URL';
	return $user_contactmethods;
}

/* Social Icons
 =================================================================================================== */

if ( ! function_exists( 'margot_icons' ) ) :
function margot_icons() {

	$output = "";
	$icons = array();

	$icons = array(
	'twitter' => of_get_option('twitter_id', false), 
	'facebook' => of_get_option('facebook_id', false),
	'googlepl' => of_get_option('gplus_id', false),
	'instagram' => of_get_option('instagram_id', false),
	'soundcloud' => of_get_option('soundcloud_id', false),
	'pinterest' => of_get_option('pinterest_id', false),
	'youtube' => of_get_option('youtube_id', false),
	'vimeo' => of_get_option('vimeo_id', false),
	'feed' => of_get_option('feed_id', false)
	);

	foreach($icons as $key => $item) {
		if (empty($item)) {
			$output .= "";
		}
		else {
			$output.= '<a href="'.esc_url($item).'" target="_blank"><i class="icon-'.$key.'"><span class="hide">'.$key.'</span></i></a>';
		}
	}

	echo $output;
}
endif;

/* Number of comments with Facebook support
 =================================================================================================== */

if (!function_exists('margot_comments_nb')):
	function margot_comments_nb($margot_comments_class) {
		global $post;
		
		$margot_comments = get_comments_number('0', '1', '%');
		$margot_postlink = get_permalink();
		
		if (get_post_meta($post->ID, 'margot_meta_fbcomms', true)) {
			echo '<a href="' . $margot_postlink . '#fb-comments" class="icon-comments fb-comments-count ' . $margot_comments_class . '" data-href="' . $margot_postlink . '">0</a>';
		} else {
			echo '<a href="' . $margot_postlink . '#comments" class="icon-comments ' . $margot_comments_class . '">' . $margot_comments . ' </a>';
		}
	}
endif;

/* Overlay Data
 =================================================================================================== */

if (!function_exists('margot_data_over')):
function margot_data_over($get_cat, $get_score, $get_format, $score_width = '36') {
	global $post;

	$is_scored = get_post_meta($post->ID, 'margot_meta_reviewon', true);
	$score_value = get_post_meta($post->ID, 'margot_meta_review_score', true);

	$output = "";
		
	if ($get_score and $is_scored) {
		$output .= '<div class="ubscore"><input type="text" class="dial" data-width="' . $score_width . '" value="' . $score_value . '"></div>';
	}
		
	if ($get_format and has_post_format('gallery') and !$is_scored) {
		$output .= '<a href="' . get_permalink() . '"><span class="ubgallery icon-gallery"></span></a>';
	} elseif (has_post_format('video') and !$is_scored) {
		$output .= '<a href="' . get_permalink() . '"><span class="ubvideo icon-video"></span></a>';
	} elseif (has_post_format('audio') and !$is_scored) {
		$output .= '<a href="' . get_permalink() . '"><span class="ubaudio icon-audio"></span></a>';
	}
		
	if ($get_cat && has_category()) {
		$output .= margot_category_style('single');
	}

	echo $output;
}
endif;

/* Get Styled Category
 =================================================================================================== */

if ( ! function_exists( 'margot_category_style' ) ) :
function margot_category_style($catlimit = ''){
	global $post;
	$categories = get_the_category($post->ID);
	$output = '';

	if ($categories) {
		$output = '<div class="mrg-color-cat color-cats">';
		foreach($categories as $category) {
			$cat_link = get_category_link( $category->cat_ID );
			$cat_nm = $category->cat_name;
			$cat_ids = $category->term_id;
			$term_meta = get_option( "term_$cat_ids" );
			$margot_color_df = of_get_option('margot_'. $cat_ids .'_style', '#333');
			$term_meta['textcolor'] = ( !empty( $term_meta['textcolor'] ) ) ? $term_meta['textcolor'] : "#fff";
			$term_meta['bgcolor']   = ( !empty( $term_meta['bgcolor'] ) ) ? $term_meta['bgcolor'] : $margot_color_df;
			$output .= '<a style="color:'. $term_meta['textcolor'] . '; border-color:'.$term_meta['bgcolor'].'; background:#FFA33C;" class="featured-category" href="'.$cat_link.'">'.$cat_nm.'</a> ';
			if ( !of_get_option('multi_cats_th', false) ) break;
		}

		$output .= '</div>';
	}

	echo $output;
}
endif;

/* Default thumbnail
 =================================================================================================== */

function margot_def_img() {
	echo "<img src=\"".get_template_directory_uri()."/img/def.png\" alt=\"Default\" />";
}

/* Custom logo
/* ----------------------------------------------*/
function margot_custom_logo($location) {

	$blognm = get_bloginfo('name');
	
	if ('header' == $location) {
		$image_url = of_get_option('logo_uploader', 'null');
		$re_image_url = of_get_option('re_logo_uploader', $image_url);
	}   else {
			$image_url = of_get_option('logo_uploader_footer', 'null');
			$re_image_url = of_get_option('re_logo_uploader_footer', $image_url);
		}

	if (of_get_option('set_retina', false)) {
		echo '<img src="' . $image_url . '" data-at2x="' . $re_image_url . '" alt="' . $blognm . '" class="retina-enabled" />';
	}   else{
			echo '<img src="' . $image_url . '" alt="' . $blognm . '" />';    
		}
}

/* Posts Navigation
 =================================================================================================== */

if (!function_exists('margot_content_nav')) :

function margot_content_nav() {
	global $wp_query, $post;

	if ($wp_query->max_num_pages < 2 && (is_home() || is_page_template('page-blog.php') || is_archive() || is_search())) return;

	$nav_style = of_get_option('st_nav', 'prevnext');
	$page_number = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$nav_class = 'site-navigation paging-navigation';
	if ( !is_paged() && "loadmore" == $nav_style ) { $nav_class = 'site-navigation paging-navigation load-navigation'; }
	if ( "numbered" == $nav_style ) { $nav_class = 'numbered-navigation'; }
?>

<nav role="navigation" id="nav-below" class="<?php echo $nav_class; ?>">
<?php if ("numbered" !== $nav_style && $wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search() )) : ?>

		<?php if (get_next_posts_link() && "loadmore" !== $nav_style || is_paged()): ?>
			<div class="nav-previous"><?php next_posts_link(__('&larr; Older posts', 'margot')); ?></div>

		<?php else : ?>
			<div class="nav-load btn-icon"><?php next_posts_link(__('Load More', 'margot')); ?></div>
		<?php endif; ?>

		<?php if (get_previous_posts_link() && "loadmore" !== $nav_style || is_paged()): ?>
			<div class="nav-next"><?php previous_posts_link(__('Newer posts &rarr;', 'margot')); ?></div>
		<?php endif; ?>

<?php else : ?>

	<?php $big = 999999999;
	echo paginate_links(array(
		'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))) ,
		'format' => '?paged=%#%',
		'type' => 'list',
		'prev_text' => '&laquo;',
		'next_text' => '&raquo;',
		'current' => max(1, get_query_var('paged')) ,
		'total' => $wp_query->max_num_pages
	)); ?>

<?php endif; ?>
</nav>

<?php } 
endif; // margotcontent_nav

/* Custom class
 =================================================================================================== */

function margot_custom_class() {
	global $post;

	$output = "";
	$nosidebar = get_post_meta($post->ID, 'margot_meta_sidebar', true);

	if ( $nosidebar || is_page_template( 'page-fullwidth.php' ) ) {
		$output .= 'col-md-10 col-md-push-1 col-feed';
	}

	if( !$nosidebar && of_get_option('full_title', true) && !is_page_template( 'page-fullwidth.php' ) ) {
		$output .= 'col-md-8 col-feed';
	}

	return $output;
}

/* Display Review Panel
 =================================================================================================== */

if (!function_exists('margot_scored_panel')) :
function margot_scored_panel() {
	global $post;
		
?>
	<div class="score-panel">
		<div class="score-post">
			<div class="ubscore"><input type="text" class="dial" data-width="100" value="<?php echo get_post_meta($post->ID, 'margot_meta_review_score', true); ?>"></div>

		</div>
		<div class="score-summ">
			<span class="score-tag"><?php echo get_post_meta($post->ID, 'margot_meta_review_title', true); ?></span>
			<span class="summ"><?php echo get_post_meta($post->ID, 'margot_meta_review_summ', true); ?></span>
		</div>

		<div class="criter">
		<?php
			$output = '';
			for ($i = 1; $i <= 4; $i++) {
				if('' !== get_post_meta( $post->ID, 'margot_meta_review_criterion_score_'.$i, true )){

					$score = get_post_meta( $post->ID, 'margot_meta_review_criterion_score_'.$i, true );
					$criteria = get_post_meta( $post->ID, 'margot_meta_review_criterion_'.$i, true );

					$output .= '<div class="progress">';
					$output .= '<div class="progress-bar progress-bar-info unwidth" role="progressbar" aria-valuenow="' . $score . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $score . '%">';
					$output .= '<span class="base-cr">' . $criteria . '</span>';
					$output .= '<span class="base-sc">' . $score . '</span>';
					$output .= '</div>';
					$output .= '</div>';
				}
			}

			echo $output;
		?>
		</div>

				  
	</div>	<div class="wave"></div>

<?php }
endif;
