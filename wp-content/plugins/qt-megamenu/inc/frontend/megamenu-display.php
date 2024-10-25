<?php
/**
 * @package qt-megamenu
 */

if(!function_exists('qt__megamenu_display')){
	// add_action('wp_footer', 'qt__megamenu_display');
	function qt__megamenu_display(){

		if( !function_exists('qt__megamenu_posttype_name')){
			return;
		}

		if ( get_post_type( get_the_ID() ) === qt__megamenu_posttype_name() ) {
			return;
		}

		if ( isset( $_GET['vc_editable'] ) && 'true' === $_GET['vc_editable'] ) {
			return;
		}

		$args = array(
			'post_type' 			=>  qt__megamenu_posttype_name(),
			'posts_per_page' 		=> -1,
			'post_status' 			=> 'publish',
			'paged' 				=> 1,
			'suppress_filters' 		=> false,
			'ignore_sticky_posts' 	=> 1,
			'orderby' 				=> array( 'orderby' => array( 'menu_order' => 'ASC' ) )
		);

		$wp_query = new WP_Query( $args );

		/**
		 * Display the mega menus
		 */
		if ( $wp_query->have_posts() ) { 
			?>
			<div id="qt-megamenu" class="qt-megamenu__container">
				<?php 
				/**
				 * Loop
				 */
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					global $post;
					$post = $wp_query->post;
					setup_postdata( $post );
					?>
					<div id='qt-megamenu-item-<?php echo get_the_ID(); ?>' <?php post_class( 'qt-megamenu__item' ); ?> >
						<div class="qt-megamenu__itemcontent">
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

