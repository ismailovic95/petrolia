<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * caption
 *
*/

if(!function_exists( 'evenz_template_3d_header' )){
	function evenz_template_3d_header( $atts = array(), $content = false ){


		extract( shortcode_atts( array(
			'intro' => false,
			'include_by_id' => false,
			'caption' => false,
			'bgimg' => false,
			'bgimg2'=> false,
			'class' => false,
			'subtitle' => false,
			'link'=>false,
			'linktext'=>false,
			'bordercolor' => false,
			'bgcolor' => false,
			// Effects
			'fx' => 'tokyo',
			'color1' => '#dedede',
			'color2' => '#999',
			'color3' => '#f00',
		), $atts ) );


	
		$id = '3dheader--'.preg_replace('/[0-9]+/', '', uniqid('evenz3d').'-'.evenz_slugify(esc_html($caption))); 
		$cssselector = 'evenz-'.$id;
		

		// Output start
		ob_start();
		?>

		<div id="<?php echo esc_attr($id); ?>" class="evenz-3dheader <?php  echo esc_attr( $class ); ?> <?php  echo esc_attr( $cssselector ); ?>">
			<div class="evenz-3dheader__wrapper">
		
				<?php 
	 			/**
				 * bg
				 * ========================================= */
				if( $bgimg ){
					$image = wp_get_attachment_image_src($bgimg, 'full'); 
					?>
					<div class="evenz-3dheader__bg evenz-3dheader__bg--1"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php esc_attr_e('Background','evenz'); ?>"></div>
					<?php  
				}
				/**
				 * bg
				 * ========================================= */
				if( $bgimg2 ){
					$image = wp_get_attachment_image_src($bgimg2, 'full'); 
					?>
					<div class="evenz-3dheader__bg evenz-3dheader__bg--2"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php esc_attr_e('Background','evenz'); ?>"></div>
					<?php  
				}

				?>
				
				<div class="evenz-3dheader__contents">
					<div class="evenz-3dheader__contents__caption">
						<div class="evenz-section-caption evenz-section-caption--l">
							<div class="evenz-3dheader__firstlevel">
								<?php  

								if( $intro ){
									?>
									<h6 class="evenz-caption evenz-gradtext"><span><?php echo esc_html( $intro ); ?></span></h6>
									<?php
								}

								if( $caption ){
									?>
									<h1  class="evenz-center evenz-3dheader__top evenz-capfont evenz-<?php echo esc_attr($id); ?> evenz-txtfx-<?php echo esc_attr($fx); ?>-container evenz-textfx-wrap ">
										<?php  
										switch($fx){
											case "paris": 
												$style = '
												.evenz-'.$id.' .evenz-txtfx--paris { color: '.esc_attr($color1).'}
												.evenz-'.$id.' .evenz-txtfx--paris span::before, .evenz-'.$id.' .evenz-txtfx--paris span::after { color: '.esc_attr($color2).'}
												.evenz-'.$id.' .evenz-txtfx--paris::before, .evenz-'.$id.' .evenz-txtfx--paris::after { background: '.esc_attr($color3).'}
												';
												$length = strlen($caption);
												if ($length > 2){
													$splitted = str_split($caption, round($length / 2));
													?>
													<span class="evenz-txtfx evenz-txtfx--paris" data-qtwaypoints-offset="50" data-qtwaypoints ><span data-letters-l="<?php echo esc_html($splitted[0]); ?>" data-letters-r="<?php echo esc_html($splitted[1]); ?>"><?php echo esc_html($caption); ?></span></span>
													<?php
												} else {
													esc_html_e("Warning: insert at least 2 letters for this effect", 'evenz');
												}
												break;
											case "oslo": 
												$length = strlen($caption);
												$splitted = str_split($caption, 1);
												$style = '
												
												.evenz-'.$id.' .evenz-txtfx--oslo, .evenz-'.$id.' .evenz-'.$id.' .evenz-txtfx--oslo::before { color: '.esc_attr($color1).'}
												.evenz-'.$id.' .evenz-txtfx--oslo.evenz-active span  { color: '.esc_attr($color2).'}
												.evenz-'.$id.' .evenz-txtfx--oslo::before { border-color: '.esc_attr($color3).'}
												';
												?>
												<span class="evenz-txtfx evenz-txtfx--oslo" data-qtwaypoints-offset="50" data-qtwaypoints >
													<?php
													foreach($splitted as $letter){
														?><span><?php echo esc_html($letter); ?></span><?php 
													}
													?>
												</span>
												<?php
												break;
											case "ibiza": 
												$style = '
												
												.evenz-'.$id.' .evenz-txtfx--ibiza, .evenz-'.$id.' .evenz-txtfx--ibiza.evenz-active { color: '.esc_attr($color1).'}
												.evenz-'.$id.' .evenz-txtfx--ibiza span::before { color: '.esc_attr($color2).'}
												.evenz-'.$id.' .evenz-txtfx--ibiza::after { background: '.esc_attr($color3).'}
												';
												?>
												<span class="evenz-txtfx evenz-txtfx--ibiza" data-qtwaypoints-offset="50" data-qtwaypoints ><span  data-letters="<?php echo esc_html($caption); ?>"><?php echo esc_html($caption); ?></span></span>
												<?php
												break;
											case "newyork": 
												$style = '
												
												.evenz-'.$id.' .evenz-txtfx--newyork { color: '.esc_attr($color1).'}
												.evenz-'.$id.' .evenz-txtfx--newyork span::before { color: '.esc_attr($color2).'}
												.evenz-'.$id.' .evenz-txtfx--newyork::before { background: '.esc_attr($color3).'}
												';
												?>					
												<span class="evenz-txtfx evenz-txtfx--newyork" data-qtwaypoints-offset="50" data-qtwaypoints ><?php echo esc_html($caption); ?><span data-letters="<?php echo esc_html($caption); ?>"></span><span data-letters="<?php echo esc_html($caption); ?>"></span></span>
												<?php 
												break;
											case "london": 
												$style = '
												
												.evenz-'.$id.' .evenz-txtfx--london { color: '.esc_attr($color1).'}
												.evenz-'.$id.' .evenz-txtfx--london.evenz-active { color: '.esc_attr($color2).'}
												.evenz-'.$id.' .evenz-txtfx--london::before { background: '.esc_attr($color3).'}
												';
												?>
												<span class="evenz-txtfx evenz-txtfx--<?php echo esc_attr($fx); ?>" data-qtwaypoints-offset="50" data-qtwaypoints  data-letters="<?php echo esc_html($caption); ?>"><?php echo esc_html($caption); ?></span>
												<?php
												break;
											case "tokyo":
											default:
												$style = '
												
												.evenz-'.$id.' .evenz-txtfx--tokyo { color: '.esc_attr($color1).'}
												.evenz-'.$id.' , .evenz-'.$id.' .evenz-txtfx--tokyo::before { color: '.esc_attr($color2).'}
												.evenz-'.$id.' .evenz-txtfx--tokyo::after { background: '.esc_attr($color3).'}
												';
												?>
												<span class="evenz-txtfx evenz-txtfx--<?php echo esc_attr($fx); ?>" data-qtwaypoints-offset="50" data-qtwaypoints  data-letters="<?php echo esc_html($caption); ?>"><?php echo esc_html($caption); ?></span>
												<?php
												break;
										}
										?>
									</h1>
									<?php
								}

								if( $content ){
									$content = apply_filters( 'the_content', $content );
	    							$content = str_replace( ']]>', ']]&gt;', $content );
									?>
									<div class="evenz-3dheader__custom"><?php 
									echo wp_kses_post( $content );
									 ?></div>
									<?php
								}

								/**
								 * event countdown
								 */
								if( $include_by_id && shortcode_exists( 'qt-countdown' ) ){
									?><div class="evenz-3dheader__cd"><?php 
										echo do_shortcode( '[qt-countdown labels="full" size="7" align="center" include_by_id="'.$include_by_id.'" ]' );
									?></div><?php  
								}

								if( $subtitle ){
									?>
									<p class="evenz-3dheader__sb"><?php echo esc_html( $subtitle ); ?></p>
									<?php
								}

								if($link && $linktext){
									?>
									<p class="evenz-spacer-xs evenz-3dheader__link">
										<a class="evenz-btn evenz-btn__l evenz-btn-primary" href="<?php echo esc_attr($link); /* We have to use esc_attr because it can be also # */ ?>"><?php echo esc_html( $linktext ); ?></a>
									</p>
									<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 

		if($bordercolor){
			$style .= ' .testingsel, .evenz-'.$id.' .evenz-section-caption { border-color: '.esc_attr($bordercolor).';} ';
		}
		if($bgcolor){
			$style .= ' .evenz-'.$id.' .evenz-section-caption { background-color: '.esc_attr($bgcolor).';} ';
		}
		
		/**
		 * This one part will prepare the custom styles for javascript to add them to the head
		 */
		?>
		<div data-evenz-customstyles="<?php echo wp_strip_all_tags( $style ); ?>"></div>
		<?php 

		// Output end
		$output = ob_get_clean();
		return $output;
		
	}
}

// Set TTG Core shortcode functionality
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-3d-header","evenz_template_3d_header");
}




/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_template_3d_header_vc' );
if(!function_exists('evenz_template_3d_header_vc')){
function evenz_template_3d_header_vc() {
  vc_map( array(
	 "name" => esc_html__( "3D Header", "evenz" ),
	 "base" => "qt-3d-header",
	 "icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/section-caption.png' ),
	 "category" => esc_html__( "Theme shortcodes", "evenz"),
	 "params" => array(
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Intro text", "evenz" ),
		   "param_name" => "intro",
		   'admin_label' => true,
		   'value' => ''
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Caption", "evenz" ),
		   "param_name" => "caption",
		   'admin_label' => true,
		   'value' => ''
		),
		array(
		   "type" => "textarea_html",
		   "heading" => esc_html__( "Free text", "evenz" ),
		   "param_name" => "content",
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Subtitle", "evenz" ),
		   "param_name" => "subtitle",
		   'value' => ''
		),

		array(
			'type' 			=> 'autocomplete',
			'heading' 		=> esc_html__( 'Event countdown', 'evenz'),
			'param_name' 	=> 'include_by_id',
			'settings'		=> array( 
				'values' 		=> evenz_autocomplete('evenz_event') ,
				'multiple'       => false,
				'sortable'       => false,
          		'min_length'     => 1,
          		'groups'         => false,  // In UI show results grouped by groups
          		'unique_values'  => true,  // In UI show results except selected. NB! You should manually check values in backend
          		'display_inline' => true, // In UI show results inline view),
			),
			'dependency' => array(
				'element' => 'post_type',
				'value' => array( 'ids' ),
			),
		),


		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Link", "evenz" ),
		   "param_name" => "link",
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Link text", "evenz" ),
		   "param_name" => "linktext",
		),


		array(
			"group" 	=> esc_html__( "Intro effect", "evenz" ),
		   "type" => "colorpicker",
		   "heading" => esc_html__( "Color 1", "evenz" ),
		   "param_name" => "color1"
		),
		array(
			"group" 	=> esc_html__( "Intro effect", "evenz" ),
		   "type" => "colorpicker",
		   "heading" => esc_html__( "Color 2", "evenz" ),
		   "param_name" => "color2"
		),
		array(
			"group" 	=> esc_html__( "Intro effect", "evenz" ),
		   "type" => "colorpicker",
		   "heading" => esc_html__( "Color 3", "evenz" ),
		   "param_name" => "color3"
		),
		array(
			"group" 	=> esc_html__( "Intro effect", "evenz" ),
		   "type" => "dropdown",
		   "heading" => esc_html__( "Effect", "evenz" ),
		   "param_name" => "fx",
		   "std" => "large",
		   'value' => array(
				esc_html__( "Tokyo", "evenz")	=> "tokyo",
				esc_html__( "London", "evenz")	=> "london",
				esc_html__( "Paris", "evenz")	=> "paris",
				esc_html__( "Ibiza", "evenz")	=> "ibiza",
				esc_html__( "New York", "evenz")	=> "newyork",
				esc_html__( "Oslo", "evenz")		=> "oslo",
				
			),
		   "description" => esc_html__( "Choose effect style", "evenz" )
		),
		array(
			"type" 			=> "attach_image",
			"heading" 		=> esc_html__( "Background image", "evenz" ),
			"param_name" 	=> "bgimg"
		),
		array(
			"type" 			=> "attach_image",
			"heading" 		=> esc_html__( "Background image", "evenz" ),
			"param_name" 	=> "bgimg2"
		),

		array(
		   "type" => "colorpicker",
		   "heading" => esc_html__( "Border color", "evenz" ),
		   "param_name" => "bordercolor"
		),
			array(
		   "type" => "colorpicker",
		   "heading" => esc_html__( "Background color", "evenz" ),
		   "param_name" => "bgcolor"
		),

		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Class", "evenz" ),
			"param_name" 	=> "class",
			'value' 		=> '',
			'description' => esc_html__( "Add an extra class for CSS styling", "evenz" )
		)
	 )
  ) );
}}

