<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * caption
 *
 * Example:
 * [qt-section-caption title="My Title" size="xs|s|m|l|xl" alignment="center|left"]
*/


if(!function_exists( 'evenz_template_section_caption' )){
	function evenz_template_section_caption( $atts = array() ){
		extract( shortcode_atts( array(
			'intro' => false,
			'caption' => false,
			'class' => false,
			'subtitle' => false,
			'size'=>'m',
			// Effects
			'fx' => 'tokyo',
			'color1' => '#dedede',
			'color2' => '#999',
			'color3' => '#f00',
		), $atts ) );

		if(!$caption){
			return;
		}

		$id = preg_replace('/[0-9]+/', '', uniqid('evenztabs').'-'.evenz_slugify(esc_html($caption))); 

		$class = $class . ' evenz-section-caption--'.$size;

		// Output start
		ob_start();
		?>

		<div class="evenz-section-caption <?php  echo esc_attr( $class ); ?>">

			<?php  

			if( $intro ){
				?>
				<h6 class="evenz-caption evenz-gradtext"><span><?php echo esc_html( $intro ); ?></span></h6>
				<?php
			}

			if( $caption ){
				?>
				<h2 id="<?php echo esc_attr($id); ?>" class="evenz-center evenz-capfont evenz-<?php echo esc_attr($id); ?> evenz-txtfx-<?php echo esc_attr($fx); ?>-container evenz-textfx-wrap ">
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
				</h2>
				<?php
			}

			if( $subtitle ){
				?>
				<p><?php echo esc_html( $subtitle ); ?></p>
				<?php
			}
			?>
		</div>
		<?php 

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
	ttg_custom_shortcode("qt-section-caption","evenz_template_section_caption");
}

/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_template_section_caption_vc' );
if(!function_exists('evenz_template_section_caption_vc')){
function evenz_template_section_caption_vc() {
  vc_map( array(
	 "name" 			=> esc_html__( "Section caption", "evenz" ),
	 "base" 			=> "qt-section-caption",
	 "icon" 			=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/section-caption.png' ),
	 "description" 		=> esc_html__( "3 Lines caption with intro text", "evenz" ),
	 "category" 		=> esc_html__( "Theme shortcodes", "evenz"),
	 "params" 			=> array(
		array(
		   "type" 			=> "textfield",
		   "heading" 		=> esc_html__( "Intro text", "evenz" ),
		   "param_name" 	=> "intro",
		   'admin_label' 	=> true,
		   'value' 			=> ''
		),
		array(
		   "type" 			=> "textfield",
		   "heading" 		=> esc_html__( "Caption", "evenz" ),
		   "param_name" 	=> "caption",
		   'admin_label' 	=> true,
		   'value' 			=> ''
		),
		array(
		   "type" 			=> "dropdown",
		   "heading" 		=> esc_html__( "Size", "evenz" ),
		   "description" 	=> esc_html__( "Choose effect style", "evenz" ),
		   "param_name" 	=> "size",
		   "std" 			=> "default",
		   'value' 			=> array(
				esc_html__( "Default", "evenz")		=> "m",
				esc_html__( "Large", "evenz")		=> "l",		
				esc_html__( "Extra large", "evenz")	=> "xl",		
			),
		),
		array(
		   "type" 			=> "textfield",
		   "heading" 		=> esc_html__( "Subtitle", "evenz" ),
		   "param_name" 	=> "subtitle",
		   'value' 			=> ''
		),
		array(
			"group" 		=> esc_html__( "Intro effect", "evenz" ),
			"type" 			=> "colorpicker",
			"heading" 		=> esc_html__( "Color 1", "evenz" ),
			"param_name" 	=> "color1"
		),
		array(
			"group" 		=> esc_html__( "Intro effect", "evenz" ),
			"type" 			=> "colorpicker",
			"heading" 		=> esc_html__( "Color 2", "evenz" ),
			"param_name" 	=> "color2"
		),
		array(
			"group" 		=> esc_html__( "Intro effect", "evenz" ),
		   "type" 			=> "colorpicker",
		   "heading" 		=> esc_html__( "Color 3", "evenz" ),
		   "param_name" 	=> "color3"
		),
		array(
			"group" 		=> esc_html__( "Intro effect", "evenz" ),
		   "type" 			=> "dropdown",
		   "heading" 		=> esc_html__( "Effect style", "evenz" ),
		   "param_name" 	=> "fx",
		   "std" 			=> "large",
		   'value' 			=> array(
				esc_html__( "Tokyo", "evenz")	=> "tokyo",
				esc_html__( "London", "evenz")	=> "london",
				esc_html__( "Paris", "evenz")	=> "paris",
				esc_html__( "Ibiza", "evenz")	=> "ibiza",
				esc_html__( "New York", "evenz")	=> "newyork",
				esc_html__( "Oslo", "evenz")		=> "oslo",
			),
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Class", "evenz" ),
			"param_name" 	=> "class",
			'value' 		=> '',
			'description' 	=> esc_html__( "Add an extra class for CSS styling", "evenz" )
		)
	 )
  ) );
}}

