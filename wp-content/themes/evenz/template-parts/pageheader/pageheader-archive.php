<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */
// Design override
$hide = 0;
$paged = evenz_get_paged();
if( is_page() ){

	if($paged == 1){
		$hide = get_post_meta($post->ID, 'evenz_page_header_hide', true); // see custom-types/page/page.php
	}
}

$title = evenz_get_title();
$has_html = false;
if($title != strip_tags($title)) {
	$has_html = true;
}

if('1' != $hide){
	?>
	<div class="evenz-pageheader evenz-pageheader--animate evenz-primary ">
		<div class="evenz-pageheader__contents">
			<div class="evenz-container">
				<h1 class="evenz-pagecaption <?php if(!$has_html){ ?>evenz-glitchtxt<?php } ?>"  data-evenz-text="<?php echo esc_attr( $title ); ?>"><?php echo esc_html( $title);  ?></h1>
				<?php if( !is_page() ){ ?><p class="evenz-meta"><?php get_template_part( 'template-parts/pageheader/meta-archive' );  ?></p><?php } ?>
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
	<?php  
} // hide end


