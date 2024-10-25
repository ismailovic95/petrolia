<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */
?>
<div id="evenz-menu" class="evenz-menu evenz-paper">
	<div class="evenz-menu__cont">
		<h3 class="evenz-menu__logo evenz-left">
			<a class="evenz-logolink" href="<?php echo home_url( '/' ); ?>">
				<?php
				echo evenz_show_logo('_header_mob');
				echo evenz_show_logo('_header');
				echo evenz_show_logo('_header_transparent');
				?>
			</a>
		</h3>
		<?php if ( has_nav_menu( 'evenz_menu_primary' ) ) { ?>
			<nav id="evenz-menunav" class="evenz-menu-horizontal">
				<div class="evenz-menu-horizontal_c">
					<ul id="evenz-menubar" class="evenz-menubar">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'evenz_menu_primary',
						'depth' => 3,
						'container' => false,
						'items_wrap' => '%3$s'
					));
					?>
					</ul>
				</div>
			</nav>
			
		<?php } ?>
		<div class="evenz-menubtns">
			<div class="evenz-menubtns__c">
			<?php 

			/**
			 * ============================================
			 * Cart button
			 * ============================================
			 */
			if ( function_exists('WC') && false !== get_theme_mod( 'evenz_wc_cart', false ) ) {
				?><a class="cart-contents evenz-btn evenz-btn__cart evenz-btn__r" href="<?php echo wc_get_cart_url(); ?>"><i class='material-icons'>shopping_cart</i><?php echo WC()->cart->get_cart_total(); ?></a><?php
			}


			/**
			 * ============================================
			 * Search button
			 * ============================================
			 */
			if ( false !== get_theme_mod( 'evenz_search_header', false ) ) {
				?> 
				<a class="evenz-btn evenz-btn__r" data-evenz-switch="open" data-evenz-target="#evenz-searchbar"><i class='material-icons'>search</i></a> 
				<?php  
			}


			/**
			 * ===========================================
			 * Off canvas menu button
			 * IMPORTANT: we display this in desktop only if there is an offcanvas menu or widgets
			 * ===========================================
			 */
			$btn_classes = array();
			if ( !has_nav_menu( 'evenz_menu_desktop_off' ) &&  !is_active_sidebar( 'evenz-offcanvas-sidebar' )  ) {
				// No reason to display the button in desktop
				$btn_classes[] = 'evenz-hide-on-large-only';
			}
			if ( !has_nav_menu( 'evenz_menu_primary' ) && !has_nav_menu( 'evenz_menu_secondary' ) &&  !is_active_sidebar( 'evenz-offcanvas-sidebar' )  ) {
				// No reason to display the button in desktop
				$btn_classes[] = 'evenz-hide-on-large-and-down';
			}
				?><a class="evenz-btn evenz-btn__r <?php echo esc_attr( implode(' ', $btn_classes ) ); ?>" data-evenz-switch="evenz-overlayopen" data-evenz-target="#evenz-body">
					<i class="material-icons">menu</i>
				</a><?php 
			/**
			 * ============================================
			 * END OF Off canvas menu button
			 * ============================================
			 */
			?>


			<?php  
			/**
			 * Call to action
			 */
			$cta_on = get_theme_mod( 'evenz_cta_on' );
			if( $cta_on ){
				$cta = get_theme_mod( 'evenz_cta_text', esc_html__('Contact us', 'evenz') );
				$icon = get_theme_mod( 'evenz_cta_i', '');

				?><a id="<?php  echo esc_attr( get_theme_mod( 'evenz_cta_id' , 'evenzCta' ) ); ?>" target="_blank" class="evenz-btn evenz-btn-primary <?php if( $icon ){ ?>evenz-icon-l<?php } ?> <?php  echo esc_attr( get_theme_mod( 'evenz_cta_class' ) ); ?>"  href="<?php echo esc_attr( get_theme_mod( 'evenz_cta_ur' , get_feed_link( ) ) ); ?>">
					<?php if( $icon ){ ?><i class="material-icons"><?php echo esc_attr( $icon ); ?></i><?php } ?>
					<?php echo esc_html( $cta ); ?>
				</a><?php
			}
			?>


			</div>
		</div>

		
	</div>

	<?php  
	/**
	 * Search bar
	 * ============================= */
	get_template_part( 'template-parts/header/search' );
	?>

	
	<?php  
	if( function_exists('qt__megamenu_display')) {
		qt__megamenu_display();
	}
	?>
</div>