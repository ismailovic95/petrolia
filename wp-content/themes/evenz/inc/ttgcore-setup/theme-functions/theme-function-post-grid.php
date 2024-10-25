<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Latest posts
 *
 * Example:
 * [qt-post-grid post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/


if(!function_exists( 'evenz_template_post_grid' )){
	function evenz_template_post_grid( $atts = array() ){

		ob_start();

		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			// Design
			'cols_l'				=> '3',// cols desktop default
			'cols_m'				=> '2',// cols tablet default

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

			// Global parameters
			'el_id'					=>  'qt-post-grid-'.get_the_ID(), // 
			'el_class'				=> '',
			'grid_id'				=> false // required for compatibility with WPBakery Page Builder
		

		), $atts ) );


		if(false === $grid_id){
			$grid_id = 'grid'.$el_id;
		}
		$grid_id = str_replace(':', '-', $grid_id);

		$paged = 1;

		include 'helpers/query-prep.php';

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
			case "product":
				$item_template = 'post-product';
				break;
			default:
				$item_template = 'post-vertical';
		}


		ob_start();
		if ( $wp_query->have_posts() ) : 

			?>
			<div id="<?php echo esc_attr( $grid_id ); ?>" class="evenz-container evenz-post-grid">
				<div class="evenz-row">
					<?php  
					/**
					 * Loop
					 */
					
					// Width
						
					$class_l = 12 / intval($cols_l);
					$class_m = 12 / intval($cols_m);
					
					while ( $wp_query->have_posts() ) : $wp_query->the_post();
						$post = $wp_query->post;
							setup_postdata( $post );
							?>
							<div class="evenz-col evenz-col__post evenz-s12 evenz-m<?php echo esc_attr( $class_m ); ?> evenz-l<?php echo esc_attr( $class_l ); ?>">
								<?php  
								get_template_part ( 'template-parts/post/'.$item_template );
								?>
							</div>
							<?php wp_reset_postdata(); ?>
					<?php endwhile; ?>
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
	ttg_custom_shortcode("qt-post-grid","evenz_template_post_grid");
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_template_post_grid_vc' );
if(!function_exists('evenz_template_post_grid_vc')){
	function evenz_template_post_grid_vc() {
  		vc_map( 
  			array(
				"name" 			=> esc_html__( "Post grid", "evenz" ),
				"base" 			=> "qt-post-grid",
				"icon" 			=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/post-grid.png' ),
				"description" 	=> esc_html__( "Post grid", "evenz" ),
				"category" 		=> esc_html__( "Theme shortcodes", "evenz"),
				"params" 		=> array_merge(
					array(
						array(
							"group" 		=> esc_html__( "Data Settings", "evenz" ),
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Post type', 'evenz' ),
							'param_name' 	=> 'post_type',
							'value' 		=> array(
								esc_html__( "Post", 'evenz' )			=> "post",
								esc_html__( "Testimonial", 'evenz' )	=> "evenz_testimonial",
								esc_html__( "Team member", 'evenz' )	=> "evenz_member",
								esc_html__( "Product", 'evenz' )		=> "product",
							),
							'std' 			=> 'post',
							'admin_label' 	=> true,
							'edit_field_class' => 'vc_col-sm-7',
						),
						array(
							"group" 	=> esc_html__( "Grid design", "evenz" ),
							"type" 		=> "dropdown",
							"heading" 	=> esc_html__( "Columns desktop", "evenz" ),
							"param_name"=> "cols_l",
							'std'		=> '3',
							'value' 	=> array( 
									esc_html__( '1', 'evenz' )	=> '1',
									esc_html__( '2', 'evenz' )	=> '2',
									esc_html__( '3', 'evenz' )	=> '3',
									esc_html__( '4', 'evenz' )	=> '4',
								)			
							),
						array(
							"group" 	=> esc_html__( "Grid design", "evenz" ),
							"type" 		=> "dropdown",
							"heading" 	=> esc_html__( "Columns medium screen", "evenz" ),
							"param_name"=> "cols_m",
							'std'		=> '2',
							'value' 	=> array( 
									esc_html__( '1', 'evenz' )	=> '1',
									esc_html__( '2', 'evenz' )	=> '2',
									esc_html__( '3', 'evenz' )	=> '3',
								)			
							),
					),
					evenz_vc_query_fields()
				)
			)
  		);
	}
}