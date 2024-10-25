<?php  
/**
 * Output the program of the event
 */

if(!function_exists('evenz_program_display')){
	function evenz_program_display($postid, $print){
		
		if( !$postid ) {
			return;
		}

		$programs = get_post_meta( $postid, 'evenz_program',true );
		if( empty( $programs ) ){
			return false;
		} 


		if( count( $programs ) <= 0  ){
			return trim( ob_get_clean() );
		}

		/**
		 * Check to be sure there is at least one
		 */
		$found = false;
		foreach( $programs as $program ){
			if($program['schedule'][0] !== ''){
				$found = true;
			}
		}

		if(!$found){
			return false;
		}




		if( count( $programs ) > 0  ){

			ob_start();


			/**
			 * ================================================
			 * Create an item with a unique ID for every schedule
			 * ================================================
			 */
			for( $n = 0; $n < count($programs) ;  $n++ ){
				if( isset( $programs[$n]['schedule'] ) ){
					$programs[$n]['unique_schedule_id'] = 'evenz-psched-'.$postid.'-'. $programs[$n]['schedule'][0].'-'.$n;
				}
			}


			?>
			<div id="evenz-program" class="evenz-program evenz-tabs" data-evenz-tabs>
				<?php 

				/**
				 * ================================================
				 * Tabs:
				 * - MOBILE: There is a button opening a modal
				 * - DESKTOP: buttons are shown as tabs
				 * ================================================
				 */
				if( count( $programs ) > 1  ){
					?>
					<a href="#" class="evenz-btn evenz-btn__full evenz-tabs__switch" data-evenz-switch="open" data-evenz-target="#evenz-tabslist"><?php esc_html_e("Select", 'evenz'); ?> <i class="material-icons">arrow_drop_down</i></a>
					<ul class="evenz-tabs__menu evenz-paper" id="evenz-tabslist">
						<?php  
						foreach( $programs as $p ){
							if( !isset( $p['unique_schedule_id']) ){
								continue;
							}
							// Create a unique ID for each schedule
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
				 * Programs
				 * ================================================
				 */
				$item_index = 0;
				if( count( $programs ) > 0  ){
					foreach( $programs as $p ){

						if( !isset( $p['unique_schedule_id'])  ){
							continue;
						}

						?>
							<div id="<?php echo esc_attr( $p['unique_schedule_id'] ); ?>" class="evenz-tabs__content">
								<?php  
								/**
								 * Schedule display
								 */
								evenz_schedule_display( $p['schedule'][0], true );  
								?>
							</div>
						<?php
						$item_index++;
					}
				}

				
				?>
			</div>
			<?php
			if($print){
				echo ob_get_clean();
				return;
			} else {
				return trim( ob_get_clean() );
			}
		}
		return false;
		
	}
}