<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/


/**
 * =================================
 * evenz_is_shop
 * This function tells you if we are in a shop page
 * =================================
 */
if(!function_exists('evenz_is_shop')){
	function evenz_is_shop(){
		if(function_exists("is_shop")){
			if( is_shop() || is_woocommerce() || is_product_category() || is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() ){
				return true;
			} else {
				return false;
			}
		}
		return false;
	}
}

/**
 * =================================
 * evenz_shop_title
 * This function returns an appropriate string for the page title of a shop page
 * =================================
 */
if(!function_exists('evenz_shop_title')){
	function evenz_shop_title(){
		if(function_exists("is_shop")){
			if(function_exists("is_shop")){
				if( is_shop() ){
					return esc_html__('Shop' , 'evenz');
				}
				else if( is_cart() ){
					return esc_html__('Cart' , 'evenz');
				}
				else if( is_product() ){
					return get_the_title();
				}
				else if( is_checkout() ){
					return esc_html__('Checkout' , 'evenz');
				}
				else if( is_account_page() ){
					return esc_html__('Account' , 'evenz');
				} 
				else if( is_wc_endpoint_url() ){
					if( is_wc_endpoint_url('order-pay') ){
						return esc_html__('Order payment' , 'evenz');
					} 
					else if( is_wc_endpoint_url( 'order-received' ) ){
						return esc_html__('Order received' , 'evenz');
					}
					else if( is_wc_endpoint_url( 'view-order' ) ){
						return esc_html__('View order' , 'evenz');
					}
					else if( is_wc_endpoint_url( 'edit-account' ) ){
						return esc_html__('Edit account' , 'evenz');
					}
					else if( is_wc_endpoint_url( 'edit-address' ) ){
						return esc_html__('Edit address' , 'evenz');
					}
					else if( is_wc_endpoint_url( 'lost-password' ) ){
						return esc_html__('Password recovery' , 'evenz');
					}
					else if( is_wc_endpoint_url( 'customer-logout' ) ){
						return esc_html__('Log out' , 'evenz');
					}
					else if( is_wc_endpoint_url( 'add-payment-method' ) ){
						return esc_html__('Add payment method' , 'evenz');
					}
				}
				else  {
					return esc_html__('Shop' , 'evenz');
				}
			}
		}
		return;
	}
}


function evenz_get_title(){
	ob_start();
	if ( is_category() ) : single_cat_title();
	elseif (is_page() || is_singular() ) : the_title();
	



	elseif ( is_search() ) : printf( esc_html__( 'Search Results for: %s', "evenz" ),  esc_html(get_search_query()) );
	elseif ( is_tag() ) : single_tag_title();
	elseif ( is_author() ) :
		the_author_meta('nickname');
		rewind_posts();
	elseif ( is_day() ) : printf( esc_html__( 'Day: %s', "evenz" ), esc_html(get_the_date())  );
	elseif ( is_month() ) : printf( esc_html__( 'Month: %s', "evenz" ), esc_html(get_the_date( 'F Y' ))  );
	elseif ( is_year() ) :  printf( esc_html__( 'Year: %s', "evenz" ), esc_html(get_the_date( 'Y' ))  );
	elseif ( is_tax( 'post_format', 'post-format-aside' ) ) : esc_html_e( 'Asides', "evenz" );
	elseif ( is_tax( 'post_format', 'post-format-image' ) ) : esc_html_e( 'Images', "evenz");
	elseif ( is_tax( 'post_format', 'post-format-video' ) ) : esc_html_e( 'Videos', "evenz" );
	elseif ( is_tax( 'post_format', 'post-format-quote' ) ) : esc_html_e( 'Quotes', "evenz" );
	elseif ( is_tax( 'post_format', 'post-format-link' ) ) : esc_html_e( 'Links', "evenz" );
	elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) : esc_html_e( 'Galleries', "evenz" );
	elseif ( is_tax( 'post_format', 'post-format-audio' ) ) : esc_html_e( 'Sounds', "evenz" );
	elseif (is_post_type_archive( 'evenz_event' ) || is_tax('evenz_eventtype')):      
			$termname = '';
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if(is_object($term)){
				echo esc_html($term->name).' ';
			} else {
				esc_html_e("Events","evenz"); 
			}
	elseif (is_post_type_archive( 'evenz_member' ) || is_tax('evenz_membertype')):      
			$termname = '';
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if(is_object($term)){
				echo esc_html($term->name).' ';
			} else {
				esc_html_e("Team","evenz"); 
			}
	elseif (is_post_type_archive( 'evenz_testimonial' ) || is_tax('evenz_testimonialcat')):      
			$termname = '';
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if(is_object($term)){
				echo esc_html($term->name).' ';
			} else {
				esc_html_e("Testimonial","evenz"); 
			}
	elseif (is_post_type_archive( 'place' ) || is_tax('pcategory')):      
			$termname = '';
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if(is_object($term)){
				echo esc_html($term->name).' ';
			} else {
				esc_html_e("Venues","evenz"); 
			}

	
	// WooCommerce categories
	elseif(  is_tax( 'product_cat' )  || is_tax( 'product_tag' ) ) :
		$termname = '';
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		if(is_object($term)){
			echo esc_html($term->name).' ';
		} else {
			esc_html_e("Products","evenz"); 
		}
	// WooCommerce
	elseif( evenz_is_shop() ) : 
		echo esc_html( evenz_shop_title() );// the function has already the translation inside
		


	else: esc_html_e( 'Blog', "evenz" );
	endif;


	$output = ob_get_clean();
	return $output;
}
