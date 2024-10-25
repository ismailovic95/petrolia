<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

/**
 * ==============================================================
 * Special evenz navigation links:
 * --------------------------------------------------------------
 * if is a podcast and is within a serie, the next and previous will be taken from that same serie,
 * otherwise normal previous chronological post.
 * ==============================================================
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
$prev_post_obj = get_adjacent_post( $in_same_term, $excluded_terms, true, $taxonomy );
$next_post_obj = get_adjacent_post( $in_same_term, $excluded_terms, false, $taxonomy );


// Previous
$prev_post_ID   	= isset( $prev_post_obj->ID ) ? $prev_post_obj->ID : '';
$prev_post_link     = get_permalink( $prev_post_ID );
$prev_post_title    = get_the_title( $prev_post_ID ); // equals "»"

// Next
$next_post_ID   	= isset( $next_post_obj->ID ) ? $next_post_obj->ID : '';
$next_post_link     = get_permalink( $next_post_ID );
$next_post_title    = get_the_title( $next_post_ID ); // equals "»"

?>
<div class="evenz-pageheader__nav-post">
	<div class="evenz-pageheader__nav-container">
		<a href="<?php echo esc_url( $prev_post_link ); ?>" rel="next" class="evenz-prev prev">
		    <span class="evenz-arr"><i class="material-icons">trending_flat</i> <?php esc_html_e('Prev', 'evenz'); ?></span>
		    <span class="evenz-tit"><?php echo esc_html( $prev_post_title ); ?></span>
		</a>
		<a href="<?php echo esc_url( $next_post_link ); ?>" rel="next" class="evenz-next next">
		    <span class="evenz-tit"><?php echo esc_html( $next_post_title ); ?></span>
		    <span class="evenz-arr"><?php esc_html_e('Next', 'evenz'); ?> <i class="material-icons">trending_flat</i></span>
		</a>
	</div>
</div>