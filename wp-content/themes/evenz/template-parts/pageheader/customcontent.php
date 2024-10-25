<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Display the page editor content in the first page of archives
*/


/**
 *
 *  This template can be used also as page template.
 *  In this case we show the page content only if is a page and is page 1
 * 
 */
$paged = evenz_get_paged();


if(is_page()){
	if($paged == 1){
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			$content = the_content();
			if( $content != '' && !is_wp_error( $content ) ){
			?>
			<div class="evenz-customcontent-firstpage evenz-spacer-l">
				<div class="evenz-container">
					<?php the_content(); ?>
				</div>
			</div>
			<?php
			}
		endwhile; endif;
	}
}
wp_reset_postdata();