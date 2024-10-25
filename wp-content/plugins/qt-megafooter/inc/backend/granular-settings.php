<?php
/**
 * @package qt-megafooter
 */



/*
 *	Change mega footer settings for single pages
 *	=============================================================
 */
if(!function_exists("qt_megafooter_granularsettings")){
function qt_megafooter_granularsettings() {
	$qt_megafooter_list = qt_megafooter_list();
	$settings = array (
		array (
			'label' =>  esc_html__('Custom MegaFooter',"qt-megafooter"),
			'id' =>  'qt-megafooter-granular',
			'default' => "0",
			'type' 	=> 'select',
			'options' => array_merge(
				array(
					array(
						'label' => esc_attr__( 'Hide',"qt-megafooter" ),
						'value' => 'hide'
					),
				),
				$qt_megafooter_list
			),
		)
	);
	if(function_exists('custom_meta_box_field')){
		$settingsbox = new Custom_Add_Meta_Box('qt_megafooter_specialfields', esc_html__('MegaFooter settings', 'qt-megafooter') , $settings, 'page', true );
	}
}}
add_action('init', 'qt_megafooter_granularsettings');