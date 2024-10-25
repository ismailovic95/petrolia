<?php
/**
 * 
 * Display share button
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

$evenz_share_header_hide = get_post_meta( $post->ID, 'evenz_share_header_hide', true );
if( '1' !== $evenz_share_header_hide ){
	?>
	<div class="evenz-shareball">
		<?php echo evenz_do_shortcode( '[ttg_reaktions-shareball]' ); ?>
	</div>
	<?php  
}
