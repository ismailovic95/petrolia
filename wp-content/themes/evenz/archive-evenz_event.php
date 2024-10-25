<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Template Name: Archive events
 */
get_header();
$paged = evenz_get_paged();

$is_page = false;


?>
<div id="evenz-pagecontent" class="evenz-pagecontent">
	<?php 
	/**
	 * ======================================================
	 * Archive header template
	 * ======================================================
	 */
	set_query_var( 'evenz_query_var_posttype' , 'evenz_event' ); 
	get_template_part( 'template-parts/pageheader/pageheader-archive' ); 
	remove_query_arg( 'evenz_query_var_posttype' ); 

	/**
	 *
	 *  This template can be used also as page template.
	 *  In this case we show the page content only if is a page and is page 1
	 * 
	 */

	get_template_part( 'template-parts/pageheader/customcontent' ); 

	if( is_page() ){

		$is_page = true;
		/**
		 * [$args Query arguments]
		 * @var array
		 */
		$args = array(
			'post_type' 		=> 'evenz_event',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> 6,
			'suppress_filters' 	=> false,
			'paged' 			=> evenz_get_paged(),
			// 'orderby' 			=> 'meta_value',
			'order'   			=> 'ASC',
			'meta_key' 			=> 'evenz_date',
			'suppress_filters' 	=> false,
			'orderby'        => [
				'meta_value' => 'ASC',
				'menu_order' => 'ASC'
	        ],
		);
		/**
		 *  For events we reorder by date and eventually hide past events
		 */
		if(get_theme_mod( 'evenz_events_hideold', 0 ) == '1'){
			$args['meta_query'] = array(
				array(
					'key' 		=> 'evenz_date',
					'value' 	=> date('Y-m-d'),
					'compare' 	=> '>=',
					'type' 		=> 'date'
				 )
			);
		}


		/**
		 * [$wp_query execution of the query]
		 * @var WP_Query
		 */
		$wp_query = new WP_Query( $args );
	} 


	?>
	<div class="evenz-maincontent evenz-bg">
		<div class="evenz-section">
			<div id="evenz-loop" class="evenz-container">
				<?php 
				/**
				 * Loop for archive and archive page
				 */
				if( $is_page ){
					
					if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
						$post = $wp_query->post;
						setup_postdata( $post );
						get_template_part ('template-parts/post/post-evenz_event');
					endwhile; 

					/**
					 * Pagination
					 */
					get_template_part ('template-parts/pagination/part-pagination'); 
					wp_reset_postdata();

					else: ?>
						<h3><?php esc_html_e( "Sorry, there are no planned events at the moment.","evenz" ); ?></h3>
					<?php 
					endif;
					
				} else {
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/post/post-evenz_event', get_post_format() );
					endwhile; 
					/**
					 * Pagination
					 */
					get_template_part ('template-parts/pagination/part-pagination'); 
					else: ?>
						<h3><?php esc_html_e( "Sorry, there are no planned events at the moment.","evenz"); ?></h3>
					<?php endif;
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php 
get_footer();