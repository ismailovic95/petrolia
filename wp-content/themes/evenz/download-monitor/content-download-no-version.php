<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @subpackage download monitor
 * @version 1.0.0
 *
 * Override the templates from the Download Monitor plugin
 * no version default
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/** @var DLM_Download $dlm_download */
?>
123
<a class="download-link" title="<?php esc_attr_e( 'Please set a version in your WordPress admin', 'evenz' ); ?>" href="#" rel="nofollow">
	"<?php $dlm_download->the_title(); ?>" <strong><?php esc_html_e( 'has no version set!', 'evenz' ); ?></strong>
</a>