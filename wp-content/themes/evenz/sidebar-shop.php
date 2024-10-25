<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */


if ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ){
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
}

if( is_active_sidebar( 'evenz-woocommerce-sidebar' ) && $layout !== 'fullpage' ){
	?>
	<div id="evenz-sidebarcontainer" class="evenz-col evenz-s12 evenz-m12 evenz-l4">
		<div id="evenz-sidebar-woocommerce" role="complementary" class="evenz-sidebar evenz-sidebar__shop evenz-sidebar__main evenz-sidebar__<?php echo esc_attr( $layout ) ?>">
			<ul class="evenz-row">
				<?php dynamic_sidebar( 'evenz-woocommerce-sidebar' ); ?>
			</ul>
		</div>
	</div>
	<?php 
}
