<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Latest posts
 *
 * Example:
 * [qt-post-carousel post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/


if(!function_exists( 'evenz_template_post_carousel' )){
	function evenz_template_post_carousel( $atts = array() ){

		ob_start();

		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			

			// Query parameters
			'post_type' 			=> 'post',
			'include_by_id'			=> false,
			'custom_query'			=> false,
			'tax_filter'			=> false,
			'items_per_page'		=> '9',
			'orderby'				=> 'date',
			'order'					=> 'DESC',
			'meta_key'				=> false,
			'offset'				=> 0,
			'exclude'				=> '',
			// Carousel parameters
			'items_per_row_desktop'	=> '3',
			'gap'					=> '15',
			'pause_on_hover'		=> 'true',
			'loop'					=> 'true',
			'center'				=> 'true',
			'nav'					=> 'true',
			'dots'					=> 'true',
			'stage_padding'			=> '0',
			'autoplay_timeout'		=> '4000',
			//tablet
			'items_per_row_tablet'	=> '2',
			//mobile
			'items_per_row_mobile'	=> '1',
			// Global parameters
			'el_id'					=> 'qt-post-carousel-'.uniqid( get_the_ID() ),
			'el_class'				=> '',
			'grid_id'				=> false // required for compatibility with WPBakery Page Builder
		

		), $atts ) );


		if(false === $grid_id){
			$grid_id = 'grid'.$el_id;
		}
		$grid_id = str_replace(':', '-', $grid_id);

		$paged = 1;

		include 'helpers/query-prep.php';

		/**
		 * 
		 * ========================================
		 * Events query parameters
		 * ========================================
		 * * Order by date
		 * * Hide old if enabled in customizer
		 * ========================================
		 * 
		 */
		if($post_type == 'evenz_event'){

			$args['orderby'] 	= 'meta_value';
			$args['order']   	= 'ASC';
			$args['meta_key'] 	= 'evenz_date';

			// Hide old?
			if(get_theme_mod( 'evenz_events_hideold', 0 ) == '1'){
				$args['meta_query'] = array(
					array(
						'key' 		=> 'evenz_date',
						'value' 	=> date('Y-m-d'),
						'compare' 	=> '>=',
						'type' 		=> 'date'
					 )
				);
			}
		}




		$wp_query = new WP_Query( $args );

		// Max results value, used in pagination
		$max = $wp_query->max_num_pages;
		switch($post_type){
			case "evenz_testimonial":
				$item_template = 'post-evenz_testimonial';
				break;
			case "evenz_member":
				$item_template = 'post-evenz_member';
				break;
			case "evenz_event":
				$item_template = 'post-evenz_event--card';
				break;
			case "product":
				$item_template = 'post-product';
				break;
			default:
				$item_template = 'post-vertical';
		}

		ob_start();
		if ( $wp_query->have_posts() ) : 
			$number = $wp_query->post_count;
			
			$container_classes = array('evenz-owl-carousel-container');
			?>

			<div id="<?php echo esc_attr($grid_id); ?>" class="<?php echo esc_attr( implode(' ', $container_classes)); ?>">
				<div id="<?php echo esc_attr($el_id); ?>" class="evenz-owl-carousel owl-carousel owl-theme evenz-owl-theme" 
					data-items="<?php 				echo esc_attr($items_per_row_desktop); ?>"
					data-items_tablet="<?php 		echo esc_attr($items_per_row_tablet); ?>"
					data-items_mobile="<?php 		echo esc_attr($items_per_row_mobile); ?>"
					data-items_mobile_hori="2"
					data-gap="<?php 				echo esc_attr($gap); ?>"
					data-pause_on_hover="<?php 		echo esc_attr($pause_on_hover); ?>"
					data-loop="<?php 				echo esc_attr($loop); ?>" 
					data-center="<?php 				echo esc_attr($center); ?>" 
					data-stage_padding="<?php 		echo esc_attr($stage_padding); ?>"
					data-nav="<?php 				echo esc_attr($nav); ?>"
					data-dots="<?php 				echo esc_attr($dots); ?>" 
					data-autoplay_timeout="<?php 	echo esc_attr($autoplay_timeout); ?>" 
					data-amount="<?php echo esc_attr( $number ); ?>">
					<?php  
					/**
					 * Loop
					 */
					while ( $wp_query->have_posts() ) : $wp_query->the_post();
						$post = $wp_query->post;
						setup_postdata( $post );
						?>
						<div class="evenz-item">
							<div class="evenz-itemcontainer">
								<?php 
								get_template_part ( 'template-parts/post/'.$item_template );
								?>
							</div>
						</div>
						<?php
					endwhile;
					?>
				</div>
			</div>
			<?php
			
		else: 
			esc_html_e("Sorry, there is nothing for the moment.", "evenz");
		endif; 
		wp_reset_postdata();
		return ob_get_clean();

		
	}
}


// Set TTG Core shortcode functionality
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-post-carousel","evenz_template_post_carousel");
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_template_post_carousel_vc' );
if(!function_exists('evenz_template_post_carousel_vc')){
	function evenz_template_post_carousel_vc() {
  		vc_map( 
  			array(
				"name" => esc_html__( "Post carousel", "evenz" ),
				"base" => "qt-post-carousel",
				"icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/post-carousel.png' ),
				"category" => esc_html__( "Theme shortcodes", "evenz"),
				"params" => array_merge(
					array(
						array(
							"group" 	=> esc_html__( "Data Settings", "evenz" ),
							'type' => 'dropdown',
							'heading' => esc_html__( 'Post type', 'evenz' ),
							'param_name' => 'post_type',
							'value' => array(
								esc_html__("Post",'evenz')	=> "post",
								esc_html__("Testimonial",'evenz')	=> "evenz_testimonial",
								esc_html__("Team member",'evenz')	=> "evenz_member",
								esc_html__("Events",'evenz')	=> "evenz_event",
							),
							'std' => 'post',
							'admin_label' => true,
							'edit_field_class' => 'vc_col-sm-7',
						),
					),
					evenz_vc_query_fields(),
					evenz_carousel_design_fields()
				)
			)
  		);
	}
}