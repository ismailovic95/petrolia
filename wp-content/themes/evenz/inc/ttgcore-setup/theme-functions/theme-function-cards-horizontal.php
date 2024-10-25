<?php  
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Mini link cards
 * Icons requires the Icons2Go plugin
*/

if(!function_exists('evenz_cardshorizontal')){
	function evenz_cardshorizontal ($atts){

		extract( shortcode_atts( array(
		
			// general
			'img'			=> false,
			'bg'			=> false,
			'bgo'			=> false,
			
			'title' 		=> false,
			'subtitle'		=> false,
			'text'			=> false,
			'btnlink'		=> false,
			'btntxt'		=> false,
			'target'		=> '_self',
			'btnstyle'		=> false,
			'layout'		=> false
		), $atts ) );

		ob_start();

		?>
		<div class="evenz-cards evenz-cards__horizontal <?php echo esc_attr( $layout ); ?>">
			<div class="evenz-cards__content evenz-card evenz-gradprimary evenz-negative">
				<div class="evenz-cards__content__c">
					<div class="evenz-row">
						<div class="evenz-col evenz-cards__horizontal__col1 evenz-m6 evenz-l6">
							<div class="evenz-cards__horizontal__pad">
								<?php  
								
								/**
								 *  subtitle
								 * ========================================= */
								if( $subtitle ){
									?><h6 class="evenz-caption evenz-caption__xs"><?php echo esc_html( $subtitle ); ?></h6><?php
								}

								/**
								 * Title
								 * ========================================= */
								if( $title ){
										?>
										<h2 class="evenz-caption"><?php echo esc_html( $title ); ?></h2>
										<?php
								}

								/**
								 *  text
								 * ========================================= */
								if( $text ){
									?><p><?php echo esc_html( $text ); ?></p><?php
								}


								/**
								 *  text
								 * ========================================= */
								if( $btntxt && $btnlink ){
									?><a href="<?php echo esc_url( $btnlink ); ?>" class="evenz-btn evenz-btn__l <?php echo esc_attr( $btnstyle ); ?>" target="<?php echo esc_attr( $target ); ?>"><?php echo esc_html( $btntxt ); ?></a><?php
								}
								
					 			?>

					 		</div>
						</div>
						<div class="evenz-col evenz-cards__horizontal__col2 evenz-m6 evenz-l6">
							<?php 
				 			/**
							 * Header
							 * ========================================= */
							if( $img ){
								$image = wp_get_attachment_image_src($img, 'full'); 
								?>
								<div class="evenz-cards__i"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr( $title ); ?>"></div>
								<?php  
							}

							?>
						</div>
					</div>
		 		</div>



	 			<?php 
	 			/**
				 * Background
				 * ========================================= */
				if( $bg ){
					$image = wp_get_attachment_image_src($bg, 'full'); 
					?>
					<img class="evenz-cards__bg <?php if( $bgo ){ echo 'evenz-bgo-'.esc_attr( $bgo ); } ?>" src="<?php echo esc_url($image[0]); ?>" alt="<?php esc_attr_e('Background', 'evenz'); ?>">
					<?php  
				}

				?>

				<span class="evenz-hov"></span><div class="evenz-particles"></div>
				
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-cardshorizontal","evenz_cardshorizontal");
}
/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_vc_cardshorizontal' );
if(!function_exists('evenz_vc_cardshorizontal')){
	function evenz_vc_cardshorizontal() {
	  	vc_map( 
	  		array(
				"name" => esc_html__( "Card horizontal", "evenz" ),
				"base" => "qt-cardshorizontal",
				"icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/cardshorizontal.png' ),
				"category" => esc_html__( "Theme shortcodes", "evenz"),
				"params" => array(


				 	// General
				 	// ============================================
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Layout", "evenz" ),
						"param_name" 	=> "layout",
						'value' 		=> array( 
							esc_html__( "Default","evenz") 			=> "",
							esc_html__( "Invert columns","evenz") 			=> "evenz-cards__horizontal__inv",
						)	
					),
					array(
						"type" 			=> "attach_image",
						"heading" 		=> esc_html__( "Header image", "evenz" ),
						"description"	=> esc_html__( "Squared, 370px", "evenz"),
						"param_name" 	=> "img"
					),
					array(
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Subtitle", "evenz" ),
						"param_name" 	=> "subtitle",
					),
					array(
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Title", "evenz" ),
						"param_name" 	=> "title",
					),
					
					array(
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Text", "evenz" ),
						"param_name" 	=> "text",
					),
					array(
						"type" 			=> "attach_image",
						"heading" 		=> esc_html__( "Background image", "evenz" ),
						"param_name" 	=> "bg"
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Background image opacity", "evenz" ),
						"param_name"	=> "bgo",
						'std'			=> false,
						'value' 		=> array( 
							esc_html__( "Full","evenz") 		=> false,
							esc_html__( "Half","evenz") 		=> "half",
							esc_html__( "Low","evenz") 		=> "low",
						)			
					),

					array(
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Button text", "evenz" ),
						"param_name" 	=> "btntxt",
					),
					array(
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Link", "evenz" ),
						"param_name" 	=> "btnlink",
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Target", "evenz" ),
						"param_name" 	=> "target",
						'value' 		=> array( 
							esc_html__( "Same window","evenz") 			=> "",
							esc_html__( "New window","evenz") 			=> "_blank",
						)	
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Button style", "evenz" ),
						"param_name" 	=> "btnstyle",
						'value' 		=> array( 
							esc_html__( "Default","evenz") 			=> "",
							esc_html__( "Primary","evenz") 			=> "evenz-btn-primary",
						)	
					)
		 		)
	  		) 
		);
	}
}


