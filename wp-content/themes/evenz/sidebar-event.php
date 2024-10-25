<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */


if( is_active_sidebar( 'evenz-event-sidebar' ) ){
	?>
	<div id="evenz-sidebar" role="complementary" class="evenz-sidebar evenz-sidebar__main evenz-sidebar__rgt">
		<ul class="evenz-row">
			<?php dynamic_sidebar( 'evenz-event-sidebar' ); ?>
		</ul>
	</div>
	<?php 
}