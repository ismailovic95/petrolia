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

if( $date && $date !== '' && $date > $now){
	?>
	<span class="evenz-countdown__container evenz-countdown__container--shortcode">
		<span class="evenz-countdown  evenz-countdown--shortcode" 
		data-evenz-date="<?php echo esc_attr( $date ); ?>" 
		data-evenz-time="<?php echo esc_attr( $time ); ?>" 
		data-evenz-now="<?php echo esc_attr( $now ); ?>"
		><?php esc_html_e('Coming soon', 'evenz'); ?></h4>
	</span>
	<?php  
}


