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
		get_template_part( 'template-parts/pageheader/pageheader-place' ); 
		?>
		<div class="evenz-maincontent">
			<div class="evenz-section evenz-paper">
				<div class="evenz-container">
					
						<div id="evenz-content">
							<div class="evenz-entrycontent">
								
								
								<?php 
								/**
								 * ======================================================
								 * Content description
								 * ======================================================
								 */
								the_content(); 
								?>

								<?php  
								/**
								 * ======================================================
								 * Details table
								 * ======================================================
								 */
								get_template_part( 'template-parts/single/part-place-table' ); 
								?>
								<?php  
								/**
								 * ======================================================
								 * Details table
								 * ======================================================
								 */
								get_template_part( 'template-parts/single/part-map' ); 
								?>

							</div>
						</div>
						
					
				</div>
			</div>
		</div>
	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();