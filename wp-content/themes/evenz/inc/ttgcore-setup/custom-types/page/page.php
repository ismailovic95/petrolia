<?php
/**
 * @package WordPress
 * @subpackage ttgcore
 * @subpackage evenz
 * @version 1.0.0
 *
 * ======================================================================
 * SETTINGS FOR THE TTGCORE PLUGIN
 * _____________________________________________________________________
 * This file adds configurations for the TTGcore plugin for custom 
 * posty types and/or taxonomies
 * ======================================================================
 */

/*
 *	Design settings for single page
 *	=============================================================
 */
if(!function_exists("evenz_custom_page_fields_settings")){
function evenz_custom_page_fields_settings() {
	$settings = array (
		array (
			'label' =>  esc_html__('Hide page header',"evenz"),
			'id' =>  'evenz_page_header_hide',
			'default' => "0",
			'type' 	=> 'checkbox'
		),
		array (
			'label' =>  esc_html__('Menu opacity',"evenz"),
			'id' =>  'evenz_menu_opacity',
			'default' => "default",
			'desc'	=> esc_html__('Override customizer option for this page', 'evenz'),
			'type' 	=> 'select',
			'options' => array (
				array('label' => esc_attr__( 'Opaque', "evenz" ), 'value' => 'evenz-menu-opaque' ),	
				array('label' => esc_attr__( 'Transparent', "evenz" ), 'value' => 'evenz-menu-transp' ),	
			)
		)
	);
	if(class_exists('Custom_Add_Meta_Box')){
		$settingsbox = new Custom_Add_Meta_Box('evenz_post_special_fields', 'Page design settings', $settings, 'page', true );
		$settingsbox = new Custom_Add_Meta_Box('evenz_post_special_fields', 'Page design settings', $settings, 'evenz_member', true );
	}
}}
add_action('init', 'evenz_custom_page_fields_settings');  

