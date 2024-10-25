<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */
?>
<div  class="evenz-searchform">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="evenz-form-wrapper">
		<div class="evenz-fieldset">
			<input id="s" name="s" placeholder="<?php esc_attr_e( 'Search in this website', 'evenz' ); ?>" type="text" required="required" value="<?php echo esc_attr( get_search_query() ); ?>" />
		</div>
		<button type="submit" name="<?php esc_attr_e( "Submit", "evenz" ); ?>" class="evenz-btn evenz-btn__txt"><i class="material-icons">search</i></button>
	</form>
</div>