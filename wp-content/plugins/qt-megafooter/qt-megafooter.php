<?php
/**
* Plugin Name: QantumThemes MegaFooter
* Plugin URI: http://qantumthemes.com/
* Description: Add mega footer capabilities using Page Builder
* Author: QantumThemes
* Version: 1.0.5
* Text Domain: qt-megafooter
* Domain Path: /languages
* 
* @package qt-megafooter
*/



if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 *
 *	For theme to check if is active
 * 
 */
if(!function_exists('qt_megafooter_assets_url')){
function qt_megafooter_assets_url() {
	return plugins_url('assets/' , __FILE__);
}}


/**
 *
 *	Base dir path for files inclusion
 * 
 */
if(!function_exists('qt_megafooter_plugin_dir_path')){
function qt_megafooter_plugin_dir_path() {
	return plugin_dir_path( __FILE__ );
}}

/**
 *
 *	MegaFooter custom type name
 * 
 */
if(!function_exists('qt_megafooter_posttype_name')){
function qt_megafooter_posttype_name() {
	return 'qt_megafooter_page';
}}



/**
 *
 *	For theme to check if is active
 * 
 */
if(!function_exists('qt_megafooter_active')){
function qt_megafooter_active() {
	return true;
}}

/**
* Returns current plugin version.
* @return string Plugin version
*/
if(!function_exists('qt_megafooter_plugin_get_version')){
function qt_megafooter_plugin_get_version() {
	$plugin_data = get_plugin_data( __FILE__ );
	$plugin_version = $plugin_data['Version'];
	return $plugin_version;
}}

/**
 *
 *	The plugin textdomain
 * 
 */
if(!function_exists('qt_megafooter_load_plugin_textdomain')){
function qt_megafooter_load_plugin_textdomain() {
	load_plugin_textdomain( 'qt-megafooter', FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
}}
add_action( 'plugins_loaded', 'qt_megafooter_load_plugin_textdomain' );



/**
 *
 *	Scripts and styles register (enqueue is below)
 * 
 */
add_action("init",'qt_megafooter_register_scripts');
function qt_megafooter_register_scripts(){
	/**
	 * Styles registration
	 */
	wp_register_style('qt-megafooter-style',plugins_url( 'assets/css/qt-megafooter.css' , __FILE__ ), false, qt_megafooter_plugin_get_version());

	// main script
	wp_register_script('qt-megafooter-script',plugins_url( 'assets/js/qt-megafooter.js' , __FILE__ ), array('jquery', 'masonry'), qt_megafooter_plugin_get_version(), true);
}



/**
 *
 *	Scripts and styles enqueue
 * 
 */
add_action("wp_enqueue_scripts",'qt_megafooter_enqueue_scripts');
if(!function_exists('qt_megafooter_enqueue_scripts')){
function qt_megafooter_enqueue_scripts()
{
	/**
	 * Styles enqueue
	 */
	wp_enqueue_style( 'qt-megafooter-style');
	if ( get_post_type( get_the_ID() ) !== qt_megafooter_posttype_name() ) {
		wp_add_inline_style( 'qt-megafooter-style', wp_kses_post( qt_megafooter_vc_customcss() ) );
	}

	/**
	 * Scripts enqueue
	 */
	wp_enqueue_script( 'qt-megafooter-script' );
}}


/**
 *
 *	Helpers and functions
 * 
 */
require plugin_dir_path( __FILE__ ) . '/inc/helpers.php';
require plugin_dir_path( __FILE__ ) . '/inc/backend/custom-post-type.php';
require plugin_dir_path( __FILE__ ) . '/inc/backend/granular-settings.php';
require plugin_dir_path( __FILE__ ) . '/inc/frontend/megafooter-display.php';




