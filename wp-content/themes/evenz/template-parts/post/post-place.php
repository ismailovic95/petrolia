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
			<div class="evenz-bgimg evenz-bgimg--full evenz-duotone">
				<?php 
				if( has_post_thumbnail() ){
					the_post_thumbnail( 'evenz-squared-m', array( 'class' => 'evenz-post__thumb') );
				}; 
				?>
			</div>
			<div class="evenz-post__headercont">
				<?php 
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
			<i class="material-icons">public</i><?php echo esc_attr( get_post_meta( $post->ID, 'qt_country', true )); ?> <i class="material-icons">location_on</i><?php echo esc_attr( get_post_meta( $post->ID, 'qt_city', true )); ?>
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