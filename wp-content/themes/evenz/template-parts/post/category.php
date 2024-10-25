<?php
/**
 * 
 * Display only the first category
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

if(!isset( $quantity )){ // allow override from calling loop via set_query_var
	$quantity = 1;
}
?>
<p class="evenz-cats">
	<?php  
	evenz_postcategories( $quantity );
	?>
</p>
