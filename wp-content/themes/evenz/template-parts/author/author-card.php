<?php
/**
 * Featured author template part
 * 
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/ 


/**
 * @var $evenz_featuredauthor_id [id of the wp author, can be passed using set_query_var]
 */

if( isset($evenz_featuredauthor_id) ){
	$user_id = $evenz_featuredauthor_id; 
	$avatar = get_avatar_url($user_id );

	// Compatibility with ttgcore_authorbox plugin
	if( function_exists( 'ttg_authorbox_plugin_get_version' )){
		$image_id = get_user_meta (  $user_id , 'ttg_authorbox_imgid', true );
		if ( $image_id ) { 
			$avatar = wp_get_attachment_image_src( $image_id, 'evenz-squared-s' );    
			$avatar = $avatar[0];
		} 
	}

	?>
	<div class="evenz-authorbox evenz-authorbox__card evenz-paper">
		<a class="evenz-authorbox__img" href="<?php echo get_author_posts_url( $user_id ); ?>">
			<?php if($avatar){ ?>
				<img src="<?php echo esc_url($avatar); ?>" alt="<?php esc_attr_e( "Avatar", "evenz" ); ?>">
			<?php } ?>
		</a>
		<h6>
			<a href="<?php echo  get_author_posts_url( $user_id  ); ?>" class="evenz-cutme"><?php echo get_the_author_meta( 'display_name', $user_id ); ?></a>
		</h6>
		<p class="evenz-caption evenz-caption__s evenz-caption__c">
			<?php echo esc_html( get_the_author_meta( 'user_title', $user_id ) ? get_the_author_meta( 'user_title', $user_id ) : esc_html__('Author', 'evenz') ) ; ?>
		</p>
	</div>
	<?php 
}
