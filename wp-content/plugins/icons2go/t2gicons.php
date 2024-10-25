<?php
/*
Plugin Name: Icons2go
Plugin URI: http://www.themes2go.xyz/
Description: This plugin allows to choose among 1500+ Icons which can be added via shortcode to your content using the Icons Editor. It is also compatible with Visual Composer.
Author: Themes2Go
Version: 1.0.2
Text Domain: t2gicons
Domain Path: /languages
*/

/**===================================================================
 * 	
 *
 *	How the plugin works:
 *	1. the function t2gicons_families contains a list of icon families
 *	2. The plugin generates an option page, the  list of icon families is the same of the function t2gicons_families
 *	3. The list of families is added dinamically to the options array in _settings.php
 *	4. If you enable the families, their CSS is loaded backend and frontend, and they become active in the text editor
 *
 *  
 ===================================================================*/

/**
* Returns current plugin version.
* @return string Plugin version
*/
function t2gicons_plugin_get_version() {
	$plugin_data = get_plugin_data( __FILE__ );
	$plugin_version = $plugin_data['Version'];
	return $plugin_version;
}


/**
* Returns current plugin version.
* @return string Plugin version
*/

function t2gicons_plugin_activation_notice() {
	$status = 0;
	$t2gicons_families = t2gicons_families();
	foreach($t2gicons_families as $family){
		if(get_option($family['options_name']) == "1"){
			$status = 1;
		}
	}
	if($status != 1){
		?>
		<div class="notice notice-warning">
			<p>
				<strong><?php echo esc_attr__("Icons2Go Plugin Notice:", "t2gicons"); ?></strong>
				<?php  echo esc_attr__("You have no active icon sets. To activate an icon set now, go to", "t2gicons"); ?>
				<a href="<?php menu_page_url( 't2gicons_settings' ); ?>" target="_blank"><?php echo esc_html__("Icons2Go Settings", "t2gicons"); ?></a>
			</p>
		</div>
		<?php
	}
}
add_action( 'admin_notices', 't2gicons_plugin_activation_notice' );

/**
 *
 *	Files inclusion
 * 
 */
require plugin_dir_path( __FILE__ ) . '/inc/_t2gicons_helpers.php';
require plugin_dir_path( __FILE__ ) . '/inc/_t2gicons_textdomain.php';
require plugin_dir_path( __FILE__ ) . '/inc/_t2gicons_families_array.php';
require plugin_dir_path( __FILE__ ) . '/inc/_t2gicons_modal_window.php';
require plugin_dir_path( __FILE__ ) . '/inc/_t2gicons_scripts.php';
require plugin_dir_path( __FILE__ ) . '/inc/frontend/_t2gicons_shortcode.php';
require plugin_dir_path( __FILE__ ) . '/inc/frontend/_t2gicons_showcase.php';
require plugin_dir_path( __FILE__ ) . '/inc/frontend/_t2gicons_editor.php';

/**
 *
 *	Options page
 * 
 */
require plugin_dir_path( __FILE__ ) . '/inc/options_page/t2gicons_admin_settings.php';

/**
 *
 *	TinyMCE extension
 * 
 */
require plugin_dir_path( __FILE__ ) . '/inc/tinymce_extensions/t2gicons-tinymce-buttons.php';

/**
 *
 *	Visual composer integration
 * 
 */
require plugin_dir_path( __FILE__ ) . '/inc/t2gicons_visualcomposer.php';
