<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}
?>

<div id="evenz-pagination" class="evenz-wp-pagination ">
	<div class="evenz-clearfix">
		<div class="evenz-pagination"><?php
		// Do not go on new line with PHP tag.
		// Empty pagination will be hidden to avoid useless spacing.
				$args = array(
					'base'         		=> $base,
					'add_args'     		=> false,
				'type' => 'plain',
				'prev_next' => true,
				'before_page_number' => '<span class="evenz-num evenz-btn evenz-btn__r">',
				'after_page_number'  => '</span>',
				'mid_size' => 3,
				'total'        		=> $total,
				'end_size'     		=> 3,
				'prev_text'          => '<span class="evenz-btn evenz-icon-l"><i class="material-icons">navigate_before</i>'.esc_html__('Previous', 'evenz').'</span>',
				'next_text'          => '<span class="evenz-btn evenz-icon-r">'.esc_html__('Next', 'evenz').'<i class="material-icons">navigate_next</i></span>',
				);
				echo paginate_links( $args ); 
		// Do not go on new line with PHP tag.
		// Empty pagination will be hidden to avoid useless spacing.
		?></div>
	</div>
</div>