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
 *	Design settings for single post to override customizer defaults
 *	=============================================================
 */
if(!function_exists("evenz_custom_post_fields_settings")){
	add_action('init', 'evenz_custom_post_fields_settings');  
	function evenz_custom_post_fields_settings() {
		$settings = array (
			array (
				'label' =>  esc_html__('Post template',"evenz"),
				'id' =>  'evenz_post_template',
				'default' => "default",
				'type' 	=> 'select',
				'options' => array (
					array('label' => esc_attr__( 'Force full',"evenz" ),'value' => '1'),	
					array('label' => esc_attr__( 'Force sidebar',"evenz" ),'value' => '2'),	
				)
			)
		);
		if(class_exists('Custom_Add_Meta_Box')){
			$settingsbox = new Custom_Add_Meta_Box('evenz_post_special_fields', 'Design settings', $settings, 'post', true );
		}
	}
}


