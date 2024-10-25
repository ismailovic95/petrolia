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
 * Default output for a download via the [download] shortcode
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/** @var DLM_Download $dlm_download */
?>
<p>
	<i class="material-icons">file_download</i><a class="download-link" title="<?php if ( $dlm_download->get_version()->has_version_number() ) { printf( esc_attr__( 'Version %s', 'evenz' ), esc_attr( $dlm_download->get_version()->get_version_number() ) );} ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
		<?php $dlm_download->the_title(); ?>
		(<?php 
			$count = $dlm_download->get_download_count();
			printf(
			    esc_attr(
			        _n(
			            '1 download',
			            '%d downloads',
			            $count,
			            'evenz'
			        )
			    ),
			    number_format_i18n( $count )
			);
		?>)
	</a>
</p>