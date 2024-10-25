<?php
/**
 * 
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

$classes = array( 'evenz-post evenz-post__card','evenz-darkbg evenz-negative' )
?>
<article <?php post_class( $classes ); ?>>
	<div class="evenz-bgimg evenz-bgimg--full evenz-duotone">
		<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'evenz-squared-m', array( 'class' => 'evenz-post__thumb') ); } ?>
	</div>
	<div class="evenz-post__headercont">
		<?php  
		get_template_part( 'template-parts/shared/actions' ); 
		?>
		<ul class="evenz-itemmetas evenz-hide-on-med-and-down">
			
			<li><?php echo evenz_do_shortcode('[ttg_reaktions-views-raw]' ); ?></li>
			<li><?php echo evenz_do_shortcode('[ttg_reaktions-commentscount-raw]' ); ?></li>
			<li><?php echo evenz_do_shortcode('[ttg_reaktions-loveit-raw]' ); ?></li>
		</ul>
		<div class="evenz-post__card__cap">
			<p class="evenz-meta evenz-small">
			<?php get_template_part( 'template-parts/post/metas' );  ?>
			</p>
			<h3 class="evenz-post__title evenz-cutme-t-3 evenz-h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div>
	</div>
	<span class="evenz-hov"></span>
</article>