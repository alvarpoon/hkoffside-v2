<?php
/**
 * @package margot
 * @since margot 1.0
 */


function options_bg_dph($option, $selectors) {
    if (of_get_option('set_bg', false)) {
        $output = $selectors . '{';
        
        if ($option['color']) {
            $output.= ' background-color: ' . $option['color'] . ';';
            if (!$option['image']) {
                $output.= ' background-image: none;';
            }
        }
        
        if (of_get_option('bg_overlay', false)) {
            $overlaybg = 'url(' . get_template_directory_uri() . '/img/overlay_a.png) fixed,';
            $overlayauto = 'auto,';
        } else {
            $overlaybg = '';
            $overlayauto = '';
        }
        
        if ($option['image']) {
            $output.= ' background: ' . $overlaybg . 'url(' . $option['image'] . ') 50% 50% fixed no-repeat;';
            $output.= ' background-repeat: ' . $option['repeat'] . ';';
            $output.= ' background-position: ' . $option['position'] . ';';
            $output.= ' background-attachment: ' . $option['attachment'] . ';';
            
            if (of_get_option('bg_responsive', false)) {
                $output.= ' -moz-background-size:' . $overlayauto . ' cover;';
                $output.= ' -webkit-background-size:' . $overlayauto . ' cover;';
                $output.= ' -o-background-size:' . $overlayauto . ' cover;';
                $output.= ' background-size:' . $overlayauto . ' cover;';
            }
        }
        
        $output.= '}';
        $output.= "\n";
        return $output;
    } else {
        return null;
    }
}

function options_custom_styles() {
    
    $output = '';
    $input = '';
    
    $output.= options_bg_dph(of_get_option('bg_opt') , 'body'); //Custom BG

    if (of_get_option('mrg_color_overlay', false)) { //disable color overlay
        $output.= "#mrg-featured-area .mrg-chroma{display:none;}\n";
    }
    
    global $post;
    
    if ($post && get_the_category($post->ID)) {
        $categories = get_the_category($post->ID);
        $cat_ids = $categories[0]->cat_ID;
        $term_meta = get_option("term_$cat_ids");
    }
    
    $term_meta['bgcolor'] = (!empty($term_meta['bgcolor']) & of_get_option('category_style_color', true)) ? $term_meta['bgcolor'] : of_get_option('main_color', '#673055');
    
    $main_color = (is_single() || is_archive() && !is_author()) ? $term_meta['bgcolor'] : of_get_option('main_color', '#673055');
    
    $text_color = of_get_option('main_header_color', '#fff');

    $header_bg = of_get_option('main_header_bg', '#111');
    
    $query = array(
        array('id' => 1, 'selector' => 'a,a:link,a:hover,.mrg-dropc .entry-content > p:first-of-type:first-letter,#infscr-loading,.entry-tags:before,.entry-tags,.entry-tags a,.author-cc .mini-author,#mrg-content .media-meta a,.widget ul li a:hover,#footer .widget ul li a:hover,.widget_margot_mostpop .entry-meta a:hover,#footer .widget_margot_mostpop .entry-meta a:hover,#footer a:hover,#footer .btm-nav .current-menu-item a,#footer .btm-nav .current-menu-item a:hover,#footer .btm-nav .sf-menu li.current-menu-item ul li:hover > a,#footer .btm-nav .sf-menu li:hover > a,#footer .btm-nav #menu-footer ul li a:hover,#mrg-wrap .contact-form form span,.share-tw,.share-fb,#mrg-wrap .contact-form .error,  #mrg-wrap .meta-buttons [class*="meta-"], .rad-button, .paging-navigation a, #commentform input#submit, input#submit.rad-button, .single-comment .comment-meta  .cc-reply:before' ),

        array('id' => 2, 'selector' => '.widget_tag_cloud ul li a:hover,#footer .widget_tag_cloud ul li a:hover,.widget_tags_margot ul li a:hover,#footer .widget_tags_margot ul li a:hover,.widget_cats_margot ul li a:hover,#footer .widget_cats_margot ul li a:hover,.widget_quick-flickr-widget ul li img:hover,#footer .widget_quick-flickr-widget ul li img:hover,#mrg-wrap .contact-form .error,.share-tw,.share-fb,.meta-buttons [class*="meta-"], .meta-buttons [class*="meta-"]::after, .widget_tag_cloud ul li a:hover, .widget_tags_margot ul li a:hover, .widget_cats_margot ul li a:hover, .widget_margot_authors ul li a:hover, #footer .widget_margot_authors ul li a:hover, .rad-button, .paging-navigation a, #commentform input#submit, input#submit.rad-button ' ),

        array('id' => 3, 'selector' => 'h3.pretitle span,#mrg-nav .sf-menu a:hover,#mrg-nav .sf-menu .current-menu-item a,.btm-nav .sf-menu a:hover,.btm-nav .sf-menu .current-menu-item a' ),

        array('id' => 4, 'selector' => '.widget_margot_mostpop h2:hover,#footer .widget_margot_mostpop h2:hover,#wp-calendar #today, #mrg-logo-menu .sf-menu .topics-menu .top-btn-link, .pretag, .score-tag, .ubscore' ),
        array('id' => 5, 'selector' => '.meta-buttons-w [class*="meta-"], .meta-buttons-w [class*="meta-"]::after ' ),

        array('id' => 6, 'selector' => '#mrg-top' ),

        array('id' => 7, 'selector' => '#mrg-social-bar .mini-icons [class*="icon-"], #mrg-logo-bar .site-description, #mrg-logo-bar h1.logo a' )


    );
    
    $props = array(
        1 => array( array('css_prop' => 'color', 'css_value' => '' . $main_color . '' ) ) ,
        2 => array( array('css_prop' => 'border-color', 'css_value' => '' . $main_color . ' !important' ) ) ,
        3 => array( array('css_prop' => 'border-bottom-color', 'css_value' => '' . $main_color . ' !important' ) ) ,
        4 => array( array('css_prop' => 'background-color', 'css_value' => '' . $main_color . ' !important' ) ) ,
        5 => array( array('css_prop' => 'border-color', 'css_value' => '#fff !important' ) ) ,

        6 => array( array('css_prop' => 'background-color', 'css_value' => '' . $header_bg . ' !important' ) ) ,
        7 => array( array('css_prop' => 'color', 'css_value' => '' . $text_color . ' !important' ) )

    );
    
    foreach ($query as $selector) {
        
        $properties = $props[$selector['id']];
        
        $rules = '';
        foreach ($properties as $element) {
            $rules.= "$element[css_prop]:$element[css_value];";
        }
        
        $output.= "$selector[selector]" . '{' . "$rules" . '}' . "";
    }
    
    if (of_get_option('custom_css', false)) {
        $output.= "\n".of_get_option('custom_css');
    }
    if (!empty($output)) {
        $output = "\n<style type=\"text/css\">\n" . $output . "\n</style>\n";
    }
    echo $output;
}

add_action('wp_head', 'options_custom_styles');
