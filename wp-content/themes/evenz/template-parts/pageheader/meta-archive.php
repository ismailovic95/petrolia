<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

/**
 * This teplate displays results information below the title
 * in the archive pages as total results, current page and total 
 * pages for the current archive
 */
if( ! isset($wp_query) ){ global $wp_query; }

$max = $wp_query->max_num_pages;
$results = $wp_query->found_posts;

switch ($results){
	case 0:
		// Do nothing because in some archives there is an offset and may result "no results" even if there is one
		break;
	case 1:
		esc_html_e( "1 Result", 'evenz' );
		break;
	default:
		echo esc_html($results).' '; 
		esc_html_e( "Results", 'evenz' );
}

if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
} else {
   $paged = 1;
}


if( $max >= $paged ) {
	echo ' / ';
	esc_html_e ( 'Page', 'evenz' );
	echo ' '.esc_html( $paged ).' ';
	esc_html_e ( 'of', 'evenz' );
	echo ' '.esc_html( $max );
}