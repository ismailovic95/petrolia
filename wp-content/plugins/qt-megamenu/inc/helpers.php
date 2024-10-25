<?php
/**
 * @package qt-megamenu
 */

/**
 * [function qt__megamenu_override_template_path]
 * Override path:
 * to override any template, place it in the theme into a subfolder called 
 * as the output of this function
 */
if (!function_exists('qt__megamenu_local_template_path')){
function qt__megamenu_local_template_path() {
	return qt__megamenu_plugin_dir_path().'templates/';
}}

/**
 * [function qt__megamenu_override_template_path]
 * Override path:
 * to override any template, place it in the theme into a subfolder called 
 * as the output of this function
 */
if (!function_exists('qt__megamenu_override_template_path')){
function qt__megamenu_override_template_path() {
	return 'qt-megamenu-templates/';
}}



/**
 * Add custom Page Builder CSS to the page
 * for custom backgrounds and other shortcode styling
 */

if(!function_exists('qt__megamenu_vc_customcss')){
	function qt__megamenu_vc_customcss(){
		if( !function_exists('qt__megamenu_posttype_name')){
			return;
		}
		$args = array(
			'post_type' 			=>  qt__megamenu_posttype_name(),
			'posts_per_page' 		=> -1,
			'post_status' 			=> 'publish',
			'paged' 				=> 1,
			'suppress_filters' 		=> false,
			'ignore_sticky_posts' 	=> 1,
			'orderby' 				=> array( 'orderby' => array( 'menu_order' => 'ASC' ) )
		);
		$wp_query = new WP_Query( $args );
		$shortcodes_custom_css_total = '';
		/**
		 * Display the mega menus
		 */
		if ( $wp_query->have_posts() ) { 
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
				$post = $wp_query->post;
				setup_postdata( $post );
				$id = get_the_ID();
				$shortcodes_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true ).' '.get_post_meta( $id, '_wpb_post_custom_css', true );
				if ( ! empty( $shortcodes_custom_css ) ) {
					$shortcodes_custom_css_total .= $shortcodes_custom_css; // add the Visual Composer custom css to the page
				   
				}
			endwhile;
		}	
		wp_reset_postdata();
		return $shortcodes_custom_css_total;
	}
}


		