<?php
/**
 * 
 * Display the post interactions on top of the header image
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/


$format = get_post_format( $post->ID );
if(!$format) {
	$format = 'std';
}
$share = false;
?>
<div class="evenz-actions__cont">
	<div class="evenz-actions">
			<?php 
			/**
			 * ==============================================
			 * Like action 
			 * ==============================================
			 */
			if(function_exists('ttg_reaktions_loveit_link')){
				echo ttg_reaktions_loveit_link('evenz-a1');
			}


			/**
			 * ==============================================
			 * Open link icon
			 * ==============================================
			 */
			
			// Switch icon depending on the post type
			$icon = 'insert_link';
			if( get_post_type( $post->ID ) == 'evenz_event') {
				$icon = 'today';
			}
			?>
			<a href="<?php the_permalink(); ?>" class="evenz-a0"><i class="material-icons"><?php echo esc_html( $icon ); ?></i></a>
			<?php 


			/**
			 * ========================================================
			 * Ttg Reaktions Plugin COmpatibility
			 * If we are using the Reaktions plugin, we can include the share functionality
			 * ========================================================
			 */
			if( shortcode_exists( 'ttg_reaktions-sharebox' )){
				?>
				<i class="material-icons evenz-a2" data-evenz-activates="gparent">share</i>
				<?php
			}
		
			?>
	</div>
	<?php  
	/**
	 * Ttg Reaktions Plugin COmpatibility
	 * If we are using the Reaktions plugin, we can include the share functionality
	 */
	if( shortcode_exists( 'ttg_reaktions-sharebox' )){
		?>
		<div class="evenz-sharebox">
			<div class="evenz-sharebox__c">
				<?php 
				echo evenz_do_shortcode( '[ttg_reaktions-sharebox classbtn="evenz-btn evenz-btn__r evenz-btn__txt"]' ); 
				?>
			</div>
			<i class="material-icons evenz-sharebox__x" data-evenz-activates="gparent">close</i>
		</div>
		<?php  
	}
	?>
</div>


