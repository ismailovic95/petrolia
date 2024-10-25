<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 *
 * Settings for the PageBuilder plugin, if active
 */


/**
 * Page Builder declare as theme plugin
 * to avoid eccessive bothering.
 */
if(function_exists('vc_set_as_theme')){
	vc_set_as_theme();
}


/* Visual composer extension settings
=============================================*/
if(defined( 'WPB_VC_VERSION' ) && function_exists( 'vc_add_param' ) && !function_exists('evenz_vc_after_init_actions') ){
	add_action( 'vc_after_init', 'evenz_vc_after_init_actions' );
	function evenz_vc_after_init_actions() {


		if(defined( 'WPB_VC_VERSION' )){
			/**
			 * 
			 * ===========================================================
			 * IMPORTANT:
			 * ===========================================================
			 * Page Builder Compatibility:
			 * Load the Page Composer styles and script forcefully otherwise with the customizer and with some plugins they don't work correctly
			 * ===========================================================
			 */
			wp_enqueue_script( 'wpb_composer_front_js' ); // Load Page Builder scripts
			wp_enqueue_style( 'js_composer_front' ); // Load Page Builder css
		}
		

		/**
		 * If using Ajax page loading, some parameters of Page Builder (Visual Composer)
		 * cannot be reinitialized because of the way its JS is created, so we need to remove
		 * those elements
		 */
		if( function_exists('vc_remove_param') && function_exists( 'qt_ajax_pageload_is_active' ) ){
			vc_remove_param( 'vc_row', 'full_width' ); 
		}
		
		/**
		 * Adding theme custom parameters
		 */
		if( function_exists('vc_add_param') ){ 
			vc_add_param(
				"vc_row", 
				array(
					'weight' => 1,
					"type" 		=> "dropdown",
					"heading" 	=> esc_html__( "Container box", "evenz" ),
					"param_name"=> "evenz_container",
					'value' 	=> array( 
									esc_html__( "None","evenz") 	=> "",
									esc_html__( "Wide","evenz") 		=> "2",
									esc_html__( "Narrow","evenz") 	=> "1",
									),
					"description" => esc_html__( "Wide: max width 1400px. Narrow: max width 1170px.", "evenz" )
				)


			);


			

			vc_add_param(
				"vc_column", 
				array(
					'type' => 'checkbox',
					'weight' => 1,
					'heading' => esc_html__( 'Section vertical paddings', "evenz" ),
					'param_name' => 'evenz_section',
					'description' => esc_html__( "Add vertical paddings for section separator", "evenz" )
				)
			);
			vc_add_param(
				"vc_row", 
				array(
					'type' => 'checkbox',
					'weight' => 1,
					'heading' => esc_html__( 'Negative colors', "evenz" ),
					'param_name' => 'evenz_negative',
					'description' => esc_html__( "Force white texts", "evenz" )
				)
			);

			vc_add_param(
				"vc_row", 
				array(
					'type' => 'checkbox',
					'weight' => 1,
					'heading' => esc_html__( 'Waves effect', "evenz" ),
					'param_name' => 'evenz_waves',
					'description' => esc_html__( "Add waves effect to the background", "evenz" )
				)
			);

			vc_add_param(
				"vc_row", 
				array(
					'weight' => 1,
					"type" 		=> "colorpicker",
					"heading" 	=> esc_html__( "Waves color", "evenz" ),
					"param_name"=> "evenz_waves_color",
				)
			);
			
			vc_add_param(
				"vc_row_inner", 
				array(
					'type' => 'checkbox',
					'weight' => 1,
					'heading' => esc_html__( 'Add container', "evenz" ),
					'param_name' => 'evenz_container',
					'description' => esc_html__( "Add a container box to the content to limit width", "evenz" )
				)
			);
			vc_add_param(
				"vc_row_inner", 
				array(
					'type' => 'checkbox',
					'weight' => 1,
					'heading' => esc_html__( 'Negative colors', "evenz" ),
					'param_name' => 'evenz_negative',
					'description' => esc_html__( "Force white texts", "evenz" )
				)
			);
			vc_add_param(
				"vc_column", 
				array(
					'type' => 'checkbox',
					'weight' => 1,
					'heading' => esc_html__( 'Sticky', "evenz" ),
					'param_name' => 'evenz_stickycolumn',
					'description' => esc_html__( "Make this one column sticky on scroll.", "evenz" )
				)
			);
		}
	}
}
