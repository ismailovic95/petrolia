<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

if(!function_exists('evenz_sanitize_content')){
	function evenz_sanitize_content($content) {
		return wp_kses_post( $content );
	}
}