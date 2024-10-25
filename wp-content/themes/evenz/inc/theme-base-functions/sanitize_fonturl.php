<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

/* Sanitize font URL
=============================================*/


/**
 * =========================================================
 * PROTOCOL NOTE:
 * ---------------------------------------------------------
 * Gutemberg cannot embed external styles with relative protocol.
 * It simply doesn't.
 * So, instead of open protocol, we match the website's protocol, and works.
 * =========================================================
 */

if(!function_exists('evenz_sanitize_fonturl')){
	function evenz_sanitize_fonturl( $font_url ){
		if ( is_ssl() ) {
			$font_url = 'https:'.$font_url;
		} else {
			$font_url = 'http:'.$font_url;
		}
		return esc_url( $font_url );
	}
}