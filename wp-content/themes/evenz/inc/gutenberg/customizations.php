<?php
/**
 * @package evenz
 * @version 1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


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

if(!function_exists('evenz_color_luminance')){
function evenz_color_luminance( $hex, $percent ) {
	
	// validate hex string
	
	$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
	$new_hex = '#';
	
	if ( strlen( $hex ) < 6 ) {
		$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
	}
	
	// convert to decimal and change luminosity
	for ($i = 0; $i < 3; $i++) {
		$dec = hexdec( substr( $hex, $i*2, 2 ) );
		$dec = min( max( 0, $dec + $dec * $percent ), 255 ); 
		$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
	}		
	
	return $new_hex;
}}

if(!function_exists('evenz_theme_gutenberg_customizations') && function_exists('ttg_core_active') ){
	function evenz_theme_gutenberg_customizations(){
		if( !is_admin() ){
			return; // Security check
		}
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
		
		$primarylight 			= get_theme_mod('evenz_primarylight', '#12181b' );
		$primarylight 			= get_theme_mod('evenz_primarylight', '#12181b' );
		$primary 			= get_theme_mod('evenz_primary', '#111618' ); 
		
		$btngradient1 		= get_theme_mod('evenz_btngradient1', '#00a2ff' );
		$btngradient2 		= get_theme_mod('evenz_btngradient2', '#5c20ef' );
		
		$duotone_c1 		= get_theme_mod('evenz_header_duotone_c1', '#50fbed' );
		$duotone_c2 		= get_theme_mod('evenz_header_duotone_c2', '#550291' );



		
		/**
		 * The style tag will be stripped before the output
		 */
		
		?>
		<style>
			/**
			 * =================================================================================
			 * CUSTOM STYLES GUTENBERG EDITOR
			 * =================================================================================
			 */
			


			




			/**
			 * Colors
			 */
			
			.editor-styles-wrapper .block-editor-writing-flow .editor-post-title {
				background: <?php echo esc_attr($gradient_overlay['start']); ?>; 
				background: linear-gradient(45deg, <?php echo esc_attr($gradient_overlay['start']); ?> 0%, <?php echo esc_attr($gradient_overlay['end']); ?> 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo esc_attr($gradient_overlay['start']); ?>', endColorstr='<?php echo esc_attr($gradient_overlay['end']); ?>',GradientType=1 ); 
			}
			.edit-post-layout,
			.editor-styles-wrapper,
			.edit-post-layout__content,
			.block-editor-writing-flow,
			.block-editor-writing-flow blockquote::before {
				color: <?php echo esc_html($ink); ?>;
				background-color: <?php echo esc_html($paper); ?>;
			}
			.block-editor-writing-flow .wp-block {
				color: <?php echo esc_html($ink); ?>;
			}
			.block-editor-writing-flow .wp-block h1,
			.block-editor-writing-flow .wp-block h2,
			.block-editor-writing-flow .wp-block h3,
			.block-editor-writing-flow .wp-block h4,
			.block-editor-writing-flow .wp-block h5,
			.block-editor-writing-flow .wp-block h6,
			.wp-block-heading h1, .wp-block-heading h2, .wp-block-heading h3,
			.wp-block-heading h4, .wp-block-heading h5, .wp-block-heading h6 {
				color: <?php echo esc_html($titles); ?>;
			}
			.block-editor-writing-flow .wp-block blockquote::before, .block-editor-writing-flow .wp-block blockquote, .block-editor-writing-flow .wp-block .wp-block-quote,
			.block-editor-writing-flow .wp-block blockquote, .block-editor-writing-flow .wp-block .wp-block-quote {
				border-color: <?php echo esc_html( evenz_hex2rgba( $ink, 0.66 ) ); ?>;
			}
			pre.wp-block-verse, .wp-block-verse pre,
			.block-editor-writing-flow .wp-block .wp-block-preformatted pre {
				color: <?php echo esc_html( evenz_hex2rgba( $ink, 0.8 ) ); ?>;
			}

			.edit-post-visual-editor.editor-styles-wrapper hr.wp-block-separator {
				border-color: <?php echo esc_html( evenz_hex2rgba( $ink, 0.66 ) ); ?>;
			}
			.edit-post-visual-editor.editor-styles-wrapper hr.wp-block-separator.is-style-dots::before {
				color: <?php echo esc_html( evenz_hex2rgba( $ink, 0.66 ) ); ?>;
			}
			hr.wp-block-separator , .block-editor-writing-flow .wp-block .wp-block-separator{
				border-color: <?php echo esc_html( evenz_hex2rgba( $ink, 0.66 ) ); ?>;
			}
			hr.wp-block-separator.is-style-dots::before {
				color: <?php echo esc_html( evenz_hex2rgba( $ink, 0.33 ) ); ?>;
			}



			/* Links */
			.block-editor-writing-flow .wp-block a {
				color: <?php echo esc_html($accent); ?>;
			}
			.block-editor-writing-flow .wp-block a:hover {
				color: <?php echo esc_html($accent_hover); ?>;
			}

			/* Buttons */
			.block-editor-writing-flow .wp-block-button__link {
				background-color: <?php echo esc_html($btngradient1); ?>;
				background-image: linear-gradient(-45deg, <?php echo esc_html($btngradient1); ?> 0%,  <?php echo esc_html($btngradient2); ?> 100%);
			}

			
		</style>
		<?php 

		/**
		 * =================================================================================
		 * Featured image
		 * =================================================================================
		 */
		$thumbnail = false;
		if(has_post_thumbnail( get_the_id() )){
			
			$thumbnail = get_the_post_thumbnail_url( get_the_id(), 'full' ); 
			?>
			<style>
				.editor-post-title {
					background-image: url(<?php echo esc_url( $thumbnail ); ?>);
				}
			</style>
			<?php
		}

		/**
		 * =================================================================================
		 * Page text font
		 * =================================================================================
		 */
		
		$usage = 'evenz_typography_text';

		$family = get_theme_mod( $usage );
		if ( isset( $family['font-family'] ) ) {
			if ( !isset( $family[ 'variant' ] ) ) {
				$variant = '400';
			} else {
				$variant = trim( $family[ 'variant' ] );
			}

			// THE STYLE TAG WILL BE REMOVED ON OUTPUT
			?>
			<style>

				.block-editor-writing-flow, .block-editor-writing-flow .wp-block,
				.block-editor-writing-flow .editor-rich-text__tinymce.mce-content-body,
				.block-editor-writing-flow .editor-block-list__block, .editor-block-list__block p {
					font-family: <?php echo '"' . esc_html( $family['font-family'] ). '"'; ?>, Helvetica, Arial, sans-serif;
					font-weight: <?php echo esc_html( $variant ); ?>;
					<?php if(isset( $family[ 'letter-spacing' ] )){ ?>
						letter-spacing:<?php echo esc_html( $family[ 'letter-spacing' ] ); ?>;
					<?php } ?>
				}
			</style>
			<?php
		}

		/**
		 * Bold text
		 */
		
		$usage = 'evenz_typography_text_bold';

		$family = get_theme_mod( $usage );
		if ( isset( $family['font-family'] ) ) {
			if ( !isset( $family[ 'variant' ] ) ) {
				$variant = '400';
			} else {
				$variant = trim( $family[ 'variant' ] );
			}
			// THE STYLE TAG WILL BE REMOVED ON OUTPUT
			?>
			<style>
				.block-editor-writing-flow, .block-editor-writing-flow .wp-block strong,
				.block-editor-writing-flow .editor-rich-text__tinymce.mce-content-body strong {
					font-family: <?php echo '"' . esc_html( $family['font-family'] ). '"'; ?>, Helvetica, Arial, sans-serif;
					font-weight: <?php echo esc_html( $variant ); ?>;
					<?php if(isset( $family[ 'letter-spacing' ] )){ ?>
						letter-spacing:<?php echo esc_html( $family[ 'letter-spacing' ] ); ?>;
					<?php } ?>
				}
			</style>
			<?php
		}

		/**
		 * =================================================================================
		 * Headings
		 * =================================================================================
		 */
		
		$usage = 'evenz_typography_headings';

		$family = get_theme_mod( $usage );
		if ( isset( $family['font-family'] ) ) {
			if ( !isset( $family[ 'variant' ] ) ) {
				$variant = '400';
			} else {
				$variant = trim( $family[ 'variant' ] );
			}
			// THE STYLE TAG WILL BE REMOVED ON OUTPUT
			?>
			<style>
			
				.wp-block-heading h1, .wp-block-heading h2, .wp-block-heading h3,
				.wp-block-heading h4, .wp-block-heading h5, .wp-block-heading h6,
				.edit-post-visual-editor.editor-styles-wrapper .editor-post-title__input, 
				.edit-post-visual-editor.editor-styles-wrapper h1, 
				.edit-post-visual-editor.editor-styles-wrapper h2, 
				.edit-post-visual-editor.editor-styles-wrapper h3, 
				.edit-post-visual-editor.editor-styles-wrapper h4, 
				.edit-post-visual-editor.editor-styles-wrapper h5, 
				.edit-post-visual-editor.editor-styles-wrapper h6 {
					font-family: <?php echo '"' . esc_html( $family['font-family'] ). '"'; ?>, Helvetica, Arial, sans-serif;
					font-weight: <?php echo esc_html( $variant ); ?>;
					<?php if(isset( $family[ 'letter-spacing' ] )){ ?>
						letter-spacing:<?php echo esc_html( $family[ 'letter-spacing' ] ); ?>;
					<?php } ?>
				}
			</style>
			<?php
		}

		/**
		 * =================================================================================
		 * Captions
		 * =================================================================================
		 */
		
		$usage = 'evenz_typography_pagecaptions';

		$family = get_theme_mod( $usage );
		if ( isset( $family['font-family'] ) ) {
			if ( !isset( $family[ 'variant' ] ) ) {
				$variant = '400';
			} else {
				$variant = trim( $family[ 'variant' ] );
			}
			// THE STYLE TAG WILL BE REMOVED ON OUTPUT
			?>
			<style>
				.block-editor-writing-flow .editor-post-title__block .editor-post-title__input {
					font-family: <?php echo '"' . esc_html( $family['font-family'] ). '"'; ?>, Helvetica, Arial, sans-serif;
					font-weight: <?php echo esc_html( $variant ); ?>;
					<?php if(isset( $family[ 'letter-spacing' ] )){ ?>
						letter-spacing:<?php echo esc_html( $family[ 'letter-spacing' ] ); ?>;
					<?php } ?>
				}
			</style>
			<?php
		}


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
			<style>
			.block-editor-writing-flow{
				text-rendering: <?php echo esc_attr( $evenz_typography_text_r ); ?>;
			}
			</style>
			<?php 
		}

		// Headings
		// =================================================================================
		$evenz_typography_headings_r = get_theme_mod( 'evenz_typography_headings_r', 'geometricPrecision' );
		if( $evenz_typography_headings_r ){
			?>
			<style>
			.wp-block h1, .wp-block h2, .wp-block h3, .wp-block h4, .wp-block h5, .wp-block h6,
			.wp-block-heading h1, .wp-block-heading h2, .wp-block-heading h3, .wp-block-heading h4, .wp-block-heading h5, .wp-block-heading h6 {
				text-rendering: <?php echo esc_attr( $evenz_typography_headings_r ); ?>;
			}
			</style>
			<?php 
		}

		$css = ob_get_clean();
		$toremove = array('<style>', '</style>', "\n", '				', '   ', '			');
		$css = str_replace($toremove, '', $css);
		header('Content-type: text/css');
  		header('Cache-control: must-revalidate');
		echo wp_strip_all_tags( $css );
		die();
	}

	/**
	* Dynamically output the customizer styling for Gutenberg editor
	*/	
	if( isset($_GET) && is_admin() ){
		if(array_key_exists('evenz-gutenberg-customizer-styles', $_GET)){
			add_action('init', 'evenz_theme_gutenberg_customizations');
		}
	}
}





