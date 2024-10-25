<?php  
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 *
*/
/**
 * 
 * Caption medium
 * =============================================
 */
if(!function_exists('evenz_herolist')){
	function evenz_herolist ($atts){
		extract( shortcode_atts( array(
			'items' => array(),
			'title' => '',
			'class' => '',
			'subtitle' => '',
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
		?>
		<div class="evenz-herolist <?php echo esc_html($class); ?>">
			<?php 
			if( is_array( $items ) ){
				foreach( $items as $item ){
					if( array_key_exists( "text", $item ) ){ 
						?>
						<p><span class="evenz-btn evenz-btn__r"><i class="material-icons">check</i></span> <?php echo esc_html( $item["text"] ); ?></p>
						<?php	
					}
				}
			}
			?>
		</div>
		<?php
		return ob_get_clean();
	}
}
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-herolist","evenz_herolist");
}
/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_vc_herolist' );
if(!function_exists('evenz_vc_herolist')){
	function evenz_vc_herolist() {
	  vc_map( array(
		 "name" 		=> esc_html__( "Hero List", "evenz" ),
		 "base" 		=> "qt-herolist",
		 "icon" 		=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/herolist.png' ),
		 "description" 	=> esc_html__( "Title with bullet list", "evenz" ),
		 "category" 	=> esc_html__( "Theme shortcodes", "evenz"),
		 "params" 		=> array(
			array(
				'type' 			=> 'param_group',
				'value' 		=> '',
				'param_name' 	=> 'items',
				'params' 		=> array(
					array(
						'type' 			=> 'textfield',
						'value' 		=> '',
						'heading' 		=> esc_html__('Enter item content', 'evenz'),
						'param_name' 	=> 'text',
					)
				)
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Class", "evenz" ),
				'description' 	=> esc_html__( "Add an extra class for CSS styling", "evenz" ),
				"param_name" 	=> "class",
				'value' 		=> '',
			)
		 )
	  ) );
	}
}
