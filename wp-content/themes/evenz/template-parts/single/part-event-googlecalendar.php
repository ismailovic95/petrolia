<?php
/**
 * Table of event details
 * 
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

$evenz_addtogooglecal = get_post_meta($post->ID, 'evenz_addtogooglecal', true );

if($evenz_addtogooglecal){

	$date = get_post_meta($post->ID, 'evenz_date',true);
	$time = get_post_meta($post->ID, 'evenz_time',true);
	$date_end = get_post_meta($post->ID, 'evenz_date_end',true);
	$time_end = get_post_meta($post->ID, 'evenz_time_end',true);
	$location = get_post_meta($post->ID, 'evenz_location',true);
	$address = get_post_meta($post->ID, 'evenz_address',true);
	$link = get_post_meta($post->ID, 'evenz_link',true);
	$phone = get_post_meta($post->ID, 'evenz_phone',true);

	if(isset($date) && isset($time) && isset($date_end) && isset($time_end)){
		if(!empty($date) && !empty($time) && !empty($date_end) && !empty($time_end)){

			$link = 'https://www.google.com/calendar/render?action=TEMPLATE&text='
			.str_replace(' ','+',get_the_title())
			.'&dates='.str_replace('-','',$date ).'T'.str_replace(':','',$time).'00Z/'.str_replace( '-','',$date_end ).'T'.str_replace(':','',$time_end)
			.'00Z&details=For+details,+link+here:+'.urlencode(get_the_permalink()).'&location='.esc_attr(str_replace(" ", '+',$location)).',+'
			.esc_attr(str_replace(" ", '+', $address )).'&sf=true&output=xml';

			?>
			<li class="evenz-widget evenz-col evenz-s12 evenz-m12 evenz-l12">
				<div class="evenz-event-googlecalendar">
					<a href="<?php echo esc_attr($link); ?>" class="evenz-btn evenz-btn-primary events_btn__l" target="_blank"><i class="evenz-gc"></i><?php esc_html_e("Add to Calendar", 'evenz'); ?></a>
				</div>
			</li>
			<?php  
		}
	}
}