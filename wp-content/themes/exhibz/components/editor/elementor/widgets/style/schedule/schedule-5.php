<?php
extract( array(
	'number' => 1,
	'order'  => $schedule_order,
	'class'  => '',
) );

global $post;
$args = array(
	'post_type' => 'ts-schedule',
	'post__in'  => array( $schedule_post_id )
);

if ( isset( $schedule_term_id ) && $schedule_term_id != '' ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'ts-schedule_cat',
			'field'    => 'term_id',
			'terms'    => $schedule_term_id
		),
	);
};

$i     = 1;
$posts = get_posts( $args );

foreach ( $posts as $postnav ) {
	setup_postdata( $postnav );

	?>
    <section class="ts-schedule">
        <div class="container">
            <div class="row">
                <div class="col-lg-12"
                     style="display:<?php echo esc_attr( $header_show == "yes" ? "block" : "none" ); ?>">
                    <h2 class="section-title">

						<?php echo get_the_title( $postnav->ID ) ?>
                    </h2>
                </div>
                <!-- col end-->
            </div>
            <!-- row end-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content schedule-tabs">
                        <div role="tabpanel" class="tab-pane active" id="date3" aria-labelledby="date3-tab">
							<?php
							$schedule_list = exhibz_meta_option( $postnav->ID, 'exhibz_schedule_pop_up', [] );

							foreach ( $schedule_list as $s_limit => $schedule ) {

								if ( $s_limit == $schedule_limit ) {
									break;
								}

								$speaker_one   = '';
								$speaker_two   = '';
								$speaker_three = '';

								$speaker_id_one   = '';
								$speaker_id_two   = '';
								$speaker_id_three = '';

								$schedule_speaker_multi = [];

								$q                = [];
								$multiple_speaker = [];

								if ( array_key_exists( "multi_speaker_choose", $schedule ) ) {
									if ( array_key_exists( "style", $schedule["multi_speaker_choose"] ) ) {
										$schedule_speaker_check = $schedule["multi_speaker_choose"];
										$schedule_speaker       = $schedule_speaker_check["yes"]["multi_speakers"];
										if ( $schedule_speaker_check["style"] == "yes" ) { //multi speaker style
											$schedule_speaker_multi = $schedule_speaker_check["yes"]['multi_speakers'];

											foreach ( $schedule_speaker_multi as $sp_key => $speaker ) {
												$multiple_speaker[] = exhibz_meta_option( $speaker, "exhibs_photo" );
												$speaker = exhibz_meta_option($schedule["speakers"], "exhibs_photo", '');
												$speaker_image_id = !empty($speaker["id"]) ? $speaker["id"] : '';
												$single_sp = get_post( $speaker );
												if ( $sp_key == 0 ) {
													$speaker_one    = $single_sp->post_title;
													$speaker_id_one = $single_sp->ID;
												}
												if ( $sp_key == 1 ) {
													$speaker_two    = $single_sp->post_title;
													$speaker_id_two = $single_sp->ID;
												}
												if ( $sp_key == 2 ) {
													$speaker_three    = $single_sp->post_title;
													$speaker_id_three = $single_sp->ID;
												}
											}
										} else { //single speaker
											if ( is_string( $schedule["speakers"] ) && $schedule["speakers"] != '' ) {
												$multiple_speaker[] = exhibz_meta_option( $schedule["speakers"], "exhibs_photo" );
												
												if ( $schedule["speakers"] != '' && $schedule["speakers"] > 0 ) {

													$q              = get_post( $schedule["speakers"] );
													$speaker_one    = $q->post_title;
													$speaker_id_one = $q->ID;
												}
											} // single speaker
										}
									}
								} else {

									if ( is_string( $schedule["speakers"] ) && $schedule["speakers"] != '' ) {
										$multiple_speaker[] = exhibz_meta_option( $schedule["speakers"], "exhibs_photo" );
										if ( $schedule["speakers"] != '' && $schedule["speakers"] > 0 ) {
											$q              = get_post( $schedule["speakers"] );
											$speaker_one    = $q->post_title;
											$speaker_id_one = $q->ID;
										}
									} // single speaker

								}


								?>
                                <div class="schedule-listing multi-schedule-list">
                                    <div class="schedule-slot-time">
                                        <span> <?php echo esc_html( $schedule["schedule_time"] ); ?> </span>
                                    </div>

                                    <div class="schedule-slot-info">
									<?php if ( $schedule['style'] == true ) :
											$multiple_speaker = $schedule["multi_speakers"];
											$speaker_query = get_posts( [
												'post_type'      => 'ts-speaker',
												'posts_per_page' => 3,
												'post__in'       => $multiple_speaker,
											] );
										 if ( count( $multiple_speaker ) ) : ?>
                                            <div class="<?php echo count( $multiple_speaker ) == 1 ? 'single-speaker' : 'multi-speaker' ?>">

												<?php foreach ( $multiple_speaker as $key => $value ) {
													$single_speaker = get_post( $value );
													$speaker_name = $single_speaker->post_title;
													$speaker_id = $single_speaker->ID;
													$speaker_image_meta = exhibz_meta_option( $speaker_id, "exhibs_photo" );
													$speaker_image_id = ! empty( $speaker_image_meta['id'] ) ? $speaker_image_meta['id'] : '';
													 ?>
                                                    <div class="speaker-content">
														<?php ++ $key;
															 
														if ( isset( $speaker_image_id ) ) :
															
														 ?>
															<a rel="noreferrer"
																href="<?php echo esc_url( get_the_permalink( $speaker_id ) ); ?>">
															<img class="schedule-slot-speakers <?php echo esc_attr( "speaker-img-" . $key ); ?>"
																		src="<?php echo wp_get_attachment_url( $speaker_image_id, 'thumbnail' ); ?>"
																		title="<?php echo esc_attr( $speaker_name ); ?>"
																		alt="<?php echo esc_attr( "speaker-" . $key ); ?>">
															</a>
															<p class="schedule-speaker <?php echo esc_attr( "speaker-" . $key ); ?>">
															<?php echo exhibz_kses( $speaker_name ); ?>
															</p>	
														<?php endif; ?>  
                                                    </div>

												<?php } ?>
												

                                            </div>
										<?php elseif ( $schedule["speakers"] == '' ) : ?>
                                            <div class="single-speaker ts-break"></div>
										<?php endif; ?>

										<?php else :
												$schedule_single_speaker = $schedule["speakers"];
												if ( $schedule_single_speaker != '' ) {
													$single_speaker_query      = get_post( $schedule_single_speaker );
													$single_speaker_name       = $single_speaker_query->post_title;
													$single_speaker_id         = $single_speaker_query->ID;
													$single_speaker_image_meta = exhibz_meta_option( $single_speaker_id, "exhibs_photo" );
													$single_speaker_image_id   = ! empty( $single_speaker_image_meta['id'] ) ? $single_speaker_image_meta['id'] : '';
												}
												?>
                                                <div class="single-speaker">
                                                    <a href="<?php echo get_the_permalink( $single_speaker_id ); ?>">
														<?php echo wp_get_attachment_image( $single_speaker_image_id, 'thumbnail', false, [ 'class' => 'schedule-slot-speakers' ] ); ?>
                                                    </a>
                                                    <p class="schedule-speaker"><?php echo exhibz_kses( $single_speaker_name ); ?></p>
                                                </div>
											<?php endif; ?>


                                        <div class="schedule-slot-info-content">

                                            <h3 class="schedule-slot-title">
												<?php echo esc_html( $schedule["schedule_title"] ); ?>
                                            </h3>
                                            <p>
												<?php echo exhibz_kses( $schedule["schedule_note"] ); ?>
                                            </p>
                                        </div>
                                        <!--Info content end -->
                                    </div>
                                    <!-- Slot info end -->
                                </div>
                                <!--schedule-listing end -->
							<?php } ?>
                            <!--schedule-listing end -->
                            <div class="schedule-listing-btn">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container end-->
    </section>
<?php } ?>
