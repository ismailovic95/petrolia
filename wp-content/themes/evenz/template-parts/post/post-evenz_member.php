<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

$author = get_post_meta( $post->ID, 'evenz_author', true );

$post_metas = get_post_meta( $post->ID );

$social = array('itunes','instagram','linkedin','facebook','twitter','pinterest','tiktok','vimeo','wordpress','youtube');
$socials = '';
foreach( $social as $s ){
	$meta_val = 'evenz_'.$s;
	if( array_key_exists( $meta_val, $post_metas ) ){
		$link = $post_metas[ $meta_val ][0];
		if( $link && $link!== ''){
			$i = 'qt-socicon-'.$s;
			$socials .= '<a class="evenz-sociallink" href="'.esc_attr( $link ).'" target="_blank"><i class="'.esc_attr( $i ).'"></i></a>';
		}
	}
}

$classes = array('evenz-post','evenz-post__member','evenz-darkbg','evenz-negative');
?>
<article id="membercard-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="evenz-post__header evenz-darkbg  evenz-negative">
		<div class="evenz-bgimg evenz-bgimg--full">
			<?php 
			if( has_post_thumbnail() ){
			 the_post_thumbnail( 'evenz-card', array( 'class' => 'evenz-post__thumb') );
			}; 
			?>
		</div>
		<a class="evenz-hov" href="<?php the_permalink(); ?>"> </a>
	</div>
	<div class="evenz-post__content">
		<p class="evenz-meta evenz-small evenz-role">
			<?php 
			if( array_key_exists( 'evenz_role', $post_metas ) ){
				echo esc_html( $post_metas['evenz_role'][0] );
			}
			?>
		</p>
		<h4 class="evenz-post__title evenz-cutme-t-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php if($socials != ''){ ?>
		<p class="evenz-meta evenz-small evenz-social">
			<?php  
			echo wp_kses_post( $socials, array('a','i') );
			?>
		</p>
		<?php } ?>
	</div>

</article>