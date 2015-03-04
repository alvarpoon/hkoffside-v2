<?php
/**
 * offside functions and definitions
 *
 * @package offside
 * @since offside 1.0
 */

/* Menu tweaks
 =================================================================================================== */
 // Removes thematic_blogtitle from the thematic_header phase
function remove_margot_actions() {
    remove_filter('wp_nav_menu_items','margot_home_link',10);
}
// Call 'remove_thematic_actions' during WP initialization
add_filter('init','remove_margot_actions');

// Add our custom function to the 'thematic_header' phase
add_filter('wp_nav_menu_items', 'offside_home_link', 10, 2);
function offside_home_link($items, $args) {
	
	if (is_home()) {
		$class = 'class="home-menu current current-menu-item"';
	} else {
		$class = 'class="home-menu"';
	}
	$homeMenuItem = "<li $class >" . $args->before . '<a href="' . home_url('/') . '" title="Home">' . $args->link_before . 'Home' . $args->link_after . '</a>' . $args->after . "</li>";
	//$items = $homeMenuItem . $items;
	return $items;
}