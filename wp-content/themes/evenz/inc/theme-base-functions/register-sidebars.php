<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/


/**
 * ======================================================
 * Register sidebars
 * ------------------------------------------------------
 * Creates 2 custom sidebars for the theme
 * ======================================================
 */
if(!function_exists( 'evenz_widgets_init' )){
	add_action( 'widgets_init', 'evenz_widgets_init' );
	function evenz_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Right Sidebar', "evenz" ),
			'id'            => 'evenz-right-sidebar',
			'before_widget' => '<li id="%1$s" class="evenz-widget evenz-col evenz-s12 evenz-m6 evenz-l12  %2$s">',
			'before_title'  => '<h6 class="evenz-widget__title evenz-caption evenz-caption__s evenz-anim" data-qtwaypoints-offset="30" data-qtwaypoints><span>',
			'after_title'   => '</span></h6>',
			'after_widget'  => '</li>'
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Off canvas Sidebar', "evenz" ),
			'id'            => 'evenz-offcanvas-sidebar',
			'before_widget' => '<li id="%1$s" class="evenz-widget evenz-col evenz-s12 evenz-m12 evenz-l12  %2$s">',
			'before_title'  => '<h6 class="evenz-widget__title evenz-caption evenz-caption__s evenz-anim" data-qtwaypoints-offset="30" data-qtwaypoints><span>',
			'after_title'   => '</span></h6>',
			'after_widget'  => '</li>'
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Event Sidebar', "evenz" ),
			'id'            => 'evenz-event-sidebar',
			'before_widget' => '<li id="%1$s" class="evenz-widget evenz-col evenz-s12 evenz-m12 evenz-l12  %2$s">',
			'before_title'  => '<h6 class=" evenz-caption evenz-caption__s evenz-anim" data-qtwaypoints-offset="30" data-qtwaypoints><span>',
			'after_title'   => '</span></h6>',
			'after_widget'  => '</li>'
		));
	}
}