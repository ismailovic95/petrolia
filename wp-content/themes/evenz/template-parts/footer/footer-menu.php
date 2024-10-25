<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

?>	

<div id="evenz-footermenu" class="evenz-footer__section evenz-section evenz-primary-light">
	<div class="evenz-footer__content">


		<?php  
		/**
		 * ======================================================
		 * Fooer logo
		 * ------------------------------------------------------
		 * Display logo or site title
		 * ======================================================
		 */
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="evenz-footer__logo">
			<h4><?php echo evenz_show_logo('_footer'); ?></h4>
		</a>


		<?php  
		/**
		 * ======================================================
		 * Footer menu
		 * ------------------------------------------------------
		 * Display menu for specific footer location
		 * ======================================================
		 */
		?>
		<ul class="evenz-menubar">
			<?php 
			/**
			*  Footer left
			*  =============================================
			*/
			if ( has_nav_menu( 'evenz_menu_footer' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'evenz_menu_footer',
					'depth' => 1,
					'container' => false,
					'items_wrap' => '%3$s'
				));
			}
			?>
		</ul>


		<?php  
		/**
		 * ======================================================
		 * Social icons
		 * ------------------------------------------------------
		 * Display list of social icon links from customizer
		 * ======================================================
		 */
		if (function_exists( 'evenz_qt_socicons_array' )){
			$social = evenz_qt_socicons_array();
			krsort($social);
			$icons_amount = 0;
			foreach($social as $var => $val){
				$link = get_theme_mod( 'evenz_social_'.$var );
				if($link){
					$icons_amount = $icons_amount + 1;
				}
			}
			
			if ( $icons_amount > 0) {
				?>
				<div class="evenz-social">
					<?php  
					foreach($social as $var => $val){
						$link = get_theme_mod( 'evenz_social_'.$var );
						if($link){
							?>
							<a href="<?php echo esc_url($link); ?>" class="evenz-btn evenz-btn__r evenz-btn__white" target="_blank"><i class="qt-socicon-<?php echo esc_attr($var); ?> qt-socialicon"></i></a>
							<?php
						}
					}
					?>
				</div>
				<?php
			}
		} 
		?>

	</div>

	<?php 
	/**
	 * ======================================================
	 * Background image
	 * ======================================================
	 */
	$bgimg = get_theme_mod( 'evenz_footer_bgimg', false );
	if( $bgimg ){
		?> 
			<div class="evenz-bgimg"><img src="<?php echo esc_url( $bgimg ); ?>" alt="<?php esc_attr_e('Background', 'evenz'); ?>"></div> 
		<?php
	}


	/**
	 * ======================================================
	 * Background tone color
	 * ======================================================
	 */
	if( get_theme_mod( 'evenz_overlay_tone', '1' ) ){
		?> 
			<div class="evenz-grad-layer"></div>
		<?php
	}

	
	?>
	

</div>