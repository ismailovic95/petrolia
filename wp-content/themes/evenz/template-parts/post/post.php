<?php
/**
 * 
 * Template part for displaying posts default style
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

$classes = array('evenz-post', 'evenz-paper', 'evenz-post__std');
if( has_post_thumbnail( ) ){
	$classes[] = 'evenz-has-thumb';
}

$size_class="evenz-h3";

if( is_sticky() ){
	$classes[] = 'evenz-primary evenz-negative';
	$size_class="evenz-h2";
}

?>
<article <?php post_class( $classes ); ?>>
	
	<?php 
	if( has_post_thumbnail() ){
		?>
		<div class="evenz-post__header evenz-primary-light  evenz-negative">
			<div class="evenz-bgimg evenz-duotone">
				<?php  
				/**
				 * Featured image with special class for vertical
				 * @var array
				 */
				$classes = ['evenz-post__holder'];
				$post_thumbnail_id = get_post_thumbnail_id( );
				$imgmeta = wp_get_attachment_metadata( $post_thumbnail_id );
				if ( $imgmeta[ 'height' ] > $imgmeta[ 'width' ]  ) {
					$classes[] = 'evenz-post__thumb--v';
				} else {
					$classes[] = 'evenz-post__thumb--h';
				}
				$classes = esc_attr( implode(' ', $classes ) );
				the_post_thumbnail( 'large', array( 'class' => $classes ) );
				?>
			</div>
			<div class="evenz-post__headercont">
				<?php 
				get_template_part( 'template-parts/post/item-metas' ); 
				get_template_part( 'template-parts/shared/actions' ); 
				?>
			</div>
		</div>
		<?php 
	} 
	?>

	<div class="evenz-post__content">
		
		
		<p class="evenz-meta evenz-small">
			<?php get_template_part( 'template-parts/post/metas' );  ?>
		</p>

		<h3 class="evenz-post__title <?php echo esc_attr( $size_class ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		
		<div class="evenz-excerpt">
			<?php the_excerpt(); ?>
			<p class="evenz-post__readmore"><a href="<?php the_permalink( ); ?>" class="evenz-btn evenz-btn__s"><?php esc_html_e( 'Read more', 'evenz' ); ?></a></p>
		</div>

	</div>

</article>