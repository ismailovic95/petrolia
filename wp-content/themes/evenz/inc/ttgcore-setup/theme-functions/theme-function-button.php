<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Custom Buttons
 *
 * Example:
 * [qt-button text="Click here" link="http" target="_blank" style="evenz-btn-primary" alignment="left|aligncenter|right" class="custom-classes"]
*/


if(!function_exists( 'evenz_template_button' )){
	function evenz_template_button( $atts = array() ){


		extract( shortcode_atts( array(
			'text' => esc_html__('Click here', 'evenz'),
			'link' => '#',
			'target' => '',
			'style' => '',
			'alignment' => '',
			'size'		=> '',
			'css_class' => ''
		), $atts ) );


		ob_start();
		
		if( $alignment == 'aligncenter' || $alignment == 'center' ){ ?> <p class="aligncenter"><?php } 
		
		?><a href="<?php echo esc_attr( $link ); ?>" <?php if( $target == "_blank" ){ ?> target="_blank" <?php } ?> 
		class="evenz-btn <?php  echo esc_attr( $style.' '.$alignment.' '.$css_class.' '.$size ); ?>"><span><?php echo esc_html($text); ?></span></a><?php 

		if($alignment == 'aligncenter'){ ?></p><?php } 

		// Output end
		
		$output = ob_get_clean();
		
		return $output;
		
	}
}

// Set TTG Core shortcode functionality
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-button","evenz_template_button");
}



/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_template_button_vc' );
if(!function_exists('evenz_template_button_vc')){
function evenz_template_button_vc() {
  vc_map( array(
	"name" 			=> esc_html__( "Button", "evenz" ),
	"base" 			=> "qt-button",
	"icon" 			=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/button.png' ),
	"description" 	=> esc_html__( "Add a button with link", "evenz" ),
	"category" 		=> esc_html__( "Theme shortcodes", "evenz"),
	"params" 		=> array(
			array(
				'type' 		=> 'textfield',
				'value' 	=> '',
				'heading' 	=> esc_html__( 'Text', 'evenz' ),
				'param_name'=> 'text',
			),
			array(
				'type' 		=> 'textfield',
				'value' 	=> '',
				'heading'	=> esc_html__( 'Link', 'evenz' ),
				'param_name'=> 'link',
			),
			array(
				"type" 		=> "dropdown",
				"heading" 	=> esc_html__( "Link target", "evenz" ),
				"param_name"=> "target",
				'value' 	=> array( 
					esc_html__( "Same window","evenz") 	=> "",
					esc_html__( "New window","evenz") 	=> "_blank",
					)			
				),
			array(
				"type" 		=> "dropdown",
				"heading" 	=> esc_html__( "Size", "evenz" ),
				"param_name"=> "size",
				'value' 	=> array( 
					esc_html__( "Default","evenz") 	=> "",
					esc_html__( "Large","evenz") 	=> "evenz-btn__l",
					)			
				),

			array(
				"type" 		=> "dropdown",
				"heading" 	=> esc_html__( "Button style", "evenz" ),
				"param_name"=> "style",
				'value' 	=> array( 
					esc_html__( "Default","evenz") 	=> "evenz-btn-default",
					esc_html__( "Primary","evenz") 	=> "evenz-btn-primary",
					esc_html__( "White","evenz") 	=> "evenz-btn__white",
					esc_html__( "Bold","evenz") 		=> "evenz-btn__bold",
					esc_html__( "Text only","evenz") => "evenz-btn__txt"
					)			
				),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Alignment", "evenz" ),
				"param_name"	=> "alignment",
				'value' 		=> array( 
								esc_html__( "Default","evenz") 	=> "",
								esc_html__( "Left","evenz") 		=> "alignleft",
								esc_html__( "Right","evenz") 	=> "alignright",
								esc_html__( "Center","evenz") 	=> "aligncenter",
								),
				"description" 	=> esc_html__( "Button style", "evenz" )
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Class", "evenz" ),
				"param_name" 	=> "css_class",
				'value' 		=> '',
				'description' 	=> esc_html__( "Add an extra class for CSS styling", "evenz" )
			)
		)
  	));
}}
