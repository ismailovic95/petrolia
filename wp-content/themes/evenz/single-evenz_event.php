<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

get_header(); 
?>
<div id="evenz-pagecontent" class="evenz-pagecontent evenz-single evenz-single__nosidebar evenz-paper">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php 
		/**
		 * ======================================================
		 * Page header template
		 * ======================================================
		 */
		set_query_var( 'evenz_header_wavescolor', get_theme_mod( 'evenz_paper', '#ffffff' ) ) ; // set waves color
		get_template_part( 'template-parts/pageheader/pageheader-event' ); 
		?>
		<div class="evenz-maincontent">
			<div class="evenz-section evenz-paper">
				<div class="evenz-container">
					<div class="evenz-row evenz-stickycont">
						<div id="evenz-content" class="evenz-col evenz-s12 evenz-m12 evenz-l8">
							<div class="evenz-entrycontent">
								
								<?php 

								/**
								 * ======================================================
								 * Contents
								 * ======================================================
								 */								
								the_content(); 


								/**
								 * ======================================================
								 * Program
								 * ======================================================
								 */
								
								get_template_part( 'template-parts/misc/program' ); 


								/**
								 * ======================================================
								 * Details table
								 * ======================================================
								 */
								get_template_part( 'template-parts/single/part-event-table' ); 


								/**
								 * ======================================================
								 * Footer with share and rating
								 * ======================================================
								 */
								if( get_theme_mod( 'reaktions_in_events', 1 ) ){
									get_template_part( 'template-parts/single/part-content-footer' ); 
								}

								?>
							</div>
						</div>
						<div id="evenz-sidebarcontainer" class="evenz-col evenz-s12 evenz-m12 evenz-l4 evenz-stickycol">
							<div id="evenz-sidebar" role="complementary" class="evenz-sidebar evenz-sidebar__main evenz-sidebar__rgt">
								<ul class="evenz-row">
									
									<?php  

									/**
									 * ======================================================
									 * Add to calendar
									 * ======================================================
									 */
									get_template_part( 'template-parts/single/part-event-googlecalendar' );
									

									/**
									 * ======================================================
									 * Purchase links
									 * ======================================================
									 */
									get_template_part( 'template-parts/single/part-event-buylinks' ); 
								

									/**
									 * ======================================================
									 * Extra widgets
									 * ======================================================
									 */
									if( is_active_sidebar( 'evenz-event-sidebar' ) ){
										dynamic_sidebar( 'evenz-event-sidebar' ); 
									}

									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php  

		/**
		 * ======================================================
		 * Footer with share and rating
		 * ======================================================
		 */
		if( get_theme_mod( 'related_in_events', 1 ) ){
			get_template_part( 'template-parts/single/part-related-events' ); 
		}

		?>
	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();