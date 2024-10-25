<?php
/**
 * 
 * Template part for displaying posts
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.1.5
*/

$classes = array('evenz-post','evenz-paper', 'evenz-post__ver');
if( has_post_thumbnail( ) ){
	$classes[] = 'evenz-has-thumb';
} else {
	$classes[] = 'evenz-no-thumb';
}

?>
<article <?php post_class( $classes ); ?>>
	<?php 
	/**
	 * Display header if we have the thumbnail
	 */
	if( has_post_thumbnail() ){
		?>
		<div class="evenz-post__header evenz-gradprimary evenz-negative">
			<div class="evenz-bgimg evenz-duotone">
				<?php 
				if( has_post_thumbnail() ){
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
				}; 
				?>
			</div>
			<div class="evenz-post__headercont">
				<?php 
				get_template_part( 'template-parts/post/item-metas' ); 
				get_template_part( 'template-parts/shared/actions' ); 
				?>
			</div>
			<span class="evenz-hov"></span>
		</div>
		<?php 
	}
	?>
	<div class="evenz-post__content evenz-paper">
		<p class="evenz-meta evenz-small">
			<?php get_template_part( 'template-parts/post/metas' );  ?>
		</p>
		<h3 class="evenz-post__title evenz-h5 evenz-cutme-t-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php  
		/**
		 * Display excerpt if the thumbnail is missing
		 */
		if( false == has_post_thumbnail( ) ){
			
			add_filter( 'excerpt_length', 'evenz_excerpt_post_vertical', 999 ); ?>

			<p class="evenz-post__ex"><?php echo get_the_excerpt(); ?></p>
			<p class="evenz-post__readmore"><a href="<?php the_permalink( ); ?>" class="evenz-btn evenz-btn__s"><?php esc_html_e( 'Read more', 'evenz' ); ?></a></p>

			<?php 
			
			add_filter( 'excerpt_length', 'evenz_excerpt_length', 999 ); 
			
		}
		?>
	</div>
</article>