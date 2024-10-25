<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

// Design override
$title = evenz_get_title();
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
	$defaults['wrap_before'] = '';
	$defaults['wrap_after'] = '';
	$defaults['delimiter'] = ' &gt; ';
	return $defaults;
}
add_action( 'evenz_woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
?>
<div class="evenz-pageheader evenz-pageheader--animate evenz-pageheader__shop evenz-primary">
	<div class="evenz-pageheader__contents">
		<div class="evenz-container">
			<h1 class="evenz-pagecaption"><?php echo esc_html( $title ); ?></h1>
			<p class="evenz-meta evenz-small"><?php do_action( 'evenz_woocommerce_before_main_content' ); ?></p>
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

