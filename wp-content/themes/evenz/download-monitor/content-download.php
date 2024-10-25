<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @subpackage download monitor
 * @version 1.0.0
 *
 *	Override the templates from the Download Monitor plugin
 * 
 * Detailed download output
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/** @var DLM_Download $dlm_download */

?>
<div class="evenz-downloadbox">
	<aside class="evenz-downloadbox__card ">
		<div class="evenz-downloadbox__i">
		<?php 
		// THERE IS NO PRINT. SANITIZATION MADE FROM THE PLUGIN
		// THIS FILE IS ONLY A TEMPLATING OVERRIDE FOR THE COMPATIBLE PLUGIN "DOWNLOAD MONITOR"
		$dlm_download->the_image(); 
		?>
		</div>
		<div class="evenz-downloadbox__content evenz-card evenz-primary">
			<h4 class="evenz-downloadbox__cap evenz-caption__s"><?php $dlm_download->the_title(); ?></h4>
			<?php $dlm_download->the_excerpt(); ?>
			<div class="evenz-downloadbox__count evenz-itemmetas"><?php 

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

			?></div>

			<p class="evenz-downloadbox__act">
			<a class="evenz-btn evenz-btn-primary" title="<?php if ( $dlm_download->get_version()->has_version_number() ) {
				printf( esc_html__( 'Version %s', 'evenz' ), esc_html( $dlm_download->get_version()->get_version_number() ) );
			} ?>" href="<?php /* NO SANITIZATION REQUIRED AS IS DONE BY THE PLUGIN!! */ $dlm_download->the_download_link(); ?>" rel="nofollow">
				<?php esc_html_e( 'Download', 'evenz' ); ?>
			</a>
			</p>

		</div>
	</aside>
</div>

