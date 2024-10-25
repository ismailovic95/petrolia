<?php
/**
 * @package WordPress
 * @subpackage woocommerce
 * @subpackage evenz
 * @version 1.0.0
 *
 * Provide setup functions for WooCommerce
*/

/**==========================================================================================
 *
 *
 *	Developer guidelines
 *	1) The theme must have a header-shop.php, footer-shop.php and sidebar-shop.php
 *	2) sidebar-shop.php must contain the classes of its column wrapper
 *	3) The customizer options about columns amount are evenz_woocommerce_design and evenz_woocommerce_design_single
 *
 * 
 ==========================================================================================*/



/**==========================================================================================
 *
 *
 *	WooCommerce settings
 *
 * 
 ==========================================================================================*/
if ( class_exists( 'WooCommerce' ) ) {

	/* Declare WooCommercecontainer support
	============================================= */
	add_action( 'after_setup_theme', 'evenz_woocommerce_support_add' );
	if (!function_exists('evenz_woocommerce_support_add')) {
	function evenz_woocommerce_support_add() {
		add_theme_support( 'woocommerce', array(
			'thumbnail_image_width'         => 270,
			'gallery_thumbnail_image_width' => 140,
			'single_image_width'            => 770,
		) );
		add_theme_support( 'wc-product-gallery-zoom' ); 
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		add_theme_support( 'disable-custom-colors' );
	
		register_sidebar( array(
			'name'          =>  esc_html__( 'WooCommerce Sidebar', "evenz" ),
			'id'            =>  'evenz-woocommerce-sidebar',
			'before_widget' => '<li id="%1$s" class="evenz-widget evenz-col evenz-s12 evenz-m6 evenz-l12  %2$s">',
			'before_title'  => '<h6 class="evenz-widget__title evenz-caption evenz-caption__s"><span>',
			'after_title'   => '</span></h6>',
			'after_widget'  => '</li>'
		));
	}}

	/**
	 * Cart button update in header (requires class cart-contents)
	 ============================================= */
	add_filter( 'woocommerce_add_to_cart_fragments', 'evenz_woocommerce_header_add_to_cart_fragment' );
	function evenz_woocommerce_header_add_to_cart_fragment( $fragments ) {
		ob_start();
		?><a class="cart-contents evenz-btn evenz-btn__r evenz-btn__cart evenz-btn__cart__upd"  href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'evenz'); ?>">
			<i class="material-icons">shopping_cart</i> <?php echo WC()->cart->get_cart_total(); ?>
		</a><?php
		$html = ob_get_clean();
		$fragments['a.cart-contents'] = $html;
		return $fragments;
	}


	/**
	 * Custom product meta
	 */
	
	if( !function_exists( 'evenz_woocommerce_product_meta_start' ) ){
		function evenz_woocommerce_product_meta_start(){
			echo '<span class="evenz-itemmetas">';
		}
	}
	if( !function_exists( 'evenz_woocommerce_product_meta_end' ) ){
		function evenz_woocommerce_product_meta_end(){
			echo '</span>';
		}
	}


	/**
	 * Images size
	 */

	add_filter( 'woocommerce_get_image_size_shop_single', 'evenz_woocommerce_set_product_img_size' );
	function evenz_woocommerce_set_product_img_size()
	{
		$size = array(
			'width'  => 370,
			'height' => 370,
			'crop'   => 1,
		);
		return $size;
	}

	/* Check if WooCommerce is installed and active
	============================================= */
	if(!function_exists('evenz_woocommerce_active')){
	function evenz_woocommerce_active(){
		return  class_exists( 'WC_API' );
	}}


	/**
	 * ==========================================================================================
	 *
	 *
	 * Returns current plugin version.
	 * @return string Plugin version
	 *
	 * 
	 * ==========================================================================================*/

	if(!function_exists('evenz_woocommerce_get_version')){
	function evenz_woocommerce_get_version() {
		if( true === evenz_woocommerce_active() ){	
			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}
			$the_plugs = get_option('active_plugins');
			$plugin_base_name = 'woocommerce/woocommerce.php';
			// if is active check version
			if(in_array($plugin_base_name, $the_plugs)) {
				$all_plugins = get_plugins();		
				$evenz_woocommerce_name = 'woocommerce/woocommerce.php';
				if(array_key_exists($evenz_woocommerce_name, $all_plugins)){
					return $all_plugins[$evenz_woocommerce_name]['Version'];
				}
			}
		}
		// or return 0 means no woocommerce
		return 0;
	}}


	/* Custom WooCommerce columns number
	============================================= */
	
	if (!function_exists('evenz_woocommerce_loop_columns')) {
		add_filter( 'loop_shop_columns', 'evenz_woocommerce_loop_columns', 9999 );
		function evenz_woocommerce_loop_columns() {
			$layout = get_theme_mod( 'evenz_woocommerce_design', 'fullpage' );
			switch($layout){
				case 'left-sidebar':
				case 'right-sidebar':
					return 3;
					break; 
				case 'fullpage':
				default:
				return 4;
			}
		}
	}



	/* Custom WooCommerce items per page
	============================================= */
	if (!function_exists('evenz_woocommerce_product_query')) {
		add_action( 'woocommerce_product_query', 'evenz_woocommerce_product_query' );
		function evenz_woocommerce_product_query( $q ) {
			if ( $q->is_main_query() && ( $q->get( 'wc_query' ) === 'product_query' ) ) {
				$layout = get_theme_mod( 'evenz_woocommerce_design', 'fullpage' );
				switch($layout){
					case 'left-sidebar':
					case 'right-sidebar':
						$q->set( 'posts_per_page', '12' );
						break; 
					case 'fullpage':
					default:
					$q->set( 'posts_per_page', '12' );
				}
			}
		}
	}


	/* Remove title to use our own template pageheader-shop.php
	============================================= */
	if (!function_exists('evenz_woocommerce_show_page_title')) {
		add_filter( 'woocommerce_show_page_title', 'evenz_woocommerce_show_page_title' );
		function evenz_woocommerce_show_page_title( ) {
			return false;
		}
	}


	/* Custom WooCommerce container CSS
	============================================= */
	
	// Open block
	if (!function_exists('evenz_woocommerce_theme_wrapper_start')) {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
		add_action('woocommerce_before_main_content', 'evenz_woocommerce_output_content_wrapper', 10);
		function evenz_woocommerce_output_content_wrapper() {
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
			switch ($layout){
				case 'right-sidebar':
					$column_class = 'evenz-col evenz-s12 evenz-m12 evenz-l8 ';
					break;
				case 'left-sidebar':
					$column_class = 'evenz-col evenz-s12 evenz-m12 evenz-l8 evenz-right';
					break;
				case 'fullpage':
				default:
					if ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ){
						$column_class = 'evenz-col evenz-s12 evenz-m12 evenz-l12';
					} else {
						$column_class = 'evenz-col evenz-s12 evenz-m12 evenz-l12';
					}
					
					break;
			}
			echo '<div class="evenz-col '.esc_attr( $column_class ).'"><section id="evenz-woocommerce-section" class="evenz-woocommerce-content">';
		}
	}
	// Close block
	if (!function_exists('evenz_woocommerce_theme_wrapper_end')) {
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
		add_action('woocommerce_after_main_content', 'evenz_woocommerce_output_content_wrapper_end', 10);
		function evenz_woocommerce_output_content_wrapper_end() {
			echo '</section></div>';
		}
	}





	


	/* Append Woocommerce Classes for the theme
	=============================================*/
	
	if ( ! function_exists( 'evenz_woocommerce_class_names_append_woo_classes' ) ) {
		add_filter('body_class', 'evenz_woocommerce_class_names_append_woo_classes');
		function evenz_woocommerce_class_names_append_woo_classes($classes){
			$classes[] = ' woocommerce woomanual evenz-woocommerce-body';
			return $classes;
		}
	}


	/* Woocommerce related products amount
	=============================================*/
	
	if(!function_exists('evenz_woocommerce_related_products_args')){
		add_filter( 'woocommerce_output_related_products_args', 'evenz_woocommerce_related_products_args' );
		function evenz_woocommerce_related_products_args( $args ) {
			$args['posts_per_page'] = 3; // number of related products
			$args['columns'] = 3;
			return $args;
		}
	}


	/* Woocommerce flash sale icon
	=============================================*/
	
	if(!function_exists('evenz_woocommerce_woo_sale_flash')){
		add_filter( 'woocommerce_sale_flash', 'evenz_woocommerce_woo_sale_flash' );
		function evenz_woocommerce_woo_sale_flash() {
			return '<span class="evenz-sale-flash evenz-itemmetas"><i class="material-icons">flash_on</i>'.esc_html__( 'On Sale' , 'evenz' ).'</span>';
		}
	}



	/* WooCommerce thumbnail settings
	=============================================*/
	
	if(!function_exists('evenz_woocommerce_image_dimensions')){
		add_action( 'after_switch_theme', 'evenz_woocommerce_image_dimensions', 1 );
		function evenz_woocommerce_image_dimensions() {
			global $pagenow;
			if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
				return;
			}
			$catalog = array(
				'width' 	=> '370',	// px
				'height'	=> '370',	// px
				'crop'		=> 1 		// true
			);
			$single = array(
				'width' 	=> '770',	// px
				'height'	=> '770',	// px
				'crop'		=> 1 		// true
			);
			$thumbnail = array(
				'width' 	=> '140',	// px
				'height'	=> '140',	// px
				'crop'		=> 1 		// false
			);
			// Image sizes
			update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
			update_option( 'shop_single_image_size', $single ); 		// Single product image
			update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
		}
	}

	/* WooCommerce custom search form HTML
	=============================================*/
	function get_product_search_form(){
		?>
		<div  class="evenz-searchform">
			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="evenz-form-wrapper">
				<div class="evenz-fieldset">
					<input id="s" name="s" placeholder="<?php esc_attr_e( 'Search products', 'evenz' ); ?>" type="text" required="required" value="<?php echo esc_attr( get_search_query() ); ?>" />
				</div>
				<input type="hidden" name="post_type" value="product" />
				<button type="submit" name="<?php esc_attr_e( "Submit", "evenz" ); ?>" class="evenz-btn evenz-btn__txt"><i class="material-icons">search</i></button>
			</form>
		</div>
		<?php
	}



}
