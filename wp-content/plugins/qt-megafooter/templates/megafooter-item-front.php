<?php  
/**
 * @package qt-megafooter
 */
?>
<div id='qt-megafooter-item-<?php echo get_the_ID(); ?>' <?php post_class( 'qt-megafooter__item' ); ?> >
	<div class="qt-megafooter__itemcontent">
		<?php  
		echo get_the_content( get_the_ID() );
		?>
	</div>
</div>

