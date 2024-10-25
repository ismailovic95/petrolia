<?php  
/**
 * @package t2gicons
 * @author Themes2Go
 * @textdomain t2gicons
 */





add_filter( 'vc_after_init', 't2gicons_add_new_icon_set_to_iconbox', 1000 );
if(!function_exists('t2gicons_add_new_icon_set_to_iconbox')){
function t2gicons_add_new_icon_set_to_iconbox( ) {
	$param = WPBMap::getParam( 't2gicons', 'type' );
	$t2gicons_families = t2gicons_families();
	foreach($t2gicons_families as $family){
		if(get_option($family['options_name']) == '1') {
			$param['value'][$family['label']] = $family['options_name'];
		}
	}
	vc_update_shortcode_param( 't2gicons', $param );
}}

// Add font picker setting to icon box module when you select your font family from the dropdown




add_action( 'vc_after_init', 't2gicons_add_font_picker', 1000 );
if(!function_exists('t2gicons_add_font_picker')){
function t2gicons_add_font_picker() {
	$t2gicons_families = t2gicons_families();
	foreach($t2gicons_families as $family){
		if(get_option($family['options_name']) == '1') {
			vc_add_param( 
				't2gicons', 
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 't2gicons' ),
					'param_name' => $family['options_name'],
					'value' => $family['classes'][0],
					'weight' => 1,
					//'std' => '',
					'settings' => array(
						'emptyIcon' => false,
						'type' => $family['options_name'],
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'type',
						'value' => $family['options_name'],
					),
					'description' => __( 'Select icon from library.', 't2gicons' )
				)
			);
		}
	}
}}


/*
$t2gicons_families = t2gicons_families();
foreach($t2gicons_families as $family){
	if(get_option($family['options_name']) == '1') {
		vc_map_update( 'icon_type', array (
		  	$family['options_name'] => $family['label']
		));
	}
}*/


/**
 * Define the Icons for VC Iconpicker
 */
$t2gicons_families = t2gicons_families();
foreach($t2gicons_families as $family){
	if(get_option($family['options_name']) == '1') {
		$classes = $family['classes'];
		add_filter('vc_iconpicker-type-'.$family['options_name'], 
		    function($icons) use ($classes) {
		    	$mytempcounter_x = $mytempcounter_x + 1;
		    	$iconsArray = array();
				foreach( $classes as $class){
					$iconsArray[] = array( $class => ucfirst($class));
				}
			    $list = array(
			        "icons" => $iconsArray
			    );
				$icons = array_merge( $icons, $list );
			    return array_unique($icons);
			}
		); // add_filter
	}
}

 
/**
 * Register Backend and Frontend CSS Styles
 */
add_action( 'vc_base_register_front_css', 't2gicons_vc_iconpicker_base_register_css' );
add_action( 'vc_base_register_admin_css', 't2gicons_vc_iconpicker_base_register_css' );
if(!function_exists('t2gicons_vc_iconpicker_base_register_css')){
function t2gicons_vc_iconpicker_base_register_css(){
	$t2gicons_families = t2gicons_families();
	foreach($t2gicons_families as $family){
		if(get_option($family['options_name']) == '1') {
			wp_register_style($family['folder'], $family['url'] );
		}
	}
}}

/**
 * Enqueue Backend and Frontend CSS Styles
 */
add_action( 'vc_backend_editor_enqueue_js_css', 't2gicons_vc_iconpicker_editor_jscss' );
add_action( 'vc_frontend_editor_enqueue_js_css', 't2gicons_vc_iconpicker_editor_jscss' );
if(!function_exists('t2gicons_vc_iconpicker_editor_jscss')){
function t2gicons_vc_iconpicker_editor_jscss(){
	$t2gicons_families = t2gicons_families();
	foreach($t2gicons_families as $family){
		if(get_option($family['options_name']) == '1') {
			wp_enqueue_style( $family['folder'] );
		}
	}
}}

/**
 * Enqueue CSS in Frontend when it's used
 */
add_action('vc_enqueue_font_icon_element', 't2gicons_enqueue_font_customicons');
if(!function_exists('t2gicons_enqueue_font_customicons')){
function t2gicons_enqueue_font_customicons($font){
	$t2gicons_families = t2gicons_families();
	foreach($t2gicons_families as $family){
		if(get_option($family['options_name']) == '1') {
			switch ( $font ) {
				case  $family['folder']: wp_enqueue_style(  $family['folder'] );
			}
		}
	}
}}

