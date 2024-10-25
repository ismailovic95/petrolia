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


$time = get_post_meta($post->ID, 'evenz_time',true);

$now =  current_time("Y-m-d").'T'.current_time("H:i");
$location = get_post_meta($post->ID, 'evenz_location',true);
$address = get_post_meta($post->ID, 'evenz_address',true);
$evenz_countdown = get_query_var( 'evenz_countdown', false );
$evenz_btntxt = get_query_var( 'evenz_btntxt', false );
$eventtype = get_the_term_list( $post->ID, 'evenz_eventtype' , '', ' / ', '');


$classes = array( 'evenz-post evenz-post__eventfeat' , 'evenz-darkbg evenz-negative' );
?>
<article <?php post_class( $classes ); ?>>
	<div class="evenz-bgimg--full evenz-duotone">
		<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'large', array( 'class' => 'evenz-post__eventfeat__i') ); } ?>
	</div>
	<div class="evenz-post__eventfeat__c evenz-negative">
		<div class="evenz-post__eventfeat__c__c">
			<p class="evenz-meta evenz-small">
				<?php if( $eventtype ){ ?>
				<span class="evenz-p-catz"><?php echo get_the_term_list( $post->ID, 'evenz_eventtype' , '', '  ', ''); ?></span>
				<?php } ?>
				<span class="evenz-meta__dets">
					<?php
					if( $date && $date !== ''){ 
						echo esc_html(date_i18n( get_option("date_format", "d M Y"), strtotime( $date )));
					}
					?>
				</span>
			</p>

			<div class="evenz-post__eventfeat__caption">
				<?php  

				/**
				 * Countdown
				 * ======================================== */
				echo evenz_do_shortcode('[qt-countdown include_by_id="'.$post->ID.'" size="5"  labels="inline"]');
				
				/**
				 * Title
				 * ======================================== */
				$caption = get_the_title();
				if( $caption ){
					?>
					<h2 class="evenz-capfont" data-evenz-text="<?php echo esc_attr( $caption ); ?>"><?php echo esc_html( $caption ); ?></h2>
					<?php
				}

				?>
			</div>


			<div class="evenz-post__eventfeat__exc">
				<?php 
				/**
				 * Custom excerpt length:
				 * we can add the function here because this element is not supposed to be repeated many times
				 */
				echo get_the_excerpt();
				?>
			</div>
			<a href="<?php the_permalink( ); ?>" class="evenz-btn evenz-btn__l evenz-btn-primary"><?php echo esc_html( $evenz_btntxt ); ?></a>
		</div>
	</div>
	
</article>
