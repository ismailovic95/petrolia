<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

get_header(); 

// Customizer sidebar settings
$hassidebar =  get_theme_mod( 'evenz_postsidebar' );

if ( have_posts() ) : while ( have_posts() ) : the_post(); 

	// Design override
	$override = get_post_meta($post->ID, 'evenz_post_template', true); // see custom-types/post/post.php

	switch( $override ){
		case '2': // force sidebar
			$hassidebar = '1';
			break;
		case '1': // force full
			$hassidebar = false;
			break; 
	}


	if( $hassidebar ){
		$post_class = 'evenz-pagecontent evenz-single evenz-single__sidebar';
	} else {
		$post_class = 'evenz-pagecontent evenz-single evenz-single__nosidebar';
	}

	?>
	<div id="evenz-pagecontent"  <?php post_class( $post_class ); ?>>


		<div class="evenz-paper">
			<?php  	
			/**
			 * ======================================================
			 * Single post header template
			 * ======================================================
			 */
			set_query_var( 'evenz_header_wavescolor', get_theme_mod( 'evenz_paper', '#ffffff' ) ) ; // set waves color
			get_template_part( 'template-parts/pageheader/pageheader-single' ); 
			?>
		</div>
		<div class="evenz-maincontent">
			<?php 
			/**
			 * ======================================================
			 * Content
			 * ======================================================
			 */
			
			if ( post_password_required() ) {
				get_template_part( 'template-parts/single/protected' );
			} else {
				/**
				 * ======================================================
				 * Customizable layout
				 * ======================================================
				 */
				if( $hassidebar ) {
					get_template_part( 'template-parts/single/single-sidebar' );
				} else {
					get_template_part( 'template-parts/single/single-full' );
				}
			}
			?>
		</div>
	</div>
	<?php 
endwhile; endif; 

get_footer();