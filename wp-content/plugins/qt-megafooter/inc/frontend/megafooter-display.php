<?php
/**
 * @package qt-megafooter
 */

if(!function_exists('qt_megafooter_display')){
	// add_action('wp_footer', 'qt_megafooter_display');
	function qt_megafooter_display(){

		if( !function_exists('qt_megafooter_posttype_name')){
			return;
		}

		if ( get_post_type( get_the_ID() ) === qt_megafooter_posttype_name() ) {
			return;
		}

		if ( isset( $_GET['vc_editable'] ) && 'true' === $_GET['vc_editable'] ) {
			// return;
		}

		// 
		// 
		// Check if the actual post has a special footer selected
		// 
		// 
		wp_reset_postdata();
		global $post;
		$granular_footer = get_post_meta( $post->ID,  'qt-megafooter-granular', true );
		if( $granular_footer == 'hide' ){
			return; // stop all, no footers here
		}

		if($granular_footer && $granular_footer != 'hide'){
			// Display a specific footer
			$args = array(
			  'p'         => intval($granular_footer), // ID of a page, post, or custom type
			  'post_type' => qt_megafooter_posttype_name()
			);
		} else {
			// Use global settings
			$args = array(
				'post_type' 			=>  qt_megafooter_posttype_name(),
				'posts_per_page' 		=> -1,
				'post_status' 			=> 'publish',
				'paged' 				=> 1,
				'suppress_filters' 		=> false,
				'ignore_sticky_posts' 	=> 1,
				'orderby' 				=> 'menu_order',
				'order'					=> 'ASC',
				'meta_query'	=> array(
					array(
						'key'	 	=> 'qt-megafooter-default',
						'value'	  	=> '1',
						'compare' 	=> '=',
					)
				),
			);
		}

		$wp_query = new WP_Query( $args );

		/**
		 * Display the mega footer
		 */
		if ( $wp_query->have_posts() ) { 
			?>
			<div id="qt-megafooter" class="qt-megafooter__container">
				<?php 
				/**
				 * Loop
				 */
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					global $post;
					$post = $wp_query->post;
					setup_postdata( $post );
					?>
					<div id='qt-megafooter-item-<?php echo get_the_ID(); ?>' <?php post_class( 'qt-megafooter__item' ); ?> >
						<div class="qt-megafooter__itemcontent">
							<?php  
							echo apply_filters('the_content', get_the_content( get_the_ID() ) );
							?>
						</div>
					</div>
					<?php
				endwhile;
				?>
			</div>
			<?php
			wp_reset_postdata();
		}	
		return;
	}
}

