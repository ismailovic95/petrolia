<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

/**==========================================================================================
 *
 *
 *	ThemeForest Support Limitation Warning:
 *	-----------------------------------------------
 * 	
 * 	*** Theme support doesn't cover any code customizations.  ***
 * 	
 * 	You are free to edit any theme's code at your own risk. 
 * 	
 * 	Issues caused by code customizations are out of the support territory, as we are not responsible
 * 	for the changes you may do to this theme or bundled plugins.
 * 	
 *  For any customization please use the provided child theme instead of editing core files.
 *  https://codex.wordpress.org/Child_Themes
 *
 * 
 * 	FUNCTIONS OVERRIDE:
 * 	-----------------------------------------------
 * 	Every function is wrapped in "function_exists" condition. 
 * 	In this way if you don't like something you can bring it yo your child theme's functions.php
 * 	and customize it.
 *
 *
 ==========================================================================================*/


// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Set custom menu classes
require_once get_theme_file_path( '/inc/theme-base-functions/sanitize_fonturl.php' );

// Set custom menu classes
require_once get_theme_file_path( '/inc/theme-base-functions/menu-classes.php' );

// Helper to create slugs from strings
require_once get_theme_file_path( '/inc/theme-base-functions/slugify.php' );

// Theme version used for enqueuing css and js
require_once get_theme_file_path( '/inc/theme-base-functions/theme-version.php' );

// Theme-specific body class
require_once get_theme_file_path( '/inc/theme-base-functions/body-class.php' );

// Gutenberg styling
require_once get_theme_file_path( '/inc/gutenberg/customizations.php' );
require_once get_theme_file_path( '/inc/gutenberg/index.php' );

// Set content width
require_once get_theme_file_path( '/inc/theme-base-functions/content-width.php' );

// Enqueue JavaScript and CSS
require_once get_theme_file_path( '/inc/theme-base-functions/styles-inclusion.php' );

// Register sidebars
require_once get_theme_file_path( '/inc/theme-base-functions/register-sidebars.php' );

// Setup theme, set menu locations, sidebars
require_once get_theme_file_path( '/inc/theme-base-functions/setup-theme.php' );

// Theme options (thumbnail and image sizes)
require_once get_theme_file_path( '/inc/theme-base-functions/setup-options.php' );

// Display logo or site title
require_once get_theme_file_path( '/inc/theme-base-functions/show-logo.php' );

// Get current page number universally
require_once get_theme_file_path( '/inc/theme-base-functions/get-current-page.php' );

// Shortcode safe execution wrapper
require_once get_theme_file_path( '/inc/theme-base-functions/shortcodes-safe-execution.php' );

// Sane content wrapper
require_once get_theme_file_path( '/inc/theme-base-functions/sane-content.php' );

// Provides different excerpt lengths to be used with custom post items
require_once get_theme_file_path( '/inc/theme-base-functions/excerpt-length.php' );

// Shorten excerpt
require_once get_theme_file_path( '/inc/theme-base-functions/shorten-excerpt.php' );

// Display post categories
require_once get_theme_file_path( '/inc/theme-base-functions/postcategories.php' );

// Set custom number of posts for the pagination
require_once get_theme_file_path( '/inc/theme-base-functions/pre-get-posts.php' );

// Comments and pingback formatting
require_once get_theme_file_path( '/inc/theme-base-functions/comments-pingback.php' );

// Password form custom formatting
require_once get_theme_file_path( '/inc/theme-base-functions/password-form.php' );

// Tags output formatting
require_once get_theme_file_path( '/inc/theme-base-functions/tags-formatting.php' );

// Categories sorting
require_once get_theme_file_path( '/inc/theme-base-functions/sort-categories.php' );

// Get titles
require_once get_theme_file_path( '/inc/theme-base-functions/title.php' );

// Get associated main taxonomy
require_once get_theme_file_path( '/inc/theme-base-functions/related-taxonomy.php' );

// Configurations for TTG Core plugin (styling settings, custom options)
require_once get_theme_file_path( '/inc/ttgcore-setup/ttg-core-configuration.php' );

if ( class_exists( 'WooCommerce' ) ) {
	require_once get_theme_file_path( '/woocommerce/woocommerce-helpers.php' );
	require_once get_theme_file_path( '/woocommerce/custom-product-fields.php' );
}


// Customization styles
require_once get_theme_file_path( '/inc/theme-base-functions/customizations.php' );

// WpBakery Page Builder settings
require_once get_theme_file_path( '/vc_templates/pagebuilder-setup.php' );

// TGM Plugins Activation
require_once get_theme_file_path( '/inc/tgm-plugin-activation/evenz-plugins-activation.php' );

// One Click Installer
require_once get_theme_file_path( '/inc/ocdi/ocdi-setup.php' );


// End of functions.php
// ============================================================================================================