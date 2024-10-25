<?php
/**
 * Single map display
 * 
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * 
 * Handled by Javascript.
 * Requires the QT places plugin and a valid js api key for google maps.
*/

$qt_coord = get_post_meta($post->ID, 'qt_coord', true);
if( $qt_coord ){
	if( function_exists( 'evenz_slugify' ) ){
		$slug =  'evenzmap-single-'.evenz_slugify( $qt_coord );
	} else {
		$slug = 'evenzmap-single-mymap';
	}
	?>
		<div id="<?php echo esc_attr( $slug ); ?>" class="evenz-map-single" data-evenz-mapcoord="<?php echo esc_attr( $qt_coord ); ?>">
			
		</div>
	<?php  
}