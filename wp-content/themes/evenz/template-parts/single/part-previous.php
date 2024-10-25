<?php
/**
 * Previous post
 * 
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/



$in_same_term = false;
$taxonomy = 'category' ;
$excluded_terms = '';
if( function_exists( 'qt_series_custom_series_name' ) ){
	$related_taxonomy = qt_series_custom_series_name();
	$format = get_post_format();
	$terms = get_the_terms( $post->ID  , $related_taxonomy, 'string');
	if( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		if(is_array($terms)) {
			$in_same_term = true;
			$taxonomy = $related_taxonomy;
		}
	}
}

// Extract objects because we make custom HTML
$prev_post = get_adjacent_post( $in_same_term, $excluded_terms, true, $taxonomy );
if (!empty( $prev_post )): 
	$post = $prev_post;
	setup_postdata( $post );
	add_filter( 'excerpt_length', 'evenz_excerpt_length_30', 999 );
	?>
	<h3 class="evenz-caption evenz-caption__l evenz-anim"  data-qtwaypoints data-qtwaypoints-offset="30">
	<span><?php 
	if( get_post_format() === 'audio' ){
		esc_html_e( 'Previous episode', 'evenz' ); 
	} else {
		esc_html_e( 'Previous post', 'evenz' ); 
	}
	?></span>
	</h3>
	<?php 
	get_template_part( 'template-parts/post/post-horizontal' );
	wp_reset_postdata();
	// put excerpt back to normal
	add_filter( 'excerpt_length', 'evenz_excerpt_length', 999 );
endif;
wp_reset_postdata();