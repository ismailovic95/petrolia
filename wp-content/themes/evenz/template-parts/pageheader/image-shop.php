<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

/**
 * ======================================================
 * This file adds the background image to archive headers.
 * ------------------------------------------------------
 * There are 3 cases:
 * ------------------------------------------------------
 * - Category image
 * - Page featured (for archive templates)
 * - Default customizer picture
 * ======================================================
 */

$header_image = false;

/**
 * ======================================================
 * 1. CUSTOMIZER FEATURED IMAGE
 * ------------------------------------------------------
 * Get the featured image from the customizer
 * ======================================================
 */
if( function_exists('ttg_core_active') ){
	$evenz_header_bgimg = get_theme_mod('evenz_header_bgimg', false);
	if ( $evenz_header_bgimg ){
		$header_image = wp_get_attachment_image_src( $evenz_header_bgimg, 'full' );
	}
}



if( false !== $header_image ){
	$img = $header_image; 
	$evenz_header_parallax = get_theme_mod( 'evenz_header_parallax' );
	if($evenz_header_parallax){
		?>
		<div class="evenz-bgimg evenz-bgimg__parallax evenz-greyscale <?php 
			if( get_theme_mod( 'evenz_header_duotone', '0' ) ){ ?> evenz-duotone <?php 
			} ?>" data-evenz-parallax>
			<img data-stellar-ratio="0.9" src="<?php echo esc_url( $img[0] ); ?>" alt="<?php esc_attr_e('Background', 'evenz'); ?>">
		</div>
		<?php
	} else {
		?>
		<div class="evenz-bgimg <?php 
			if( get_theme_mod( 'evenz_header_greyscale', '1' ) ){ ?> evenz-greyscale <?php }
			if( get_theme_mod( 'evenz_header_duotone', '0' ) ){ ?> evenz-duotone <?php 
			} ?>">
			<img src="<?php echo esc_url( $img[0] ); ?>" alt="<?php esc_attr_e('Background', 'evenz'); ?>">
		</div>
		<?php
	}
	
}


/**
 * ======================================================
 * Background tone color
 * ======================================================
 */
?> 
<div class="evenz-grad-layer"></div>
<?php


/**
 * ======================================================
 * Background tone color
 * ======================================================
 */
?>
	<div class="evenz-dark-layer"></div>
<?php


/**
 * ======================================================
 * Waves
 * ======================================================
 */
if( get_theme_mod('evenz_header_waves', '1') ){
	$optional_color =  get_theme_mod( 'evenz_accent', '#ff0062' );
	?>
	<div class="evenz-waterwave evenz-waterwave--l1">
	  	<canvas class="evenz-waterwave__canvas" data-waterwave-color="<?php echo esc_attr( $optional_color ); ?>" data-waterwave-speed="0.3"></canvas>
	</div>
	<?php  
	$optional_color = get_query_var( 'evenz_header_wavescolor', get_theme_mod( 'evenz_background', '#f9f9f9' ) ) ;
	?>
	<div class="evenz-waterwave evenz-waterwave--l2">
	  	<canvas class="evenz-waterwave__canvas" data-waterwave-color="<?php echo esc_attr( $optional_color ); ?>" data-waterwave-speed="0.5"></canvas>
	</div>
	<?php
}