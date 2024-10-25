<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/


/**
 * ======================================================
 * CONTENT WIDTH
 * ------------------------------------------------------
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 * ======================================================
 */
function evenz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'evenz_content_width', 1170 );
}
add_action( 'after_setup_theme', 'evenz_content_width', 0 );
