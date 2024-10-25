<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Carousel design fields
*/


/**
 * ===============================================================
 * CAROUSEL DESIGN FIELDS
 * ================================================================
 */

function evenz_carousel_design_fields(){
	$fields = array (

		array(
			"group" 	=> esc_html__( "Carousel settings", "evenz" ),
			'type' => 'dropdown',
			'heading' => esc_html__( 'Items per row in desktop', 'evenz' ),
			'param_name' => 'items_per_row_desktop',
			'value' => array(
				esc_html__( '1', 'evenz' ) 	=> '1',
				esc_html__( '2', 'evenz' ) 	=> '2',
				esc_html__( '3', 'evenz' ) 	=> '3',
				esc_html__( '4', 'evenz' ) 	=> '4',
				esc_html__( '5', 'evenz' ) 	=> '5',
				esc_html__( '6', 'evenz' ) 	=> '6',
				esc_html__( '7', 'evenz' ) 	=> '7',
				esc_html__( '8', 'evenz' ) 	=> '8',
			),
			'std' => '3',
			'admin_label' => true,
			'edit_field_class' => 'vc_col-sm-7',
			'description' => esc_html__( 'Select number of items per row.', 'evenz' ),
		),
		array(
			"group" 	=> esc_html__( "Carousel settings", "evenz" ),
			'type' => 'dropdown',
			'heading' => esc_html__( 'Gap', 'evenz' ),
			'param_name' => 'gap',
			'value' => array(
				esc_html__( '0px', 'evenz' ) => '0',
				esc_html__( '1px', 'evenz' ) => '1',
				esc_html__( '2px', 'evenz' ) => '2',
				esc_html__( '3px', 'evenz' ) => '3',
				esc_html__( '4px', 'evenz' ) => '4',
				esc_html__( '5px', 'evenz' ) => '5',
				esc_html__( '6px', 'evenz' ) => '6',
				esc_html__( '7px', 'evenz' ) => '7',
				esc_html__( '8px', 'evenz' ) => '8',
				esc_html__( '9px', 'evenz' ) => '9',
				esc_html__( '10px', 'evenz' ) => '10',
				esc_html__( '11px', 'evenz' ) => '11',
				esc_html__( '12px', 'evenz' ) => '12',
				esc_html__( '13px', 'evenz' ) => '13',
				esc_html__( '14px', 'evenz' ) => '14',
				esc_html__( '15px', 'evenz' ) => '15',
				esc_html__( '16px', 'evenz' ) => '16',
				esc_html__( '17px', 'evenz' ) => '17',
				esc_html__( '18px', 'evenz' ) => '18',
				esc_html__( '19px', 'evenz' ) => '19',
				esc_html__( '20px', 'evenz' ) => '20',
				esc_html__( '21px', 'evenz' ) => '21',
				esc_html__( '22px', 'evenz' ) => '22',
				esc_html__( '23px', 'evenz' ) => '23',
				esc_html__( '24px', 'evenz' ) => '24',
				esc_html__( '25px', 'evenz' ) => '25',
				esc_html__( '26px', 'evenz' ) => '26',
				esc_html__( '27px', 'evenz' ) => '27',
				esc_html__( '28px', 'evenz' ) => '28',
				esc_html__( '29px', 'evenz' ) => '29',
				esc_html__( '30px', 'evenz' ) => '30'
			),
			'std' => '15',
			'description' => esc_html__( 'Select gap between items.', 'evenz' ),
			'edit_field_class' => 'vc_col-sm-7',
		),

		array(
			"type" 		=> "textfield",
			"group" 	=> esc_html__( "Carousel settings", "evenz" ),
			"heading" 	=> esc_html__( "Autoplay timeout", "evenz" ),
			'description' => esc_html__( 'Set to 0 to disable', 'evenz' ),
			"param_name"=> "autoplay_timeout",
			'std'		=> '4000',
			'value'		=> ''
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Carousel settings", "evenz" ),
			"heading" 	=> esc_html__( "Pause on hover", "evenz" ),
			"param_name"=> "pause_on_hover",
			'std'		=> 'true',
			'value'		=> 'true'
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Carousel settings", "evenz" ),
			"heading" 	=> esc_html__( "Loop", "evenz" ),
			"param_name"=> "loop",
			'std'		=> 'true',
			'value'		=> 'true'
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Carousel settings", "evenz" ),
			"heading" 	=> esc_html__( "Center", "evenz" ),
			"param_name"=> "center",
			'std'		=> 'true',
			'value'		=> 'true'
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Carousel settings", "evenz" ),
			"heading" 	=> esc_html__( "Nav", "evenz" ),
			"param_name"=> "nav",
			'std'		=> 'true',
			'value'		=> 'true'
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Carousel settings", "evenz" ),
			"heading" 	=> esc_html__( "Dots", "evenz" ),
			"param_name"=> "dots",
			'std'		=> 'true',
			'value'		=> 'true'
		),
		
		
		// Tablet
		// --------------------------------------------------------

		array(
			"group" 	=> esc_html__( "Tablet", "evenz" ),
			'type' => 'dropdown',
			'heading' => esc_html__( 'Items per row tablet', 'evenz' ),
			'param_name' => 'items_per_row_tablet',
			'value' => array(
				esc_html__( '1', 'evenz' ) 	=> '1',
				esc_html__( '2', 'evenz' ) 	=> '2',
				esc_html__( '3', 'evenz' ) 	=> '3',
				esc_html__( '4', 'evenz' ) 	=> '4',
				esc_html__( '5', 'evenz' ) 	=> '5',
				esc_html__( '6', 'evenz' ) 	=> '6',
				esc_html__( '7', 'evenz' ) 	=> '7',
				esc_html__( '8', 'evenz' ) 	=> '8',
			),
			'std' => '2',
			'admin_label' => true,
			'edit_field_class' => 'vc_col-sm-7',
		),
		
		// Mobile
		// --------------------------------------------------------
		
		array(
			"group" 	=> esc_html__( "Mobile", "evenz" ),
			'type' => 'dropdown',
			'heading' => esc_html__( 'Items per row mobile', 'evenz' ),
			'param_name' => 'items_per_row_mobile',
			'value' => array(
				esc_html__( '1', 'evenz' ) 	=> '1',
				esc_html__( '2', 'evenz' ) 	=> '2',
				esc_html__( '3', 'evenz' ) 	=> '3',
				esc_html__( '4', 'evenz' ) 	=> '4',
				esc_html__( '5', 'evenz' ) 	=> '5',
				esc_html__( '6', 'evenz' ) 	=> '6',
				esc_html__( '7', 'evenz' ) 	=> '7',
				esc_html__( '8', 'evenz' ) 	=> '8',
			),
			'std' => '1',
			'admin_label' => true,
			'edit_field_class' => 'vc_col-sm-7',
			'description' => esc_html__( 'Select number of single grid elements per row.', 'evenz' ),
		),
		array(
			'type' => 'vc_grid_id',
			'param_name' => 'grid_id',
		),
	);
	return $fields;

}

