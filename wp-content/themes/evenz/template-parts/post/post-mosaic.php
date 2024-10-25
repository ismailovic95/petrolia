<?php
/**
 * 
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/
$classes = array( 'evenz-post','evenz-post__mosaic','evenz-gradprimary evenz-negative' );
?>
<article id="post-mosaic-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="evenz-duotone evenz-bgimg--full">
	<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'large', array( 'class' => 'evenz-post__mosaic__i') ); } ?>
	</div>
	<div class="evenz-post__mosaic__c">
		<div class="evenz-post__mosaic__c__c">
			<p class="evenz-meta evenz-small">
				<span class="evenz-p-catz"><?php evenz_postcategories( 1 ); ?></span>
			</p>
			<a href="<?php the_permalink(); ?>"><h3 class="evenz-pagecaption"  data-evenz-text="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></h3></a>
		</div>
	</div>
	<span class="evenz-hov"></span><div class="evenz-particles"></div>
</article>