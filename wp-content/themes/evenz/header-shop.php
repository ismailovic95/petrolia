<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

get_header();
$classes = array('evenz-pagecontent', 'evenz-master__woocommerce');
if ( is_shop() || is_tax( 'product_cat' )  || is_tax( 'product_tag' ) ){
	$layout = get_theme_mod( 'evenz_woocommerce_design', 'fullpage' );

} else {
	$layout = get_theme_mod( 'evenz_woocommerce_design_single', 'fullpage' );
	/**
	 * Check for meta fields override
	 */
	$evenz_post_template = get_post_meta(get_the_ID(),  'evenz_post_template' , true);
	if($evenz_post_template){
		$layout = $evenz_post_template;
	}	
	$classes[] = 'product';
}
$classes = implode(' ', $classes);


?>

	<div id="evenz-pagecontent" <?php post_class( $classes ); ?>>
	<?php 
	/**
	 * ======================================================
	 * Page header template
	 * ======================================================
	 */
	get_template_part( 'template-parts/pageheader/pageheader-shop' );
	?>
	<div id="evenz-woocommerce-section" class="evenz-section evenz-bg">
		<div class="evenz-container">
			<div class="evenz-row">