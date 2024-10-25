<?php
/**
 * Related posts
 * 
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

$postid = get_the_id();

/**
 *
 *  Basic query preparation
 *  
 */
$previous_post = get_previous_post();
if($previous_post && !is_wp_error( $previous_post )){
	$argsList = array(
		'post_type' => 'post',
		'posts_per_page' => 2,
		'ignore_sticky_posts' => 1,
		'orderby' => array(  'menu_order' => 'ASC' ,    'post_date' => 'DESC'),
		'post_status' => 'publish',
		'post__not_in'=>array( $postid, $previous_post->ID )
	);

	/**
	 *
	 *  If this post is in a serie we try to get the posts
	 *  in the same serie, otherwise in same category.
	 *  
	 */

	$term_ids = false;
	$terms = get_the_terms( $postid  , 'category', 'string');
	$argsList = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'suppress_filters' => false,
		'paged' => 1,
		'posts_per_page' => 2
	);
	// Add taxonomy query arguments
	if( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		if(is_array($terms)) {
			$term_ids = wp_list_pluck($terms,'term_id');
			if ($term_ids) {
				$argsList['tax_query'] =  array(
					array(
						'taxonomy' => 'category',
						'field' => 'id',
						'terms' => $term_ids,
						'operator'=> 'IN'
					)
				);
			}
		}
	}


	/**
	 * 
	 * Execute query
	 * 
	 */
	$the_query = new WP_Query($argsList);

	if ( $the_query->have_posts() ) :

		if( $the_query->post_count > 0 ){
			?>
			<hr class="evenz-spacer-m">
			<h3 class="evenz-caption evenz-caption__l evenz-anim"  data-qtwaypoints data-qtwaypoints-offset="30">
				<span><?php 
				if( get_post_format() === 'audio' ){
					esc_html_e( 'Similar episodes', 'evenz' ); 
				} else {
					esc_html_e( 'Similar posts', 'evenz' ); 
				}
				?></span>
			</h3>
			<div class="evenz-row">
				<?php 
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
					?>
					<div class="evenz-col  evenz-s12 evenz-m6  evenz-l6">
						<?php
						setup_postdata( $post ); 
						get_template_part( 'template-parts/post/post-vertical' );
						wp_reset_postdata();
						?>
					</div>
					<?php
				endwhile;
				?>
			</div>
			<?php  
		}
	endif;
}
wp_reset_postdata();
