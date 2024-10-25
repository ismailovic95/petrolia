<?php  
/**
 * @package qt-megamenu
 */
?>
<div id='qt-megamenu-item-<?php echo get_the_ID(); ?>' <?php post_class( 'qt-megamenu__item' ); ?> >
	<div class="qt-megamenu__itemcontent">
		<?php  
		echo get_the_content( get_the_ID() );
		?>
	</div>
</div>

