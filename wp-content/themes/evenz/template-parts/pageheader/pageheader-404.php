<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */


?>
<div class="evenz-pageheader evenz-pageheader--animate evenz-primary">
	<div class="evenz-pageheader__contents">
		<div class="evenz-container evenz-container--404">
			<h1 class="evenz-pagecaption"><?php esc_html_e('404', 'evenz'); ?></h1>
			<h6 class="evenz-meta"><?php esc_html_e('Page Not Found', 'evenz'); ?></h6>
			<div class="evenz-pageheader__search evenz-spacer-xs">
				<?php get_search_form(); ?>
			</div>
			<p class="evenz-meta"><a class="" href="<?php echo home_url( '/' ); ?>"><?php esc_html_e( 'Return to the homepage','evenz' ); ?></a></p>
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