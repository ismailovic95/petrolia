<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

$date = get_post_meta($post->ID, 'evenz_date',true);
$day = '';
$monthyear = '';

if($date && $date != ''){
	$day = date( "d", strtotime( $date ));
	$monthyear=esc_attr(date_i18n("M Y",strtotime($date)));
}



$location = get_post_meta($post->ID, 'evenz_location',true);
$address = get_post_meta($post->ID, 'evenz_address',true);

$classes = array( 'evenz-post', 'evenz-post__event', 'evenz-darkbg evenz-negative' );

$time = get_post_meta($post->ID, 'evenz_time',true);
if(get_theme_mod( 'timeformat_am' )){
	$time = date_i18n("g:i a", strtotime($time));
}
?>
<article <?php post_class( $classes ); ?>>
	<div class="evenz-bgimg evenz-bgimg--full evenz-duotone">
		<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'large', array( 'class' => 'evenz-post__event__i') ); } ?>
	</div>
	<div class="evenz-post__event__c">
		<h4 class="evenz-post__event__d evenz-capfont">
			<span><?php echo esc_html( $day ); ?></span>
			<span><?php echo esc_html( $monthyear ); ?></span>
		</h4>
		<div class="evenz-post__event__t">
			<p class="evenz-meta evenz-small cutme">
				<?php  
				/**
				 * Countdown
				 * ======================================== */
				$cd = evenz_do_shortcode('[qt-countdown include_by_id="'.$post->ID.'"  size="inherit"  labels="inline"]');
				if($cd){
					?><i class="material-icons">today</i><?php
					echo wp_kses_post( $cd );
				}

				if ($time && $time !== ''){
					?><i class="material-icons">schedule</i><?php echo esc_html( $time );
				}

				if ($location && $location !== ''){
					?><i class="material-icons">my_location</i><?php echo esc_html( $location );
				}
				
				?>
			</p>
			<h2><?php the_title(); ?></h2>
		</div>
		<div class="evenz-post__event__b">
			<a href="<?php the_permalink( ); ?>" class="evenz-btn evenz-btn__white"><?php esc_html_e("More info", "evenz"); ?></a>

			<?php 
			/*$link = get_post_meta($post->ID, 'evenz_link',true);
			if($link){
			 	?><a href="<?php echo esc_url($link); ?>" class="evenz-btn evenz-btn__white" target="_blank">
			 		EVENT PAGE
			 	</a><?php  
			}*/
			?>
		</div>

	</div>
	<span class="evenz-hov"></span>
</article>