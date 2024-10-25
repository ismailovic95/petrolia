<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Template Name: Blog horizontal
*/
get_header(); 
$paged = evenz_get_paged();



?>
<div id="evenz-pagecontent" class="evenz-pagecontent">
	<?php 
	/**
	 * ======================================================
	 * Archive header template
	 * ======================================================
	 */
	get_template_part( 'template-parts/pageheader/pageheader-archive' ); 
	?>


	<?php 
	/**
	 *
	 *  This template can be used also as page template.
	 *  In this case we show the page content only if is a page and is page 1
	 * 
	 */

	get_template_part( 'template-parts/pageheader/customcontent' ); 
	?>
	<div class="evenz-maincontent evenz-bg">
		<div class="evenz-section">
			<div class="evenz-container">
				<div class="evenz-row evenz-stickycont">
					<div id="evenz-loop" class="evenz-col evenz-s12 evenz-m12 evenz-l8">
						<?php 
						/**
						 * Change the default excerpt length
						 */
						add_filter( 'excerpt_length', 'evenz_excerpt_length_30', 999 );

						/**
						 * Loop for archive and archive page
						 */
						
						if( is_page() ){
							/**
							 * [$args Query arguments]
							 * @var array
							 */
							$args = array(
								'post_type' => 'post',
								'post_status' => 'publish',
								'suppress_filters' => false,
								'paged' => $paged
							);
							/**
							 * [$wp_query execution of the query]
							 * @var WP_Query
							 */
							$wp_query = new WP_Query( $args );
							if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
								$post = $wp_query->post;
								setup_postdata( $post );
								get_template_part ('template-parts/post/post-horizontal');
							endwhile; else: ?>
								<h3><?php esc_html_e("Sorry, nothing here","evenz"); ?></h3>
							<?php endif;
							wp_reset_postdata();
						} else {
							if ( have_posts() ) : while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/post/post-horizontal', get_post_format() );
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
					<div id="evenz-sidebarcontainer" class="evenz-col evenz-s12 evenz-m12 evenz-l4 evenz-stickycol">
						<?php get_sidebar(); ?>
					</div>

				</div>
				
			</div>
		</div>
	</div>
</div>
<?php 
get_footer();