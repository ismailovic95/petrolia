<?php
add_action('init', 'qt__megamenu_menu_register_type');  
if(!function_exists('qt__megamenu_menu_register_type')){
function qt__megamenu_menu_register_type() {
	$labels = array(
		'name' => esc_html__("MegaMenu","qt-megamenu"),
		'singular_name' => esc_html__("MegaMenu","qt-megamenu"),
		'add_new' => esc_html__("Add new","qt-megamenu"),
		'add_new_item' => esc_html__("Add new MegaMenu","qt-megamenu"),
		'edit_item' => esc_html__("Edit MegaMenu","qt-megamenu"),
		'new_item' => esc_html__("New MegaMenu","qt-megamenu"),
		'all_items' => esc_html__("All MegaMenus","qt-megamenu"),
		'view_item' => esc_html__("View MegaMenu","qt-megamenu"),
		'search_items' => esc_html__("Search MegaMenu","qt-megamenu"),
		'not_found' => esc_html__("No MegaMenu found","qt-megamenu"),
		'not_found_in_trash' => esc_html__("No MegaMenu found in trash","qt-megamenu"),
		'menu_name' => esc_html__("MegaMenus","qt-megamenu")
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
		'menu_position' => 40,
		'exclude_from_search' => true,
		'hierarchical' => false,
		'menu_icon' => 'dashicons-menu',
		'show_in_nav_menus' => false
	);  
	if (function_exists('register_post_type') && function_exists('qt__megamenu_posttype_name')){
		register_post_type( qt__megamenu_posttype_name() , $args );
	}

}}


if(!function_exists('qt__megamenu_flush_rewrite_rules')){
function qt__megamenu_flush_rewrite_rules() {
    qt__megamenu_menu_register_type();
    flush_rewrite_rules();
}}
register_activation_hook( __FILE__, 'qt__megamenu_flush_rewrite_rules' );