<?php
/**
 * @package margot
 * @since margot 1.0
 */

 function register_shortcodes(){
     add_shortcode('display_alert', 'margot_alert_function');                      //Alerts
     add_shortcode('display_accordion', 'margot_accordion_function');             //Acordion
     add_shortcode('display_accordion-div', 'margot_accordiondiv_function');      //Accordion-Container
     add_shortcode('display_bar', 'margot_bar_function');                         //Progress-Bar
     add_shortcode('display_button', 'margot_button_function');                   //Buttons
     add_shortcode('display_maps', 'margot_maps_function');                       //Google Maps
     add_shortcode('display_label', 'margot_label_function');                     //Labels
     add_shortcode('display_quote', 'margot_quote_function');                     //Pull-Quote
     add_shortcode('display_tabs', 'margot_tabs_function');                       //Tabs
     add_shortcode('display_tabs-div', 'margot_tabsdiv_function');                //Tabs-Container
     add_shortcode('display_video', 'margot_video_function');                     //Video 
 }

 function register_button( $buttons ) {
    array_push( $buttons, "|", "margot_dphbuttonshc" );
    return $buttons;
 }

function buttons_lang() {
if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
  if ( in_array(basename($_SERVER['PHP_SELF']), array('post-new.php', 'page-new.php', 'post.php', 'page.php') ) ) {
wp_enqueue_script( 'dph-lang', get_template_directory_uri() . '/inc/shortcodes/shortcodes-button.js', array( 'jquery' ));
$params = array(
  'sh_icon' => get_template_directory_uri() . '/img/star.png',
  'sh_url' => get_template_directory_uri()
);
wp_localize_script('dph-lang', 'dphvars', $params ); } } }
add_action( 'admin_enqueue_scripts', 'buttons_lang' );

function add_plugin( $plugin_array ) {
  if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
    if ( in_array(basename($_SERVER['PHP_SELF']), array('post-new.php', 'page-new.php', 'post.php', 'page.php') ) ) {
	$jsurl = get_template_directory_uri() . '/inc/shortcodes/shortcodes-button.js';
	$plugin_array['margot_dphbuttonshc'] = $jsurl;
   return $plugin_array;
} } }

function margot_shortcode_buttons() {
   if ( ! current_user_can('edit_shc') && ! current_user_can('edit_pages') ) {
      return;
   }
   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_plugin' );
      add_filter( 'mce_buttons', 'register_button' );
   }
}
add_action('init', 'margot_shortcode_buttons');