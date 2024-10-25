<?php  

/**
 * Function to display the schedule
 */

if(!function_exists('evenz_schedule_display')){
	function evenz_schedule_display($postid, $print){
		
		ob_start();
		
		$evenz_timetable = get_post_meta($postid, 'evenz_timetable',true);
		if( count( $evenz_timetable ) > 0  ){
			?>
			<div id="evenz-schedule-<?php echo esc_attr($postid); ?>" class="evenz-schedule">
				<div class="evenz-schedule__content">
					<?php 
					/**
					 * ========================
					 * Single items
					 * ========================
					 */
					$item_index = 0;
					foreach( $evenz_timetable as $e ){

						/**
						 * ========================
						 * Make sure we have defaults
						 * ========================
						 */
						$requested = ['time','time_end','timesub','title','desc', 'img'];
						foreach( $requested as $r ){
							if( !array_key_exists($r, $e) ) {
								$e[$r] = '';
							}
						}



						/**
						 * ========================
						 * Convert time format if required
						 * ========================
						 */
						if($e['time'] && $e['time'] !== ''){
							if(get_theme_mod( 'timeformat_am' )){
								if($e['time'] === "24:00"){
									$e['time'] === "00:00";
								}
								if($e['time_end'] === "24:00"){
									$e['time_end'] === "00:00";
								}
								// 12 hours format
								$e['time'] = date("g:i a", strtotime($e['time']));
								$e['time_end'] = date("g:i a", strtotime($e['time_end']));
								$toreplace = array("am", "pm");
								$replacer = array('<span class="evenz-12h">am</span>','<span class="evenz-12h">pm</span>');
								$e['time'] = str_replace($toreplace, $replacer, $e['time']);
								$e['time_end'] = str_replace($toreplace, $replacer, $e['time_end']);
							} else {
								$e['time'] = date("H:i", strtotime($e['time']));
								$e['time_end'] = date("H:i", strtotime($e['time_end']));
							}
						}

						$postid = trim( $postid );
						$accordion_selector = '#evenz-schedule-'.$postid.'-'.$item_index.' .evenz-schedule__more';


						?>
						<div id="evenz-schedule-<?php echo esc_attr( $postid.'-'.$item_index ); ?>" class="evenz-schedule__item evenz-paper evenz-card">
							<div class="evenz-schedule__item__head evenz-primary">
								<div class="evenz-schedule__item__head__c">
								<?php if($e['time'] && $e['time'] !== ''){ ?>	<h6 class="evenz-schedule__item__time evenz-h4"><span class="evenz-schedule__item__time__start"><?php echo wp_kses_post( $e['time'] ); ?></span> <i class="material-icons">remove</i> <?php echo wp_kses_post( $e['time_end'] ); ?> </h6><?php } ?>
									<h6 class="evenz-schedule__item__sub"><?php echo esc_html( $e['timesub'] ); ?></h6>
									<a href="#" data-evenz-activates="<?php echo esc_attr( $accordion_selector ); ?>"><i class="material-icons">keyboard_arrow_down</i></a>
								</div>
								<?php if(isset( $e['img'] )){
									$img = wp_get_attachment_image_src( $e['img'], 'evenz-squared-m' );
									if( $img ){

										?>
										<div class="evenz-schedule__item__head__bg">
											<img src="<?php echo esc_url( $img[0] ); ?>" alt="<?php esc_attr_e( 'Background', 'evenz' ); ?>">
										</div>
										<?php  
									}
								} ?>
							</div>
							<div class="evenz-schedule__item__body">
								<h4 class="evenz-color-h"><?php echo esc_html( $e['title'] ); ?></h4>

								<div class="evenz-schedule__more">
									<?php  
									/**
									 * ========================
									 * Speakers
									 * ========================
									 */
									$max = intval($speakers_number_per_time = get_theme_mod('evenz_speakersnum',1));
									for( $i = 1; $i<=$max; $i++ ){
										if (array_key_exists('speaker_'.$i, $e )){
											$speaker = $e[ 'speaker_'.$i ];
											if( $speaker && $speaker != '' ){
												$sid = $speaker[0];
												if( $sid ){
														?>
														<p class="evenz-schedule__item__sp evenz-cutme">
															<a href="<?php echo get_the_permalink( $sid ); ?>">
																<?php
																if( has_post_thumbnail( $sid )){
																	?>
																	<img src="<?php echo get_the_post_thumbnail_url( $sid,  'post-thumbnail' ); ?>" alt="<?php esc_attr_e( 'Thumbnail', 'evenz' ); ?>">
																	<?php 
																}
																echo get_the_title( $sid );
																?>
															</a>
														</p>
													<?php
												}
											}
										}
									}
									?>
									<p class="evenz-schedule__des"><?php echo wp_kses_post(  $e['desc'] ); ?></p>
								</div>
							</div>
						</div>
						<?php 
						$item_index = $item_index + 1;
					}
					?>
				</div>
			</div>
			<?php

		}
		
		if($print){
			echo ob_get_clean();
			return;
		} else {
			return ob_get_clean();
		}

	}
}