<?php
/**
 * Author in single post
 * 
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

/**
 * =======================================
 * Requires to enable the option and to have a featured description.
 * =======================================
 */

if(get_theme_mod('evenz_show_author', '1' ) ){
	$user_id = get_the_author_meta('ID');
	$desc = get_the_author_meta( 'description' , $user_id );
	if( $desc  ){
		set_query_var( 'evenz_featuredauthor_id', $user_id );
		?>
		<div class="evenz-author-section">
			<div class="evenz-part-author">
				<h6 class="evenz-caption__s"><?php esc_html_e( 'About the author', 'evenz' ) ?></h6>
				<?php
					get_template_part( 'template-parts/author/featured-author' ); 
				?>
			</div>
		</div>
		<hr class="evenz-spacer-m">
		<?php  
		remove_query_arg( 'evenz_featuredauthor_id' );
	}
}