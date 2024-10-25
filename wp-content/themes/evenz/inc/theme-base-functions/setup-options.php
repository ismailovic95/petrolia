<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

/**
 * ======================================================
 * Thumbnails
 * ------------------------------------------------------
 * Change default thumbnails sizes 
 * ======================================================
 */
if (!function_exists( 'evenz_setup_options' )){
	add_action( 'after_switch_theme', 'evenz_setup_options' );
	function evenz_setup_options () {
		update_option( 'medium_size_w', 770 );
		update_option( 'medium_size_h', 770 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 1170 );
	}
}