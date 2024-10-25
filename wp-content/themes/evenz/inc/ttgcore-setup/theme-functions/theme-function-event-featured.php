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


if(!function_exists('evenz_events_featured_shortcode')) {
	function evenz_events_featured_shortcode($atts){

		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			'include_by_id' 	=> false,
			'quantity' 			=> 1,
			'hideold' 			=> false,
			'title' 			=> false,
			'countdown' 		=> false,
			'category' 			=> false,
			'orderby' 			=> 'date',
			'btntxt' 			=> esc_html__( 'Learn more', 'evenz' ),
			'offset' 			=> 0,
		), $atts ) );

		if(!is_numeric($quantity)) {
			$quantyty = 1;
		}

		$offset = (int)$offset;
		if(!is_numeric($offset)) {
			$offset = 0;
		}
		
		/**
		 *  Query for my content
		 */
		$args = array(
			'post_type' 			=>  'evenz_event',
			'posts_per_page' 		=> $quantity,
			'post_status' 			=> 'publish',
			'paged' 				=> 1,
			'suppress_filters' 		=> false,
			'offset' 				=> esc_attr($offset),
			'ignore_sticky_posts' 	=> 1
		);

		/**
		 * Add category parameters to query if any is set
		 */
		if (false !== $category && 'all' !== $category) {
			$args[ 'tax_query'] = array(
					array(
					'taxonomy' 	=> 'evenz_eventtype',
					'field' 	=> 'slug',
					'terms' 	=> array(esc_attr($category)),
					'operator'	=> 'IN'
				)
			);
		}

		/**
		 * Query parameters for events only
		 */
		
		$args['orderby'] 	= 'meta_value';
		$args['order']   	= 'ASC';
		$args['meta_key'] 	= 'evenz_date';


		/**
		 * Optionally hide old events
		 */
		if($hideold){
			$args['meta_query'] = array(
				array(
					'key' 		=> 'evenz_date',
					'value' 	=> date('Y-m-d'),
					'compare' 	=> '>=',
					'type' 		=> 'date'
				 )
			);
		}


		/**
		 * Alternative: query by ID only
		 */
		if($include_by_id){
			$idarr = explode(",",$include_by_id);
			if(count($idarr) > 0){
				$quantity = count($idarr);
				$args = array(
					'post__in'=> $idarr,
					'post_type' =>  'evenz_event',
					'orderby' => 'post__in',
					'posts_per_page' => -1,
					'ignore_sticky_posts' => 1
				);  
			}
		}
		

		/**
		 * [$wp_query execution of the query]
		 * @var WP_Query
		 */
		$wp_query = new WP_Query( $args );

		/**
		 * Output object start
		 */

		ob_start();

		if($title){ ?><h3 class="qt-sectiontitle"><?php echo esc_html($title); ?></h3><?php }

		set_query_var( 'evenz_countdown', $countdown );
		set_query_var( 'evenz_btntxt', $btntxt );
		
		/**
		 * Loop start
		 */
		if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$post = $wp_query->post;
			setup_postdata( $post );
			get_template_part( 'template-parts/post/post-evenz_event-featured' );
		endwhile;  else: 
			esc_html_e("Sorry, there is nothing for the moment.", "evenz"); ?>
		<?php  
		endif; 
		wp_reset_postdata();
		remove_query_arg( 'evenz_countdown' );
		remove_query_arg( 'evenz_btntxt' );

		/**
		 * Loop end
		 */
		
		return ob_get_clean();
	}
}

if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-events-featured","evenz_events_featured_shortcode");
}


/**
 *  Visual Composer integration
 */

if(!function_exists('evenz_events_featured_shortcode_vc')){
	add_action( 'vc_before_init', 'evenz_events_featured_shortcode_vc' );
	function evenz_events_featured_shortcode_vc() {
	  vc_map( array(
		 "name" 		=> esc_html__( "Events featured", "evenz" ),
		 "base" 		=> "qt-events-featured",
		 "icon" 		=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/events-featured.png' ),
		 "description" 	=> esc_html__( "List of events with featured design", "evenz" ),
		 "category" 	=> esc_html__( "Theme shortcodes", "evenz"),
		 "params" 		=> array(
			array(
			   "type" 			=> "checkbox",
			   "heading" 		=> esc_html__( "Hide old events", "evenz" ),
			   "param_name" 	=> "hideold",
			),
			array(
			   "type" 			=> "checkbox",
			   "heading" 		=> esc_html__( "Countdown", "evenz" ),
			   "param_name" 	=> "countdown",
			),
			array(
			   'type' 			=> 'autocomplete',
				'heading' 		=> esc_html__( 'Event', 'evenz'),
				'param_name' 	=> 'include_by_id',
				'settings'		=> array( 
					'values' 		=> evenz_autocomplete('evenz_event') ,
					'multiple'		=> false,
					'sortable'		=> false,
	          		'min_length'	=> 1,
	          		'groups'		=> false,  
	          		'unique_values' => true,  
	          		'display_inline'=> true,
				),
				'dependency' 	=> array(
					'element' 		=> 'post_type',
					'value' 		=> array( 'ids' ),
				),
			),
			array(
			   "type" 			=> "textfield",
			   "heading" 		=> esc_html__( "Quantity", "evenz" ),
			   "param_name" 	=> "quantity",
			   'std'			=> '1',
			   "description" 	=> esc_html__( "Number of items to display", "evenz" )
			),
			array(
			   "type" 			=> "textfield",
			   "heading" 		=> esc_html__( "Button text", "evenz" ),
			   "param_name" 	=> "btntxt",
			   'std' 			=> esc_html__( 'Learn more', 'evenz' )
			),
			array(
			   "type" 			=> "textfield",
			   "heading" 		=> esc_html__( "Filter by event type (slug)", "evenz" ),
			   "description"	=> esc_html__( "Instert the slug of the event type to filter the results","evenz"),
			   "param_name" 	=> "category"
			),
			array(
			   "type" 			=> "textfield",
			   "heading" 		=> esc_html__( "Offset (number)", "evenz" ),
			   "description"	=> esc_html__( "Number of items to skip in the database query","evenz"),
			   "param_name" 	=> "offset"
			)
		 )
	  ) );
	}
}


		



