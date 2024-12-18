<?php

if ( !defined( 'WP_DEBUG' ) ) {
	die( 'Direct access forbidden.' );
}


add_action( 'wp_enqueue_scripts', 'exhibz_child_enqueue_styles', 99 );
function exhibz_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_stylesheet_directory_uri() . '/style.css' );
 
}

function add_custom_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml'; // Example to allow SVG files
    return $mimes;
}
add_filter('upload_mimes', 'add_custom_mime_types');
