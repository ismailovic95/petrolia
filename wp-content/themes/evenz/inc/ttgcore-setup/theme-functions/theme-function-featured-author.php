<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Featured author
 *
 * Example:
 * [qt-featured-author id="0"]
*/


if(!function_exists( 'evenz_template_featured_author' )){
	function evenz_template_featured_author( $atts = array() ){
		extract( shortcode_atts( array(
			'id'	=> false
		), $atts ) );
		ob_start();
		// Output start
		?>
		<div class="evenz-container">
			<?php  
			if( !$id ){
				$query = array(
					'blog_id'      => $GLOBALS['blog_id'],
					'orderby'      => 'post_count', // nicename // registered
					'order'        => 'DESC', // ASC
					'offset'       => '',
					'search'       => '',
					'number'       => 1, // HOW MANY
					'count_total'  => false,
					'fields'       => 'ID',
					'who'          => 'subscriber', // subscriber
					'class' 		=> ''
				);
				$blogusers = get_users( $query );
				if(is_array( $blogusers )){	
					$id =  $blogusers[0]; 
				}
			}
			set_query_var( 'evenz_featuredauthor_id', $id );
			get_template_part( 'template-parts/author/featured-author' ); 
			remove_query_arg( 'evenz_var_series_amount' );
			?>
		</div>
		<?php

		$output = ob_get_clean();
		
		return $output;
		
	}
}

// Set TTG Core shortcode functionality
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-featured-author","evenz_template_featured_author");
}


/**
 *  Visual Composer / Page Builder integration
 */
if(!function_exists('evenz_template_featured_author_vc')){
	add_action( 'vc_before_init', 'evenz_template_featured_author_vc' );
	function evenz_template_featured_author_vc() {
		vc_map( 
			array(
				"name" 			=> esc_html__( "Featured author", "evenz" ),
				"base" 			=> "qt-featured-author",
				"icon" 			=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/featured-author.png' ),
				"description" 	=> esc_html__( "Display a single featured author", "evenz" ),
				"category" 		=> esc_html__( "Theme shortcodes", "evenz"),
				"params" 		=> array(
					array(
					   "type" 			=> "textfield",
					   "heading" 		=> esc_html__( "User ID", "evenz" ),
					   "param_name" 	=> "id",
					   "description" 	=> esc_html__( "If empty, the author with most posts will be used.", "evenz" )
					),
				)
			)
		);
	}
}