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



function qtt_additional_plugins_url(){
	return 'http://qantumthemes.xyz/t2gconnector-comm/evenz/tgm-json/';
}
function qtt_tgm_iid_url(){
	return 'http://qantumthemes.xyz/t2gconnector-comm/evenz/iid/';
}
function qtt_connector_documentation_url(){
	return 'https://evenz.qantumthemes.xyz/manual/';
}
function qtt_connector_url(){
	return 'http://qantumthemes.xyz/t2gconnector-comm/connector-proxy/';
}
function qtt_support_message(){
	return 'Please contact us via <a href="https://evenz.qantumthemes.xyz/manual/knowledge-base/2-1-support/" target="_blank">HelpDesk</a> https://evenz.qantumthemes.xyz/manual/knowledge-base/2-1-support/';
}

function qtt_tgmpa_page(){
	return 'qtt-install-plugins';
}
/**
 * This is the list of plugins used by TGM
 * It can be extended by our repository list which can be fetched dynamically.
 */
function qtt_default_plugins_list(){
	return array(
		array(
	        'name'     			 => esc_html__('Server check', 'qtt' ),
	        'slug'     			 => 'qt-servercheck',
	        'required'           => true,
	        'source'			 => get_template_directory_uri() . '/inc/tgm-plugin-activation/plugins/qt-servercheck-2.0.zip',
	        'version'			 => '2.0'
		),
	);
}