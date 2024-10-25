<?php
/**
 * @package t2gicons
 * @author Themes2Go
 * @textdomain t2gicons
 */

/**
 *
 *	The plugin textdomain
 * 
 */
function t2gicons_load_plugin_textdomain() {
  load_plugin_textdomain( 't2gicons', FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 't2gicons_load_plugin_textdomain' );

