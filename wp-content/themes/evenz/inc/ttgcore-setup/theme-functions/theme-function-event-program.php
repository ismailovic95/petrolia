<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Latest posts list
 *
 * Example:
 * [qt-post-list post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/


if(!function_exists('evenz_eventprogram_shortcode')) {
	function evenz_eventprogram_shortcode($atts){


		

		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			'include_by_id' => false,		
		), $atts ) );


		if( !$include_by_id ){
			return esc_html__( 'No ID selected', 'evenz' );
		}


		if( !is_string( get_post_status( $include_by_id ) ) ){
			return esc_html__( 'Invalid ID', 'evenz' );
		}


		/**
		 * Output object start
		 */

		ob_start();
		
		if(function_exists('evenz_program_display')){
			$program = evenz_program_display( $include_by_id , false); // no output
			if( $program && $program !== ''){

				?>
				<div class="evenz-event-program evenz-spacer-s">
					<?php  
					echo wp_kses_post( $program );
					?>
				</div>
				<?php
			} else {
				esc_html_e( 'This event currently has no program', 'evenz' );
			}
		}

		wp_reset_postdata();
		
		/**
		 * Loop end;
		 */
		
		return ob_get_clean();
	}
}

if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-eventprogram","evenz_eventprogram_shortcode");
}


/**
 *  Visual Composer integration
 */

if(!function_exists('evenz_eventprogram_shortcode_vc')){
	add_action( 'vc_before_init', 'evenz_eventprogram_shortcode_vc' );
	function evenz_eventprogram_shortcode_vc() {
	  vc_map( array(
		 "name" 		=> esc_html__( "Events program", "evenz" ),
		 "base" 		=> "qt-eventprogram",
		 "icon" 		=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/events.png' ),
		 "description" 	=> esc_html__( "Display full program of an event", "evenz" ),
		 "category" 	=> esc_html__( "Theme shortcodes", "evenz" ),
		 "params" 		=> array(
			array(
			   'type' 			=> 'autocomplete',
				'heading' 		=> esc_html__( 'Event', 'evenz' ),
				'param_name' 	=> 'include_by_id',
				'settings'		=> array( 
					'values' 			=> evenz_autocomplete( 'evenz_event' ) ,
					'multiple'       	=> false,
					'sortable'       	=> false,
	          		'min_length'     	=> 1,
	          		'groups'         	=> false,
	          		'unique_values'  	=> true,
	          		'display_inline' 	=> true,
				),
				'dependency' 	=> array(
					'element' 			=> 'post_type',
					'value' 			=> array( 'ids' ),
				),
			),
		 )
	  ) );
	}
}


		



