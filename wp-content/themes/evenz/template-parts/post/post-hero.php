<?php
/**
 * 
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/
$classes = array('evenz-post' , 'evenz-post__hero ');
?>
<article id="post-hero-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="evenz-post__header evenz-darkbg evenz-negative">
		<div class="evenz-bgimg evenz-duotone">
			<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'large', array( 'class' => 'evenz-post__thumb') ); } ?>
		</div>
		<span class="evenz-hov"></span>
		<div class="evenz-post__headercont">
			<?php 
			get_template_part( 'template-parts/post/date' );
			get_template_part( 'template-parts/shared/actions' ); 
			get_template_part( 'template-parts/post/item-metas' ); 
			?>
			<div class="evenz-post__hero__caption">
				
				<p class="evenz-meta evenz-small">
					<span class="evenz-p-catz"><?php evenz_postcategories( 1 ); ?></span> <span class="evenz-p-auth"><?php the_author(); ?></span>
				</p>
				<h3 class="evenz-post__title evenz-h3 evenz-cutme-t-2"><a class="evenz-cutme-t-2" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			</div>
		</div>
	</div>
</article>