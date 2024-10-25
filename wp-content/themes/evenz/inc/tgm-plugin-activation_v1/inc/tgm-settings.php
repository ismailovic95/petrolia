<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage Evenz
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'tgmpa_register', 'evenz_register_required_plugins' );
function evenz_register_required_plugins() {

	if(!is_admin()){
		return;
	}

	$plugins = evenz_default_plugins_list();

	$additional_plugins = evenz_get_pluginslist( evenz_additional_plugins_url() );

	if( $additional_plugins ){
		$plugins = array_merge (
			$additional_plugins,
			$plugins
		);
	}

	if( is_array( $plugins ) ) {

		if( count( $plugins ) > 0 ) {
			$config = array(
				'id'           => 'evenz-tgmpa',
				'default_path' => '',
				'menu'         => 'evenz-tgmpa-install-plugins',
				'parent_slug'  => 'themes.php',
				'capability'   => 'edit_theme_options',
				'has_notices'  => true,
				'dismissable'  => true,
				'dismiss_msg'  => '',
				'is_automatic' => true,
				'message'      => evenz_message_tgm()
			);
			tgmpa( $plugins, $config );
		} else {
			// It seems that something is wrong, let's display a link to refresh this
			add_action( 'admin_notices', 'evenz_plugins_notice__refresh' );
		}
	} else {
		 add_action( 'admin_notices', 'evenz_plugins_notice__nolist' );
	}

}