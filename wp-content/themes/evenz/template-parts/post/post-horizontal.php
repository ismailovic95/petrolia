<?php
/**
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 *
 * Template part for displaying posts with horizontal design for desktop
*/

$classes = array('evenz-post','evenz-paper', 'evenz-post__hor');
if( has_post_thumbnail( ) ){
	$classes[] = 'evenz-has-thumb';
} else {
	$classes[] = 'evenz-no-thumb';
}
$classes = implode(' ', $classes);


add_filter( 'excerpt_length', 'evenz_excerpt_length_30', 999 );
?>
<article <?php post_class( esc_attr($classes) ); ?>>
	<?php 
	if( has_post_thumbnail() ){
		?>
		<div class="evenz-post__header evenz-primary-light evenz-negative">
			<div class="evenz-bgimg evenz-duotone">
				<?php 

				if( has_post_thumbnail( ) ){ 
					/**
					 * Featured image with special class for vertical
					 * @var array
					 */
					$classes = ['evenz-post__thumb'];
					$post_thumbnail_id = get_post_thumbnail_id( );
					$imgmeta = wp_get_attachment_metadata( $post_thumbnail_id );
					if ( $imgmeta[ 'height' ] > $imgmeta[ 'width' ]  ) {
						$classes[] = 'evenz-post__thumb--v';
					} else {
						$classes[] = 'evenz-post__thumb--h';
					}
					$classes = esc_attr( implode(' ', $classes ) );
					the_post_thumbnail( 'evenz-squared-m', array( 'class' => $classes ) );
				}
				?>
			</div>
			<span class="evenz-hov"></span>
			<div class="evenz-post__headercont">
				<?php 
				get_template_part( 'template-parts/post/item-metas' );
				get_template_part( 'template-parts/shared/actions' ); 
				?>
			</div>

		</div>
		<div class="evenz-post__content">
			<p class="evenz-meta evenz-small">
				<?php get_template_part( 'template-parts/post/metas' );  ?>
			</p>
			<h3 class="evenz-post__title evenz-cutme-t-3 evenz-h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p class="evenz-post__ex"><?php echo get_the_excerpt(); ?></p>
			<p class="evenz-post__readmore"><a href="<?php the_permalink( ); ?>" class="evenz-btn evenz-btn__s"><?php esc_html_e( 'Read more', 'evenz' ); ?></a></p>
			
		</div>
	<?php 
	} else {
		add_filter( 'excerpt_length', 'evenz_excerpt_length_40', 999 );
		
		?>
		<div class="evenz-post__content">
			<p class="evenz-meta evenz-small">
				<?php get_template_part( 'template-parts/post/metas' );  ?>
			</p>
			<h3 class="evenz-post__title evenz-cutme-t-2  evenz-h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php add_filter( 'excerpt_length', 'evenz_excerpt_length_30', 999 ); ?>
			<p class="evenz-post__ex"><?php echo get_the_excerpt(); ?></p>
			<p class="evenz-post__readmore"><a href="<?php the_permalink( ); ?>" class="evenz-btn evenz-btn__s"><?php esc_html_e( 'Read more', 'evenz' ); ?></a></p>
			<?php add_filter( 'excerpt_length', 'evenz_excerpt_length', 999 ); ?>
		</div>
		<?php
	}
	?>
</article>
<?php 
add_filter( 'excerpt_length', 'evenz_excerpt_length', 999 );