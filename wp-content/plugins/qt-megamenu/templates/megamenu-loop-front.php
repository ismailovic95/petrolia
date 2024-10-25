<?php  
/**
 * @package qt-megamenu
 */

?>
<div id="qt-megamenu" class="qt-megamenu__container">
	<?php 
	/**
	 * Loop
	 */
	while ( $wp_query->have_posts() ) : $wp_query->the_post();
		$post = $wp_query->post;
		setup_postdata( $post );
		?>
		<div id='qt-megamenu-item-<?php echo get_the_ID(); ?>' <?php post_class( 'qt-megamenu__item' ); ?> >
			<div class="qt-megamenu__itemcontent">
				<?php  
				echo get_the_content( get_the_ID() );
				?>
			</div>
		</div>
		<?php
	endwhile;
	?>
</div>