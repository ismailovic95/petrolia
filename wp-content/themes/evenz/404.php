<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

get_header(); 
?>
			<div id="evenz-pagecontent" class="evenz-pagecontent evenz-primary-light evenz-notfound404">

				<?php  
				get_template_part( 'template-parts/pageheader/pageheader-404' ); 
				?>
				
			</div>
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