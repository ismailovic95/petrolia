<?php
/**
 * @package t2gicons
 * @author Themes2Go
 * @textdomain t2gicons
 * Main frontend function
 */

if(!function_exists("t2gicons_shortcode")){
	function t2gicons_shortcode($atts) {

		extract( shortcode_atts( array(
				'icontype' => false,
				'type' => false,
				'size' => "200",
				'fontsize' => "100",
				'bgcolor' => "blue",
				'color' => "white",
				'shape' => "rsquare",
				'align' => "center",
				'link' => "",
				'classes' => '',
				'target' => "_blank"
		), $atts ) );
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

		if($fontsize > $size){
			$fontsize = $size;
		}
		ob_start();
		if($icontype){
			if($link && $link !== '') {
				?>
					<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_html($target); ?>">
				<?php  
				}
				?>
					<i class="t2gicons-icon t2gicon-size-<?php echo esc_attr($size); ?> t2gicon-fontsize-<?php echo esc_attr($fontsize); ?> t2gicon-bgcolor-<?php echo esc_attr($bgcolor); ?> t2gicon-color-<?php echo esc_attr($color); ?> t2gicon-shape-<?php echo esc_attr($shape); ?> t2gicon-align-<?php echo esc_attr($align); ?> <?php echo esc_attr($icontype); ?> <?php echo esc_attr($classes); ?>"></i>
				<?php  
				if($link && $link !== '') {
				?>
					</a>
				<?php  
			}
		}
		return ob_get_clean();
	}
}


add_shortcode("t2gicons","t2gicons_shortcode");