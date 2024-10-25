<?php
/**
 * Footer for post content in single posts
 * 
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/
if( function_exists( 'ttg_reaktions_social' ) || function_exists( 'ttg_reaktions_rating' )  || function_exists( 'qtmplayer_downloadlink' ) ){
	?>
	<div class="evenz-entrycontent__footer">
		<div class="evenz-entrycontent__share">
			<?php 
			if( function_exists( 'ttg_reaktions_social' ) ){
				echo ttg_reaktions_social('evenz-btn');
			}
			?>
		</div>
		<div class="evenz-entrycontent__rating">
			<?php
			if( function_exists( 'ttg_reaktions_rating' ) ){
				echo ttg_reaktions_rating();
			}
			?>
		</div>
	</div>
	<?php  
}