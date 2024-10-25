<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
if( array_key_exists('class', $args)) {
	$args['class'] = $args['class'] .' '.'evenz-a0';
	$prefix = 'button ';// leave the space!!
	if (substr( $args['class'] , 0, strlen($prefix)) == $prefix) {
	    $args['class'] = substr( $args['class'] , strlen($prefix));
	} 
} else {
	$args['class'] = 'evenz-a0';
}


echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf( '<a href="%s" data-quantity="%s" class="%s" %s><i class="material-icons"></i></a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ), //'evenz-a0',
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : ''
	),
$product, $args );
