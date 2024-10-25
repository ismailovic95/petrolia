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
		get_template_part( 'template-parts/pageheader/pageheader-page' ); 
		?>
		<div class="evenz-maincontent">
			<div class="evenz-section evenz-paper">
				<div class="evenz-container">
					<div class="evenz-entrycontent">
						<div class="evenz-the_content">
							<?php 
							/**
							 * Display the schedule table
							 */
							evenz_schedule_display( $post->ID, true ); // ID of the schedule, print action
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