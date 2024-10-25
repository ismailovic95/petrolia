<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Template Name: Page sidebar
 * Template Post Type: evenz_member, page, evenz_event
 */

get_header(); 
?>
<div id="evenz-pagecontent" class="evenz-pagecontent">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<?php 
		/**
		 * ======================================================
		 * Page header template
		 * ======================================================
		 */
		get_template_part( 'template-parts/pageheader/pageheader-page' ); 
		?>
		<div class="evenz-maincontent">
			<div class="evenz-section evenz-paper">
				<div class="evenz-container">
					<div class="evenz-row evenz-stickycont">
						<div id="evenz-content" class="evenz-col evenz-s12 evenz-m12 evenz-l8">
							<div class="evenz-entrycontent">
								<div class="evenz-the_content">
									<?php the_content(); ?>
								</div>
							</div>
							<?php 
							$atts_pagelink = array(
								'before'           => '<h6 class="evenz-itemmetas evenz-pagelinks">',
								'after'            => '</h6>',
								'link_before'      => '',
								'link_after'       => '',
								'next_or_number'   => 'next',
								'separator'        => '  ',
								'nextpagelink'     => esc_html__( 'Next page', 'evenz').'<i class="material-icons">chevron_right</i>',
								'previouspagelink' => '<i class="material-icons">chevron_left</i>'.esc_html__( 'Previous page', 'evenz' ),
								'pagelink'         => '%',
								'echo'             => 1
							);
							wp_link_pages( $atts_pagelink ); 
							?>
						</div>
						<div id="evenz-sidebarcontainer" class="evenz-col evenz-s12 evenz-m12 evenz-l4 evenz-stickycol">
							<?php get_sidebar(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();