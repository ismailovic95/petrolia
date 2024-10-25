<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}



// customize meta appearance
add_action ('woocommerce_product_meta_start' 	, 'evenz_woocommerce_product_meta_start');
add_action ('woocommerce_product_meta_end' 		, 'evenz_woocommerce_product_meta_end');

// evenz move metas before price
// move price to 11
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 ); // evenz
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 ); // evenz

// Customise review form
add_filter( 'woocommerce_product_review_comment_form_args', 'evenz_woocommerce_product_review_comment_form_args', 10, 1  );
function evenz_woocommerce_product_review_comment_form_args( $comment_form ){
	$comment_form['label_submit']  = esc_html__( 'Leave your rating', 'evenz' );
	$comment_form['title_reply_before']   = '<div><h6 class="evenz-review-form-title evenz-caption evenz-caption__m">';
	$comment_form['title_reply_after']    = '</h6></div>';
	return $comment_form ;
}

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('evenz-product-single' , $product); ?>>

	<?php
		/**
		 * Hook: woocommerce_before_single_product_summary.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5 // evenz removed
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
