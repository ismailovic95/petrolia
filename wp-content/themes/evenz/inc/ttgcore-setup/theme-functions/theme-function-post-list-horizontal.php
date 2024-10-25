<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Latest posts list
 *
 * Example:
 * [qt-post-list-horizontal post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/


if(!function_exists( 'evenz_template_post_list_horizontal' )){
	function evenz_template_post_list_horizontal( $atts = array() ){

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

			// Global parameters
			'el_id'					=>  uniqid('qt-post-list-'.get_the_ID()),
			'el_class'				=> '',
			'list_id'				=> false // required for compatibility with WPBakery Page Builder
		), $atts ) );


		if(false === $list_id){
			$list_id = 'list'.$el_id;
		}
		$list_id = str_replace(':', '-', $list_id);

		$paged = 1;

		include 'helpers/query-prep.php';

		$wp_query = new WP_Query( $args );

		// Max results value, used in pagination
		$max = $wp_query->max_num_pages;

		ob_start();
		if ( $wp_query->have_posts() ) : 
			?>
			<div id="<?php echo esc_attr( $list_id ); ?>" class="evenz-container evenz-post-list-horizontal">
				<?php  
				/**
				 * Loop
				 */
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$post = $wp_query->post;
					setup_postdata( $post );
					get_template_part ('template-parts/post/post-horizontal');
				 	wp_reset_postdata(); 
				endwhile; 
				?>
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
	ttg_custom_shortcode("qt-post-list-horizontal","evenz_template_post_list_horizontal");
}

/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_template_post_list_horizontal_vc' );
if(!function_exists('evenz_template_post_list_horizontal_vc')){
	function evenz_template_post_list_horizontal_vc() {
  		vc_map( 
  			array(
				"name" => esc_html__( "Post list - Horizontal", "evenz" ),
				"base" => "qt-post-list-horizontal",
				"icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/post-list-horizontal.png' ),
				"description" => esc_html__( "List of posts with horizontal design", "evenz" ),
				"category" => esc_html__( "Theme shortcodes", "evenz"),
				"params" => array_merge(
					evenz_vc_query_fields()
				)
			)
  		);
	}
}