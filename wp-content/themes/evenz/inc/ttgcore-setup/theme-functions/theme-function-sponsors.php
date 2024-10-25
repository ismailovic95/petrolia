<?php
/*
Package: evenz
*/
if (!function_exists('evenz_short_sponsors')){
function evenz_short_sponsors($atts){
	extract( shortcode_atts( array(
		'items' => array(),
	), $atts ) );
	if(!function_exists('vc_param_group_parse_atts') ){
		return;
	}
	if(is_array($atts)){
		if(array_key_exists("items", $atts)){
			$items = vc_param_group_parse_atts( $atts['items'] );
		}
	}
	ob_start();
	if(count($items) > 0){ 
		?>
			<ul class="evenz-sponsors evenz-sponsors__i<?php echo esc_attr( count( $items ) ); ?>">
				<?php
					foreach($items as $item){
						$link = false;
						if( array_key_exists( "link", $item ) ){
							$link = $item['link'];
						}
						$target = false;
						if( array_key_exists( "target", $item ) ){
							$target = $item['target'];
						}
						$thumb = '';
						if( array_key_exists( "img", $item ) ){
							$image = wp_get_attachment_image_src( $item[ 'img' ], 'full'); 
							$thumb = $image[0];
						}
						?>
						<li class="evenz-glitchimg">

							<?php if($link){ ?><a href="<?php echo esc_url( $link ); ?>" <?php if($target){ ?>target="_blank"<?php } ?>><?php } ?>
								<img src="<?php echo esc_url($thumb); ?>" alt="<?php esc_attr_e('Sponsor', 'evenz'); ?>">
								<?php if($link){ ?><span class="evenz-hov"></span><?php } ?>
							<?php if($link){ ?></a><?php } ?>

						</li>
						<?php
					}
				?>
			</ul>
		<?php  
	}
	return ob_get_clean();
}}
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode('qt-sponsors', 'evenz_short_sponsors' );
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_short_sponsors_vc' );
if(!function_exists('evenz_short_sponsors_vc')){
function evenz_short_sponsors_vc() {
  vc_map( array(
	 "name" 	=> esc_html__( "Tile gallery", "evenz" ),
	 "base" 	=> "qt-sponsors",
	 "icon" 	=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/sponsors.png' ),
	 "category" => esc_html__( "Theme shortcodes", "evenz"),
	 "params" 	=> array(
	 	array(
			'type' => 'param_group',
			'value' => '',
			'param_name' => 'items',
			'params' => array(
				array(
					"type" 			=> "attach_image",
					"heading" 		=> esc_html__( "Images", "evenz" ),
					"param_name" 	=> "img"
				),
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__( "Link", "evenz" ),
					"param_name" 	=> "link",
				),
				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( "Open in new window", "evenz" ),
					"param_name" 	=> "target",
				),
			)
		),
		
	 )
  ) );
}}
