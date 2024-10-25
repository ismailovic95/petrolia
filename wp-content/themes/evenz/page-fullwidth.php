<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Template Name: Page FullWidth
 * Template Post Type: evenz_member, page, evenz_event
 */

get_header(); 
?>
<div id="evenz-pagecontent" class="evenz-pagecontent evenz-single evenz-single__fullwidth">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<?php 
		/**
		 * ======================================================
		 * Page header template
		 * ======================================================
		 */
		
		if(get_post_type() === 'evenz_member'){
			get_template_part( 'template-parts/pageheader/pageheader-member' ); 
		} else {
			get_template_part( 'template-parts/pageheader/pageheader-page' ); 
		}
		?>
		<div class="evenz-maincontent">
			<div class="evenz-entrycontent">
			<?php the_content(); ?>
			</div>
		</div>

	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();