<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Latest posts list
 *
 * Example:
 * [qt-post-list post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/


if(!function_exists('evenz_schedule_shortcode')) {
	function evenz_schedule_shortcode($atts){

		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			'include_by_id' => false,		
		), $atts ) );

		

		if( !$include_by_id ){
			return esc_html__( 'No ID selected', 'evenz' );
		}


		if( !is_string( get_post_status( $include_by_id ) ) ){
			return esc_html__( 'Invalid ID', 'evenz' );
		}


		$schedules = explode(',',$include_by_id );

		if( 0 == count( $schedules )){
			return esc_html__( 'No schedules selected', 'evenz' );
		}



		/**
		 * Output object start
		 */

		ob_start();
		
		if(!function_exists('evenz_schedule_display')){
			return esc_html__('Missing schedule functionality in this theme', 'evenz');
		}

		$schedulesarray = [];
		
		/**
		 * ================================================
		 * Array of entities
		 * ================================================
		 */
		foreach ($schedules as $schedule_id) {

			$schedulesarray[$schedule_id] = array(
				'title' => get_the_title( trim( $schedule_id ) ),
				'unique_schedule_id'=>'evenz-shortcodeschedule-'.trim($schedule_id)
			);

		}

		?>
		<div class="evenz-schedule-shortcode">
			<div class="evenz-program evenz-tabs" data-evenz-tabs>
				<?php 

				/**
				 * ================================================
				 * Tabs
				 * ================================================
				 */
				if( count( $schedulesarray ) > 1  ){
					?>
					<a href="#" class="evenz-btn evenz-btn__full evenz-tabs__switch" data-evenz-switch="open" data-evenz-target="#evenz-tabslist"><?php esc_html_e("Select", 'evenz'); ?> <i class="material-icons">arrow_drop_down</i></a>
					<ul class="evenz-tabs__menu evenz-paper" id="evenz-tabslist">
						<?php  
						foreach( $schedulesarray as $id => $p ){
							?>
							<li><a href="#<?php echo esc_attr( $p['unique_schedule_id'] ); ?>" class="evenz-btn" data-evenz-switch="open" data-evenz-target="#evenz-tabslist"><?php echo esc_html(  $p['title'] ); ?></a></li>
							<?php
						}
						?>
					</ul>
					<?php
				}

				/**
				 * ================================================
				 * Contents
				 * ================================================
				 */
				foreach ($schedulesarray as $schedule_id => $p ) {
					$schedule = evenz_schedule_display( $schedule_id , false); // no output
					if( $schedule && $schedule !== ''){
						?>
						<div id="<?php echo esc_attr( $p['unique_schedule_id'] ); ?>" class="evenz-tabs__content">
							<?php
							echo wp_kses_post( $schedule );
							?>
						</div>
						<?php
					} else {
						esc_html_e( 'This schedule has is still empty', 'evenz' );
					}
				}

				?>
			</div>
		</div>

		<?php

		wp_reset_postdata();

		/**
		 * Loop end;
		 */
		
		return ob_get_clean();
	}
}

if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-schedule","evenz_schedule_shortcode");
}


/**
 *  Visual Composer integration
 */

if(!function_exists('evenz_schedule_shortcode_vc')){
	add_action( 'vc_before_init', 'evenz_schedule_shortcode_vc' );
	function evenz_schedule_shortcode_vc() {
	  vc_map( array(
		 "name" => esc_html__( "Schedule", "evenz" ),
		 "base" => "qt-schedule",
		 "icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/events.png' ),
		 "description" => esc_html__( "Display a single schedule", "evenz" ),
		 "category" => esc_html__( "Theme shortcodes", "evenz"),
		 "params" => array(
			array(
			   	'type' 			=> 'autocomplete',
				'heading' 		=> esc_html__( 'Choose schedule by title', 'evenz'),
				'param_name' 	=> 'include_by_id',
				'settings'		=> array( 
					'values' 			=> evenz_autocomplete('evenz_schedule') ,
					'multiple'       	=> true,
					'sortable'       	=> true,
	          		'min_length'     	=> 1,
	          		'groups'         	=> false,
	          		'unique_values'  	=> true, 
	          		'display_inline' 	=> true,
				),
				'dependency' => array(
					'element' => 'post_type',
					'value' => array( 'ids' ),
				),
			),
		 )
	  ) );
	}
}


		



