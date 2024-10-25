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
				<span class="evenz-p-catz"><?php evenz_postcategories( 10 ); ?></span>
			</p>
			<h1 class="evenz-pagecaption <?php if(!$has_html){ ?>evenz-glitchtxt<?php } ?>"  data-evenz-text="<?php echo esc_attr( $title ); ?>"><?php the_title();  ?></h1>
			<p class="evenz-meta evenz-small">
				<span class="evenz-meta__dets">
					<i class="material-icons">today</i><?php echo get_the_date(); ?>
					<?php echo evenz_do_shortcode('[ttg_reaktions-views-raw]' ); ?>
					<?php echo evenz_do_shortcode('[ttg_reaktions-commentscount-raw]' ); ?>
					<?php echo evenz_do_shortcode('[ttg_reaktions-loveit-raw]' ); ?>
					<?php echo evenz_do_shortcode('[ttg_reaktions-rating-raw]' ); ?>
				</span>
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