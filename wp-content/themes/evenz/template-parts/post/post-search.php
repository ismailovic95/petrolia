<?php
/**
 * 
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/
$classes = array( 'evenz-post','evenz-post__search' );
?>
<article <?php post_class( $classes ); ?>>
	
	<div class="evenz-post__content evenz-post__search__c <?php if( has_post_thumbnail()){ ?>evenz-thmb<?php } ?>">
		<p class="evenz-meta evenz-small">
			<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
		</p>
		<h3><a class="evenz-cutme-t-2" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php the_excerpt(); ?>
	</div>
</article>