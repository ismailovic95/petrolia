<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */


?>
<div class="evenz-pageheader__nav-archive">
	<div class="evenz-pageheader__nav-container">
		<?php 
		$pagination_args = array(
			'type' => 'plain',
			'prev_next' => true,
			
			'before_page_number' => '<span class="evenz-num">',
			'after_page_number'  => '</span>',
			'mid_size' => 2,
			'prev_text'          => '<span class="evenz-btn evenz-btn__txt evenz-navlink evenz-navlink__p"><i class="material-icons">trending_flat</i>'.esc_html__('Previous page', 'evenz').'</span>',
			'next_text'          => '<span class="evenz-btn evenz-btn__txt evenz-navlink evenz-navlink__n">'.esc_html__('Next page', 'evenz')
			.'<i class="material-icons">trending_flat</i></span>',
		);
		$links = paginate_links( $pagination_args );

		if( $links ){
			echo paginate_links( $pagination_args ); 
		} else {

			/**
			 * This pagination is for the archive page templates
			 */
			$paged = evenz_get_paged();
			$args = array('posts_per_page' => 10, 'paged' => $paged );

			/**
			 * [$args Query arguments]
			 * @var array
			 */
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'suppress_filters' => false,
				'paged' => evenz_get_paged()
			);
			/**
			 * [$wp_query execution of the query]
			 * @var WP_Query
			 */
			$wp_query = new WP_Query( $args );
			if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
			endwhile;endif;
			echo paginate_links( $pagination_args ); 
		}
		?>
	</div>
</div>



