<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

/**
 * ======================================================
 * Google fonts
 * ------------------------------------------------------
 * Translators: If there are characters in your language that are not supported
 * by chosen font(s), translate this to 'off'. Do not translate into your own language.
 * ======================================================
 */

if(!function_exists('evenz_fonts_url')){
function evenz_fonts_url() {
	$font_url = '';
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'evenz' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Montserrat:600,700|Karla:400,700' ), "//fonts.googleapis.com/css" );
	}
	return $font_url;
}}



/**
 * ======================================================
 * CSS and Js loading
 * ------------------------------------------------------
 * Theme javascript and style inclusion
 * ======================================================
 */
if(!function_exists('evenz_styles_inclusion')){
	
	add_action( 'wp_enqueue_scripts', 'evenz_styles_inclusion', 500 );
	
	function evenz_styles_inclusion() {

		/**
		 * ===========================================================================================================
		 * CSS libraries
		 * ===========================================================================================================
		 */
		
		// Styles
		wp_enqueue_style( "qt-socicon", get_theme_file_uri( '/css/fonts/qt-socicon/styles.css' ), false, evenz_theme_version(), "all" );
		wp_enqueue_style( "material-icons", get_theme_file_uri( '/css/fonts/google-icons/material-icons.css' ), false, evenz_theme_version(), "all" );
		
		// if no customizer is active, load default fonts
		if( !function_exists( 'ttg_core_active' ) ){
			wp_enqueue_style( 'evenz-fonts', evenz_fonts_url(), array(), '1.0.0' );
			wp_enqueue_style( "evenz-typography", 	get_theme_file_uri( '/css/evenz-typography.css' ), false, evenz_theme_version(), "all" );
		}

		// Main.css
		// Optionally load a minified stylesheet
		if( '1' == get_theme_mod( 'evenz_advanced_mincss' ) ){
			wp_register_style( 'evenz-main', get_theme_file_uri( 'css/main-min.css' ) , false, evenz_theme_version(), "all" );
		} else {
			wp_register_style( 'evenz-main', get_theme_file_uri( 'css/main.css' ) , false, evenz_theme_version(), "all" );
		}
		wp_enqueue_style( 'evenz-main' );

		// Optional customizations styles
		if( function_exists( 'evenz_theme_customizations' ) ){
			wp_add_inline_style( 'evenz-main', evenz_theme_customizations() );
		}

		// Default root stylesheet
		wp_enqueue_style( 'evenz', get_stylesheet_uri() , false, evenz_theme_version(), "all" );

		// Optional WooCommerce stylesheet
		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_style( 'evenz-woocommerce', get_template_directory_uri().'/css/woocommerce.css', false, evenz_theme_version() , "all");
		}

		
		/**
		 * ===========================================================================================================
		 * Javascript libraries
		 * ===========================================================================================================
		 */

		$deps = array("jquery", "masonry", 'jquery-migrate' );


		// Modernizer
		wp_enqueue_script( 'modernizr', get_theme_file_uri( '/components/modernizr/modernizr-custom.js' ), $deps, '3.5.0', true ); $deps[] = 'modernizr';

		// Skip link focus fix
		wp_enqueue_script( 'skip-link-focus-fix', get_theme_file_uri( '/js/skip-link-focus-fix.js' ), array(), '20151215', true );

		// Owl Carousel
		wp_register_script( 'owl-carousel', get_theme_file_uri( 'components/owl-carousel/dist/owl.carousel-min.js' , __FILE__ ), array('jquery', 'masonry'),'2.3.2', true);$deps[] = 'owl-carousel';
		wp_enqueue_style( 'owl-carousel', get_theme_file_uri( 'components/owl-carousel/dist/assets/owl.carousel.min.css' , __FILE__ ), false, '2.3.2');
		
		// stellar.js for parallax fx
		wp_enqueue_script( 'stellar', get_theme_file_uri( '/components/stellar/jquery.stellar.min.js' ), $deps, '0.6.2', true ); $deps[] = 'stellar';

		// sticky sidebar script
		wp_enqueue_script( 'ttg-sticky-sidebar', get_template_directory_uri().'/components/ttg-stickysidebar/min/ttg-sticky-sidebar-min.js', $deps, evenz_theme_version(), true ); $deps[] = 'ttg-sticky-sidebar';
		
		// Main script of the QTT framework
		// Optionally load minified script
		if( '1' == get_theme_mod( 'evenz_advanced_minjs' ) ){
			wp_enqueue_script( 'qtt-main', get_theme_file_uri('/js/qtt-main-min.js'), $deps, evenz_theme_version(), true ); $deps[] = 'qtt-main';
		} else {
			wp_enqueue_script( 'qtt-main', get_theme_file_uri('/js/qtt-main.js'), $deps, evenz_theme_version(), true ); $deps[] = 'qtt-main';
		}
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
