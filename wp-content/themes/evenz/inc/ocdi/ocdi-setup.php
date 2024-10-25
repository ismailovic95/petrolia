<?php
/**
 * 
 * @package WordPress
 * @subpackage One Click Demo Import
 * @subpackage evenz
 * @version 1.0.0
 * Settings for the demo import
 * https://wordpress.org/plugins/one-click-demo-import/
 * 
*/

add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

/**
 * Customize the popup width
 */
function evenz_ocdi_confirmation_dialog_options ( $options ) {
    return array_merge( $options, array(
        'width'       => 400,
        'dialogClass' => 'wp-dialog',
        'resizable'   => false,
        'height'      => 'auto',
        'modal'       => true,
    ) );
}
add_filter( 'pt-ocdi/confirmation_dialog_options', 'evenz_ocdi_confirmation_dialog_options', 10, 1 );

/**
 * Customize the popup width
 */
function evenz_ocdi_plugin_intro_text( $default_text ) {
    $default_text .= '<h2>'.esc_html__('Welcome to the "Evenz Theme" Demo Import.', 'evenz' ).'</h2>';
     $default_text .=  '<h3>'.esc_html__('Please make sure you check the manual before proceeding', 'evenz').'</h3>';

    return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'evenz_ocdi_plugin_intro_text' );

function evenz_ocdi_import_files() {
	$url = 'https://qantumthemes.xyz/public_plugins/evenz/demodata-20190830/';
	return array(
		array(
			'import_file_name'           => 'Default Demo',
			'categories'                 => array( 'Default' ),
			'import_file_url'            => $url.'demo1/evenz-demo1-data-v7b.xml',
			'import_widget_file_url'     => $url.'demo1/evenz-demo1-widgets-v7.wie',
			'import_customizer_file_url' => $url.'demo1/evenz-demo1-customizer-v7b.json', // dat extension triggers security restrictions
			'import_notice'              => esc_html__( 'IMPORTANT NOTICE: activate the Evenz Child theme and  any required plugin first.', 'evenz' ),
			'preview_url'                => 'https://evenz.qantumthemes.xyz/demo/',
			'import_preview_image_url'	 => $url.'default/preview.jpg',
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'evenz_ocdi_import_files' );



function evenz_ocdi_after_import_setup($selected_import) {


	/**
	 * Enable Places for posts
	 */
	update_option('qtmaps_typeselect_evenz_event', '1');


	// Home page ID
	$front_page_id = get_page_by_title( 'HOME 01' );

	// use the name of the selected import
	$demo_name =  $selected_import['import_file_name'];

	// Icons2Go configuration
	update_option("t2gicons_family_entertainments", "1");
	update_option("t2gicons_family_professional", "1");
	update_option("t2gicons_family_travel", "1");
	update_option("t2gicons_family_tech", "1");
	update_option("t2gicons_family_qticons", "1");
	update_option("t2gicons_plugin_configured", "1");

	/**
	 * 
	 * Set the menus
	 * 
	 */
	$evenz_menu_primary = get_term_by( 'name', 'Primary', 'nav_menu' );
	$evenz_menu_secondary = get_term_by( 'name', 'Secondary', 'nav_menu' );
	$evenz_menu_footer = get_term_by( 'name', 'Footer', 'nav_menu' );
	$evenz_menu_desktop_off = get_term_by( 'name', 'OffCanvas', 'nav_menu' );

	$menus = array();

	if( isset( $evenz_menu_primary ) ){
		$menus['evenz_menu_primary'] = $evenz_menu_primary->term_id;
	}
	if( isset( $evenz_menu_secondary ) ){
		$menus['evenz_menu_secondary'] = $evenz_menu_secondary->term_id;
	}
	if( isset( $evenz_menu_footer ) ){
		$menus['evenz_menu_footer'] = $evenz_menu_footer->term_id;
	}
	if( isset( $evenz_menu_desktop_off ) ){
		$menus['evenz_menu_desktop_off'] = $evenz_menu_desktop_off->term_id;
	}

	if( count( $menus ) >= 1 ){ // If my array has items, set them
		set_theme_mod( 'nav_menu_locations', $menus );
	}


	// Assign front page and posts page (blog page).
	
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	
}
add_action( 'pt-ocdi/after_import', 'evenz_ocdi_after_import_setup' );