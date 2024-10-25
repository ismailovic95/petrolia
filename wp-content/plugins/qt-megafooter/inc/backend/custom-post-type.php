<?php
/**
 * @package qt-megafooter
 */

add_action('init', 'qt_megafooter_register_type');  
if(!function_exists('qt_megafooter_register_type')){
function qt_megafooter_register_type() {
	$labels = array(
		'name' => esc_html__("MegaFooter","qt-megafooter"),
		'singular_name' => esc_html__("MegaFooter","qt-megafooter"),
		'add_new' => esc_html__("Add new","qt-megafooter"),
		'add_new_item' => esc_html__("Add new MegaFooter","qt-megafooter"),
		'edit_item' => esc_html__("Edit MegaFooter","qt-megafooter"),
		'new_item' => esc_html__("New MegaFooter","qt-megafooter"),
		'all_items' => esc_html__("All MegaFooters","qt-megafooter"),
		'view_item' => esc_html__("View MegaFooter","qt-megafooter"),
		'search_items' => esc_html__("Search MegaFooter","qt-megafooter"),
		'not_found' => esc_html__("No MegaFooter found","qt-megafooter"),
		'not_found_in_trash' => esc_html__("No MegaFooter found in trash","qt-megafooter"),
		'menu_name' => esc_html__("MegaFooters","qt-megafooter")
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
		'menu_position' => 40,
		'exclude_from_search' => true,
		'hierarchical' => false,
		'menu_icon' => 'dashicons-editor-insertmore',
		'show_in_nav_menus' => false,
		'supports' => array('title', 'thumbnail','editor', 'page-attributes' )
	);  
	if (function_exists('register_post_type') && function_exists('qt_megafooter_posttype_name')){
		register_post_type( qt_megafooter_posttype_name() , $args );
	}

}}


/*
 *	Design settings for single page
 *	=============================================================
 */
if(!function_exists("qt_megafooter_customfields")){
function qt_megafooter_customfields() {
	$settings = array (
		array (
			'label' =>  esc_html__('Display as default everywhere',"qt-megafooter"),
			'id' =>  'qt-megafooter-default',
			'default' => "0",
			'type' 	=> 'select',
			'options' => array (
				array('label' => esc_attr__( 'Yes',"qt-megafooter" ),'value' => '1'),	
			)
		)
	);
	if(function_exists('custom_meta_box_field')){
		$settingsbox = new Custom_Add_Meta_Box('qt_megafooter_specialfields', 'Footer design settings', $settings, qt_megafooter_posttype_name(), true );
	}
}}
add_action('init', 'qt_megafooter_customfields');




if(!function_exists('qt_megafooter_flush_rewrite_rules')){
function qt_megafooter_flush_rewrite_rules() {
    qt_megafooter_register_type();
    flush_rewrite_rules();
}}
register_activation_hook( __FILE__, 'qt_megafooter_flush_rewrite_rules' );