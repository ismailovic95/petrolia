<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage qtt
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/* ADMIN CSS and Js loading
=============================================*/
if(!function_exists('qtt_tgm_admin_files_inclusion')){
function qtt_tgm_admin_files_inclusion() {
	wp_enqueue_style( 'qtt-tgm-admin', get_theme_file_uri('/inc/tgm-plugin-activation/css/qtt-tgm-admin.css' ), false, '1.0.1' );
}}
add_action( 'admin_enqueue_scripts', 'qtt_tgm_admin_files_inclusion', 999999 );