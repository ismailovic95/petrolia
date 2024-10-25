<?php  
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Mini link cards
 * Icons requires the Icons2Go plugin
*/

if(!function_exists('evenz_cards')){
	function evenz_cards ($atts){
		extract( shortcode_atts( array(
			// general
			'img'			=> false,
			'bg'			=> false,
			'bgo'			=> false,
			'featured'		=> false,
			'title' 		=> false,
			'subtitle'		=> false,
			'btnlink'		=> false,
			'btntxt'		=> false,
			'format'		=> 'def',
			'order'			=> false,
			'target'		=> '_self',
		), $atts ) );


		ob_start();

		?>
		<a href="<?php echo esc_attr( $btnlink ); ?>" class="evenz-cards  <?php 
			if( $format ){ echo esc_attr( 'evenz-cards__'.$format ); echo ' '; }
			if( $featured ){ echo 'evenz-cards__featured' ; echo ' '; } 
			if( $order == 'text-image' ){ echo 'evenz-cards__inv' ; echo ' '; } 
			?>" target="<?php echo esc_attr( $target ); ?>">
			<div class="evenz-cards__content evenz-card evenz-gradprimary evenz-negative  <?php if( $featured ){ ?> evenz-gradaccent <?php } ?>">

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

				<div class="evenz-cards__content__c">
					<?php  
					
					/**
					 * Title
					 * ========================================= */
					if( $title ){
						?><h4 class="evenz-capfont"><?php echo esc_html( $title ); ?></h4><?php
					}

					/**
					 *  subtitle
					 * ========================================= */
					if( $subtitle ){
						?><p class="evenz-small"><?php echo esc_html( $subtitle ); ?></p><?php
					}


					if( $btntxt ){
						?><span class="evenz-btn evenz-btn__bold evenz-btn__s"><?php echo esc_html( $btntxt ); ?></span><?php
					} else {
						?><hr class="evenz-sep"><?php  
					}
					
		 			?>

		 			
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
		</a>
		<?php
		return ob_get_clean();
	}
}
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-cards","evenz_cards");
}
/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_vc_cards' );
if(!function_exists('evenz_vc_cards')){
	function evenz_vc_cards() {
	  	vc_map( 
	  		array(
				"name" => esc_html__( "Cards with link", "evenz" ),
				"base" => "qt-cards",
				"icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/cards.png' ),
				"category" => esc_html__( "Theme shortcodes", "evenz"),
				"params" => array(
				 	// General
				 	// ============================================
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Format", "evenz" ),
						"param_name"	=> "format",
						'std'			=> false,
						'value' 		=> array( 
							esc_html__( "Default","evenz") 		=> 'def',
							esc_html__( "Long","evenz") 	=> "sky",
						)			
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Order", "evenz" ),
						"param_name"	=> "order",
						'std'			=> false,
						'value' 		=> array( 
							esc_html__( "Image + Text","evenz") 		=> false,
							esc_html__( "Text + Image","evenz") 		=> "text-image",
						),
						'dependency' 	=> array(
							'element' 		=> 'format',
							'value' 		=> 'sky',
						),		
					),
					array(
						"type" 			=> "checkbox",
						"heading" 		=> esc_html__( "Featured", "evenz" ),
						"param_name" 	=> "featured",
					),
					array(
						"type" 			=> "attach_image",
						"heading" 		=> esc_html__( "Header image", "evenz" ),
						"description"	=> esc_html__( "Squared, 370px", "evenz"),
						"param_name" 	=> "img"
					),
					array(
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Title", "evenz" ),
						"param_name" 	=> "title",
					),
					array(
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Subtitle", "evenz" ),
						"param_name" 	=> "subtitle",
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
						"heading" 		=> esc_html__( "Link", "evenz" ),
						"param_name" 	=> "btnlink",
					),
					array(
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Button text", "evenz" ),
						"description"	=> esc_html__( "Optional", "evenz"),
						"param_name" 	=> "btntxt",
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Target", "evenz" ),
						"param_name" 	=> "target",
						'value' 		=> array( 
							esc_html__( "Same window","evenz") 			=> "",
							esc_html__( "New window","evenz") 			=> "_blank",
						)	
					)
		 		)
	  		) 
		);
	}
}


