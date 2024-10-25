<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */
$copy_text = get_theme_mod('evenz_footer_text');

if( $copy_text || has_nav_menu( 'evenz_menu_footer' ) ){
	?>	
	<div id="evenz-copybar" class="evenz-footer__copy evenz-primary">
		<div class="evenz-container">
			<?php  

			/**
			 * ======================================================
			 * Copyright text
			 * ======================================================
			 */ 
			if( $copy_text ){
				?>
				<p><?php echo wp_kses_post( $copy_text ); ?></p>
				<?php
			}

			/**
			 * ======================================================
			 * Footer menu
			 * ======================================================
			 */ 
			if ( has_nav_menu( 'evenz_menu_footer' ) ) {
				?>
				<ul class="evenz-menubar evenz-menubar__footer">
					<?php 
					/**
					*  Footer left
					*  =============================================
					*/
					
						wp_nav_menu( array(
							'theme_location' => 'evenz_menu_footer',
							'depth' => 1,
							'container' => false,
							'items_wrap' => '%3$s'
						));
					
					?>
				</ul>
				<?php  
			}
			?>
		</div>
	</div>
	<?php  
}
?>