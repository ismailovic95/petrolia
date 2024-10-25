<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}


remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 20 );
add_action( 'evenz_woocommerce_loop_flash', 'woocommerce_show_product_loop_sale_flash', 5 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'evenz_woocommerce_loop_rating', 'woocommerce_template_loop_rating', 5 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'evenz_woocommerce_loop_price', 'woocommerce_template_loop_price', 5 );

// cart button
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'evenz_woocommerce_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart', 5 );

// remove link
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

?>
<li <?php wc_product_class('evenz-post evenz-post__product' , $product); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	do_action( 'woocommerce_template_loop_rating');
	?>

	<div class="evenz-post__header evenz-darkbg evenz-negative">
		<div class="evenz-bgimg evenz-bgimg--full evenz-duotone">
			<?php 
			do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
		</div>
		<div class="evenz-post__headercont">
			<?php 
			do_action( 'evenz_woocommerce_loop_flash' );
			?>
			<span class="evenz-post__product__rating">
				<?php  
				do_action( 'evenz_woocommerce_loop_rating' );
				?>
			</span>

			<div class="evenz-actions__cont">
				<div class="evenz-actions">
					<?php
					do_action( 'evenz_woocommerce_loop_add_to_cart' );
					?>
					<a href="<?php the_permalink(); ?>" class="evenz-post__product__lk"></a>
				</div>
			</div>

			
		</div>
		<span class="evenz-hov"></span>
		
	</div>

	<div class="evenz-post__content">
		<p class="evenz-meta evenz-small">
			<span class="evenz-p-catz">
				<?php 
					get_the_terms( $product->get_id(), 'product_cat');
					$categories = get_the_terms( $product->get_id(), 'product_cat' ); 
					if( count( $categories ) > 0 ){
						$cat = $categories[0];
						?><a href="<?php echo get_term_link($cat->term_id ); ?>"><?php echo esc_html($cat->name); ?></a><?php
					}
				?>
			</span>
			<?php 
			do_action( 'evenz_woocommerce_loop_price' );
			?>		
		</p>
		<h5 class="evenz-post__title evenz-cutme-t-2"><a href="<?php the_permalink( $product->get_id() ); ?>"><?php the_title(); ?></a></h5>
	</div>

	
	<?php

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * REMOVED @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
