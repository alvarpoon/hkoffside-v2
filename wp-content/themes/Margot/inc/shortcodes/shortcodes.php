<?php
/**
 * @package margot
 * @since margot 1.0
 */


/* Google Maps
=================================================================================================== */
function margot_maps_function($atts, $content = null){
   extract(shortcode_atts(array('src' => '', 'width' => '', 'height' => ''), $atts));

   return '<iframe src="'.$src.'&output=embed" width="'. esc_attr( $width ) .'" height="'. esc_attr( $height ) .'" frameborder="0" allowfullscreen></iframe>';

}


/* Alerts
=================================================================================================== */
function margot_alert_function($atts, $content = null){
   extract(shortcode_atts(array('style' => '', 'text' => ''), $atts));
		 
		 return '<div class="alert alert-' . $style . '">' . $content . '</div>';

		}
		
/* Labels
=================================================================================================== */
function margot_label_function($atts, $content = null){
   extract(shortcode_atts(array('style' => ''), $atts));
		 
		 return '<span class="label label-' . $style . '">' . $content . '</span>';
		}

/* Pull-Quote
=================================================================================================== */
function margot_quote_function($atts, $content = null){
   extract(shortcode_atts(array('align' => ''), $atts));
	  if ('right' === $align){
		 return '<blockquote class="pullquote-r">' . $content . '</blockquote>';
	  }
	  else{
		 return '<blockquote class="pullquote">' . $content . '</blockquote>';
	  }
}
		
/* Progress Bar
=================================================================================================== */
function margot_bar_function($atts, $content = null){
   extract(shortcode_atts(array('style' => '', 'progress' => '', 'striped' => ''), $atts));
		 
			if($striped) {
				  return '<div class="progress progress-striped"><div class="progress-bar progress-bar-' . $style . '" role="progressbar" aria-valuenow="'.$progress.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress.'"><span class="sr-only" style="width: '.$progress.'"></span></div></div>';
				}
			else {
				return '<div class="progress"><div class="progress-bar progress-bar-' . $style . '" role="progressbar" aria-valuenow="'.$progress.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress.'"><span class="sr-only" style="width: '.$progress.'"></span></div></div>';
			}
		}
		
		
/* Buttons
		=================================================================================================== */
function margot_button_function($atts, $content = null){
	extract(shortcode_atts(array('color' => 'blue', 'size' => 'medium', 'classi' => 'none', 'text' => '', 'url' => ''), $atts));

		if($url) {
		return '<a class="btn btn-' . $size . ' btn-' . $color . ' ' . $classi . '" href="' . $url . '">' . $text . $content . '</a>';
		} else {
		return '<button class="btn btn-' . $size . ' btn-' . $color . ' ' . $classi . '" type="button">' . $text . $content . '</button>';
		}
}	
		

/* Tabs
=================================================================================================== */
function margot_tabsdiv_function( $atts, $content ){
$GLOBALS['tab_count'] = 0;
do_shortcode( $content );
$count = 0;
if( is_array( $GLOBALS['tabs'] ) ){
foreach( $GLOBALS['tabs'] as $tab ){
$count++;
$tabs[] = '<li><a href="tab'.$count.'" data-toggle="tab">'.$tab['title'].'</a></li>';
$panes[] = '<div class="tab-pane" id="tab'.$count.'"><p>'.$tab['content'].'</p></div>';
}
$return = "\n".'<div class="tabbable" style="margin-bottom: 18px;"><ul class="nav nav-tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<div  class="tab-content" border-bottom: 1px solid #ddd;">'.implode( "\n", $panes ).'</div></div>'."\n";
}
return $return;
}


function margot_tabs_function( $atts, $content ){
extract(shortcode_atts(array('title' => 'Tab %d'), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>      $content );

$GLOBALS['tab_count']++;
}

/* Video Shortcode
=================================================================================================== */
function margot_video_function($atts, $content = null){
   extract(shortcode_atts(array('youtube' => '', 'vimeo' => '', 'blip' => ''), $atts));


	if($youtube) {
		  return '<div class="video-in embed-responsive embed-responsive-16by9"><iframe width="560" height="315" src="http://www.youtube.com/embed/'. esc_attr( $youtube ) .'" frameborder="0" allowfullscreen></iframe></div>';
		}
		
	if($vimeo) {
		  return '<div class="video-in embed-responsive embed-responsive-16by9"><iframe src="http://player.vimeo.com/video/'. esc_attr( $vimeo ) .'" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
		}
}


/* Accordion
=================================================================================================== */
function margot_accordiondiv_function( $atts, $content ){
$GLOBALS['accord_count'] = 0;
do_shortcode( $content );
$count = 0;
if( is_array( $GLOBALS['accord'] ) ){
foreach( $GLOBALS['accord'] as $acc ){
$count++;

$texty[] = '<div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$count.'">'.$acc['title'].'</a></h4></div> <div id="collapse'.$count.'" class="panel-collapse collapse"><div class="panel-body">'.$acc['content'].'</div></div></div>';
}
$return = "\n".'<div class="panel-group" id="accordion">'.implode( "\n", $texty ).'</div>'."\n";

}
return $return;
}


function margot_accordion_function( $atts, $content ){
extract(shortcode_atts(array('title' => 'Accord %d'), $atts));

$vi = $GLOBALS['accord_count'];
$GLOBALS['accord'][$vi] = array( 'title' => sprintf( $title, $GLOBALS['accord_count'] ), 'content' =>      $content );

$GLOBALS['accord_count']++;
}

include_once(get_template_directory() . '/inc/shortcodes/load.php');