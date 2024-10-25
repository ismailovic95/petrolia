<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Latest posts
 *
 * Example:
 * [qt-post-cards post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/

if(!function_exists( 'evenz_template_post_cards' )){
	function evenz_template_post_cards( $atts = array() ){
		ob_start();

		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			// Query parameters
			'post_type' 			=> 'post',
			'include_by_id'			=> false,
			'custom_query'			=> false, // [Example year=2012]
			'tax_filter'			=> false, // Taxonomy filter [Example category:trending, post_tag:video]'
			'items_per_page'		=> '9',
			'orderby'				=> 'date',
			'order'					=> 'DESC',
			'meta_key'				=> false,
			'offset'				=> 0,
			'columns'				=> '3',
			'columnst'				=> '2',
			'exclude'				=> '',
			'el_id'					=> uniqid( 'qt-post-cards-'.get_the_ID() ), 
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

		ob_start();
		if ( $wp_query->have_posts() ) : 
			?>
			<div id="<?php echo esc_attr( $grid_id ); ?>" class="evenz-container evenz-post-cards">
				<div class="evenz-row">
					<?php  
					/**
					 * Loop
					 */
					
					$cols = '4';
					if( $columns == '1' || $columns == '2' || $columns == '3' ){
						$cols = 12 / intval( $columns );
					}
					$colst = '6';
					if( $columnst == '1' || $columnst == '2' || $columnst == '3' ){
						$colst = 12 / intval( $columnst );
					}

					while ( $wp_query->have_posts() ) : $wp_query->the_post();
						$post = $wp_query->post;
							setup_postdata( $post );
							?>
							<div class="evenz-col evenz-col__post evenz-s12 evenz-m<?php echo esc_attr( $colst ); ?> evenz-l<?php echo esc_attr( $cols ); ?>">
								<?php  
								get_template_part ('template-parts/post/post-card');
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
	ttg_custom_shortcode("qt-post-cards","evenz_template_post_cards");
}

/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_template_post_cards_vc' );
if(!function_exists('evenz_template_post_cards_vc')){
	function evenz_template_post_cards_vc() {
  		vc_map( 
  			array(
				"name" => esc_html__( "Post cards grid", "evenz" ),
				"base" => "qt-post-cards",
				"icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/post-cards.png' ),
				"description" => esc_html__( "Cards with background image", "evenz" ),
				"category" => esc_html__( "Theme shortcodes", "evenz"),
				"params" => array_merge(
					array(
						array(
						"type" 		=> "dropdown",
						"heading" 	=> esc_html__( "Columns number", "evenz" ),
						"param_name"=> "columns",
						'std'		=> '3',
						'value' 	=> array( 
								esc_html__( '1', 'evenz' ) 	=> '1',
								esc_html__( '2', 'evenz' ) 	=> '2',
								esc_html__( '3', 'evenz' ) 	=> '3',
							)			
						),
					),
					array(
						array(
						"type" 		=> "dropdown",
						"heading" 	=> esc_html__( "Columns tablet", "evenz" ),
						"param_name"=> "columnst",
						'std'		=> '2',
						'value' 	=> array( 
								esc_html__( '1', 'evenz' ) 	=> '1',
								esc_html__( '2', 'evenz' ) 	=> '2',
								esc_html__( '3', 'evenz' ) 	=> '3',
							)			
						),
					),
					evenz_vc_query_fields()
				)
			)
  		);
	}
}

