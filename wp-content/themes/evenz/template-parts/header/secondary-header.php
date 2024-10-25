<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */
?>
<div id="evenz-secondary-header" class="evenz-secondaryhead evenz-primary">
	<div class="evenz-secondaryhead__cont">


		<?php  
		/**
		 * ======================================================
		 * SOS text CTA
		 * ------------------------------------------------------
		 * Display a custom text super prominent in secondary header
		 * ======================================================
		 */
		$ic 	= get_theme_mod( 'evenz_sos_cta_i' );
		$t1 	= get_theme_mod( 'evenz_sos_cta_text1' );
		$t2 	= get_theme_mod( 'evenz_sos_cta_text2' );
		$l  	= get_theme_mod( 'evenz_sos_cta_l' );

		if($t1 || $t2){
			?>
			<h6 class="evenz-sos evenz-scf">
				<?php if($l){ ?><a href="<?php echo esc_url( $l ); ?>"><?php } ?>
						<?php 
						/**
						 * ===============================================
						 * ICON
						 * ================================================
						 */
						if($ic){ ?><i class="material-icons"><?php echo esc_html($ic); ?></i><?php } ?><?php echo esc_html( $t1 ); ?> 
						
						

						<span class="evenz-sos__t2"><?php echo esc_html( $t2 ); ?></span>

						<?php  
						/**
						 * ===============================================
						 * COUNTDOWN FROM CUSTOMIZER
						 * ================================================
						 */
						$countdown_event_id = get_theme_mod( 'evenz_ctaevent' );
						if( $countdown_event_id ){
							// Safe shortcode execution
							echo evenz_do_shortcode('[qt-countdown include_by_id="'.esc_attr( $countdown_event_id ).'" size="inherit"  labels="inline" show_ms="'.esc_attr( get_theme_mod( 'show_ms' ) ).'"]');
						}
						?>

				<?php if($l){ ?></a><?php } ?>
			</h6>
			<?php
		}
		?>


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
			if(is_array($social)){
				if(count($social)>0){
					foreach($social as $var => $val){
						$link = get_theme_mod( 'evenz_social_'.$var );
						if($link){
							$icons_amount = $icons_amount + 1;
						}
					}
				}
			}			
		} 
		?>

		<?php 

		/**
		 * ======================================================
		 * Secondary menu
		 * ======================================================
		 */
		
		if ( has_nav_menu( 'evenz_menu_secondary' ) || $icons_amount > 0 ) { 
			?>
			<ul class="evenz-menubar evenz-menubar__secondary">
				<?php  

					/**
					 * Menu
					 */
					wp_nav_menu( array(
						'theme_location' => 'evenz_menu_secondary',
						'depth' => 1,
						'container' => false,
						'link_before' => '',
						'items_wrap' => '%3$s'
					) );

					/**
					 * Print the P only if there are social icons from the customizer
					 */
					if (function_exists( 'evenz_qt_socicons_array' )){

						if(is_array($social)){
							$social = evenz_qt_socicons_array();
							krsort($social);
							if(count($social)>0){
								foreach( $social as $var => $val ){
									$link = get_theme_mod( 'evenz_social_'.$var );
									if($link){
										?>
										<li class="evenz-social"><a href="<?php echo esc_url($link); ?>" target="_blank"><i class="qt-socicon-<?php echo esc_attr($var); ?> qt-socialicon"></i></a></li>
										<?php
									}
								}
							}
						}
					}
				?>
			</ul>
			<?php 
		} 
		?>
	</div>
</div>