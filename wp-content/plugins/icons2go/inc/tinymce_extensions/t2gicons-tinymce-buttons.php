<?php
/**
 * @package t2gicons
 * @author Themes2Go
 * @textdomain t2gicons
 *
 * The shortcodes tinymce buttons
 * from https://generatewp.com/take-shortcodes-ultimate-level/
 * https://github.com/bainternet/bs3_panel_shortcode
 * 
 */

/**
 *
 *	Adding the shortcode to the PHP
 *
 * 
 */
if(!function_exists('t2gicons_enqueue_plugin_scripts_tinymce')){
function t2gicons_enqueue_plugin_scripts_tinymce($plugin_array)
{
	if(t2gicons_function_enabled() == false){
		return;
	}

    $plugin_array["t2gicons_shortcodes_plugin"] =  plugins_url( '' , __FILE__ )  . '/assets/t2gicons-tinymce.js';
    return $plugin_array;
}}
add_filter("mce_external_plugins", "t2gicons_enqueue_plugin_scripts_tinymce");


/**
 *	Adding the button to the editor
 */
if(!function_exists('t2gicons_register_buttons_editor')){
	function t2gicons_register_buttons_editor($buttons)
	{
		if(t2gicons_function_enabled()  == false){
			return $buttons;
		}
	    $buttons[] = 't2gicons';
	    return $buttons;
	}
	add_filter("mce_buttons", "t2gicons_register_buttons_editor");
}