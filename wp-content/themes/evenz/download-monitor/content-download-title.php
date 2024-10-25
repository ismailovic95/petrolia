<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @subpackage download monitor
 * @version 1.0.0
 *
 * Override the templates from the Download Monitor plugin
 * 
 */
/**
 * Shows title only.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/** @var DLM_Download $dlm_download */
?>
<div>
	<p>
<a class="download-link" title="<?php if ( $dlm_download->get_version()->has_version_number() ) {
	printf( esc_attr__( 'Version %s', 'evenz' ), esc_attr( $dlm_download->get_version()->get_version_number() ) );
} ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
	<?php 
	// THERE IS NO PRINT. SANITIZATION MADE FROM THE PLUGIN
	// THIS FILE IS ONLY A TEMPLATING OVERRIDE FOR THE COMPATIBLE PLUGIN "DOWNLOAD MONITOR"
	// 
	$dlm_download->the_title(); ?>
</a>
</p>
</div>