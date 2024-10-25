<?php  
/**
 * Configuration for the Kirki Customizer.
 * @package Kirki
 */


Kirki::add_config( 'evenz_config', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod'
) );

if(!function_exists('evenz_kirki_configuration')){
function evenz_kirki_configuration( $config ) {
	return wp_parse_args( array (
		'disable_loader' => true
	), $config );
}}

add_filter( 'kirki/config', 'evenz_kirki_configuration' );

