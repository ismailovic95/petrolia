<?php  
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Pricing tables
 *
 * Example:
 * Due to the serialized nature of the data for this shortcode, 
 * is not possible to use it out of page builder
*/

if(!function_exists('evenz_pricingtable')){
	function evenz_pricingtable ($atts){

		extract( shortcode_atts( array(

			// Icons (require Icons2Go plugin)
			'icontype' => false,
			'type' => false,

			// general
			'title' 		=> false,
			'subtitle' 		=> false,
			'footertext'	=> false,
			'featured'		=> false,
			'bg'			=> false,
			'bgo'			=> false,

			// price
			'price' 		=> false,
			'cents'			=> false,
			'coin'			=> false,
			'details'		=> false,
			
			// button
			'btntext'		=> false,
			'btnlink'		=> false,
			'target'		=> '_self',

			// items
			'items' 		=> false,
			
		), $atts ) );

		/**
		 * Icons2Go plugin attachment for special icons
		 * @var [type]
		 */
		if( function_exists( 't2gicons_families' )) {
			$t2gicons_families = t2gicons_families();
			if($icontype == false){
				if($type != false){
					if(array_key_exists($type, $atts)){
						$icontype = $atts[$type];
					} else {
						if(array_key_exists($type, $t2gicons_families)){
							$icontype = $t2gicons_families[$type]["classes"][0];
						}
					}
				}
			}
		}

		/**
		 * Unserialize the values of items using Page Builder's function vc_param_group_parse_atts
		 */
		if(is_array($atts)){
			if(array_key_exists("items", $atts)){
				if( false !== $items){
					if(function_exists('vc_param_group_parse_atts') ){
						$items = vc_param_group_parse_atts( $atts['items'] );
					}
				}
			}
		}


		ob_start();

		?>
		<div class="evenz-pricingtable <?php if( $featured ){ ?> evenz-pricingtable__featured <?php } ?>">

			<div class="evenz-pricingtable__content evenz-card evenz-gradprimary <?php if( $featured ){ ?> evenz-gradaccent <?php } ?> evenz-negative">
				<?php  

				/**
				 * Special icon // Icons2Go plugin required
				 * ========================================= */
				if($icontype){
					?>
					<i class="evenz-gradicon evenz-pricingtable__icon t2gicons-icon <?php echo esc_attr($icontype); ?>"></i>
					<?php
				}

				/**
				 * Title and subtitle
				 * ========================================= */
				if( $title ){
					?><h4 class="evenz-capfont"><?php echo esc_html( $title ); ?></h4><?php
				}
				if( $subtitle ){
					?><h6><?php echo esc_html( $subtitle ); ?></h6><?php
				}
	 
				/**
				 * Price section
				 * ========================================= */
				if( $price ){
					?>
					<div class="evenz-pricingtable__pc">
						<?php if( $coin ){ ?><span class="evenz-pricingtable__coin"><?php echo esc_html( $coin ); ?></span><?php } ?>
						<?php if( $price ){ ?><var class="evenz-pricingtable__price"><?php echo esc_html( $price ); ?><?php if( $cents ){ ?><sup><?php echo esc_html( $cents ); ?></sup><?php if( $details ){ ?><sub class="evenz-itemmetas <?php if( $cents ){ ?>l<?php } ?>"><?php echo esc_html( $details ); ?></sub><?php } ?></var><?php } ?><?php } ?>
						
					</div>

					<?php  
				}

				/**
				 * Features
				 * ========================================= */
				if( is_array( $items ) ){
					if( count($items) > 0) {
						?>
						<ul>
							<?php  
							foreach( $items as $item ){
								if( array_key_exists( "text", $item ) ){
									if( !array_key_exists( "icon", $item ) ){
										$icon = false;
									} else {
										$icon = $item['icon'];
									}
									if( !array_key_exists( "status", $item ) ){
										$status = false;
									} else {
										$status = $item['status'];
										if($status){
											$status = 'active';
										} else {
											$status = 'inactive';
										}
									}
									?><li class="<?php echo esc_attr( $status ); ?>"><?php if( $icon ){ ?><i class="material-icons"><?php echo esc_html( $icon ); ?></i><?php } ?> <?php echo esc_html( $item["text"] ); ?></li><?php
								}
							}
							?>
						</ul>
						<?php
					}
				}
	 

				/**
				 * Button
				 * ========================================= */
				if( $btntext && $btnlink ){
					?>
					<a href="<?php echo esc_url( $btnlink ); ?>" class="evenz-btn evenz-btn-primary evenz-btn__full" target="<?php echo esc_attr( $target ); ?>"><?php echo esc_html( $btntext ); ?></a>
					<?php
				}



				/**
				 * Button
				 * ========================================= */
				if( $footertext ){
					?>
					<p class="evenz-itemmetas evenz-pricingtable__foot "><?php echo wp_kses_post( $footertext ); ?></p>
					<?php
				}


				/**
				 * Background
				 * ========================================= */
				if( $bg ){
					$image = wp_get_attachment_image_src($bg, 'full'); 
					?>
					<img class="evenz-pricingtable__bg <?php if( $bgo ){ echo 'evenz-bgo-'.esc_attr( $bgo ); } ?>" src="<?php echo esc_url($image[0]); ?>" alt="<?php esc_attr_e('Background', 'evenz'); ?>">
					<?php  
				}
				
				?>
			</div>

		</div>
		<?php
		return ob_get_clean();
	}
}
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-pricingtable","evenz_pricingtable");
}
/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_vc_pricingtable' );
if(!function_exists('evenz_vc_pricingtable')){
	function evenz_vc_pricingtable() {
	  	vc_map( 
	  		array(
				"name" => esc_html__( "Pricing table", "evenz" ),
				"base" => "qt-pricingtable",
				"icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/pricingtable.png' ),
				"description" => esc_html__( "Create a pricing table column", "evenz" ),
				"category" => esc_html__( "Theme shortcodes", "evenz"),
				"params" => array(


				 	// General
				 	// ============================================
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
						"type" 			=> "checkbox",
						"heading" 		=> esc_html__( "Featured", "evenz" ),
						"param_name" 	=> "featured",
					),
					array(
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Footer text", "evenz" ),
						"param_name" 	=> "footertext",
					),
					array(
						"type" 			=> "attach_image",
						"heading" 		=> esc_html__( "Background", "evenz" ),
						"param_name" 	=> "bg"
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Background opacity", "evenz" ),
						"param_name"	=> "bgo",
						'std'			=> false,
						'value' 		=> array( 
							esc_html__( "Full","evenz") 		=> false,
							esc_html__( "Half","evenz") 		=> "half",
							esc_html__( "Low","evenz") 		=> "low",
						)			
					),

			  		//	Price
			  		//	================================================
					array(
						'group' 		=> esc_html__( 'Price', 'evenz' ),
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Price", "evenz" ),
						"param_name" 	=> "price",
					),
					array(
						'group' 		=> esc_html__( 'Price', 'evenz' ),
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Price cents", "evenz" ),
						"param_name" 	=> "cents",
					),
					array(
						'group' 		=> esc_html__( 'Price', 'evenz' ),
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Coin symbol (eg. $)", "evenz" ),
						"param_name" 	=> "coin",
					),
					array(
						'group'		 	=> esc_html__( 'Price', 'evenz' ),
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Price details (for instance MONTHLY)", "evenz" ),
						"param_name" 	=> "details",
					),
					
					//	Button
			  		//	================================================
					array(
						'group' 		=> esc_html__( 'Button', 'evenz' ),
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Button text", "evenz" ),
						"param_name" 	=> "btntext",
					),
					array(
						'group' 		=> esc_html__( 'Button', 'evenz' ),
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Button link", "evenz" ),
						"param_name" 	=> "btnlink",
					),
					array(
						'group' 		=> esc_html__( 'Button', 'evenz' ),
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Button target", "evenz" ),
						"param_name" 	=> "target",
						'value' 		=> array( 
							esc_html__( "Same window","evenz") 			=> "",
							esc_html__( "New window","evenz") 			=> "_blank",
						)	
					),
					
					array(
						'group' 		=> esc_html__( 'Features', 'evenz' ),
						'type' 			=> 'param_group',
						'value' 		=> '',
						'param_name' 	=> 'items',
						'params' 		=> array(
							array(
								'type' 			=> 'textfield',
								'value' 		=> '',
								'heading' 		=> esc_html__('Features item', 'evenz'),
								'param_name' 	=> 'text',
							),
							array(
								"type" 			=> "dropdown",
								"heading" 		=> esc_html__( "Icon", "evenz" ),
								"param_name"	=> "icon",
								'std'			=> false,
								'value' 		=> array( 
									esc_html__( "Default","evenz") 			=> "",
									esc_html__( "check","evenz") 			=> "check",
									esc_html__( "close","evenz") 			=> "close",
									esc_html__( "add","evenz") 				=> "add",
									esc_html__( "chevron_right","evenz") 	=> "chevron_right",
								)			
							),
							array(
								"type" 			=> "dropdown",
								"heading" 		=> esc_html__( "Status", "evenz" ),
								'description' 	=> esc_html__('Is this feature included in the plan?', 'evenz'),
								"param_name"	=> "status",
								'std'			=> '1',
								'value' 		=> array( 
									esc_html__( "Included","evenz") 			=> "1",
									esc_html__( "Not included","evenz") 		=> "0",
								)			
							),
						)
					)
		 		)
	  		) 
		);
	}



}




/**
 * T2gIcons selector
 */







/**
 * Array of icon famimlis for dropdown
 */
if( !function_exists( 'evenz_t2gicons_familieslist' ) ) {
	function evenz_t2gicons_familieslist(){
		if( !function_exists( 't2gicons_families' )) {
			return array();
		}
		$t2gicons_families = t2gicons_families();
		$icons = array();
		foreach( $t2gicons_families as $family ){
			if( get_option($family['options_name']) == '1' ) {
				$icons[ $family[ 'label' ] ] = $family[ 'options_name' ];
			}
		}
		return $icons;
	}
}

if(!function_exists('evenz_add_font_picker_pricingtable') && function_exists( 't2gicons_families' )){

	add_action( 'vc_after_init', 'evenz_add_font_picker_pricingtable', 1200 );
	function evenz_add_font_picker_pricingtable() {
		$t2gicons_families = t2gicons_families();


		// Add icon family dropdown
		vc_add_param( 
			'qt-pricingtable', 
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon library', 'evenz' ),
				'value' => evenz_t2gicons_familieslist(),
				'weight' => 10,
				'admin_label' => true,
				'param_name' => 'type',
				"std"	=> '',
				'description' => esc_html__( 'Select icon library.', 'evenz' )
			)
		);


		foreach($t2gicons_families as $family){
			if(get_option($family['options_name']) == '1') {
				vc_add_param( 
					'qt-pricingtable', 
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'evenz' ),
						'param_name' => $family['options_name'],
						'value' => $family['classes'][0],
						'weight' => 1,
						'settings' => array(
							'emptyIcon' => false,
							'type' => $family['options_name'],
							'iconsPerPage' => 4000,
						),
						'dependency' => array(
							'element' => 'type',
							'value' => $family['options_name'],
						),
						'description' => esc_html__( 'Select icon from library.', 'evenz' )
					)
				);
			}
		}
	}
}
