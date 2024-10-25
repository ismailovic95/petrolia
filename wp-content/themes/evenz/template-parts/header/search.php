<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Search
 */

if ( false !== get_theme_mod( 'evenz_search_header', false ) ) {
	?>
	<nav id="evenz-searchbar" class="evenz-searchbar evenz-paper">
		<div class="evenz-searchbar__cont">
			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
				<input name="s" type="text" placeholder="<?php esc_attr_e( 'Search', 'evenz' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
				<button type="submit" name="<?php esc_attr_e( "Submit", "evenz" ); ?>" class="evenz-btn evenz-icon-l evenz-hide-on-small-only evenz-btn-primary" value="<?php esc_attr_e( "Search", "evenz" ); ?>" ><i class="material-icons">search</i> <?php esc_html_e( "Search", "evenz" ); ?></button>
			</form>

			<a class="evenz-btn evenz-btn__r"  data-evenz-switch="open" data-evenz-target="#evenz-searchbar"> <i class="material-icons">close</i></a>
		</div>
	</nav>
	<?php
}
