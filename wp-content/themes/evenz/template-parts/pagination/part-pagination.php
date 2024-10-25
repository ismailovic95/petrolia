<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */
?>
<?php
/**
 * ==================================
 * classic pagination numbers
 * ==================================
 */

if( ! isset($wp_query) ){ global $wp_query; }
$max = $wp_query->max_num_pages;
if($max > 1){
?>
<div id="evenz-pagination" class="evenz-wp-pagination evenz-row">
		<div class="evenz-clearfix  evenz-col evenz-s12 evenz-m12 evenz-l12">
			<div class="evenz-pagination"><?php
				// Do not go on new line with PHP tag.
				// Empty pagination will be hidden to avoid useless spacing.
				$args = array(
				'type' => 'plain',
				'prev_next' => true,
				'before_page_number' => '<span class="evenz-num evenz-btn evenz-btn__r">',
				'after_page_number'  => '</span>',
				'mid_size' => 2,
				'prev_text'          => '<span class="evenz-btn evenz-icon-l"><i class="material-icons">navigate_before</i>'.esc_html__('Previous', 'evenz').'</span>',
				'next_text'          => '<span class="evenz-btn evenz-icon-r">'.esc_html__('Next', 'evenz').'<i class="material-icons">navigate_next</i></span>',
				);
				echo paginate_links( $args ); 

				// Do not go on new line with PHP tag.
				// Empty pagination will be hidden to avoid useless spacing.
			?></div>
		</div>
</div>
<?php 
}
