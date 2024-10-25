<?php
/**
* Plugin Name: QantumThemes MegaMenu
* Plugin URI: http://qantumthemes.com/
* Description: Add mega menu capabilities using Page Builder
* Author: QantumThemes
* Version: 1.0.5
* Text Domain: qt-megamenu
* Domain Path: /languages
* 
* @package qt-megamenu
*/

/**
 * INSTRUCTIONS
 * ────────────────────────────────────────────────────────────
 * After the activation a new item will appear on the admin menu.
 * 1. In Page Builder > Role Manager - enable Page Builder for  qt__megamenu_page
 * 2. in PHP in the theme, add the megamenu tag:
 * ────────────────────────────────────────────────────────────
	
	if( function_exists('qt__megamenu_display')) {
		qt__megamenu_display();
	}
	
 * ────────────────────────────────────────────────────────────
 * 3. Add the the menu items the class qt-megamenu-is-XXXXXX
 * 
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 *
 *	For theme to check if is active
 * 
 */
if(!function_exists('qt__megamenu_assets_url')){
function qt__megamenu_assets_url() {
	return plugins_url('assets/' , __FILE__);
}}


/**
 *
 *	Base dir path for files inclusion
 * 
 */
if(!function_exists('qt__megamenu_plugin_dir_path')){
function qt__megamenu_plugin_dir_path() {
	return plugin_dir_path( __FILE__ );
}}

/**
 *
 *	Megamenu custom type name
 * 
 */
if(!function_exists('qt__megamenu_posttype_name')){
function qt__megamenu_posttype_name() {
	return 'qt__megamenu_page';
}}



/**
 *
 *	For theme to check if is active
 * 
 */
if(!function_exists('qt__megamenu_active')){
function qt__megamenu_active() {
	return true;
}}

/**
* Returns current plugin version.
* @return string Plugin version
*/
if(!function_exists('qt__megamenu_plugin_get_version')){
function qt__megamenu_plugin_get_version() {
	$plugin_data = get_plugin_data( __FILE__ );
	$plugin_version = $plugin_data['Version'];
	return $plugin_version;
}}

/**
 *
 *	The plugin textdomain
 * 
 */
if(!function_exists('qt__megamenu_load_plugin_textdomain')){
function qt__megamenu_load_plugin_textdomain() {
	load_plugin_textdomain( 'qt-megamenu', FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
}}
add_action( 'plugins_loaded', 'qt__megamenu_load_plugin_textdomain' );



/**
 *
 *	Scripts and styles register (enqueue is below)
 * 
 */
add_action("init",'qt__megamenu_register_scripts');
function qt__megamenu_register_scripts(){
	/**
	 * Styles registration
	 */
	wp_register_style('qt-megamenu-style',plugins_url( 'assets/css/qt-megamenu.css' , __FILE__ ), false, qt__megamenu_plugin_get_version());

	// main script
	wp_register_script('qt-megamenu-script',plugins_url( 'assets/js/qt-megamenu.js' , __FILE__ ), array('jquery', 'masonry'), qt__megamenu_plugin_get_version(), true);
}



/**
 *
 *	Scripts and styles enqueue
 * 
 */
add_action("wp_enqueue_scripts",'qt__megamenu_enqueue_scripts');
if(!function_exists('qt__megamenu_enqueue_scripts')){
function qt__megamenu_enqueue_scripts()
{
	/**
	 * Styles enqueue
	 */
	wp_enqueue_style( 'qt-megamenu-style');
	if ( get_post_type( get_the_ID() ) !== qt__megamenu_posttype_name() ) {
		wp_add_inline_style( 'qt-megamenu-style', qt__megamenu_vc_customcss() );
	}

	/**
	 * Scripts enqueue
	 */
	wp_enqueue_script( 'qt-megamenu-script' );
}}


/**
 *
 *	Helpers and functions
 * 
 */
require plugin_dir_path( __FILE__ ) . '/inc/helpers.php';
require plugin_dir_path( __FILE__ ) . '/inc/backend/custom-post-type.php';
require plugin_dir_path( __FILE__ ) . '/inc/frontend/megamenu-display.php';



