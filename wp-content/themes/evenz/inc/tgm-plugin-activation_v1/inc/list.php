<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage Evenz
 * Returns the array of additional plugins
 **/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function evenz_get_pluginslist( $url ){
	$plugins            = false;
	$current_theme      = wp_get_theme( );
	$theme_version      = $current_theme->get( 'Version' );
	$name               = $current_theme->get( 'Name' );
	$stored_optionname  = 'evenz_stored_required_plugins';
	$plugins_json       = false; // will be populated with actualized plugins json list
	$stored_plugins_list_json = get_option( $stored_optionname );

	$force = false;
	
	/**
	 * Am I forcing a refresh?
	 */
	if( current_user_can('edit_others_pages') ) {

		if( isset( $_GET )){
			if( array_key_exists( 'tgmpa-force-nonce' , $_GET) && array_key_exists( 'tgmpa-force' , $_GET) ) {
				$nonce = $_GET['tgmpa-force-nonce'];
				if ( wp_verify_nonce( $nonce, 'tgmpa-force-nonce' ) ) {
					$force = true;
					$stored_plugins_list_json = false; // will trigger a new fetch
				}
			}
		}

		/**
		 * Getting plugins archive
		 */
		if( !$stored_plugins_list_json || $stored_plugins_list_json == ''){
		
			$plugins_json = evenz_parse_plugins_update( $theme_version , $stored_optionname, $url );
			$plugins_data = json_decode( $plugins_json, true );
			$plugins_list = json_decode( $plugins_data['plugins_list_json'], true );

		} else {
			$required_update = false; // if set to true, will parse a new data
			$stored_vers_array = json_decode( $stored_plugins_list_json, true);
			if( !array_key_exists( 'plugins_list_json' , $stored_vers_array )
				|| !array_key_exists( 'plugins_list_json' , $stored_vers_array ) ){
				$required_update = true;
			} else {
				$stored_version = $stored_vers_array[ 'theme_version' ];
				if( $stored_version < $theme_version ){
					$required_update = true;
				}
			}

			$plugins_list = json_decode( $stored_vers_array [ 'plugins_list_json' ], true) ;
			if( $required_update ){
				$plugins_json = evenz_parse_plugins_update( $theme_version , $stored_optionname, $url );
				$plugins_data = json_decode( $plugins_json, true );
				$plugins_list = json_decode( $plugins_data['plugins_list_json'], true );
			}
		}
	
		if( $plugins_list ) {
			return $plugins_list;
		} else {
			return array();
			// add_action( 'admin_notices', 'evenz_plugins_notice__error' );
		}

	}
}