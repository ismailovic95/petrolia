<?php
/**
 * Single post with sidebar
 * 
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/
?>
<div class="evenz-section evenz-paper">
	<div class="evenz-container">
		<div class="evenz-row evenz-stickycont">
			<div class="evenz-col evenz-s12 evenz-m12 evenz-l8">
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

					/**
					 * Author
					 */
					?>
					<p class="evenz-itemmetas evenz-single__author"><span><?php esc_html_e("Written by:  ", "evenz"); ?><a href="<?php echo esc_attr( get_author_posts_url( get_the_author_meta('ID') ) ); ?>" class="qt-authorname qt-capfont"><?php echo get_the_author_meta( 'display_name', get_the_author_meta('ID') ); ?></a></p>
					<?php

					/**
					 * Tags
					 */
					the_tags('<p class="evenz-tags">', ' ', '</p>' );

					/**
					 * Post footer with share
					 */
					get_template_part( 'template-parts/single/part-content-footer' );
					?>
				</div>

				<?php  
				/**
				 * ==============================================
				 * Previous post section
				 * ==============================================
				 */
				?>
				<div class="evenz-previouspost-section">
					<hr class="evenz-spacer-m">
					<?php get_template_part( 'template-parts/single/part-previous' ); ?>
				</div>
				<?php  
				/**
				 * ==============================================
				 * Related posts section
				 * ==============================================
				 */
				?>
				<div class="evenz-relatedpost-section">
					<?php get_template_part( 'template-parts/single/part-related' ); ?>
				</div>
				<?php  
				/**
				 * ==============================================
				 * Comments section
				 * ==============================================
				 */
				$comments_count = wp_count_comments( $id );
				$comments_count = $comments_count->approved;
				if ( ( comments_open() || '0' != get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) :
					?>
					<div class="evenz-comments-section evenz-spacer-m">
						<h3 class="evenz-caption evenz-caption__l"><span><?php esc_html_e("Post comments","evenz"); ?> (<?php echo esc_html( $comments_count ); ?>)</span></h3>
						<?php  
						/**
						 * Comments template
						 */
						comments_template();
						?>
					</div>
					<?php 
				endif; 
				?>
				<hr class="evenz-spacer-m evenz-hide-on-large-only">
			</div>
			<div class="evenz-col evenz-s12 evenz-m12 evenz-l4 evenz-stickycol">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
