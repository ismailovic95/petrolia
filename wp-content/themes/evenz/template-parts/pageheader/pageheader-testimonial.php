<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

// Design override
$hide = get_post_meta($post->ID, 'evenz_page_header_hide', true); // see custom-types/page/page.php
$title = evenz_get_title();
if('1' != $hide){
	?>
	<div class="evenz-pageheader evenz-pageheader--animate evenz-pageheader__testimonial evenz-primary">
		<div class="evenz-pageheader__contents">
			<div class="evenz-container evenz-pageheader__testimonial__quote">
				<?php  
				// IMPORTANT!
				//  is the material icon for the glitch effect, is not an error!!
				?>
				<span class="evenz-pageheader__decoricon"><i class="material-icons">format_quote</i></span>
				<h1 class="evenz-pagecaption"  data-evenz-text="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></h1>
				<p class="evenz-meta evenz-small">
					<?php  
					$author = get_post_meta( $post->ID, 'evenz_author', true );
					$role = get_post_meta( $post->ID, 'evenz_role', true );
					echo esc_html( $author );
					if($author && $role){
						?> / <?php  
					}
					echo esc_html( $role );
					?>
				</p>
				<i class="evenz-decor evenz-center"></i>
			</div>
		</div>
		<?php 
		/**
		 * ======================================================
		 * Background image
		 * ======================================================
		 */
		get_template_part( 'template-parts/pageheader/image' ); 

	
		?>
	</div>
	<?php  
} // hide end
