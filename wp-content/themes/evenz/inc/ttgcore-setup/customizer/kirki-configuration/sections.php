<?php  
/**
 * Create sections using the WordPress Customizer API.
 * @package Kirki
 */
if(!function_exists('evenz_kirki_sections')){
function evenz_kirki_sections( $wp_customize ) {

	/**
	 * ============================================================
	 * Player settings with sub panel 
	 * ============================================================
	 */
	$wp_customize->add_panel( 'evenz_theme_settings', array(
		'title'       => esc_html__( 'Theme customization', "evenz" ),
		'priority'    => 60
	));

		/**
		 * sections of the panel
		 * ============================================================
		 */

		$wp_customize->add_section( 'evenz_colors_section', array(
			'panel'          => 'evenz_theme_settings',
			'title'       => esc_html__( 'Colors', "evenz" ),
			'priority'    => 1
		));
		$wp_customize->add_section( 'evenz_typo_section', array(
			'panel'          => 'evenz_theme_settings',
			'title'       => esc_html__( 'Typography', "evenz" ),
			'priority'    => 2,
			'description' => esc_html__( 'Set font families and settings', "evenz" ),
		));

		$wp_customize->add_section( 'evenz_buttons_section', array(
			'panel'          => 'evenz_theme_settings',
			'title'       => esc_html__( 'Buttons', "evenz" ),
			'priority'    => 3
		));
		$wp_customize->add_section( 'evenz_header_section', array(
			'panel'          => 'evenz_theme_settings',
			'title'       => esc_html__( 'Menu bar', "evenz" ),
			'priority'    => 3
		));
		$wp_customize->add_section( 'evenz_cta_section', array(
			'panel'          => 'evenz_theme_settings',
			'title'       => esc_html__( 'Call to action button', "evenz" ),
			'priority'    => 10
		));
		$wp_customize->add_section( 'evenz_secondary_header_section', array(
			'panel'          => 'evenz_theme_settings',
			'title'       => esc_html__( 'Secondary menu', "evenz" ),
			'priority'    => 10
		));
		$wp_customize->add_section( 'evenz_social_section', array(
			'panel'          => 'evenz_theme_settings',
			'title'       => esc_html__( 'Social networks', "evenz" ),
			'priority'    => 10,
			'description' => esc_html__( 'Social network profiles', "evenz" ),
		));
	

		$wp_customize->add_section( 'evenz_pageheader_section', array(
			'panel'          => 'evenz_theme_settings',
			'title'       => esc_html__( 'Header', "evenz" ),
			'priority'    => 40
		));

		$wp_customize->add_section( 'evenz_footer_section', array(
			'panel'          => 'evenz_theme_settings',
			'title'       => esc_html__( 'Footer', "evenz" ),
			'priority'    => 40,
			'description' => esc_html__( 'Footer text and functions', "evenz" ),
		));

		$wp_customize->add_section( 'evenz_blog_settings', array(
			'panel'          => 'evenz_theme_settings',
			'title'       => esc_html__( 'Blog settings', "evenz" ),
			'priority'    => 41
		));
		
		
		$wp_customize->add_section( 'evenz_events_settings', array(
			'panel'          => 'evenz_theme_settings',
			'title'       => esc_html__( 'Events settings', "evenz" ),
			'priority'    => 102
		));


		//This will appear in the WooCommerce section of the customizer
		if ( class_exists( 'WooCommerce' ) ) {
		$wp_customize->add_section( 'evenz_woocommerce_section', array(
			'panel'          => 'woocommerce',
			'title'       => esc_html__( 'Shop design settings', "evenz" ),
			'priority'    => 103,
			'description' => esc_html__( 'Customize shop design', "evenz" ),
		));
		}


		$wp_customize->add_section( 'evenz_advanced_settings', array(
			'panel'          => 'evenz_theme_settings',
			'title'       => esc_html__( 'Advanced', "evenz" ),
			'priority'    => 999
		));


}}
add_action( 'customize_register', 'evenz_kirki_sections' );
