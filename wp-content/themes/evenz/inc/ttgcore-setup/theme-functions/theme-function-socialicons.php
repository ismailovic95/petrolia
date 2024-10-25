<?php  
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Social Icons
 *
 * Example:
 * [qt-socialicons text="" link="" icon="" style="" alignment="" class=""]
*/


if(!function_exists('evenz_template_socialicons_shortcode')){
	function evenz_template_socialicons_shortcode ($atts){
		extract( shortcode_atts( array(
			'text' 		=> '',
			'link' 		=> '#',
			'size' 		=> 'qt-btn-s',
			'target' 	=> '',
			'style' 	=> '',
			'alignment' => '',
			'icon' 		=> 'android',
			'class' 	=> ''
		), $atts ) );

		if(!function_exists('vc_param_group_parse_atts') ){
			return;
		}

		if($size === 'qt-btn-xxl') {
			$class 	= $class.' qt-big-icons';
			$size 	= 'qt-btn-xl';
		}

		ob_start();
		if ( $alignment == 'aligncenter' ) { ?><p class="aligncenter"> <?php } 
			?>
			<a href="<?php echo esc_url($link); ?>" <?php if($target == "_blank"){ ?> target="_blank" <?php } ?> class="evenz-btn evenz-short-socialicon <?php  echo esc_attr($class.' '.$style.' '.$alignment); ?> <?php if($text !='') { echo 'evenz-icon__l'; } else { echo 'evenz-btn__r'; } ?>">
			<i class="qt-socicon-<?php echo esc_attr($icon); ?> qt-socialicon"></i><?php if($text) { echo ' '.esc_html($text); } ?></a>
			<?php
		if ( $alignment == 'aligncenter' ) { ?></p><?php } 
		return ob_get_clean();
	}
}
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-socialicons","evenz_template_socialicons_shortcode");
}




/* QT Socicons list [This is a configuration list used by Theme Core plugin]
=============================================*/
if(!function_exists('evenz_template_qt_socicons_array')){
function evenz_template_qt_socicons_array(){
	return array(
		'android' 			=> esc_html__( 'Android', 'evenz' ),
		'amazon' 			=> esc_html__( 'Amazon', 'evenz' ),
		'beatport' 			=> esc_html__( 'Beatport', 'evenz' ),
		'blogger' 			=> esc_html__( 'Blogger', 'evenz' ),
		'facebook' 			=> esc_html__( 'Facebook', 'evenz' ),
		'flickr' 			=> esc_html__( 'Flickr', 'evenz' ),
		'googleplus' 		=> esc_html__( 'Googleplus', 'evenz' ),
		'instagram' 		=> esc_html__( 'Instagram', 'evenz' ),
		'itunes' 			=> esc_html__( 'Itunes', 'evenz' ),
		'juno' 				=> esc_html__( 'Juno', 'evenz' ),
		'kuvo' 				=> esc_html__( 'Kuvo', 'evenz' ),
		'linkedin' 			=> esc_html__( 'Linkedin', 'evenz' ),
		'trackitdown' 		=> esc_html__( 'Trackitdown', 'evenz' ),
		'spotify' 			=> esc_html__( 'Spotify', 'evenz' ),
		'soundcloud' 		=> esc_html__( 'Soundcloud', 'evenz' ),
		'snapchat' 			=> esc_html__( 'Snapchat', 'evenz' ),
		'skype' 			=> esc_html__( 'Skype', 'evenz' ),
		'reverbnation' 		=> esc_html__( 'Reverbnation', 'evenz' ),
		'residentadvisor' 	=> esc_html__( 'Resident Advisor', 'evenz' ),
		'pinterest' 		=> esc_html__( 'Pinterest', 'evenz' ),
		'myspace' 			=> esc_html__( 'Myspace', 'evenz' ),
		'mixcloud' 			=> esc_html__( 'Mixcloud', 'evenz' ),
		'rss' 				=> esc_html__( 'RSS', 'evenz' ),
		'twitter' 			=> esc_html__( 'Twitter', 'evenz' ),
		'vimeo' 			=> esc_html__( 'Vimeo', 'evenz' ),
		'vk' 				=> esc_html__( 'VK.com', 'evenz' ),
		'youtube' 			=> esc_html__( 'YouTube', 'evenz' ),
		'whatsapp' 			=> esc_html__( 'Whatsapp', 'evenz' ),
	);
}}

/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_template_socialicons_shortcode_vc' );
if(!function_exists('evenz_template_socialicons_shortcode_vc')){
function evenz_template_socialicons_shortcode_vc() {
  vc_map( array(
	"name" 			=> esc_html__( "Social icons", "evenz" ),
	"base" 			=> "qt-socialicons",
	"icon" 			=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/socialicons.png' ),
	"description" 	=> esc_html__( "Add a social link", "evenz" ),
	 "category" 	=> esc_html__( "Theme shortcodes", "evenz"),
	"params" 		=> array(
			array(
				'type' 			=> 'textfield',
				'value' 		=> '',
				'heading' 		=> esc_html__( 'Text', "evenz" ),
				'param_name'	=> 'text',
			),
			array(
				'type' 			=> 'textfield',
				'value' 		=> '',
				'heading'		=> esc_html__( "Link", "evenz" ),
				'param_name'	=> 'link',
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Link target", "evenz" ),
				"param_name"	=> "target",
				'value' 		=> array( 
					esc_html__( "Same window","evenz") 	=> "",
					esc_html__( "New window","evenz") 	=> "_blank",
					)			
				),

			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Icon", "evenz" ),
				"param_name"	=> "icon",
				"std"			=> "android",
				'value' 		=>  array_flip(evenz_template_qt_socicons_array() ),
				'admin_label' 	=> true,
				"description" 	=> esc_html__( "Choose social icon", "evenz" )
			),

			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Button style", "evenz" ),
				"param_name"	=> "style",
				'value' 		=> array( 
					esc_html__( "Default","evenz") 		=> "",
					esc_html__( "Primary","evenz") 		=> "evenz-btn-primary",
					esc_html__( "White","evenz") 		=> "evenz-btn__white",
					esc_html__( "Transparent","evenz") 	=> "evenz-btn__txt",
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
				'description' 	=> esc_html__( "Add an extra class for CSS styling", "evenz" ),
				"param_name" 	=> "class",
				'value' 		=> '',
			)
		)
  	));
}}
