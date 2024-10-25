<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

// Design override
$hide = get_post_meta($post->ID, 'evenz_page_header_hide', true); // see custom-types/page/page.php
$title = evenz_get_title();

$now =  current_time("Y-m-d").'T'.current_time("H:i");
$date = get_post_meta($post->ID, 'evenz_date',true);
$time = get_post_meta($post->ID, 'evenz_time',true);
if($time == '' || !$time){
	$time = '00:00';
}
$location = get_post_meta($post->ID, 'evenz_location',true);
$address = get_post_meta($post->ID, 'evenz_address',true);
if('1' != $hide){
	?>
	<div class="evenz-pageheader evenz-pageheader--animate evenz-pageheader__event evenz-primary">
		<div class="evenz-pageheader__contents">
			<div class="evenz-container">

				<p class="evenz-meta evenz-small">
					<span class="evenz-p-catz"><?php echo get_the_term_list( $post->ID, 'evenz_eventtype' , '', ' / ', ''); ?></span>
				</p>

				
				<h1 class="evenz-pagecaption"  data-evenz-text="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></h1>
				<p class="evenz-meta evenz-small">
					<span class="evenz-meta__dets">
						<?php
						if( $date && $date !== ''){ 
							echo '<i class="material-icons">today</i> '.esc_html(date_i18n( get_option("date_format", "d M Y"), strtotime( $date )));
						}
						if ($location && $location !== ''){
							?><i class="material-icons">my_location</i><?php echo esc_html( $location );
						}
						?>
					</span>
				</p>
				<hr class="evenz-spacer-xs">
				<?php 
				/**
				 * Countdown
				 * ======================================== */
				$hide_cs = get_post_meta($post->ID, 'evenz_hidecountdown', true);
				if(!$hide_cs){
					$cd = evenz_do_shortcode('[qt-countdown include_by_id="'.$post->ID.'"  size="4" style="bricks" labels="inline"]');
					if($cd){
						echo wp_kses_post( $cd );
					}
				}
				?>
				<i class="evenz-decor evenz-center"></i>
				

			</div>
		</div>
		<?php 
		/**
		 * ======================================================
		 * Background image
		 * ======================================================
		 */
		get_template_part( 'template-parts/pageheader/image' ); 

		?>
	</div>
	<?php  
} // hide end
