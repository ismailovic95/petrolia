<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

if(!function_exists('evenz_event_register_type')){





	add_action('init', 'evenz_event_register_type'); 

	function evenz_event_register_type() {

		/**
	  	 * Custom post type
	  	 * ======================================================*/
		$labelsevent = array(
	        'name' 						=> esc_html__( "Event","evenz"),
	        'singular_name'		 		=> esc_html__( "Event","evenz"),
	        'add_new' 					=> esc_html__( "Add new","evenz"),
	        'add_new_item' 				=> esc_html__( "Add new event","evenz"),
	        'edit_item' 				=> esc_html__( "Edit event","evenz"),
	        'new_item' 					=> esc_html__( "New event","evenz"),
	        'all_items' 				=> esc_html__( "All events","evenz"),
	        'view_item' 				=> esc_html__( "View event","evenz"),
	        'search_items' 				=> esc_html__( "Search event","evenz"),
	        'not_found' 				=> esc_html__( "No events found","evenz"),
	        'not_found_in_trash'		=> esc_html__( "No events found in trash","evenz"),
	        'menu_name' 				=> esc_html__( "Events","evenz")
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
	    	'rewrite' 					=> array( 'slug' => 'event' ),
	    	'labels' 					=> $labelsevent,
	        'supports' 					=> array('title','thumbnail','editor','page-attributes', 'excerpt'),
	        'menu_icon' 				=> 'dashicons-calendar-alt',
	    	'capability_type' 			=> 'page',
	  	); 
	    if(function_exists('ttgcore_posttype')){
	    	ttgcore_posttype( "evenz_event" , $args );
	    }
	  	
	  	/**
	  	 * Custom taxonomy
	  	 * ======================================================*/
		$labels = array(
			'name' 						=> esc_html__( 'Event type',"evenz" ),
			'singular_name' 			=> esc_html__( 'Types',"evenz" ),
			'search_items' 				=> esc_html__( 'Search by genre',"evenz" ),
			'popular_items' 			=> esc_html__( 'Popular genres',"evenz" ),
			'all_items' 				=> esc_html__( 'All events',"evenz" ),
			'edit_item' 				=> esc_html__( 'Edit Type',"evenz" ), 
			'update_item' 				=> esc_html__( 'Update Type',"evenz" ),
			'add_new_item' 				=> esc_html__( 'Add New Type',"evenz" ),
			'new_item_name' 			=> esc_html__( 'New Type Name',"evenz" ),
			'separate_items_with_commas'=> esc_html__( 'Separate Types with commas',"evenz" ),
			'add_or_remove_items' 		=> esc_html__( 'Add or remove Types',"evenz" ),
			'choose_from_most_used' 	=> esc_html__( 'Choose from the most used Types',"evenz" ),
			'menu_name' 				=> esc_html__( 'Event types',"evenz" ),
			'parent_item' 				=> null,
			'parent_item_colon' 		=> null,
		);
	    $args = array(
			'hierarchical' 				=> true,
			'show_ui' 					=> true,
			'query_var' 				=> true,
			'labels' 					=> $labels,
			'update_count_callback' 	=> '_update_post_term_count',
			'rewrite' 					=> array( 'slug' => 'eventtype' )
		);
	    if(function_exists('ttgcore_custom_taxonomy')){
			ttgcore_custom_taxonomy('evenz_eventtype','evenz_event',$args	);
		} 
		

		/**
	  	 * Custom meta fields
	  	 * ======================================================*/
	
		$event_meta_boxfields = array(
		    array(
				'label' => esc_html__('Date start', "evenz"),
				'id'    =>  'evenz_date',
				'type'  => 'date'
			),
			array(
				'label' => esc_html__('Date end', "evenz"),
				'id'    =>  'evenz_date_end',
				'type'  => 'date'
			),
			array(
				'label' => esc_html__('Time start (24h format)', "evenz"),
				'id'    => 'evenz_time',
				'type'  => 'time'
			),
			array(
				'label' => esc_html__('Time end (24h format)', "evenz"),
				'id'    => 'evenz_time_end',
				'type'  => 'time'
			),
			array(
				'label' => esc_html__('External event link', "evenz"),
				'id'    => 'evenz_link',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Add to google calendar (requires end date and time)', "evenz"),
				'id'    =>  'evenz_addtogooglecal',
				'type'  => 'checkbox'
			),
			array(
				'label' => esc_html__('Hide countdown', "evenz"),
				'id'    =>  'evenz_hidecountdown',
				'type'  => 'checkbox'
			),
			array(
				'label' => esc_html__('Location', "evenz"),
				'desc'	=> esc_html__('Venue name', "evenz"),
				'id'    =>  'evenz_location',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Address', "evenz"),
				'id'    => 'evenz_address',
				'desc'	=> esc_html__('Will appear in global event details', "evenz"),
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Phone', "evenz"),
				'id'    =>  'evenz_phone',
				'type'  => 'text'
			),
			
			array( // Repeatable & Sortable Text inputs
				'label'		=> esc_html__('Ticket Buy Links', "evenz"), // label
				'desc'		=> esc_html__('Add one for each link to external websites', "evenz"),
				'id'		=> 'evenz_buylinks', // field id and name
				'type'		=> 'repeatable', // type of field
				'sanitizer' => array( // array of sanitizers with matching kets to next array
					'featured' 	=> 'meta_box_santitize_boolean',
					'title' 	=> 'sanitize_text_field',
					'desc' 		=> 'wp_kses_data'
				),
				'repeatable_fields' => array ( // array of fields to be repeated
					'txt' => array(
						'label' 	=> esc_html__( 'Ticket buy text', "evenz" ),
						'desc'		=> esc_html__( 'Text for the purchase button', "evenz" ),
						'id' 		=> 'txt',
						'type' 		=> 'text'
					),
					'url' => array(
						'label' 	=> esc_html__('Ticket buy link ', "evenz"),
						'desc'		=> esc_html__( 'URL of the purchase page', "evenz" ),
						'id' 		=> 'url',
						'type' 		=> 'text'
					),
					'target' => array(
						'label' 	=> esc_html__('Open in new window', "evenz"),
						'id' 		=> 'target',
						'type' 		=> 'checkbox'
					)
				)
			)  
		);
		if(class_exists("Custom_Add_Meta_Box")){
			$event_meta_box = new Custom_Add_Meta_Box( 'evenz_event_customtab', esc_html__('Event details', "evenz"), $event_meta_boxfields, 'evenz_event', true );
		}




		/**
	  	 * Add programming table
	  	 * ======================================================*/
	
		$event_program_boxfields = array(
			
			array( // Repeatable & Sortable Text inputs
				'label'		=> esc_html__('Program of the event', "evenz"), // label
				'id'		=> 'evenz_program', // field id and name
				'type'		=> 'repeatable', // type of field
				'sanitizer' => array( // array of sanitizers with matching kets to next array
					'featured' 	=> 'meta_box_santitize_boolean',
					'title' 	=> 'sanitize_text_field',
					'desc' 		=> 'wp_kses_data'
				),
				'repeatable_fields' => array_merge ( // array of fields to be repeated
					array(
						array(
							'label'		=> esc_html__('Title', "evenz"),
							'id'    	=> 'title',
							'type'  	=> 'text'
						),
						array(
							'label' 	=> esc_html__( "Schedule","evenz"),
							'id'		=> 'schedule', // field id and name
							'type' 		=> 'post_chosen',
							'posttype' 	=> 'evenz_schedule'
						)						
					)
				)
			)  
		);
		if( class_exists( "Custom_Add_Meta_Box" ) ){
			$event_program_box = new Custom_Add_Meta_Box( 'evenz_event_schedules_customtab', esc_html__('Event program', "evenz"), $event_program_boxfields, 'evenz_event', true );
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

if(!function_exists('evenz_event_query_order')){
	add_action( 'pre_get_posts', 'evenz_event_query_order', 1, 999 );
	function evenz_event_query_order( $query ) {
		if($query->is_main_query() && !is_admin()){
			if ( $query->is_post_type_archive('evenz_event')
				 || $query->is_tax('evenz_eventtype')
			) {
				$query->set( 'meta_key', 'evenz_date' );
				$query->set( 'orderby', 'meta_value' );
				$query->set( 'order', 'ASC' );
				if ( get_theme_mod ( 'evenz_events_hideold', 0 ) == '1'){
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




if(!function_exists('evenz_enable_places')){
	add_action("after_switch_theme", "evenz_enable_places");
	function evenz_enable_places() {  
	    $optionKey='qtmaps_typeselect_evenz_event';
	    if(!get_option($optionKey)) {
	        update_option($optionKey , 1);
	    }
	}
}














