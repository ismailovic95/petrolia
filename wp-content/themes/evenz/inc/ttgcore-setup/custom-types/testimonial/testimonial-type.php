<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

if(!function_exists('evenz_testimonial_register_type')){





	add_action('init', 'evenz_testimonial_register_type');  

	function evenz_testimonial_register_type() {

		/**
	  	 * Custom post type
	  	 * ======================================================*/
		$labels = array(
			'name' 					=> esc_html__( "Testimonials","evenz"),
			'singular_name' 		=> esc_html__( "Testimonial","evenz"),
			'add_new' 				=> esc_html__( "Add new","evenz"),
			'add_new_item' 			=> esc_html__( "Add new testimonial","evenz"),
			'edit_item'		 		=> esc_html__( "Edit testimonial","evenz"),
			'new_item' 				=> esc_html__( "New testimonial","evenz"),
			'all_items' 			=> esc_html__( "All testimonials","evenz"),
			'view_item' 			=> esc_html__( "View testimonial","evenz"),
			'search_items' 			=> esc_html__( "Search testimonial","evenz"),
			'not_found' 			=> esc_html__( "No testimonial found","evenz"),
			'not_found_in_trash' 	=> esc_html__( "No testimonial found in trash","evenz"),
			'menu_name' 			=> esc_html__( "Testimonials","evenz"),
			'parent_item_colon' 	=> '',
		);
		$args = array(
			
			'public' 				=> true,
			'publicly_queryable' 	=> true,
			'member_ui' 			=> true, 
			'member_in_menu' 		=> true, 
			'query_var' 			=> true,
			'has_archive' 			=> true,
			'hierarchical' 			=> false,
			'page-attributes' 		=> true,
			'member_in_nav_menus' 	=> true,
			'member_in_admin_bar' 	=> true,
			'member_in_menu' 		=> true,
			'menu_position' 		=> 30,
			'labels' 				=> $labels,
			'capability_type' 		=> 'page',
			'rewrite' 				=> array( 'slug' => 'testimonial' ),
			'menu_icon' 			=> 'dashicons-format-quote',
			'supports' 				=> array('title', 'thumbnail','page-attributes', 'revisions', 'editor'  )
		); 
	    if(function_exists('ttgcore_posttype')){
	    	ttgcore_posttype( "evenz_testimonial" , $args );
	    }

	    /**
	  	 * Custom taxonomy
	  	 * ======================================================*/
	    $labels = array(
			'name' 					=> esc_html__( 'Testimonial category',"evenz" ),
			'singular_name' 		=> esc_html__( 'Categories',"evenz" ),
			'search_items' 			=>  esc_html__( 'Search by category',"evenz" ),
			'popular_items' 		=> esc_html__( 'Popular categories',"evenz" ),
			'all_items' 			=> esc_html__( 'All categories',"evenz" ),
			'parent_item' 			=> null,
			'parent_item_colon' 	=> null,
			'edit_item' 			=> esc_html__( 'Edit category',"evenz" ), 
			'update_item' 			=> esc_html__( 'Update category',"evenz" ),
			'add_new_item' 			=> esc_html__( 'Add New category',"evenz" ),
			'new_item_name' 		=> esc_html__( 'New category',"evenz" ),
			'separate_items_with_commas' => esc_html__( 'Separate categories with commas',"evenz" ),
			'add_or_remove_items' 	=> esc_html__( 'Add or remove categories',"evenz" ),
			'choose_from_most_used' => esc_html__( 'Choose from the most used categories',"evenz" ),
			'menu_name' 			=> esc_html__( 'Categories',"evenz" ),
		);
	    $args = array(
			'hierarchical' 			=> true,
			'labels' 				=> $labels,
			'show_ui' 				=> true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' 			=> true,
			'rewrite' 				=> array( 'slug' => 'testimonial-category' )
		);
	    if(function_exists('ttgcore_custom_taxonomy')){
			ttgcore_custom_taxonomy('evenz_testimonialcat','evenz_testimonial',$args	);
		} 


		/**
	  	 * Custom meta fields
	  	 * ======================================================*/
	    $event_meta_boxfields = array(
			array(
				'label' => esc_html__('Testimonial name', "evenz"),
				'id'    => 'evenz_author',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Professional role', "evenz"),
				'id'    => 'evenz_role',
				'type'  => 'text'
			)
		);
		if(class_exists("Custom_Add_Meta_Box")){
			$meta_box 	= new Custom_Add_Meta_Box( 'testimonial_customtab', esc_html__('Testimonial details', "evenz"), $event_meta_boxfields, 'evenz_testimonial', true );
		}
	}
}