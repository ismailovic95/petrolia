<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * 
*/

if(!function_exists('evenz_countdown_shortcode')) {
	function evenz_countdown_shortcode($atts){

		extract( shortcode_atts( array(
			'include_by_id' => false,
			'size' => '3',
			'align' => false,
			'labels' => false,
			'style' => 'default',
			'color_text' => '',
			'color_border' => '',
			'color_bg' => '',
			'color_bgn' => '',
			'bwidth' => '',
			'show_ms' => false
		), $atts ) );


		/**
		 * Output start
		 */
		ob_start();

		if( !$include_by_id ){
			return esc_html__( 'No ID selected', 'evenz' );
		}

		if( !is_string( get_post_status( $include_by_id ) ) ){
			return esc_html__( 'Invalid ID', 'evenz' );
		}

		/**
		 * ========================================
		 * Create a unique ID for the custom css
		 * ========================================
		 */
		$uniqstring = implode('',$atts);
		$tempid = md5(implode('',$atts));
		$cid = 'evenz-countdown--'.$tempid; 


		$css_styles = [];
		$selector = '.'.$cid;
		if( $color_text ) {
			$css_styles[] = $selector.' .evenz-countdown__container { color: '.esc_attr($color_text).'} ';
		}
		if( $color_border ) {
			$css_styles[] = $selector.'.evenz-countdown--bricks .evenz-countdown__i { border-color: '.esc_attr($color_border).'} ';
			$css_styles[] = $selector.'.evenz-countdown--boxed .evenz-countdown__container { border-color: '.esc_attr($color_border).'} ';
		}
		if( $color_bg ) {
			$css_styles[] = $selector.' .evenz-countdown__container { background-color: '.esc_attr($color_bg).'} ';
		}
		if( $color_bgn ) {
			$css_styles[] = $selector.' .evenz-countdown__i { background-color: '.esc_attr($color_bgn).'} ';
		}
		if( $bwidth ){
			$css_styles[] = $selector.'.evenz-countdown--bricks .evenz-countdown__i { border-width: '.esc_attr($bwidth).'} ';	
			$css_styles[] = $selector.'.evenz-countdown--boxed .evenz-countdown__container { border-width: '.esc_attr($bwidth).'} ';	
		}
		
		
		if( count( $css_styles ) > 0 ){
			$css_styles = implode(' ', $css_styles );
			?>
			<div data-evenz-customstyles="<?php echo wp_strip_all_tags( $css_styles ); ?>"></div>
			<?php 
		}


		
		$date = get_post_meta($include_by_id, 'evenz_date',true);


		$day = '';
		$monthyear = '';

		if($date && $date != ''){
			$day = date( "d", strtotime( $date ));
			$monthyear=esc_attr(date_i18n("M Y",strtotime($date)));
		}

		$time = get_post_meta($include_by_id, 'evenz_time',true);
		$now =  current_time("Y-m-d").'T'.current_time("H:i");
		$location = get_post_meta($include_by_id, 'evenz_location',true);
		$address = get_post_meta($include_by_id, 'evenz_address',true);

		$classes = array( 
			'evenz-countdown-shortcode'
		);

		if( $align ){
			$classes[] = 'evenz-countdown-shortcode--'.$align;
		}
		if( $style ){
			$classes[] = 'evenz-countdown--'.$style;
		}

		$classes[] = $cid;

		if( $labels == 'full' ){
			$classes[] 	= 	'evenz-countdown-shortcode--labels';
			$label_d 	=  	esc_html__( "Days",'evenz' );
			$label_h 	=  	esc_html__( "Hours",'evenz' );
			$label_m 	=  	esc_html__( "Minutes",'evenz' );
			$label_s 	=  	esc_html__( "Seconds",'evenz' );
			$label_ms 	=  	esc_html__( "Milliseconds",'evenz' );

		} else if ( $labels == 'inline' ){
			$classes[] 	= 	'evenz-countdown-shortcode--labels-inline';
			$label_d 	=   esc_html_x( 'D', 'Letter label for days', 'evenz' );
			$label_h 	=  	esc_html_x( 'H', 'Letter label for hours', 'evenz' );
			$label_m 	= 	esc_html_x( 'M', 'Letter label for minutes', 'evenz' );
			$label_s 	=  	esc_html_x( 'S', 'Letter label for seconds', 'evenz' );
			$label_ms 	=  	esc_html_x( 'MS', 'Letter label for milliseconds', 'evenz' );
		}

		$classes = implode(' ', $classes );

		if( $date && $date !== '' && $date > $now){
			?>
			<span id="<?php echo esc_attr( $cid ); ?>" class="<?php echo esc_attr( $classes ); ?>">
				<span class="evenz-countdown__container">
					<span class="evenz-countdown  evenz-countdown-size--<?php echo esc_attr( $size ); ?>" 
					data-evenz-date="<?php echo esc_attr( $date ); ?>" 
					data-evenz-time="<?php echo esc_attr( $time ); ?>" 
					data-evenz-now="<?php echo esc_attr( $now ); ?>">
						<span class="evenz-countdown__i d"><span class="n"></span><span class="l"><?php echo esc_html( $label_d ); ?></span></span>
						<span class="evenz-countdown__i h"><span class="n"></span><span class="l"><?php echo esc_html( $label_h ); ?></span></span>
						<span class="evenz-countdown__i m"><span class="n"></span><span class="l"><?php echo esc_html( $label_m ); ?></span></span>
						<span class="evenz-countdown__i s"><span class="n"></span><span class="l"><?php echo esc_html( $label_s ); ?></span></span>
						<?php if( $show_ms ){ ?><span class="evenz-countdown__i ms"><span class="n"></span><span class="l"><?php echo esc_html( $label_ms ); ?></span></span><?php } ?>
					</span>
				</span>
			</span>
			<?php  
		}
		/**
		 * Output end
		 */
		return ob_get_clean();
	}
}

if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-countdown","evenz_countdown_shortcode");
}


/**
 *  Visual Composer integration
 */

if(!function_exists( 'evenz_countdown_shortcode_vc' ) ){
	add_action( 'vc_before_init', 'evenz_countdown_shortcode_vc' );
	function evenz_countdown_shortcode_vc() {
	  vc_map( array(
		 "name" => esc_html__( "Countdown", "evenz" ),
		 "base" => "qt-countdown",
		 "icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/events-featured.png' ),
		 "description" => esc_html__( "Show only a countdown", "evenz" ),
		 "category" => esc_html__( "Theme shortcodes", "evenz"),
		 "params" => array(
			array(
				'type' 			=> 'autocomplete',
				'heading' 		=> esc_html__( 'Event', 'evenz'),
				'param_name' 	=> 'include_by_id',
				'settings'		=> array( 
					'values' 		=> evenz_autocomplete('evenz_event') ,
					'multiple'       => false,
					'sortable'       => false,
	          		'min_length'     => 1,
	          		'groups'         => false,  // In UI show results grouped by groups
	          		'unique_values'  => true,  // In UI show results except selected. NB! You should manually check values in backend
	          		'display_inline' => true, // In UI show results inline view),
				),
				'dependency' => array(
					'element' 		=> 'post_type',
					'value' 		=> array( 'ids' ),
				),
			),
			array(
				'heading' 	=> esc_html__( 'Labels', 'evenz'),
				"type" 		=> "dropdown",
				"param_name"=> "labels",		
				'std'		=> false,
				'value' 	=> array( 
					esc_html__('Hidden', 'evenz' ) 	=> false,
					esc_html__('Full', 'evenz' ) 	=> 'full',
					esc_html__('Inline', 'evenz' ) 	=> 'inline',
				)	
			),

			array(
				'heading' 	=> esc_html__( 'Show milliseconds', 'evenz'),
				"type" 		=> "checkbox",
				"param_name"=> "show_ms",		
				'std'		=> false,
				'value' 	=> 'true'
			),

			array(
				'heading' 	=> esc_html__( 'Size', 'evenz'),
				"type" 		=> "dropdown",
				"param_name"=> "size",
				'std'		=> '3',
				'value' 	=> array( 
					'1','2','3','4','5','6','7','8','9','10'
					)			
			),

			array(
				'heading' 	=> esc_html__( 'Align', 'evenz'),
				"type" 		=> "dropdown",
				"param_name"=> "align",
				'value' 	=> array( 
					esc_html__('inline', 'evenz' ) 	=>'inline',
					esc_html__('center', 'evenz' ) 	=>'center',
					esc_html__('left', 'evenz' ) 	=> 'left',
					esc_html__('right', 'evenz' ) 	=> 'right',
				)			
			),

			array(
				'heading' 	=> esc_html__( 'Style', 'evenz'),
				"type" 		=> "dropdown",
				"param_name"=> "style",
				'std'		=> 'default',
				'value' 	=> array( 
					esc_html__('Default', 'evenz' ) => 'default',
					esc_html__('Bricks', 'evenz' ) 	=> 'bricks',
					esc_html__('Boxed', 'evenz' ) 	=> 'boxed'
				)			
			),
			array(
				"group" 	=> esc_html__( "Colors", "evenz" ),
			   	"type" 		=> "colorpicker",
			   	"heading" 	=> esc_html__( "Text", "evenz" ),
			   	"param_name"=> "color_text"
			),
			array(
				"group" 	=> esc_html__( "Colors", "evenz" ),
			   "type" 		=> "colorpicker",
			   "heading" 	=> esc_html__( "Borders", "evenz" ),
			   "param_name" => "color_border"
			),
			array(
				"group" 	=> esc_html__( "Colors", "evenz" ),
				'heading' 	=> esc_html__( 'Borders width', 'evenz'),
				"type" 		=> "textfield",
				"param_name"=> "bwidth",
			),
			array(
				"group" 	=> esc_html__( "Colors", "evenz" ),
			   	"type" 		=> "colorpicker",
			   	"heading" 	=> esc_html__( "Background", "evenz" ),
			   	"param_name"=> "color_bg"
			),
			array(
				"group" 	=> esc_html__( "Colors", "evenz" ),
			   	"type" 		=> "colorpicker",
			   	"heading" 	=> esc_html__( "Numbers background", "evenz" ),
			   	"param_name"=> "color_bgn"
			),
		 )
	  ) );
	}
}