<?php
/**
* Internal menu for pages
* 
* @package WordPress
* @subpackage evenz
* @version 1.0.0
*/


$links = get_post_meta($post->ID, 'evenz_internalmenu_items', true);
if( is_array( $links )){
	if( count($links) > 0 ){
		$overlap = get_post_meta($post->ID, 'evenz_internalmenu_overlap', true);
		?>
		<div id="evenz-sticky" class="evenz-sticky evenz-internal-menu" data-offset="0">
			<div id="evenz-stickycon" class="evenz-internal-menu__c evenz-sticky__content  <?php if($overlap){ ?>evenz-internal-menu__c__overlap<?php } ?>">
				<div class="evenz-container__l">
					<ul class="evenz-paper" data-evenz-scrollspy>
						<?php
						foreach( $links as $b ){
							if(!array_key_exists('txt', $b ) || !array_key_exists('url', $b )){
								continue;
							}
							if($b['txt'] == '' || $b['url'] == ''){
								continue;
							}
							/**
							 * Add hash if is not URL
							 */
							$b[ 'url' ] = trim( $b[ 'url' ] );
							$search = '/^http/';
							preg_match ($search, $b[ 'url' ], $find );
							if( count($find) < 1 ){
								$b[ 'url' ] = '#'.$b[ 'url' ];
							}

							/**
							 * Add class primary if is a highlight button
							 */
							$class_li = '';
							$class_a = '';
							if(array_key_exists('highlight', $b )){
								if( $b[ 'highlight' ] == '1' ){
									$class_a = 'evenz-btn-primary';
									$class_li = 'evenz-right';
								}
							}

							?>
							<li class="<?php echo esc_attr( $class_li ); ?>"><a href="<?php echo esc_attr( $b[ 'url' ] ); ?>" class="<?php echo esc_attr( $class_a ); ?>"><?php echo esc_html( $b['txt'] ); ?></a></li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
		<?php
	}
}
