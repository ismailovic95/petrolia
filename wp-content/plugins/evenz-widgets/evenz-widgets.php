<?php  
/*
Plugin Name: Evenz Widgets
Plugin URI: http://www.qantumthemes.xyz
Description: Adds custom widgets to Wordpress
Version: 1.0.2
Author: QantumThemes
Author URI: http://www.qantumthemes.xyz
Text Domain: evenz-widgets
Domain Path: /languages
*/

/**
 *
 *	The plugin textdomain
 * 	=============================================
 */
if(!function_exists('evenz_widgets_load_plugin_textdomain')){
function evenz_widgets_load_plugin_textdomain() {
	load_plugin_textdomain( 'evenz-widgets', FALSE, plugin_dir_path( __FILE__ ) . 'languages' );
}}
add_action( 'plugins_loaded', 'evenz_widgets_load_plugin_textdomain' );




/**
 * 
 * Reading time calculation
 * =============================================
 */
if(!function_exists('evenz_widgets_readintime')) {
function evenz_widgets_readintime($id = null){
	$id = get_the_id();
	$content = get_post_field('post_content', $id);
	$word = str_word_count(strip_tags($content));

	//words read per minute
	$wpm = 240;
	//words read per second
	$wps = $wpm/60;
	$secs_to_read = ceil($word/$wps);
	return gmdate("i's''", $secs_to_read);
}}

/**
 * 
 * Icon by post format
 * =============================================
 * 
 */


/*  Icon by post format // material icons
=============================================*/
if ( ! function_exists( 'evenz_widgets_format_icon_class' ) ) {
function evenz_widgets_format_icon_class ( $id = false) {
	if ( false === $id ) {
		return;
	} else {
		$format = get_post_format( $id );
		if ( false === $format ) {
			$format = 'post';
		}
		switch ($format){
			case "video":
				echo 'videocam';
				break;
			case "audio":
				echo 'audiotrack';
				break;
			case "gallery":
				echo 'photo_library';
				break;
			case "image":
				echo 'photo_camera';
				break;
			case "link":
				echo 'insert_link';
				break;
			case "chat":
				echo 'chat';
				break;
			case "quote":
				echo 'format_quote';
				break;
			case "aside":
				echo 'insert_comment';
				break;
			case "post": 
			case "aside":
			default:
				echo 'format_align_left';
			break;
		}
	}
}}

/**
 * 	includes
 * 	=============================================
 */
include ( plugin_dir_path( __FILE__ ) . 'widgets/widget-archives-list.php');
include ( plugin_dir_path( __FILE__ ) . 'widgets/widget-archives-card.php');
include ( plugin_dir_path( __FILE__ ) . 'widgets/widget-archives-events.php');

