<?php 
use \Etn\Utils\Helper as Helper;
$data = Helper::user_data_query( $etn_speaker_count, $etn_speaker_order, $speakers_category, $orderby );

$swiper_class = \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container';?>
        <div class="<?php echo esc_attr($this->get_name()); ?>" data-widget_settings='<?php echo json_encode($settings); ?>'>
            <?php if (!empty($settings['enable_carousel']) && $settings['enable_carousel'] == 'yes') : ?>
            <div class="<?php echo esc_attr($swiper_class); ?>">
                <div class="swiper-wrapper">
                    <?php else: ?>
                    <div class="speakers-grid">
                        <?php endif;
                        ?>
                        <?php
                        foreach ($data as $post):
                            $speaker_overlay_color = get_user_meta($post->ID, 'user_custom_color', true);
                            $speaker_overlay_blend_mode = 'darken';
                            $etn_speaker_designation = get_user_meta( $post->data->ID , 'etn_speaker_designation', true);
                            $etn_speaker_image = get_user_meta( $post->data->ID, 'image', true);
                            $social = get_user_meta( $post->data->ID, 'etn_speaker_social', true);
                            $author_id = get_the_author_meta($post->data->ID);
                            $speaker_name = $post->data->display_name;
                            ?>
                            <div class="speaker-item <?php echo esc_attr($item_class); ?>"
                                 style="--speaker-overlay-color: <?php echo esc_attr($speaker_overlay_color); ?>; --speaker-overlay-blend-mode: <?php echo esc_attr($speaker_overlay_blend_mode); ?>">
                                <a href="<?php echo Helper::get_author_page_url_by_id($post->data->ID); ?>" class="exhibz-img-link">
                                    <div class="speaker-thumb">
                                        <?php
                                        if (!empty( $etn_speaker_image )) {
                                            ?>
                                                <img src="<?php echo esc_url($etn_speaker_image); ?>"
                                                    alt="<?php the_title_attribute($post->data->ID); ?>">
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </a>
                                <div class="speaker-content-wrapper">
                                    <div class="etn-speakers-social">
                                        <?php
                                        if (is_array($social)  & !empty( $social )) { 
                                            ?>
                                            <?php 
                                            foreach ($social as $social_value) {  
                                                if(!empty($social_value)){
                                                    ?>
                                                    <a href="<?php echo esc_url($social_value["etn_social_url"]); ?>">
                                                        <i class="etn-icon <?php echo esc_attr($social_value["icon"]); ?>"></i>
                                                    </a>
                                                    <?php  
                                                }
                                            }
                                        } 
                                        ?>
                                    </div>
                                    <div class="speaker-information">
                                        <h3 class="exh-speaker-title">
                                            <a href="<?php echo Helper::get_author_page_url_by_id($post->data->ID); ?>"><?php echo esc_html($speaker_name); ?></a>
                                        </h3>
                                        <?php if($etn_speaker_designation !=''): ?>
                                            <p class="exh-speaker-designation">
                                                <?php
                                                    echo esc_html($etn_speaker_designation);                                               
                                                ?>
                                            </p>
                                        <?php endif; ?>
                                        <a class="speaker-details-arrow"
                                           href="<?php echo Helper::get_author_page_url_by_id($post->data->ID); ?>">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                        wp_reset_postdata();
                        ?>
                        <?php if (!empty($settings['enable_carousel']) && $settings['enable_carousel'] == 'yes') : ?>
                    </div>
                </div>
                <?php if ($settings['show_navigation'] == 'yes') { ?>
                    <div class="speaker-slider-nav-item swiper-button-prev swiper-prev-<?php echo esc_attr($this->get_id()); ?>">
                        <?php \Elementor\Icons_Manager::render_icon($settings['left_arrow_icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                    <div class="speaker-slider-nav-item swiper-button-next swiper-next-<?php echo esc_attr($this->get_id()); ?>">
                        <?php \Elementor\Icons_Manager::render_icon($settings['right_arrow_icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                <?php } ?>
                <?php if ($settings['enable_scrollbar'] == 'yes') { ?>
                    <div class="exhibz-speaker-scrollbar swiper-pagination">
                    </div>
                <?php } ?>
                <?php else: ?>
            </div>
        <?php endif; ?>

        </div>