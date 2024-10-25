<?php
/**
 * Related events
 * 
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

/**
 * 
 * =========================================
 * Extract and display the related posts for a specific post type
 * =========================================
 * 
 */

$related_posttype = get_post_type( get_the_id());
$related_taxonomy = esc_attr( evenz_get_type_taxonomy( $related_posttype ) );
$related_posts_per_page = 3;


/**
 *
 *  Basic query preparation
 *  
 */
$argsList = array(
	'post_type' => $related_posttype,
	'posts_per_page' => $related_posts_per_page,
	'orderby' => array(  'menu_order' => 'ASC' , 'post_date' => 'DESC'),
	'post_status' => 'publish',
	'post__not_in'=>array(get_the_id())
);


/**
 *
 *  Check if we have a taxonomy result and add to query
 *  
 */
$add_more = false;
if($related_posttype == 'event'){
	if(get_theme_mod( 'evenz_events_hideold')=='1'){
		$add_more = true;
	}
}
$terms = get_the_terms( get_the_id()  , $related_taxonomy, 'string');
$term_ids = false;
if( true == $add_more && !is_wp_error( $terms ) ) {
	if(is_array($terms)) {
		$term_ids = wp_list_pluck($terms,'term_id');
		if ($term_ids) {
			$argsList['tax_query'] =  array(
				array(
					'taxonomy' => $related_taxonomy,
					'field' => 'id',
					'terms' => $term_ids,
					'operator'=> 'IN'
				)
			);
		}
	}
}



/**
 *  For events we reorder by date and eventually hide past events
 */
if($related_posttype == 'evenz_event'){
	$argsList['orderby'] = 'meta_value';
	$argsList['order'] = 'ASC';
	$argsList['meta_key'] = 'evenz_date';
	if(get_theme_mod( 'kentha_events_hideold')=='1'){
		$argsList['meta_query'] = array(
		array(
			'key' => 'evenz_date',
			'value' => date('Y-m-d'),
			'compare' => '>=',
			'type' => 'date'
			 )
		);
	}
}



/**
 * 
 * Execute query
 * 
 */
$the_query = new WP_Query($argsList);

?>

<!-- ======================= RELATED SECTION ======================= -->
<?php if ( $the_query->have_posts() ) :

	?>
	<div class="evenz-related evenz-primary-light evenz-section">
		<div class="evenz-container">

			<h5 class="evenz-caption"><?php esc_html_e('Related events', 'evenz'); ?></h5>
			<hr class="evenz-spacer_m">
			<div class="evenz-row ">
				<?php 
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
					$post = $the_query->post;
					setup_postdata( $post );
					
					?>
					<div class="evenz-col evenz-s12 evenz-m6 evenz-l4">
						<?php get_template_part ('template-parts/post/post-evenz_event--card'); ?>
					</div>
					<?php
				endwhile;
				?>
			</div>
		</div>
	</div>
<?php  endif;
wp_reset_postdata();
