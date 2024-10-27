<?php
defined('ABSPATH') || exit;
use \Etn\Utils\Helper;
use Etn\Templates\Event\Parts\EventDetailsParts;

$single_event_id = get_the_id();
$banner_bg_image = get_post_meta($single_event_id, 'event_banner', true);
?>
<?php do_action("etn_before_single_event_details", $single_event_id); ?>

<div class="etn-event-single-wrap main-container">
    <div class="etn-container">
        <?php  do_action("etn_before_single_event_container", $single_event_id); ?>

        <!-- Row start -->
        <div class="etn-row">
            <div class="etn-col-lg-8">
            
                <?php do_action("etn_before_single_event_content_wrap", $single_event_id); ?>

                <div class="etn-event-single-content-wrap">
                    
                    <?php if (has_post_thumbnail()) { ?>
                        <div class="etn-single-event-media">
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title_attribute(); ?>" />
                        </div>
                    <?php } else { ?>
                        <div class="etn-single-event-media">
                            <img src="<?php echo esc_url($banner_bg_image); ?>" alt="<?php the_title_attribute(); ?>" />
                        </div>
                        <?php } ?>

                    <?php do_action("etn_before_single_event_content_body", $single_event_id); ?>

                    <div class="etn-event-content-body">
                        <?php the_content(); ?>
                    </div>

                    <?php do_action("etn_after_single_event_content_body", $single_event_id); ?>
                    
                    
                </div>

                    <?php
                    if(class_exists('Wpeventin_Pro')) {
                        do_action("etn_after_single_event_details_rsvp_form", $single_event_id); 
                    }
                ?>
                
                <?php do_action("etn_after_single_event_content_wrap", $single_event_id); ?>

            </div><!-- col end -->

            <div class="etn-col-lg-4">
                <div class="etn-sidebar">
                        <?php                       if( \Etn\Utils\Helper::get_child_events($single_event_id) !== false) {

                            // It's recurring event
                            ?>
                            <div class="scroll recurring-event">
                            <a class="etn-recurring-title scroll" href="#etn-recurring-event-wrapper"><?php echo esc_html__( "Attend Event", 'exhibz' )?></a>
                            </div>

                            <?php                       }
                        ?>
                    <?php do_action("etn_before_single_event_meta", $single_event_id); ?>

                    <!-- event schedule meta end -->
                    <?php do_action("etn_single_event_meta", $single_event_id); ?>
                    <!-- event schedule meta end -->

                    <?php
                    global $post;
                    $current_event_id = get_queried_object_id();
                    $ticket_variation = get_post_meta($current_event_id,"etn_ticket_variations",true);
                    if ( is_array($ticket_variation) && count($ticket_variation) > 1 ) {
                        do_action("etn_after_single_event_meta", $single_event_id); 
                    } else {
                        etn_after_single_event_meta_add_to_calendar($single_event_id);
                        $etn_organizer_events = get_post_meta( $single_event_id, 'etn_event_organizer', true );
                        EventDetailsParts::event_single_organizers( $etn_organizer_events );
                    }
                    ?>

                </div>
                <!-- etn sidebar end -->
            </div>
            <!-- col end -->
        </div>
        <!-- Row end -->

        <?php  do_action("etn_after_single_event_container", $single_event_id); ?>

    </div>
</div>

<?php  do_action("etn_after_single_event_details", $single_event_id); ?>