<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

get_header(); 
?>
<div id="evenz-pagecontent" class="evenz-pagecontent evenz-single evenz-single__nosidebar">
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



		<?php  
		/**
		 * ==============================================
		 * Comments section here
		 * ==============================================
		 */
		$comments_count = wp_count_comments( $id );
		$comments_count = $comments_count->approved;
		if ( ( comments_open() || '0' != get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
			<div class="evenz-section">
				<div class="evenz-container">
					<div class="evenz-comments-section">
						<h3 class="evenz-caption evenz-caption__l"><span><?php esc_html_e("Post comments","evenz"); ?> (<?php echo esc_html( $comments_count ); ?>)</span></h3>
						<?php  
						/**
						 * Comments template
						 */
						comments_template();
						?>
					</div>
				</div>
			</div>
			<?php 
		endif; 

		/* Comments section end ================= */
		?>

	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();