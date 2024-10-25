<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Template Name: Page wide
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
		set_query_var( 'evenz_header_wavescolor', get_theme_mod( 'evenz_paper', '#ffffff' ) ) ; // set waves color
		if(get_post_type() === 'evenz_member'){
			get_template_part( 'template-parts/pageheader/pageheader-member' ); 
		} else {
			get_template_part( 'template-parts/pageheader/pageheader-page' ); 
		}
		?>
		<div class="evenz-maincontent">
			<div class="evenz-section evenz-paper">
				<div class="evenz-container">
					<div class="evenz-entrycontent">
						<div class="evenz-the_content">
							<?php the_content(); ?>
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
				</div>
			</div>
		</div>

	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();