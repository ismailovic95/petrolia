<?php
/**
 * 
 * Template part for displaying posts with Hero design (title in image)
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

$series = false;
if( function_exists( 'qt_series_custom_series_name' )){
	$series = get_the_terms( $post->ID, qt_series_custom_series_name());
}

$format = get_post_format( $post->ID );
if(!$format) {
	$format = 'std';
}
add_filter( 'excerpt_length', 'evenz_excerpt_length_40', 999 );
?>
<article id="evenz-slider-post-<?php the_ID(); ?>" class="evenz-slider__item evenz-negative">
	<div class="evenz-slider__img">
		<?php 
		if( has_post_thumbnail( $post->ID )){
			the_post_thumbnail( 'full', array( 'class' => 'evenz-slider__i', 'alt' => esc_attr( get_the_title() ) ) );
		}
		?>
	</div>
	<div class="evenz-slider__c">
		<div class="evenz-container">
			<h6 class="evenz-capfont evenz-slider_det">
				<span class="evenz-p-catz"><?php evenz_postcategories( 1 ); ?></span> <span class="evenz-p-auth"><?php the_author(); ?></span>
			</h6>
			<h2 class="evenz-caption evenz-post__title evenz-cutme-t-3" data-evenz-text="<?php echo esc_attr( get_the_title() ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="evenz-cutme-t-3">
				<?php 
				add_filter( 'excerpt_length', 'evenz_excerpt_length_30', 999 ); 
				echo get_the_excerpt(); 
				add_filter( 'excerpt_length', 'evenz_excerpt_length', 999 ); 
				?>
			</p>
			<div class="evenz-slider__btns">
				<a href="<?php the_permalink(); ?>" class="evenz-btn evenz-btn-primary evenz-btn__bold evenz-icon-l"><i class="material-icons">play_arrow</i><?php esc_html_e( 'Read All', 'evenz' ); ?></a>
			</div>
		</div>
		<?php 
		/**
		 * Action content
		 * ===============================
		 */
		?>
	</div>
		
</article>
<?php  
add_filter( 'excerpt_length', 'evenz_excerpt_length', 999 );