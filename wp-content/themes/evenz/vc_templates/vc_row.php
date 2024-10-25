<?php
/**
 * @package evenz, VC
 * @version 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$evenz_waves_color = $evenz_waves = $evenz_glitch = $evenz_fixedbg = $evenz_negative = $evenz_tilecolumn =  $evenz_container = $el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $css_animation = '';
$disable_element = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

$css_classes = array(
	'vc_row',
	'evenz-stickycont',// added for sticky sidebar feature
	'wpb_row',
	//deprecated
	'evenz-vc_row',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( vc_shortcode_custom_css_has_property( $css, array(
		'border',
		'background',
	) ) || $video_bg || $parallax
) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="evenz-intid-' . esc_attr( $el_id ) . '"'; // evenz
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );


$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;

	$css_classes[] = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

$parallax_image_src = false;

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
}



/**
 * evenz customization
 */

if($evenz_tilecolumn){
	$css_classes[] = 'evenz-tilecolumn';
}
if($evenz_negative){
	$css_classes[] = 'evenz-negative';
}


$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';




/**
 * Custom parallax
 */
$evenz_parallax_bg = '';
$pbg_attributes = array();
if( $parallax_image_src && !$has_video_bg ){
	$speed = '0.1';
	if( $parallax_speed ){
		$parallax_speed = $parallax_speed / 10;
		$speed = trim( $parallax_speed );
	}
	ob_start();
	?>
		<div class="evenz-bgimg evenz-bgimg__vc evenz-bgimg__parallax <?php if($evenz_glitch){ ?> evenz-glitchpicture <?php } ?>" data-evenz-parallax <?php if ($has_video_bg ) { ?> data-evenz-video-bg="<?php echo esc_attr( $video_bg_url ); ?>" <?php }  ?> >
			<img data-stellar-ratio="<?php echo esc_attr( $parallax_speed ); ?>" src="<?php echo esc_url(  $parallax_image_src ); ?>" alt="<?php esc_attr_e('Background', 'evenz'); ?>">
		</div>
	<?php
	$evenz_parallax_bg = ob_get_clean();
} else {
	if ( $has_video_bg && isset( $parallax_image_src ) ) {
		$wrapper_attributes[] = 'data-evenz-video-bg="' . esc_attr( $video_bg_url ) . '"';
		$vid = str_replace('https://www.youtube.com/watch?v=','',$parallax_image_src);
	}
}



/**
 * evenz custom html
 */
$outid = '';
if ( ! empty( $el_id ) ) {
	$outid = ' id="'.esc_attr($el_id).'" ';
}


$evenz_rowcontainer_classes = ['evenz-vc-row-container'];
if($evenz_waves){ 
	$evenz_rowcontainer_classes[] = 'evenz-vc-row-container--nooverflow';
}
$output .= '<div class="' . implode( ' ', $evenz_rowcontainer_classes ) . '" '.$outid.'>';
	$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
	
		$evenz_container_class = '';
		if($evenz_container) {
			if( $evenz_container == '2'){ 
				$evenz_container_class = 'evenz-container__l';
			} else if($evenz_container == '1') {
				$evenz_container_class = 'evenz-container';
			}
			
		}	
		$output .=	'<div class="'.esc_attr($evenz_container_class).' evenz-rowcontainer-vc">';
			$output .=	'<div class="evenz-rowcontent">';
				$output .= wpb_js_remove_wpautop( $content );
			$output .= '</div>'; // ."evenz-rowcontent
		$output .= '</div>'; // .evenz-rowcontainer-vc
	$output .= '</div>'; // $wrapper_attributes

	/** Parallax image  ====================================================== */
	$output .= $evenz_parallax_bg;

	/** Glitch  ====================================================== */
	if($evenz_glitch){ 
		$output .= '<div class="evenz-particles evenz-particles__auto"></div>';
	}

	/** Waves  ====================================================== */
	if($evenz_waves){ 

		/**
		 * ======================================================
		 * Waves
		 * ======================================================
		 */
		
		$waves_color_accent = get_theme_mod( 'evenz_accent', '#ff0062' ) ;
		$waves_color = get_theme_mod( 'evenz_background', '#f9f9f9' ) ;
		if(isset( $evenz_waves_color )){
			$waves_color = $evenz_waves_color;
		}
		if(!$waves_color || $waves_color==''){
			$waves_color = '#f9f9f9';
		}
		if(!$waves_color_accent || $waves_color_accent==''){
			$waves_color_accent = '#ff0062';
		}
		$output .='
		<div class="evenz-waterwave evenz-waterwave--l1">
		  	<canvas class="evenz-waterwave__canvas" data-waterwave-color="'.esc_attr( $waves_color_accent ).'" data-waterwave-speed="0.3"></canvas>
		</div>
		<div class="evenz-waterwave evenz-waterwave--l2">
		  	<canvas class="evenz-waterwave__canvas" data-waterwave-color="'.esc_attr( $waves_color ).'" data-waterwave-speed="0.5"></canvas>
		</div>';
	}
	
$output .= '</div>';// evenz_rowcontainer_classes // .evenz-vc-row-container
$output .= $after_output;

echo $output;