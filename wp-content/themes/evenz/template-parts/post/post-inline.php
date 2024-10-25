<?php
/**
 * 
 * Template part for displaying posts with inline design
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/
$classes = array( 'evenz-post' , 'evenz-post__inline', 'evenz-paper' );
?>
<article <?php post_class( $classes ); ?>>
	<?php  
	if( has_post_thumbnail()){
	?>
	<a class="evenz-thumb evenz-duotone" href="<?php the_permalink(); ?>">
		<?php 
		the_post_thumbnail( 'evenz-squared-s', array( 'class' => 'evenz-post__thumb', 'alt' => esc_attr( get_the_title() ) ) ); 
		?>
	</a>
	<?php  
	}
	?>
	<h6><a class="evenz-cutme-t-2" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
	<p class="evenz-meta evenz-small">
		<i class="material-icons">today</i><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
	</p>
</article>