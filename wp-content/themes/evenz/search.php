<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/
get_header(); 
?>
<div id="evenz-pagecontent" class="evenz-pagecontent">
	<?php 
	/**
	 * ======================================================
	 * Archive header template
	 * ======================================================
	 */
	get_template_part( 'template-parts/pageheader/pageheader-search' ); 
	?>
	<div class="evenz-section">
		<div id="evenz-loop" class="evenz-container">
			<?php 
			/**
			 * Loop for archive and archive page
			 */
			add_filter( 'excerpt_length', 'evenz_excerpt_length_30', 999 );
			if ( have_posts() ) : while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/post/post-search' );
				endwhile; else: ?>
					<h3><?php esc_html_e("Sorry, nothing here","evenz"); ?></h3>
				<?php endif;
			add_filter( 'excerpt_length', 'evenz_excerpt_length', 999 );
			/**
			 * Pagination
			 */
			
			?>
			<div class="evenz-row">
				
				<div class="evenz-col evenz-s12 evenz-l7 evenz-offset-l2">
					<?php get_template_part ('template-parts/pagination/part-pagination');  ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
get_footer();