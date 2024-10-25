<?php
/**
 * @package t2gicons
 * @author Themes2Go
 * @textdomain t2gicons
 */


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 't2gicons_vc_shortcode' );
if(!function_exists('t2gicons_vc_shortcode')){
function t2gicons_vc_shortcode() {

	
	vc_map( array(
	 	"name" => esc_html__( "Icons2go", "t2gicons" ),
	 	"base" => "t2gicons",
	 	"icon" => plugins_url( '../t2gicons-icon.png' , __FILE__ ),
	 	"description" => esc_html__( "1000+ Premium Icons", "t2gicons" ),
	 	"category" => esc_html__( "Content", "t2gicons"),
	 	"params" => array(
		

		array(
			'type' => 'dropdown',
			'heading' => __( 'Icon library', 't2gicons' ),
			'value' => array(),//array( __( 'Material', 't2gicons' ) => 'material', ),
			'weight' => 10,
			'admin_label' => true,
			'param_name' => 'type',
			"std"	=> '',
			'description' => __( 'Select icon library.', 't2gicons' ),
		),



		/*array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 't2gicons' ),
			'param_name' => 'icon',
			'value' => 'vc-material vc-material-cake',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'material',
				'iconsPerPage' => 100,
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'material',
			),
			'description' => __( 'Select icon from library.', 't2gicons' ),
		),*/


		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Alignment", "t2gicons" ),
			"param_name" => "align",
			"std" => "center",
			'value' => array( 
			esc_attr__("Default", "t2gicons") => "default", 
			esc_attr__("Left", "t2gicons") => "left", 
			esc_attr__("Right", "t2gicons") => "right", 
			esc_attr__("Center", "t2gicons") => "center", 
			),
			"description" => esc_html__( "Icon alignment", "t2gicons" )
		),
		array(
			 "type" => "dropdown",
			 "heading" => esc_attr__("Font size", "t2gicons"),
			 "param_name" => "fontsize",
			 "std" => "100",
			 'value' => array( 
					"10","20","30","40","50","60","70","80","90","100","110","120","130","140","150","160","170","180","190","200"
				),
			 "description" => esc_html__( "Icon font size", "t2gicons" )
		),
		array(
			 "type" => "dropdown",
			 "heading" => esc_attr__("Color", "t2gicons"),
			 "param_name" => "color",
				"std" => "white",
			 'value' => array( 
					esc_attr__("Default", "t2gicons") => "default",
					esc_attr__("Red", "t2gicons") => "red", 
					esc_attr__("Pink", "t2gicons") => "pink", 
					esc_attr__("Purple", "t2gicons") => "purple", 
					esc_attr__("Deep purple", "t2gicons") => "deep-purple", 
					esc_attr__("Indigo", "t2gicons") => "indigo", 
					esc_attr__("Blue", "t2gicons") => "blue", 
					esc_attr__("Light-blue", "t2gicons") => "light-blue", 
					esc_attr__("Teal", "t2gicons") => "teal", 
					esc_attr__("Green", "t2gicons") => "green", 
					esc_attr__("Light-green", "t2gicons") => "light-green", 
					esc_attr__("Lime", "t2gicons") => "lime", 
					esc_attr__("Yellow", "t2gicons") => "yellow", 
					esc_attr__("Amber", "t2gicons") => "amber", 
					esc_attr__("Orange", "t2gicons") => "orange", 
					esc_attr__("Deep-orange", "t2gicons") => "deep-orange", 
					esc_attr__("Brown", "t2gicons") => "brown", 
					esc_attr__("Grey", "t2gicons") => "grey", 
					esc_attr__("Blue-grey", "t2gicons") => "blue-grey", 
					esc_attr__("Black", "t2gicons") => "black",
					esc_attr__("White", "t2gicons") => "white",

				),
			 "description" => esc_html__( "Icon text color", "t2gicons" )
		),
		array(
			 "type" => "dropdown",
			 "heading" => esc_attr__("Background shape", "t2gicons"),
			 "param_name" => "shape",
			 "std" => "rsquare",
			 'value' => array( 
					esc_attr__("No background", "t2gicons") => "none", 
					esc_attr__("Circle", "t2gicons") => "circle", 
					esc_attr__("Square", "t2gicons") => "square", 
					esc_attr__("Rounded square", "t2gicons") => "rsquare", 
					esc_attr__("Rhombus", "t2gicons") => "rhombus", 
					esc_attr__("Circle border", "t2gicons") => "circle-border", 
					esc_attr__("Square border", "t2gicons") => "square-border", 
					esc_attr__("Rounded square border", "t2gicons") => "rsquare-border", 
					esc_attr__("Rhombus border", "t2gicons") => "rhombus-border", 
				),
			 "description" => esc_html__( "Background shape", "t2gicons" )
		),
		array(
			 "type" => "dropdown",
			 "heading" => esc_attr__("Background color", "t2gicons"),
			 "param_name" => "bgcolor",
			  "std" => "blue",
			 'value' => array(
			 		esc_attr__("Default", "t2gicons") => "default",
					esc_attr__("Red", "t2gicons") => "red",
					esc_attr__("Pink", "t2gicons") => "pink", 
					esc_attr__("Purple", "t2gicons") => "purple", 
					esc_attr__("Deep purple", "t2gicons") => "deep-purple", 
					esc_attr__("Indigo", "t2gicons") => "indigo", 
					esc_attr__("Blue", "t2gicons") => "blue", 
					esc_attr__("Light-blue", "t2gicons") => "light-blue", 
					esc_attr__("Teal", "t2gicons") => "teal", 
					esc_attr__("Green", "t2gicons") => "green", 
					esc_attr__("Light-green", "t2gicons") => "light-green", 
					esc_attr__("Lime", "t2gicons") => "lime", 
					esc_attr__("Yellow", "t2gicons") => "yellow",
					esc_attr__("Amber", "t2gicons") => "amber", 
					esc_attr__("Orange", "t2gicons") => "orange",
					esc_attr__("Deep-orange", "t2gicons") => "deep-orange",
					esc_attr__("Brown", "t2gicons") => "brown",
					esc_attr__("Grey", "t2gicons") => "grey",
					esc_attr__("Blue-grey", "t2gicons") => "blue-grey",
					esc_attr__("Black", "t2gicons") => "black",
					esc_attr__("White", "t2gicons") => "white"
				),
			 "description" => esc_html__( "Icon text color", "t2gicons" )
		),
		array(
			 "type" => "dropdown",
			 "heading" => esc_attr__("Background size", "t2gicons"),
			 "param_name" => "size",
			 "std" => "200",
			 'value' => array( 
					"10","20","30","40","50","60","70","80","90","100","110","120","130","140","150","160","170","180","190","200"
				),
			 "description" => esc_html__( "Background shape size", "t2gicons" )
		),
		array(
			 "type" => "textfield",
			 "heading" => esc_html__( "Link", "t2gicons" ),
			 "description" => esc_html__("Add an URL to make the icon clickable","t2gicons"),
			 "param_name" => "link",
		),
		array(
			 "type" => "dropdown",
			 "heading" => esc_attr__("Link target", "t2gicons"),
			 "param_name" => "target",
			 'value' => array( 
					esc_html__("Same window", "t2gicons") => "_top", 
					esc_html__("New window", "t2gicons") => "_blank", 
				),
			 "description" => esc_html__( "Choose where to open the link", "t2gicons" )
		),
	 )
	));
}}



require plugin_dir_path( __FILE__ ) . '_t2gicons_vc_customsets.php'; // igor: temporary disabled

