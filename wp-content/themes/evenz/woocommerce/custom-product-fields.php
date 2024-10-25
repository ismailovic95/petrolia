<?php
/*
* Package: evenz
* This is a WooCommerce support file to add custom fields to products
*/



if(!function_exists('evenz_woocommerce_custom_product_fields')){
	add_action('init', 'evenz_woocommerce_custom_product_fields');  
	function evenz_woocommerce_custom_product_fields() {
		// Single product sidebar option
		$fields_release = array(
			array (
				'label' =>  esc_html__('Custom product template',"evenz"),
				'description' =>  esc_html__('Override customizer settings for this product',"evenz"),
				'id' =>  'evenz_post_template',
				'default' => "default",
				'type' 	=> 'select',
				'options' => array (
					array('label' => esc_attr__( 'Force full',"evenz" ),'value' => 'fullpage'),	
					array('label' => esc_attr__( 'Right sidebar',"evenz" ),'value' => 'right-sidebar'),	
					array('label' => esc_attr__( 'Left sidebar',"evenz" ),'value' => 'left-sidebar'),	
				)
			)
			
		);
		if( post_type_exists( 'product' ) && class_exists('Custom_Add_Meta_Box')){
			$details_box = new Custom_Add_Meta_Box( 'associated_release_fields', 'Custom product design', $fields_release, 'product', true );
		}
	}
}
