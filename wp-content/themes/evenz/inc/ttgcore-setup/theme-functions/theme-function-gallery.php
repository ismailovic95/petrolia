<?php
/*
Package: evenz
*/
if (!function_exists('evenz_short_gallery')){
function evenz_short_gallery($atts){
	extract( shortcode_atts( array(
		'images'    => false,
		'thumbsize' => 'thumbnail',
		'linksize'  => 'large'
	), $atts ) );
	if(!function_exists('vc_param_group_parse_atts') ){
		return;
	}
	if(is_array($atts)){
		if(array_key_exists("images", $atts)){
			$images = explode(',', $images);
		}
	}
	ob_start();
	if(count($images) > 0){ 
		?>
			<div class="evenz-gallery evenz-s<?php echo esc_attr($thumbsize); ?>">
				<?php
					foreach($images as $image){
						$thumb = wp_get_attachment_image_src($image, $thumbsize); 
						$link  = wp_get_attachment_image_src($image, $linksize);
						$thumb = $thumb[0];
						$link  = $link[0];
						?>
						<a href="<?php echo esc_url( $link ); ?>" class="evenz-gallery__item">
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title($image)); ?>">
						</a>
						<?php
					}
				?>
			</div>
		<?php  
	}
	return ob_get_clean();
}}
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode('qt-gallery', 'evenz_short_gallery' );
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_short_gallery_vc' );
if(!function_exists('evenz_short_gallery_vc')){
	function evenz_short_gallery_vc() {
	  vc_map( array(
		 "name" 	=> esc_html__( "Gallery", "evenz" ),
		 "base" 	=> "qt-gallery",
		 "icon" 	=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/gallery.png' ),
		 "category" => esc_html__( "Theme shortcodes", "evenz"),
		 "params" 	=> array(
			array(
				"type" 			=> "attach_images",
				"heading" 		=> esc_html__( "Images", "evenz" ),
				"param_name" 	=> "images"
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Image size", "evenz" ),
				"param_name" 	=> "thumbsize",
				"std" 			=> 'm',
				'value' 		=> array(
					esc_html__( "Squared small", "evenz")	=> 'evenz-squared-s',
					esc_html__( "Squared medium", "evenz")	=> 'evenz-squared-m',
					esc_html__( "Thumbnail", "evenz")		=> 'thumbnail',
					esc_html__( "Medium", "evenz")			=> 'medium',
					esc_html__( "Large", "evenz")			=> 'large',
				),
			   "description" 	=> esc_html__( "Choose the post template for the items", "evenz" )
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Linked image size", "evenz" ),
				"param_name" 	=> "linksize",
				"std" 			=> "large",
				'value' 		=> array(
					esc_html__( "Medium", "evenz")			=> 'medium',
					esc_html__( "Large", "evenz")			=> 'large',
					esc_html__( "Full", "evenz")				=> 'full'
				),
			   "description" => esc_html__( "Choose the post template for the items", "evenz" )
			)		
		 )
	  ) );
	}
}
