<?php
/**
 * 
 * Add mark if is sticky
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

if( is_sticky()) {
	?>
	<div class="evenz-post__sticky"><span class="evenz-meta"><?php esc_html_e( 'Featured', 'evenz' ) ?></span><i class="material-icons">star</i></div>
	<?php
}