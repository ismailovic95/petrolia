<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

if(!function_exists('evenz_schedule_register_type')){




	add_action('init', 'evenz_schedule_register_type'); 

	function evenz_schedule_register_type() {

		/**
	  	 * Custom post type
	  	 * ======================================================*/
		$labelsschedule = array(
	        'name' 						=> esc_html__( "Schedule","evenz"),
	        'singular_name'		 		=> esc_html__( "Schedule","evenz"),
	        'add_new' 					=> esc_html__( "Add new","evenz"),
	        'add_new_item' 				=> esc_html__( "Add new schedule","evenz"),
	        'edit_item' 				=> esc_html__( "Edit schedule","evenz"),
	        'new_item' 					=> esc_html__( "New schedule","evenz"),
	        'all_items' 				=> esc_html__( "All schedules","evenz"),
	        'view_item' 				=> esc_html__( "View schedule","evenz"),
	        'search_items' 				=> esc_html__( "Search schedule","evenz"),
	        'not_found' 				=> esc_html__( "No schedules found","evenz"),
	        'not_found_in_trash'		=> esc_html__( "No schedules found in trash","evenz"),
	        'menu_name' 				=> esc_html__( "Schedules","evenz")
	    );
	  	$args = array(
	        'public' 					=> true,
	        'publicly_queryable'		=> true,
	        'show_ui' 					=> true, 
	        'show_in_menu' 				=> true, 
	        'query_var' 				=> true,
	        'has_archive' 				=> true,
	        'hierarchical' 				=> false,
	    	'page-attributes' 			=> true,
	    	'show_in_nav_menus' 		=> true,
	    	'show_in_admin_bar' 		=> true,
	    	'show_in_menu' 				=> true,
	    	'menu_position' 			=> 30,
	    	'rewrite' 					=> array( 'slug' => 'schedule' ),
	    	'labels' 					=> $labelsschedule,
	        'supports' 					=> array('title'),
	        'menu_icon' 				=> 'dashicons-calendar-alt',
	    	'capability_type' 			=> 'page',
	  	); 
	    if(function_exists('ttgcore_posttype')){
	    	ttgcore_posttype( "evenz_schedule" , $args );
	    }
	  	
	  	
	  	/**
	  	 * Add variable amount of speakers for each time zone
	  	 * ======================================================*/
		if(!function_exists( 'evenz_get_speakers_array' )){
		    function evenz_get_speakers_array(){

		    	$speakers_number_per_time = get_theme_mod('evenz_speakersnum',1);
		    	$speakers_arr = array();
		    	for( $i = 1; $i <= $speakers_number_per_time; $i++ ){
		    		$speakers_arr[] =array(
						'label' => esc_html__( "Speaker","evenz"),
						'id'	=> 'speaker_'.$i, // field id and name
						'type' => 'post_chosen',
						'posttype' => 'evenz_member'
					);
		    	}
		    	return $speakers_arr;
		    }
		}
		/**
	  	 * Custom meta fields
	  	 * ======================================================*/
	
		$schedule_meta_boxfields = array(
			
			array( // Repeatable & Sortable Text inputs
				'label'		=> esc_html__('Schedule items', "evenz"), // label
				'id'		=> 'evenz_timetable', // field id and name
				'type'		=> 'repeatable', // type of field
				'sanitizer' => array( // array of sanitizers with matching kets to next array
					'featured' 	=> 'meta_box_santitize_boolean',
					'title' 	=> 'sanitize_text_field',
					'desc' 		=> 'wp_kses_data'
				),
				'repeatable_fields' => array_merge ( // array of fields to be repeated
					array(
						array(
							'label' => esc_html__('Background image', "evenz"),
							'id'    =>  'img',
							'type'  => 'image'
						),
						array(
							'label' => esc_html__('Title', "evenz"),
							'id'    =>  'title',
							'type'  => 'text'
						),
						array(
							'label' => esc_html__('Description', "evenz"),
							'id'    =>  'desc',
							'type'  => 'textarea'
						),
						array(
							'label' => esc_html__('Time start (24h format)', "evenz"),
							'id'    => 'time',
							'type'  => 'time'
						),
						array(
							'label' => esc_html__('Time end (24h format)', "evenz"),
							'id'    => 'time_end',
							'type'  => 'time'
						),
						array(
							'label' => esc_html__('Time subtitle', "evenz"),
							'id'    =>  'timesub',
							'type'  => 'text'
						),
						
					), 
					evenz_get_speakers_array()
				)
			)  
		);
		if(class_exists("Custom_Add_Meta_Box")){
			$schedule_meta_box = new Custom_Add_Meta_Box( 'evenz_schedule_customtab', esc_html__('Schedule details', "evenz"), $schedule_meta_boxfields, 'evenz_schedule', true );
		}
	}
}



/**
 * ======================================================
 * Item pagination amount
 * ------------------------------------------------------
 * Customize number of posts depending on the archive post type
 * ======================================================
 */

if(!function_exists('evenz_schedule_query_order')){
	add_action( 'pre_get_posts', 'evenz_schedule_query_order', 1, 999 );
	function evenz_schedule_query_order( $query ) {
		if($query->is_main_query() && !is_admin()){
			if ( $query->is_post_type_archive('evenz_schedule')
				 || $query->is_tax('evenz_scheduletype')
			) {
				$query->set( 'meta_key', 'evenz_date' );
				$query->set( 'orderby', 'meta_value' );
				$query->set( 'order', 'ASC' );
				if ( get_theme_mod ( 'evenz_schedules_hideold', 0 ) == '1'){
					$query->set ( 
						'meta_query' , array (
							array (
								'key' => 'evenz_date',
								'value' => date('Y-m-d'),
								'compare' => '>=',
								'type' => 'date'
							)
						)
					);
				}
			}
		}
		return;
	}
}



















