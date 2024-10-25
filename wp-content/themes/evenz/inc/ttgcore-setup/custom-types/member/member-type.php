<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

if(!function_exists('evenz_member_register_type')){




	add_action('init', 'evenz_member_register_type');  

	function evenz_member_register_type() {

		/**
	  	 * Custom post type
	  	 * ======================================================*/
		$labels = array(
			'name' 						=> esc_html__( "Team Members","evenz" ),
			'singular_name' 			=> esc_html__( "Team member","evenz" ),
			'add_new' 					=> esc_html__('Add new',"evenz" ),
			'add_new_item' 				=> esc_html__('Add new team member',"evenz" ),
			'edit_item' 				=> esc_html__('Edit member',"evenz" ),
			'new_item' 					=> esc_html__('New member',"evenz" ),
			'all_items'					=> esc_html__('All team members',"evenz" ),
			'view_item' 				=> esc_html__('View team member',"evenz" ),
			'search_items' 				=> esc_html__('Search team member',"evenz" ),
			'not_found' 				=>  esc_html__('No member found',"evenz" ),
			'not_found_in_trash' 		=> esc_html__('No members found in Trash', "evenz" ),
			'parent_item_colon' 		=> '',
			'menu_name' 				=> esc_html__('Team members',"evenz" ),
		);
		$args = array(
			'public' 					=> true,
			'publicly_queryable' 		=> true,
			'show_ui' 					=> true, 
			'member_in_menu' 			=> true,
			'query_var' 				=> true,
			'has_archive' 				=> true,
			'hierarchical' 				=> false,
			'page-attributes' 			=> true,
			'show_in_nav_menus' 		=> true,
			'show_in_admin_bar' 		=> true,
			'show_in_menu' 				=> true,
			'menu_position' 			=> 30,
			'labels' 					=> $labels,
			'capability_type' 			=> 'page',
			'menu_icon' 				=> 'dashicons-businessman',
			'rewrite' 					=> array( 'slug' => 'team-members' ),
			'supports' 					=> array('title', 'thumbnail','page-attributes','editor', 'revisions'  )
		); 
	    if(function_exists('ttgcore_posttype')){
	    	ttgcore_posttype( "evenz_member" , $args );
	    }

		/**
	  	 * Custom taxonomy
	  	 * ======================================================*/
		$labels = array(
		    'name' 						=> esc_html__( 'Member type',"evenz" ),
		    'singular_name' 			=> esc_html__( 'Type',"evenz" ),
		    'search_items' 				=> esc_html__( 'Search by type',"evenz" ),
		    'popular_items' 			=> esc_html__( 'Popular member types',"evenz" ),
		    'all_items' 				=> esc_html__( 'All members',"evenz" ),
		    'edit_item' 				=> esc_html__( 'Edit type',"evenz" ), 
		    'update_item' 				=> esc_html__( 'Update type',"evenz" ),
		    'add_new_item' 				=> esc_html__( 'Add new type',"evenz" ),
		    'new_item_name'			 	=> esc_html__( 'New type Name',"evenz" ),
		    'separate_items_with_commas'=> esc_html__( 'Separate types with commas',"evenz" ),
		    'add_or_remove_items' 		=> esc_html__( 'Add or remove types',"evenz" ),
		    'choose_from_most_used' 	=> esc_html__( 'Choose from the most used types',"evenz" ),
		    'menu_name' 				=> esc_html__( 'Member types',"evenz" ),
		    'parent_item' 				=> null,
		    'parent_item_colon' 		=> null,
	  	); 
		$args = array(
		    'hierarchical' 				=> false,
		    'labels' 					=> $labels,
		    'show_ui' 					=> true,
		    'update_count_callback' 	=> '_update_post_term_count',
		    'query_var' 				=> true,
		    'rewrite' 					=> array( 'slug' => 'team-member-type' )
		);
		if(function_exists('ttgcore_custom_taxonomy')){
			ttgcore_custom_taxonomy('evenz_membertype','evenz_member', $args	);
		}
		


		/**
	  	 * Custom meta fields
	  	 * ======================================================*/

		$fields = array(
			array(
				'label' => esc_html__('Short bio (no HTML)',"evenz" ),
				'id'    => 'evenz_bio',
				'type'  => 'textarea'
				)
			,array(
				'label' => esc_html__('Professional role',"evenz" ),
				'id'    => 'evenz_role',
				'type'  => 'text'
				)
			,array(
				'label' => esc_html__('Itunes link',"evenz" ),
				'id'    => 'evenz_itunes',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Instagram link',"evenz" ),
				'id'    => 'evenz_instagram',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Linkedin link',"evenz" ),
				'id'    => 'evenz_linkedin',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Facebook link',"evenz" ),
				'id'    => 'evenz_facebook',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Twitter link',"evenz" ),
				'id'    => 'evenz_twitter',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Pinterest link',"evenz" ),
				'id'    => 'evenz_pinterest',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('TikTok link',"evenz" ),
				'id'    => 'evenz_tiktok',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Vimeo link',"evenz" ),
				'id'    => 'evenz_vimeo',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Wordpress link',"evenz" ),
				'id'    => 'evenz_wordpress',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Youtube link',"evenz" ),
				'id'    => 'evenz_youtube',
				'type'  => 'text'
				)
		);
		if(class_exists('Custom_Add_Meta_Box')) {
			$members_meta_box = new Custom_Add_Meta_Box( 'evenz_members_customtab',  esc_html__('Member details', "evenz"), $fields, 'evenz_member', true );
		}
	}
}