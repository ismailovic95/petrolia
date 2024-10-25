<?php
/**
 * Table of event details
 * 
 * @package WordPress
 * @subpackage evenz
 * @version 1.1.6
*/
$buylinks = get_post_meta($post->ID, 'evenz_buylinks', true);
if( is_array( $buylinks )){
	if( count($buylinks) > 0 ){
		ob_start();
		foreach( $buylinks as $b ){
			if(!array_key_exists('txt', $b ) || !array_key_exists('url', $b )){
				continue;
			}
			if($b['txt'] == '' || $b['url'] == ''){
				continue;
			}
			$target = '';
			if( array_key_exists('target', $b )){
				$target = ( $b['target'] == '1' ) ? '_blank' : '_self' ;
			}
			?>
			<a href="<?php echo esc_url( $b[ 'url' ] ); ?>" target="<?php echo esc_attr( $target ); ?>" class="evenz-btn"><span class="evenz-cutme"><?php echo esc_html( $b['txt'] ); ?></span></a>
			<?php
		}

		$html = ob_get_clean();
		
		if( $html != '' ){
			?>
			<li class="evenz-widget evenz-col evenz-s12 evenz-m12 evenz-l12">
				<div class="evenz-buylinks">
					<h5 class="evenz-caption evenz-caption__s"><span><?php esc_html_e( 'Book event' , 'evenz' ); ?></span></h5>
					<div class="evenz-buylinks__btns">
						<?php
						echo $html;
						?>
					</div>
				</div>
			</li>
			<?php
		}
	}
}