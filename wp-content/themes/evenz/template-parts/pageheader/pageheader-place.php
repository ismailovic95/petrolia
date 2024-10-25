<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

$format = get_post_format( $post->ID );
if(!$format) {
	$format = 'std';
}
$title = evenz_get_title();
$has_html = false;
if($title != strip_tags($title)) {
	$has_html = true;
}
?>
<div class="evenz-pageheader evenz-pageheader--animate evenz-primary">
	<div class="evenz-pageheader__contents">
		<div class="evenz-container">
			<p class="evenz-meta evenz-small">
				<span class="evenz-p-catz"><?php evenz_postcategories( 3, 'pcategory' ); ?></span>
			</p>
				
			<h1 class="evenz-pagecaption <?php if(!$has_html){ ?>evenz-glitchtxt<?php } ?>"  data-evenz-text="<?php echo esc_attr( $title ); ?>"><?php the_title();  ?></h1>
			<p class="evenz-meta evenz-small">
				<?php if(get_post_meta( $post->ID, 'qt_country', true )){ ?>
					<i class="material-icons">public</i><?php echo esc_attr( get_post_meta( $post->ID, 'qt_country', true )); ?>
				<?php } ?>
				<?php if(get_post_meta( $post->ID, 'qt_city', true )){ ?>
					<i class="material-icons">location_on</i><?php echo esc_attr( get_post_meta( $post->ID, 'qt_city', true )); ?>
				<?php } ?>
			</p>	
			<i class="evenz-decor evenz-center"></i>

		</div>
	</div>
	<?php 
	/**
	 * ======================================================
	 * Background image
	 * ======================================================
	 */
	get_template_part( 'template-parts/pageheader/image' ); 


	?>
</div>