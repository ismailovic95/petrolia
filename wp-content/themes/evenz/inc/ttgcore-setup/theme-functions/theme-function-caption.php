<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * caption
 *
 * Example:
 * [qt-caption title="My Title" size="xs|s|m|l|xl" alignment="center|left"]
*/


if(!function_exists( 'evenz_template_caption' )){
	function evenz_template_caption( $atts = array() ){

		ob_start();
	
		extract( shortcode_atts( array(
			'title' => esc_html__( 'Caption Here', 'evenz' ),
			'cssclass' => '',
			'size' => 'm',
			'alignment' => 'left',
			'anim' => false
			
		), $atts ) );

		// Output start
		
		$classes = array(  
			$cssclass,
			'evenz-caption__'.$size
		);

		switch ( $size ){
			case 'xs':
				$tag = 'h6';
				break;
			case 's':
				$tag = 'h5';
				break;
			case 'l':
				$tag = 'h3';
				break;
			case 'xl':
				$tag = 'h2';
				break;
			case 'xxl':
				$tag = 'h2';
				break;
			case 'xxxl':
				$tag = 'h2';
				$classes[] = 'evenz-h1';
				break;
			case 'm':
			default:
				$tag = 'h4';
		}


		if($alignment == 'alignright') {
			$classes[] = 'alignright';
		}
		if($alignment == 'alignleft') {
			$classes[] = 'alignleft';
		}

		if($alignment == 'center') {
			$classes[] = 'center evenz-center evenz-caption__c';
		}

		if( $anim ){
			$classes[] = 'evenz-anim';
		}

		//Use mb_substr to get the first character.
		$firstChar = mb_substr($title, 0, 1, "UTF-8");
		?>
		<div>
			<?php if ( $alignment == 'aligncenter' ) { ?><div class="aligncenter"> <?php } 
				echo '<'.esc_attr( $tag ).'  class="evenz-element-caption evenz-caption ' . esc_attr( implode( ' ', $classes ) ) . ' ' . ( ( $alignment == 'aligncenter' ) ? 'evenz-caption__c' : '' ) . ' " data-qtwaypoints-offset="30" data-qtwaypoints>' ;
				?>
				<span><?php echo esc_html($title); ?></span>
				<?php 
				echo '</' . esc_attr( $tag ) . '>';
			if ( $alignment == 'aligncenter' ) { ?></div><?php } ?>
		</div>
		<?php 
		// Output end
		$output = ob_get_clean();
		return $output;
		
	}
}

// Set TTG Core shortcode functionality
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-caption","evenz_template_caption");
}




/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_template_caption_vc' );
if(!function_exists('evenz_template_caption_vc')){
function evenz_template_caption_vc() {
  vc_map( array(
	 "name" => esc_html__( "Caption", "evenz" ),
	 "base" => "qt-caption",
	 "icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/caption.png' ),
	 "category" => esc_html__( "Theme shortcodes", "evenz"),
	 "params" => array(

		array(
		   "type" 			=> "textfield",
		   "heading" 		=> esc_html__( "Text", "evenz" ),
		   "param_name" 	=> "title",
		   'admin_label' 	=> true,
		   'value' 			=> ''
		),
		array(
		   "type" 			=> "checkbox",
		   "heading" 		=> esc_html__( "Animation", "evenz" ),
		   "param_name" 	=> "anim",
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Size", "evenz" ),
			"param_name"	=> "size",
			'admin_label' 	=> true,
			'std' 			=> 'm',
			'value' 		=> array(
					esc_html__( "XS", 'evenz' )		=> "xs",
					esc_html__( "S", 'evenz' ) 		=> "s",
					esc_html__( "M", 'evenz' ) 		=> "m",
					esc_html__( "L", 'evenz' ) 		=> "l", 
					esc_html__( "XL", 'evenz' ) 	=> 'xl',
					esc_html__( "XXL", 'evenz' ) 	=> 'xxl',
					esc_html__( "XXXL", 'evenz') 	=> 'xxxl'
				),
			"description" 	=> esc_html__( "Button size", "evenz" )
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Alignment", "evenz" ),
			"param_name"	=> "alignment",
			'admin_label' 	=> true,
			'std' 			=> 'left',
			'value' 		=> array(
					esc_html__("Left",'evenz') 		=> "left",
					esc_html__("Center",'evenz') 	=> "aligncenter",
				),
		),
		array(
		   "type" 			=> "textfield",
		   "heading" 		=> esc_html__( "Class", "evenz" ),
		   "param_name" 	=> "cssclass",
		   'value' 			=> '',
		   'description' 	=> esc_html__( "Add an extra class for CSS styling", "evenz" )
		)
	 )
  ) );
}}

