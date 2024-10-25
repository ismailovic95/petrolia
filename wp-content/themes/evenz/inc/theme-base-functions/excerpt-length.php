<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/



if(!function_exists('evenz_get_excerpt_by_id')){
function evenz_get_excerpt_by_id($post_id, $excerpt_length = 30){
    $the_post = get_post($post_id); //Gets post ID
    $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
    $excerpt_length = 35; //Sets excerpt length by word count
    $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
    $words = explode(' ', $the_excerpt, $excerpt_length + 1);

    if(count($words) > $excerpt_length) :
        array_pop($words);
        array_push($words, '…');
        $the_excerpt = implode(' ', $words);
    endif;

    $the_excerpt = '<p>' . $the_excerpt . '</p>';

    return $the_excerpt;
}}


/**
 * ======================================================
 * Excerpt length
 * ------------------------------------------------------
 * Depending on the template we may require to change the 
 * excerpt length to different sizes for a nice effect.
 * ======================================================
 */
add_filter( 'excerpt_length', 'evenz_excerpt_length', 999 );
if(!function_exists('evenz_excerpt_length')){
function evenz_excerpt_length( $length ) {
	return 50;
}}
if(wp_is_mobile()){
	add_filter( 'excerpt_length', 'evenz_excerpt_length_20', 999 );
}


add_filter( 'the_excerpt', 'evenz_the_excerpt_scremove_now', 20 );

if(!function_exists('evenz_the_excerpt_scremove_now')){
function evenz_the_excerpt_scremove_now( $content ) {
	$content = str_replace('[&#8230;]', '...', $content);
	return strip_shortcodes( $content );
}}


if(!function_exists('evenz_excerpt_length_20')){
function evenz_excerpt_length_20( $length ) {
	return 20;
}}

if(!function_exists('evenz_excerpt_length_30')){
function evenz_excerpt_length_30( $length ) {
	return 30;
}}
if(!function_exists('evenz_excerpt_length_40')){
function evenz_excerpt_length_40( $length ) {
	return 40;
}}
if(!function_exists('evenz_excerpt_post_vertical')){
function evenz_excerpt_post_vertical( $length ) {
	return 55;
}}
if(!function_exists('evenz_excerpt_length_100')){
function evenz_excerpt_length_100( $length ) {
	return 100;
}}
if(!function_exists('evenz_excerpt_length_300')){
function evenz_excerpt_length_300( $length ) {
	return 300;
}}

if(!function_exists('evenz_trim_all_excerpt')){
function evenz_trim_all_excerpt($text) {
	// Creates an excerpt if needed; and shortens the manual excerpt as well
	global $post;
   $raw_excerpt = $text;
   if ( '' == $text ) {
	  $text = get_the_content('');
	  $text = strip_shortcodes( $text );
	  $text = apply_filters('the_content', $text);
	  $text = str_replace(']]>', ']]&gt;', $text);
   }

	$text = strip_tags($text);
	$excerpt_length = apply_filters('excerpt_length', 55);
	$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
	$text = wp_trim_words( $text, $excerpt_length, $excerpt_more ); 

	return apply_filters('evenz_trim_excerpt', $text, $raw_excerpt); 
}}
add_filter('get_the_excerpt', 'evenz_trim_all_excerpt');