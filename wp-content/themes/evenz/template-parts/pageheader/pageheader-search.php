<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */
$title = evenz_get_title();
?>
<div class="evenz-pageheader evenz-pageheader--animate evenz-primary">
	<div class="evenz-pageheader__contents">
		<div class="evenz-container">
			
			<h1 class="evenz-pagecaption"  data-evenz-text="<?php echo esc_attr( $title ); ?>"><?php echo esc_html( $title );  ?></h1>
			<div class="evenz-pageheader__search evenz-spacer-xs">
				<?php get_search_form(); ?>
			</div>
			<p class="evenz-meta"><?php get_template_part( 'template-parts/pageheader/meta-archive' );  ?></p>
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