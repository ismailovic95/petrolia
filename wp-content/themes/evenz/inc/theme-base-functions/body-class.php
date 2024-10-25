<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.1.8
*/

/* Add theme body class
=============================================*/
	
if ( ! function_exists( 'evenz_body_class' ) ) {
	add_filter('body_class', 'evenz_body_class');
	function evenz_body_class($classes){
		$classes[] = 'evenz-body';
		$classes[] = 'evenz-unscrolled';

		

		
		if( get_theme_mod( 'evenz_header_transp') ){
			$classes[] = 'evenz-menu-transp';
		} else {
			$classes[] = 'evenz-menu-opaque';
		}


		if( get_theme_mod('evenz_header_sticky') ){
			$classes[] = 'evenz-menu-stick';
		} else {
			$classes[] = 'evenz-menu-scroll';
		}

		/**
		 * 
		 * =====================================
		 * Override global transparency for custom page options
		 * =====================================
		 * 
		 */
		if( is_single() || is_page() || is_singular() ){
			$custom_opacity = get_post_meta( get_the_ID(), 'evenz_menu_opacity', true ); 
			$key_to_remove = false;
			switch( $custom_opacity ){
				case 'evenz-menu-transp':
					$classes[] = 'evenz-menu-transp';
					$key_to_remove = array_search('evenz-menu-opaque', $classes);
					break;
				case 'evenz-menu-opaque':
					$classes[] = 'evenz-menu-opaque';
					$key_to_remove = array_search('evenz-menu-transp', $classes);
					break;
			}
			if( $key_to_remove !== null ) {
				unset( $classes[ $key_to_remove ] );
			}
		} 


		return $classes;
	}
}