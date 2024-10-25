<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

?>	
			<?php  
			/**
			 * ======================================================
			 * Global hook used by our plugin to add special functions
			 * as ajax page loading or more
			 * ======================================================
			 */
			do_action( 'qantumthemes-after-maincontent' );
			?>


			<?php  
			/**
			 * ======================================================
			 * Compatibility for the MegaFooter plugin
			 * ======================================================
			 */
			if( function_exists('qt_megafooter_display')) {
				qt_megafooter_display();
			}


			?>
			<div id="evenz-footer" class="evenz-footer">
				<?php 
				/**
				 * ======================================================
				 * Load footer copyright bar. Can set in customizer
				 * ======================================================
				 */
				get_template_part( 'template-parts/footer/copyright-bar' ); 
				
				?>
			</div>
		</div><!-- end of .evenz-master -->
	</div><!-- end of .evenz-globacontainer -->
	<?php wp_footer(); ?>
	</body>
</html>