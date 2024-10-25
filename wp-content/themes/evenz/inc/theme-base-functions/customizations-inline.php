<?php
/**
 * @package evenz
 * @version 1.0.0
 */

if(!function_exists('evenz_hex2rgba')){
function evenz_hex2rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';
	if(empty($color)) {
		return $default; 
	}
	if ($color[0] == '#' ) {
		$color = substr( $color, 1 );
	}
	if (strlen($color) == 6) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
			return $default;
	}
	$rgb =  array_map('hexdec', $hex);
	if($opacity == false && $opacity != 0){
		$opacity = 1;
	}
	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	return $output;
}}


if(!function_exists('evenz_theme_customizations') && function_exists('ttg_core_active') ){
	
	if( function_exists( 'ttg_core_active' ) ){
		add_action('wp_head','evenz_theme_customizations',1000);
	}


	function evenz_theme_customizations(){

		ob_start();
		
		$background 		= get_theme_mod('evenz_background', '#f9f9f9' ); //
		$paper 				= get_theme_mod('evenz_paper', '#fff' );
		$ink 				= get_theme_mod('evenz_ink', '#818181' );
		$titles 			= get_theme_mod('evenz_titles', '#343434');
		
		$accent 			= get_theme_mod('evenz_accent', '#ff0062' );
		$accent_hover 		= get_theme_mod('evenz_accent_hover', '#be024a' );
		$accenttext 		= get_theme_mod('evenz_accenttext', '#fff' ); 
		
		$primary 			= get_theme_mod('evenz_primary', '#111618' ); 
		
		$primarylight 		= get_theme_mod('evenz_primarylight', '#12181b' );
		$primarytext 		= get_theme_mod('evenz_primarytext', '#fff' );
		
		
		
		$btngradient1 		= get_theme_mod('evenz_btngradient1', '#00a2ff' );
		$btngradient2 		= get_theme_mod('evenz_btngradient2', '#5c20ef' );
		
		$duotone_c1 		= get_theme_mod('evenz_header_duotone_c1', '#50fbed' );
		$duotone_c2 		= get_theme_mod('evenz_header_duotone_c2', '#550291' );


		// Overlay
		$gradient_defaults = array(
			'start'    => '#ff0062',
        	'end'   => '#be024a',
		);
		$gradient_overlay = get_theme_mod( 'gradient_overlay', $gradient_defaults );
		
		// BG
		$gradient_bg_defaults = array(
			'start'    => '#0d0232',
			 'middle'    => '#5f0090',
        	'end'   => '#1467ab',
		);
		$gradient_bg = get_theme_mod( 'gradient_background', $gradient_bg_defaults );


		// PRIMARY
		$gradient_primary_defaults = array(
			'start'    => '#111618',
        	'end'   => '#353535',
		);
		$gradient_primary = get_theme_mod( 'gradient_primary', $gradient_primary_defaults );

		?>
		<style>


			.evenz-grad-layer {
				background: <?php echo esc_attr($gradient_overlay['start']); ?>; 
				background: linear-gradient(45deg, <?php echo esc_attr($gradient_overlay['start']); ?> 0%, <?php echo esc_attr($gradient_overlay['end']); ?> 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo esc_attr($gradient_overlay['start']); ?>', endColorstr='<?php echo esc_attr($gradient_overlay['end']); ?>',GradientType=1 ); 
			}
			.evenz-circlesanimation::before {
				background: <?php echo esc_attr($gradient_overlay['end']); ?>;
			}
			.evenz-circlesanimation::after {
				background: <?php echo esc_attr($gradient_overlay['start']); ?>;
			}
   			.evenz-gradprimary {
    			background: <?php echo esc_attr($gradient_overlay['start']); ?>; 
				background: linear-gradient(45deg, <?php echo esc_attr($gradient_primary['start']); ?> 0%, <?php echo esc_attr($gradient_primary['end']); ?> 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo esc_attr($gradient_primary['start']); ?>', endColorstr='<?php echo esc_attr($gradient_primary['end']); ?>',GradientType=1 ); 
    		}
    		.evenz-gradaccent, .evenz-hov {
   				background: linear-gradient(45deg, <?php echo esc_attr($gradient_bg['start']); ?> 0%, <?php echo esc_attr($gradient_bg['middle']); ?> 50%, <?php echo esc_attr($gradient_bg['end']); ?> 100% );
   			}

    		.evenz-gradicon::before {
				background: <?php echo esc_attr( $accent ); ?>;
				background: linear-gradient(45deg, <?php echo esc_attr( $accent ); ?> 0%, <?php echo esc_attr( $accent_hover ); ?> 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo esc_attr( $accent ); ?>', endColorstr='<?php echo esc_attr( $accent_hover ); ?>',GradientType=1 ); 
				color: #fff; /* No customizer required, always white */
			}

			.evenz-post__title a {
				background-image: linear-gradient(to right, <?php echo esc_attr( $accent ); ?> 50%, <?php echo esc_attr( $accent_hover ); ?> 100%, #fff 100%);
			}

			.evenz-stripes__accent {
				background-image: linear-gradient(135deg, <?php echo esc_attr( $accent ); ?> 12.50%, transparent 12.50%, transparent 50%, <?php echo esc_attr( $accent ); ?> 50%, <?php echo esc_attr( $accent ); ?> 62.50%, transparent 62.50%, transparent 100%);
				background-size: 5px 5px; }

			.evenz-menu-horizontal .evenz-menubar > li > ul li a {
			    background-image: linear-gradient(45deg, <?php echo esc_attr( $accent ); ?> 0%,<?php echo esc_attr( $accent_hover ); ?> 100%, #fff 100%);
			}


			<?php 

			/**
			 * =================================================================================
			 * Text rendering
			 * =================================================================================
			 */
			//Text rendering menu, meta and buttons
			//=================================================================================
			$evenz_typography_text_r = get_theme_mod( 'evenz_typography_text_r', 'geometricPrecision' );
			if( $evenz_typography_text_r ){
				?>
				html body {
					text-rendering: <?php echo esc_attr( $evenz_typography_text_r ); ?>;
				}
				<?php 
			}

			// Headings
			// =================================================================================
			$evenz_typography_headings_r = get_theme_mod( 'evenz_typography_headings_r', 'geometricPrecision' );
			if( $evenz_typography_headings_r ){
				?>
				h1, h2, h3, h4, h5, h6 {
					text-rendering: <?php echo esc_attr( $evenz_typography_headings_r ); ?>;
				}
				<?php 
			}


			//Text rendering menu, meta and buttons
			//=================================================================================
			$evenz_typography_menu_r = get_theme_mod( 'evenz_typography_menu_r', 'geometricPrecision' );
			if( $evenz_typography_menu_r ){
				?>
				.evenz-internal-menu, .evenz-capfont, label, .evenz-footer__copy, .evenz-scf, .evenz-btn, .evenz-caption, .evenz-itemmetas, .evenz-menu, .evenz-secondaryhead, .evenz-cats, .evenz-menu-tree ,
				 button, input[type="button"], 	input[type="submit"], .button, .evenz-meta, .evenz-readm, .evenz-navlink {
					text-rendering: <?php echo esc_attr( $evenz_typography_menu_r ); ?>;
				}
				<?php 
			}
		?>
		</style>

		<?php  
		$output = ob_get_clean();
		$output = str_replace("<style>", "", $output);
		$output = str_replace("</style>", "", $output);
		$output = str_replace(array("	","\n","  "), " ", $output);
		$output = str_replace("  ", " ", $output);
		$output = str_replace("  ", " ", $output);
		$output = str_replace(" { ", "{", $output);
		$output = str_replace("} .", "}.", $output);
		$output = str_replace("; }", ";}", $output);
		$output = str_replace(", .", ",.", $output);

		return $output;
	}
}





