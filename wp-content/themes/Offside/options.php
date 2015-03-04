<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

function optionsframework_options() {

	// Background Defaults
	$background_defaults = array(
		'color' => '#999',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	$style_navigation = array(
		'prevnext' => __('Prev/Next Buttons', 'margot'),
		'loadmore' => __('Load More Button', 'margot'),
		'numbered' => __('Numbered Pagination', 'margot'),
	);

	$options_format_posts = array(
		'featured' => __('Featured Posts', 'margot'),
		'reviews' => __('Reviews', 'margot'),
		'standard' => __('All Posts', 'margot'),
		'video' => __('Video', 'margot'),
		'gallery' => __('Gallery', 'margot'),
		'audio' => __('Audio', 'margot')
	);

	$limit_featured = array(
		'5' => '5',
		'8' => '8'
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories[] = 'All Categories';
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}


	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/img/';

	$options = array();

	/* General Options
 	=================================================================================================== */

	$options[] = array(
		'name' => __('General', 'margot'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Site tagline (Header)', 'margot'),
		'desc' => __('Add a tagline about your site. It will be displayed under the header logo section.', 'margot'),
		'id' => 'header_tagline',
		'std' => '',
		'class' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Site description (Footer)', 'margot'),
		'desc' => __('Add a brief description about your site. It will be displayed under the footer logo section.', 'margot'),
		'id' => 'footer_description',
		'std' => '',
		'class' => 'desc',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Header Logo', 'margot'),
		'desc' => __('Add a URL or upload an image for your logo (header section).', 'margot'),
		'id' => 'logo_uploader',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Footer Logo', 'margot'),
		'desc' => __('Add a URL or upload an image for your logo (footer section).', 'margot'),
		'id' => 'logo_uploader_footer',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Retina Support', 'options_framework_theme'),
		'desc' => __('Add Retina logo', 'margot'),
		'id' => 'set_retina',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Retina Header Logo', 'margot'),
		'desc' => __('Retina logo (header section).', 'margot'),
		'id' => 're_logo_uploader',
		'class' => 'hidden',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Retina Footer Logo', 'margot'),
		'desc' => __('Retina logo (footer section).', 'margot'),
		'id' => 're_logo_uploader_footer',
		'class' => 'hidden',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Favicon', 'margot'),
		'desc' => __('Add a URL or upload an icon for your favicon. (recommended size: 16px*16px)', 'margot'),
		'id' => 'favicon_uploader',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Google Analytics', 'options_framework_theme'),
		'desc' => __('Paste here your Google Analytics code.', 'options_framework_theme'),
		'id' => 'ga_code',
		'std' => '',
		'class' => 'big',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Footer Tagline', 'options_framework_theme'),
		'desc' => __('Add a tagline to display in the footer.', 'options_framework_theme'),
		'id' => 'footer_tag',
		'std' => '',
		'class' => '',
		'type' => 'text');

	/* Style Options
 	=================================================================================================== */

	$options[] = array(
		'name' => __('Style', 'margot'),
		'type' => 'heading');

	$options[] = array(
		'desc' => __('Main Layout Color.', 'margot'),
		'id' => 'main_color',
		'std' => '#f53e2a',
		'type' => 'color' );

	$options[] = array(
		'desc' => __('Header Background.', 'margot'),
		'id' => 'main_header_bg',
		'std' => '#111111',
		'type' => 'color' );

		$options[] = array(
		'desc' => __('Header Text Color.', 'margot'),
		'id' => 'main_header_color',
		'std' => '#ffffff',
		'type' => 'color' );

	$options[] = array(
		'desc' => __('Change Pages with Category Main Color', 'options_framework_theme'),
		'std' => '1',
		'id' => 'category_style_color',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Custom Background', 'options_framework_theme'),
		'desc' => __('Enable to set custom background', 'options_framework_theme'),
		'std' => '',
		'id' => 'set_bg',
		'type' => 'checkbox');

	$options[] = array(
		'desc' => __('Boxed Layout', 'options_framework_theme'),
		'id' => 'set_boxed',
		'class' => 'hidden',
		'std' => '',
		'type' => 'checkbox');

	$options[] = array(
		'desc' => __('Change the background color or add an image.', 'margot'),
		'id' => 'bg_opt',
		'class' => 'hidden',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'desc' => __('Responsive background image', 'margot'),
		'id' => 'bg_responsive',
		'class' => 'hidden',
		'std' => '0',
		'options' => 'Enable',
		'type' => 'checkbox');

	$options[] = array(
		'desc' => __('Pattern overlay on background', 'margot'),
		'id' => 'bg_overlay',
		'class' => 'hidden',
		'std' => '0',
		'options' => 'Enable',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Custom CSS', 'options_framework_theme'),
		'desc' => __('Add your custom CSS code in this area.', 'options_framework_theme'),
		'id' => 'custom_css',
		'std' => '',
		'class' => 'big',
		'type' => 'textarea');

		$options[] = array(
		'name' => __('Content', 'margot'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Logo Menu', 'options_framework_theme'),
		'desc' => __('Menu Title', 'options_framework_theme'),
		'id' => 'logo_menu_title',
		'std' => 'Topics',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Header Menu', 'options_framework_theme'),
		'desc' => __('Fixed Menubar when scrolling page', 'options_framework_theme'),
		'std' => '1',
		'id' => 'sticky_menu',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __('Single Posts', 'margot'),
		'desc' => __('Share post buttons', 'margot'),
		'id' => 'share_buttons',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'desc' => __('Drop-Caps (style first letter)', 'margot'),
		'id' => 'en_dropcaps',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'desc' => __('Hide comments until click', 'margot'),
		'id' => 'hide_comments',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'desc' => __('Display Related Posts', 'margot'),
		'id' => 'related_posts',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'desc' => __('Display Author bio box', 'margot'),
		'id' => 'author_box',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'desc' => __('Full-Width title area', 'margot'),
		'id' => 'full_title',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Facebook Comments', 'margot'),
		'desc' => __('Number of Comments to show', 'margot'),
		'id' => 'fb_comments_limit',
		'std' => '10',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Featured Category', 'options_framework_theme'),
		'desc' => __('Multiple Categories on Thumbnails', 'margot'),
		'id' => 'multi_cats_th',
		'std' => '0',
		'type' => 'checkbox');


		$options[] = array(
		'name' => __('Navigation Style', 'margot'),
		'desc' => __('Set the posts navigation', 'margot'),
		'id' => 'st_nav',
		'type' => 'select',
		'class' => 'mini',
		'options' => $style_navigation);

	$options[] = array(
		'name' => __('Blog Template', 'margot'),
		'desc' => __('Filter Posts by Categories (i.e: music, events, fashion)', 'margot'),
		'id' => 'filter_cats',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');


	/* Featured Posts Section
 	=================================================================================================== */
		
	$options[] = array(
		'name' => __('Homepage', 'margot'),
		'type' => 'heading');


	$options[] = array(
		'name' => __('Featured Posts', 'options_framework_theme'),
		'desc' => __('Display Featured Posts section', 'options_framework_theme'),
		'std' => '',
		'id' => 'mrg_featured_area',
		'class' => 'sep_title',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __('Section Title', 'options_framework_theme'),
		'desc' => __('Title of the featured area', 'options_framework_theme'),
		'id' => 'featured_title',
		'std' => 'Featured Now',
		'class' => 'mini hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Filter by Format', 'margot'),
		'desc' => __('Display posts by format', 'margot'),
		'id' => 'filter_featured_format',
		'type' => 'select',
		'class' => 'mini hidden',
		'options' => $options_format_posts);

	$options[] = array(
		'name' => __('Filter by Category', 'margot'),
		'desc' => __('Display posts by category', 'margot'),
		'id' => 'filter_featured_cats',
		'type' => 'select',
		'class' => 'mini hidden',
		'options' => $options_categories);

	$options[] = array(
		'name' => __('Maximum number of posts', 'margot'),
		'desc' => __('Number of posts to display', 'margot'),
		'id' => 'featured_posts_number',
		'type' => 'select',
		'class' => 'mini hidden',
		'options' => $limit_featured);

	$options[] = array(
		'desc' => __('Disable color overlay', 'options_framework_theme'),
		'std' => '',
		'class' => 'hidden',
		'id' => 'mrg_color_overlay',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __('Carousel Posts', 'options_framework_theme'),
		'desc' => __('Display Carousel Posts section', 'options_framework_theme'),
		'std' => '',
		'class' => 'sep_title sep_top',
		'id' => 'mrg_carousel_posts',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __('Section Title', 'options_framework_theme'),
		'desc' => __('Title of the carousel section.', 'options_framework_theme'),
		'id' => 'carousel_title',
		'std' => 'Section Title',
		'class' => 'mini hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Filter by Format', 'margot'),
		'desc' => __('Display posts by format', 'margot'),
		'id' => 'filter_carousel_format',
		'type' => 'select',
		'class' => 'mini hidden',
		'options' => $options_format_posts);

	$options[] = array(
		'name' => __('Filter by Category', 'margot'),
		'desc' => __('Display posts by category', 'margot'),
		'id' => 'filter_carousel_cats',
		'type' => 'select',
		'class' => 'mini hidden',
		'options' => $options_categories);



	/* Social Options
 	=================================================================================================== */

	$options[] = array(
		'name' => __('Social', 'margot'),
		'type' => 'heading');

	$options[] = array(
		'desc' => __('Display social icons in header', 'margot'),
		'id' => 'minicons_hd',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Twitter', 'options_framework_theme'),
		'desc' => __('Add your Twitter URL.', 'options_framework_theme'),
		'id' => 'twitter_id',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Facebook', 'options_framework_theme'),
		'desc' => __('Add your Facebook URL.', 'options_framework_theme'),
		'id' => 'facebook_id',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Google Plus', 'options_framework_theme'),
		'desc' => __('Add your Google+ URL.', 'options_framework_theme'),
		'id' => 'gplus_id',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Instagram', 'options_framework_theme'),
		'desc' => __('Add your Instagram URL.', 'options_framework_theme'),
		'id' => 'instagram_id',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Soundcloud', 'options_framework_theme'),
		'desc' => __('Add your Soundcloud URL.', 'options_framework_theme'),
		'id' => 'soundcloud_id',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Pinterest', 'options_framework_theme'),
		'desc' => __('Add your Pinterest URL.', 'options_framework_theme'),
		'id' => 'pinterest_id',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('YouTube', 'options_framework_theme'),
		'desc' => __('Add your YouTube URL.', 'options_framework_theme'),
		'id' => 'youtube_id',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Feed', 'options_framework_theme'),
		'desc' => __('Add your Feed URL.', 'options_framework_theme'),
		'id' => 'feed_id',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Vimeo', 'options_framework_theme'),
		'desc' => __('Add your Vimeo URL.', 'options_framework_theme'),
		'id' => 'vimeo_id',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Advertising', 'margot'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Header Ad', 'margot'),
		'desc' => __('Ad Image Location (max width: 1140px)', 'margot'),
		'class' => 'adupload',
		'id' => 'ad_banner_uploader',
		'type' => 'upload');

	/* Advertising Options
 	=================================================================================================== */		

	$options[] = array(
		'desc' => __('Ad Link Destination', 'margot'),
		'id' => 'ad_banner_link',
		'std' => '',
		'class' => 'adsfield noborder',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Adsense Code', 'margot'),
		'id' => 'adsense_header',
		'std' => '',
		'class' => 'big noborder',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Widget Single Ad', 'margot'),
		'desc' => __('Ad Image Location', 'margot'),
		'id' => 'ad_medium_uploader',
		'class' => 'adupload',
		'type' => 'upload');

	$options[] = array(
		'desc' => __('Ad Link Destination', 'margot'),
		'id' => 'ad_medium_link',
		'std' => '',
		'class' => 'adsfield noborder',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Adsense Code', 'margot'),
		'id' => 'adsense_widget',
		'std' => '',
		'class' => 'big noborder',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Widget Ads (125x125)', 'margot'),
		'desc' => __('Ad #1 Image Location', 'margot'),
		'id' => 'ad_square_uploader_1',
		'class' => 'adupload',
		'type' => 'upload');

	$options[] = array(
		'desc' => __('Ad #1 Link Destination', 'margot'),
		'id' => 'ad_square_link_1',
		'std' => '',
		'class' => 'adsfield',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Ad #2 Image Location', 'margot'),
		'id' => 'ad_square_uploader_2',
		'class' => '',
		'type' => 'upload');

	$options[] = array(
		'desc' => __('Ad #2 Link Destination', 'margot'),
		'id' => 'ad_square_link_2',
		'std' => '',
		'class' => 'adsfield',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Ad #3 Image Location', 'margot'),
		'id' => 'ad_square_uploader_3',
		'class' => '',
		'type' => 'upload');

	$options[] = array(
		'desc' => __('Ad #3 Link Destination', 'margot'),
		'id' => 'ad_square_link_3',
		'std' => '',
		'class' => 'adsfield',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Ad #4 Image Location', 'margot'),
		'id' => 'ad_square_uploader_4',
		'class' => '',
		'type' => 'upload');

$options[] = array(
		'desc' => __('Ad #4 Link Destination', 'margot'),
		'id' => 'ad_square_link_4',
		'std' => '',
		'class' => 'adsfield',
		'type' => 'text');

	return $options;
}

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');