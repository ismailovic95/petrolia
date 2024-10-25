<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

// Design override
$hide = get_post_meta($post->ID, 'evenz_page_header_hide', true); // see custom-types/page/page.php
$title = get_the_title();
$has_html = false;
if($title != strip_tags($title)) {
	$has_html = true;
}
if('1' != $hide){
	?>
	<div class="evenz-pageheader evenz-pageheader--animate evenz-primary">
		<div class="evenz-pageheader__contents">
			<div class="evenz-container">
				
				<h1 class="evenz-pagecaption <?php if(!$has_html){ ?>evenz-glitchtxt<?php } ?>"  data-evenz-text="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></h1>
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



		/**
		 * ======================================================
		 * Internal menu
		 * ======================================================
		 */
		$internalmenu_enable = get_post_meta($post->ID, 'evenz_internalmenu_enable', true);
		if( $internalmenu_enable ){
			?><div class="evenz-stickybar-parent"><?php
				get_template_part( 'template-parts/pageheader/part-internal-menu' ); 
			?></div><?php  
		}
		?>
	</div>
	<?php  
} // hide end