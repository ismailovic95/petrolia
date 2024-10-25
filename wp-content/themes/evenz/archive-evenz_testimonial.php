<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Template Name: Archive testimonial
*/
get_header(); 
$paged = evenz_get_paged();

/**
 * Special query if I'm in a custom template for archives
 */
$is_page = false;



?>
<div id="evenz-pagecontent" class="evenz-pagecontent">
	<?php 
	/**
	 * ======================================================
	 * Archive header template
	 * ======================================================
	 */
	set_query_var( 'evenz_query_var_posttype' , 'evenz_member' ); 
	get_template_part( 'template-parts/pageheader/pageheader-archive' ); 
	remove_query_arg( 'evenz_query_var_posttype' ); 

	/**
	 *
	 *  This template can be used also as page template.
	 *  In this case we show the page content only if is a page and is page 1
	 * 
	 */

	get_template_part( 'template-parts/pageheader/customcontent' ); 


	/**
	 * 
	 * Custom archive query
	 * 
	 */
	if( is_page() ){
		$is_page = true;
		/**
		 * [$args Query arguments]
		 * @var array
		 */
		$args = array(
			'post_type' => 'evenz_testimonial',
			'post_status' => 'publish',
			'suppress_filters' => false,
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 12,
			'paged' => evenz_get_paged()
		);
		/**
		 * [$wp_query execution of the query]
		 * @var WP_Query
		 */
		$wp_query = new WP_Query( $args );
	}
	?>
	<div class="evenz-maincontent evenz-bg">
		<div class="evenz-section">
			<div class="evenz-container">
				<div id="evenz-loop" class="evenz-row">
					
						<?php 
						add_filter( 'excerpt_length', 'evenz_excerpt_length_30', 999 );

						/**
						 * Loop for archive and archive page
						 */
						if( $is_page ){
							if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
								$post = $wp_query->post;
								setup_postdata( $post );
								?>
									<div class="evenz-col evenz-col__post evenz-s12 evenz-m4 evenz-l3">
										<?php  
										get_template_part ('template-parts/post/post-evenz_testimonial');
										?>
									</div>
								<?php  
							endwhile; else: ?>
								<h3><?php esc_html_e("Sorry, nothing here","evenz"); ?></h3>
							<?php endif;
							wp_reset_postdata();
						} else {
							if ( have_posts() ) : while ( have_posts() ) : the_post();
								?>
									<div class="evenz-col evenz-col__post evenz-s12 evenz-m4 evenz-l3">
										<?php  
										get_template_part ('template-parts/post/post-evenz_testimonial');
										?>
									</div>
								<?php  
							endwhile; else: ?>
								<h3><?php esc_html_e("Sorry, nothing here","evenz"); ?></h3>
							<?php endif;
						}

						add_filter( 'excerpt_length', 'evenz_excerpt_length', 999 );
						
						/**
						 * Pagination
						 */
						get_template_part ('template-parts/pagination/part-pagination'); 
						?>

				</div>
				
			</div>
		</div>
	</div>
</div>
<?php 
get_footer();