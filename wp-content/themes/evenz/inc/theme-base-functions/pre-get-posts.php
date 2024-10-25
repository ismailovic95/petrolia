<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

/**
 * ======================================================
 * Item pagination amount
 * ------------------------------------------------------
 * Customize number of posts depending on the archive post type
 * ======================================================
 */

if(!function_exists('evenz_custom_number_of_posts')){
function evenz_custom_number_of_posts( $query ) {
	if($query->is_main_query() && !is_admin()){


		/**
		 * Team members pages archives
		 */
		if ( $query->is_post_type_archive( 'evenz_member' ) || $query->is_tax('evenz_membertype')){
			$query->set( 'posts_per_page', 9 );
			$query->set( 'orderby', array ('menu_order' => 'ASC', 'postname' => 'ASC'));
		}

		/**
		 * Events pages archives
		 */
		else if ( $query->is_post_type_archive( 'evenz_testimonial' ) || $query->is_tax('evenz_testimonialcat')){
			$query->set( 'posts_per_page', 12 );
			$query->set( 'orderby', array ('menu_order' => 'ASC', 'date' => 'DESC'));
		}

		/**
		 * Events pages archives
		 */
		else if ( $query->is_post_type_archive( 'place' ) || $query->is_tax('pcategory')){
			$query->set( 'posts_per_page', 9 );
			$query->set( 'orderby', array ('menu_order' => 'ASC', 'postname' => 'ASC'));
		}

		/**
		 * Events pages archives
		 */
		else if ( $query->is_post_type_archive( 'evenz_event' ) || $query->is_tax('evenz_eventtype')){
			$query->set( 'posts_per_page', 9 );
			$query->set( 'orderby', array ('menu_order' => 'ASC', 'date' => 'DESC'));
		}

		/**
		 * Defaults for any other archive
		 */
		else if ( 
			is_archive()
			|| is_category()
			|| is_tag()
		) {
			$query->set( 'posts_per_page','9' );
		}
		
		return;
	}
}}
add_action( 'pre_get_posts', 'evenz_custom_number_of_posts', 1, 999 );

