<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Custom internalmenus
 *
 * Example:
 * [qt-internalmenu text="Click here" link="http" target="_blank" style="evenz-btn-primary" alignment="left|aligncenter|right" class="custom-classes"]
*/


if(!function_exists( 'evenz_template_internalmenu' )){
	function evenz_template_internalmenu( $atts = array() ){
		extract( shortcode_atts( array(
			'class' => ''
		), $atts ) );
		ob_start();
	 	?>
	 	<div class="<?php echo esc_attr( $class ); ?>">
	 		<?php
			/**
			 * ======================================================
			 * Internal menu
			 * ======================================================
			 */
			get_template_part( 'template-parts/pageheader/part-internal-menu' ); 
			?>
		</div>
		<?php
		return ob_get_clean();
	}
}

// Set TTG Core shortcode functionality
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-internalmenu","evenz_template_internalmenu");
}



/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_template_internalmenu_vc' );
if(!function_exists('evenz_template_internalmenu_vc')){
	function evenz_template_internalmenu_vc() {
	  vc_map( array(
		"name" 			=> esc_html__( "Internal menu", "evenz" ),
		"base" 			=> "qt-internalmenu",
		"icon" 			=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/internalmenu.png' ),
		"description" 	=> esc_html__( "Display the internal menu. Set links using meta fields.", "evenz" ),
		"category" 		=> esc_html__( "Theme shortcodes", "evenz"),
		"params" 		=> array(
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__( "Class", "evenz" ),
					"param_name" 	=> "class",
					'value' 		=> '',
					'description' 	=> esc_html__( "Add an extra class for CSS styling. Use the custom fields under the content to add internal menu items.", "evenz" )
				)
			)
	  	));
	}
}
