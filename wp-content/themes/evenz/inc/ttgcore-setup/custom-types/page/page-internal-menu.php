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

if(!function_exists("evenz_linternal_menu_fields_settings")){
	function evenz_linternal_menu_fields_settings() {

		$this_template_only = 'page-fullwidth.php';
		
		$fields = array (
			array(
				'label' => esc_html__('Enable internal page menu', "evenz"),
				'id'    =>  'evenz_internalmenu_enable',
				'type'  => 'checkbox'
			),
			array(
				'label' => esc_html__('Overlap header', "evenz"),
				'id'    =>  'evenz_internalmenu_overlap',
				'type'  => 'checkbox'
			),
			array( // Repeatable & Sortable Text inputs
				'label'	=> esc_html__('Internal Menu', 'evenz'), // <label>
				'desc'	=> esc_html__('Link to internal page ids.', 'evenz') ,// description
				'id'	=> 'evenz_internalmenu_items', // field id and name
				'type'	=> 'repeatable', // type of field
				'sanitizer' => array( // array of sanitizers with matching kets to next array
					'featured' => 'meta_box_santitize_boolean',
					'title' => 'sanitize_text_field',
					'desc' => 'wp_kses_data'
				),
				'repeatable_fields' => array ( // array of fields to be repeated
					'text' => array(
						'label' => esc_html__('Label', "evenz"),
						'id' => 'txt',
						'type' => 'text',
					),
					'url' => array(
						'label' => esc_html__('Section ID or link URL', 'evenz'),
						'id' => 'url',
						'desc' => esc_html__( 'Edit a row in Visual Composer to add its ID or set a custom URL', 'evenz' ),
						'type' => 'text'
					),
					array(
						'label' => esc_html__('Highlight button', "evenz"),
						'id'    =>  'highlight',
						'type'  => 'checkbox'
					),
				)
			)
		);
		if(class_exists('Custom_Add_Meta_Box')){
			$settingsbox = new Custom_Add_Meta_Box('evenz_post_internalmenu', esc_html__('Internal page menu', 'evenz'), $fields, 'page', true , $this_template_only );
		}
	}
	add_action('init', 'evenz_linternal_menu_fields_settings');  
}
