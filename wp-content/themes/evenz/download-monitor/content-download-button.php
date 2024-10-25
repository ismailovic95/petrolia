<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @subpackage download monitor
 * @version 1.0.0
 *
 * Override the templates from the Download Monitor plugin
 * Download button
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/** @var DLM_Download $dlm_download */
?>
<div class="evenz-downloadbox__button">
		<a class="evenz-downloadbox__buttonlink evenz-btn-primary" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
		<p class="evenz-capfont"><?php printf( esc_html__( 'Download &ldquo;%s&rdquo;', 'evenz' ), esc_html( $dlm_download->get_title() ) ); ?></p>
		<p class="evenz-itemmetas"><?php echo esc_html( $dlm_download->get_version()->get_filename() ); ?> &ndash; <?php 
			$count = $dlm_download->get_download_count();
			printf(
			    esc_attr(
			        _n(
			            'Downloaded 1 time', 
			            'Downloaded %d times',
			            $count,
			            'evenz'
			        )
			    ),
			    number_format_i18n( $count )
			);
			?> &ndash; <?php echo esc_html(  $dlm_download->get_version()->get_filesize_formatted() ); ?></p>
		</a>
</div>