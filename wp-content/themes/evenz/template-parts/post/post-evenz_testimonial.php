<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

$author = get_post_meta( $post->ID, 'evenz_author', true );
$role = get_post_meta( $post->ID, 'evenz_role', true );
$classes = array( 'evenz-post','evenz-post__testimonial','evenz-darkbg evenz-negative' );
?>
<article <?php post_class( $classes ); ?>>
	<div class="evenz-bgimg evenz-bgimg--full evenz-duotone">
		<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'evenz-squared-m', array( 'class' => 'evenz-post__thumb') ); } ?>
	</div>
	<div class="evenz-post__headercont">
		<div class="evenz-post__testimonial__cap">
			<div class="evenz-capdec">
				<h5 class="evenz-capfont"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $author ); ?></a></h5>
				<p class="evenz-meta evenz-small"><?php echo esc_html( $role ); ?></p>
			</div>
			<p class="evenz-intro">
				"<?php the_title(); ?>"
			</p>
		</div>
	</div>
	<span class="evenz-hov"></span>
</article>