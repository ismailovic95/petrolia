<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * emplate Name: Member page
 * Template Post Type: evenz_member
 */

get_header(); 
?>
<div id="evenz-pagecontent" class="evenz-pagecontent evenz-single evenz-single__nosidebar">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="evenz-paper">
			<?php 
			/**
			 * ======================================================
			 * Page header template
			 * ======================================================
			 */
			set_query_var( 'evenz_header_wavescolor', get_theme_mod( 'evenz_paper', '#ffffff' ) ) ; // set waves color
			get_template_part( 'template-parts/pageheader/pageheader-member' ); 
			?>
		</div>
		<div class="evenz-maincontent evenz-bg">
			<div class="evenz-section evenz-paper">
				<div class="evenz-container">
					<div class="evenz-entrycontent">
					<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();