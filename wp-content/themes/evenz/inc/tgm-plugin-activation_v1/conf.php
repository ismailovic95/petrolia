<?php  
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Set page builder as theme extension
 */
if( function_exists('vc_set_as_theme') ){
	add_action( 'vc_before_init', 'vc_set_as_theme' );
	vc_set_as_theme();
}


/**
*	===========================================
*	Deactivate obsolete plugins	
*	===========================================
*/
if(!function_exists( 'qt_deactivate_plugin_admin_notice' ) ){
	function qt_deactivate_plugin_admin_notice(){   
	     echo '<div class="notice notice-warning is-dismissible">
	         <p>The plugin Easy Swipebox has been deactived because incompatible with WordPress 5.6</p>
	     </div>';
	}
}
if(!function_exists( 'qt_wp_deactivate_plugin_conditional' ) && function_exists( 'run_easy_swipebox' )){
	add_action( 'admin_init', 'qt_wp_deactivate_plugin_conditional' );
	function qt_wp_deactivate_plugin_conditional() {
		$plugin_path = 'easy-swipebox/easy-swipebox.php';
	    if ( is_plugin_active( $plugin_path ) ) {
			deactivate_plugins( $plugin_path, true );    
	    	add_action('admin_notices', 'qt_deactivate_plugin_admin_notice');
	    }
	}
}




function evenz_additional_plugins_url(){
	return 'http://qantumthemes.xyz/t2gconnector-comm/evenz/tgm-json/';
}
function evenz_tgm_iid_url(){
	return 'http://qantumthemes.xyz/t2gconnector-comm/evenz/iid/';
}
function evenz_connector_url(){
	return 'http://envato-connector.qantumthemes.xyz/';
}
function evenz_support_message(){
	return 'Please contact us via <a href="https://evenz.qantumthemes.xyz/manual/knowledge-base/2-1-support/" target="_blank">HelpDesk</a> https://evenz.qantumthemes.xyz/manual/knowledge-base/2-1-support/';
}

/**
 * This is the list of plugins used by TGM
 * It can be extended by our repository list which can be fetched dynamically.
 */
function evenz_default_plugins_list(){
	return array(
		array(
	        'name'     			 => esc_html__('Server check', 'qtt' ),
	        'slug'     			 => 'qt-servercheck',
	        'required'           => true,
	        'source'			 => get_template_directory_uri() . '/inc/tgm-plugin-activation/plugins/qt-servercheck-1.0.3.zip',
	        'version'			 => '1.0.3'
		),
	);
}