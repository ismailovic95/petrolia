<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage Evenz
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/* ADMIN CSS and Js loading
=============================================*/
if(!function_exists('evenz_tgm_admin_files_inclusion')){
function evenz_tgm_admin_files_inclusion() {
	wp_enqueue_style( 'evenz-tgm-admin', get_theme_file_uri('/inc/tgm-plugin-activation/css/evenz-tgm-admin.css' ), false, '1.0.0' );
}}
add_action( 'admin_enqueue_scripts', 'evenz_tgm_admin_files_inclusion', 999999 );