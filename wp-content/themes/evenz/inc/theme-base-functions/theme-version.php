<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

/**
 * ======================================================
 * THEME VERSION
 * ------------------------------------------------------
 * Theme version definition to prevent caching of old files
 * ======================================================
 */
if(!function_exists('evenz_theme_version')){
function evenz_theme_version(){
	$my_theme = wp_get_theme( );
	return $my_theme->get( 'Version' );
}}