<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Authors small cards grid
 *
 * Example:
 * [qt-authors-grid number="6" orderby="post_count|nicename|registered"]
*/


if(!function_exists( 'evenz_template_authors_small' )){
	function evenz_template_authors_small( $atts = array() ){
		ob_start();
		$atts = shortcode_atts( array(
			'blog_id'      => $GLOBALS['blog_id'],
			'orderby'      => 'post_count', // nicename // registered
			'order'        => 'DESC', // ASC
			'offset'       => '',
			'search'       => '',
			'number'       => 999, // HOW MANY
			'count_total'  => false,
			'fields'       => 'ID', // not a variable, we just need the IDs
			'who'          => 'subscriber', // subscriber
			'class' => ''
		), $atts );

		$atts[ 'number' ] = intval( $atts['number'] );

		$orderby = $atts[ 'orderby' ];
		if( $orderby == 'nicename' || $orderby == 'email' || $orderby == 'display_name'){
			$atts['order'] = 'ASC';
		}
		$blogusers = get_users( $atts );
		
		// Output start
		?>
		<div class="evenz-container">
			<div class="evenz-row">
				<?php
				foreach ( $blogusers as $id ) {
					$post_count = count_user_posts( $id );
					if ( $post_count > 0 ){
						?><div class="evenz-col evenz-s6 evenz-m4 evenz-l2"><?php  
						set_query_var( 'evenz_featuredauthor_id', $id );
						get_template_part( 'template-parts/author/author-card' ); 
						remove_query_arg( 'evenz_var_series_amount' );
						?></div><?php  
					}	
				}
				?>
			</div>
		</div>
		<?php
		// Output end
		$output = ob_get_clean();
		return $output;
	}
}



// Set TTG Core shortcode functionality
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-authors-small","evenz_template_authors_small");
}


/**
 *  Visual Composer / Page Builder integration
 */
if(!function_exists('evenz_template_authors_small_vc')){
	add_action( 'vc_before_init', 'evenz_template_authors_small_vc' );
	function evenz_template_authors_small_vc() {
		vc_map( 
			array(
				"name" 			=> esc_html__( "Authors small", "evenz" ),
				"base" 			=> "qt-authors-small",
				"icon" 			=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/authors-small.png' ),
				"description" 	=> esc_html__( "Grid of authors small cards. Only authors with published posts will be extracted.", "evenz" ),
				"category" 		=> esc_html__( "Theme shortcodes", "evenz"),
				"params" 		=> array(
					array(
					   "type" 		=> "dropdown",
					   "heading" 	=> esc_html__( "Order by", "evenz" ),
					   "param_name" => "orderby",
					   'std'		=> 'post_count',
					   'value' 		=> array(
					   		esc_html__( "Post Count", "evenz")		=> "post_count",
					   		esc_html__( "Nicename", "evenz")		=> "nicename",
							esc_html__( "Email", "evenz")			=> "email",
							esc_html__( "Display name", "evenz")	=> "display_name",
						),
					),
					array(
					   "type" => "textfield",
					   "heading" => esc_html__( "Offset (number)", "evenz" ),
					   "description" => esc_html__( "Number of posts to skip in the database query","evenz"),
					   "param_name" => "offset"
					),
					array(
			           "type" => "textfield",
			           "heading" => esc_html__( "Quantity", "evenz" ),
			           "param_name" => "number",
			           "description" => esc_html__( "Number of items to display", "evenz" )
			        ),
			        array(
			           "type" => "textfield",
			           "heading" => esc_html__( "Search by name", "evenz" ),
			           "param_name" => "search",
			           "description" => esc_html__( "Use this argument to search users by email address, URL, ID, username or display_name. More info: ", "evenz" ).'https://codex.wordpress.org/Function_Reference/get_users'
			        ),
			        array(
					   "type" => "textfield",
					   "heading" => esc_html__( "Class", "evenz" ),
					   "param_name" => "class",
					   'value' => '',
					   'description' => esc_html__( "Add an extra class for CSS styling", "evenz" )
					)
				)
	 		)
		);
	}
}








