<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage Evenz
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer, Igor Nardo, QantumThemes
 * @copyright  Copyright (c) 2011, Thomas Griffin / Igor Nardo - QantumThemes (for authentication part)
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**========================================================
 *
 *	CUSTOM SPECIAL LAUNCHER FOR TGM
 *	-------------------------------------------------------
 *	
 *	Parse the fresh list of plugins from the private repo
 *	and verifies Envato Purchase Code as per 2019 ThemeForest
 *	theme requirements and allowed checks.
 *
 *  https://help.author.envato.com/hc/en-us/articles/360000481263#h_724052476231526019180068
 *
 * 	How does this work?
 * 	1) Check if I have additional "premium" plugins
 * 	2) If set, request a purchase code to activate automated installer 
 *  
 ========================================================*/

// Configuration
require_once get_theme_file_path( '/inc/tgm-plugin-activation/conf.php' );

// Tgm library
require_once get_theme_file_path( '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php' );

// Helper functions
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/helpers.php' );

// Error messages admin
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/errors.php' );

// Remote call
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/remote.php' );

// Plugins list
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/list.php' );

// Activation message TGM
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/message.php' );

// Enqueue scripts
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/enqueue.php' );

// Welcome page with activation form
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/welcome-page.php' );

// TGM settings
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/tgm-settings.php' );

// End of functions