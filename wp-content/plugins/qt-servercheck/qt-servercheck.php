<?php  
/*
Plugin Name: QT Server Check
Plugin URI: http://qantumthemes.com
Description: Verify the server status and theme compatibility
Version: 2.0
Author: QantumThemes
Author URI: http://qantumthemes.com
Text Domain: qt-servercheck
Domain Path: /languages
*/

/**
 *
 *	The plugin textdomain
 * 
 */
if(!function_exists('qt_servercheck_td')){
function qt_servercheck_td() {
  load_plugin_textdomain( 'qt-servercheck', FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
}}
add_action( 'plugins_loaded', 'qt_servercheck_td' );

/**
* Returns current plugin version.
* @return string Plugin version. Needs to stay here because of plugin file path
*/
if(!function_exists('qt_servercheck_get_version')){
function qt_servercheck_get_version() {
	if ( is_admin() ) {
		$plugin_data = get_plugin_data( __FILE__ );
		$plugin_version = $plugin_data['Version'];
	} else {
		$plugin_version = get_file_data( __FILE__ , array('Version'), 'plugin');
	}
	return $plugin_version;
}}



/**
 * 	includes
 * 	=============================================
 */
include ( plugin_dir_path( __FILE__ ) . 'inc/servercheck-admin.php');


/**
 * 	includes
 * 	=============================================
 */
if(!function_exists('qt_servercheck_scripts')){
	add_action("admin_enqueue_scripts",'qt_servercheck_scripts');
	function qt_servercheck_scripts(){
		wp_enqueue_style(	'qt_servercheck_style',plugins_url( 'assets/css/qt-servercheck-style.css' , __FILE__ ), false, qt_servercheck_get_version());
	}
}
















