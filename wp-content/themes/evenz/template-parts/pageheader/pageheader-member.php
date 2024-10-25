<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

// Design override
$hide = get_post_meta($post->ID, 'evenz_page_header_hide', true); // see custom-types/page/page.php
$title = evenz_get_title();
$post_metas = get_post_meta( $post->ID );
if('1' != $hide){
	?>
	<div class="evenz-pageheader evenz-pageheader--animate evenz-pageheader__member evenz-primary">
		<div class="evenz-pageheader__contents">
			<div class="evenz-container">
				<?php  
				if( has_post_thumbnail(  )){
					?>
					<span class="evenz-pageheader__thumb">
						<?php the_post_thumbnail( 'evenz-squared-s', array('class' => 'evenz-thumb-round') );?>
					</span>
					<?php
				}
				?>
				<h1 class="evenz-pagecaption"  data-evenz-text="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></h1>
				<h5 class="evenz-capfont evenz-pageheader__sub">
					<?php  
					/**
					 * =================================
					 * Role
					 * =================================
					 */
					if( array_key_exists( 'evenz_role', $post_metas ) ){
						echo esc_html( $post_metas['evenz_role'][0] );
					}
					

					?><i></i><?php

					/**
					 * =================================
					 * Social
					 * =================================
					 */
					
					$social = array('itunes','instagram','linkedin','facebook','twitter','pinterest','tiktok','vimeo','wordpress','youtube');
					foreach( $social as $s ){
						$meta_val = 'evenz_'.$s;
						if( array_key_exists( $meta_val, $post_metas ) ){
							$link = $post_metas[ $meta_val ][0];
							if( $link && $link!== ''){
								$i = 'qt-socicon-'.$s;
								?>
								<a href="<?php echo esc_attr( $link ); ?>" target="_blank"><i class="<?php echo esc_attr( $i ); ?>"></i></a>
								<?php
							}
						}
					}
					?>
				</h5>
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
