<?php  
/**
 * @package qt-megafooter
 */

?>
<div id="qt-megafooter" class="qt-megafooter__container">
	<?php 
	/**
	 * Loop
	 */
	while ( $wp_query->have_posts() ) : $wp_query->the_post();
		$post = $wp_query->post;
		setup_postdata( $post );
		?>
		<div id='qt-megafooter-item-<?php echo get_the_ID(); ?>' <?php post_class( 'qt-megafooter__item' ); ?> >
			<div class="qt-megafooter__itemcontent">
				<?php  
				echo get_the_content( get_the_ID() );
				?>
			</div>
		</div>
		<?php
	endwhile;
	?>
</div>