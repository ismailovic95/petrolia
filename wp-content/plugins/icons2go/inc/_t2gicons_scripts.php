<?php
/**
 * @package t2gicons
 * @author Themes2Go
 * @textdomain t2gicons
 *
 * 
 *	Admin styles and scripts
 */
if(!function_exists('t2gicons_enqueue_scripts')){
function t2gicons_enqueue_scripts($hook)
{

	$t2gicons_families = t2gicons_families();
	$screen = get_current_screen();

	/**=====================================================
	 * 	CSS
	 =====================================================*/
	/**
	 * Styles registration
	 */
	wp_register_style('t2gicons_frontend_Style',plugins_url( '../assets/css/t2gicons-frontend.css' , __FILE__ ), false);
	wp_register_style('t2gicons_backend_Style',plugins_url( '../assets/css/t2gicons-adminstyle.css' , __FILE__ ), false);
	foreach($t2gicons_families as $family){
		wp_register_style( $family['folder'], $family['url']);
	}

	/**
	 * Styles enqueue
	 */
	wp_enqueue_style( 't2gicons_backend_Style');
	wp_enqueue_style( 't2gicons_frontend_Style');
	foreach($t2gicons_families as $family){
		if ( get_option($family['options_name']) == '1' || 'settings_page_t2gicons_settings' == $screen->id ) {
			wp_enqueue_style( $family['folder']);
		}
	}

	/**=====================================================
	 * 	JS
	 =====================================================*/
	wp_register_script( 't2gicons_backend_Script',plugins_url( '../assets/js/min/t2gicons-adminscript-min.js' , __FILE__ ), $deps = array("jquery"), $ver = "1.0", $in_footer = true );

	if ( 'settings_page_t2gicons_settings' !==  $screen->id && t2gicons_function_enabled() == false) {
		return;
	}
    wp_enqueue_script( 't2gicons_backend_Script', 99999);
    
}}
add_action("admin_enqueue_scripts",'t2gicons_enqueue_scripts');


/**
 * Frontend style
 */
if(!function_exists('t2gicons_iconpack_css')){
function t2gicons_iconpack_css(){


	/**
	 * Used by shortcodes
	 */
	
	wp_register_style('t2gicons_backend_Style',plugins_url( '../assets/css/t2gicons-adminstyle.css' , __FILE__ ), false);
	wp_register_script( 't2gicons_backend_Script',plugins_url( '../assets/js/min/t2gicons-adminscript-min.js' , __FILE__ ), $deps = array("jquery"), $ver = "1.0", $in_footer = true );


	$t2gicons_families = t2gicons_families();
	wp_enqueue_style( 't2gicons_frontend_Style',plugins_url( '../assets/css/t2gicons-frontend.css' , __FILE__ ), false);
	foreach($t2gicons_families as $family){
		if( get_option($family['options_name']) == '1' ) {
			wp_enqueue_style( $family['folder'], $family['url']);
		}
	}
}}
add_action('wp_enqueue_scripts', 't2gicons_iconpack_css');


