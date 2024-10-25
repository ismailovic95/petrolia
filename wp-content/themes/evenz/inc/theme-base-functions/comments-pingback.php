<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

/**
 * ======================================================
 * Comments and pingbacks.
 * ------------------------------------------------------
 * Used as a callback by wp_list_comments() for 
 * displaying the comments.
 * ======================================================
 */
if ( ! function_exists( 'evenz_s_comment' ) ) {
	function evenz_s_comment( $comment, $args, $depth ) {
		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class("comment evenz-comment__item"); ?>>
				<article id="div-comment-<?php comment_ID(); ?>" class="evenz-comment__body ">
					<div class="evenz-comment evenz-pingback">
						<span class="evenz-comment__icon"><i class="material-icons">link</i></span>
						<div class="evenz-comment__c">
							<?php esc_html_e( 'Pingback:', "evenz" ); ?> <?php edit_comment_link( '<i class="material-icons">mode_edit</i>'.esc_html__( "Edit pingback","evenz"), '<span class="edit-link">', '</span>' ); ?>
							<?php comment_author_link(); ?> 
						</div>
					</div>
				</article>
		<?php else : ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? 'comment evenz-comment__item evenz-depth-'.$depth  : 'comment evenz-comment__item parent evenz-depth-'.$depth ); ?>>
				<article id="div-comment-<?php comment_ID(); ?>" class="evenz-comment__body ">
					<div class="evenz-comment">
						<a href="<?php echo esc_url( get_comment_author_url() ); ?>" class="evenz-avatar">
							<?php 
							/** 
							 * User avatar
							 */
							$avatar = get_avatar( $comment, $args['avatar_size'] );
							if ( 0 != $args['avatar_size'] && $avatar != '' ){
								echo get_avatar( $comment, $args['avatar_size'] );
							}else{
								?><i class="fa fa-user"></i><?php
							}
							?>
						</a>
						<p class="evenz-comment__auth evenz-itemmetas">
							<?php echo get_comment_author_link(); ?>
							<span class="evenz-comment__metas"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( esc_attr_x( 'on %1$s', 'Comment date', "evenz" ), get_comment_date(), get_comment_time() ); ?></a> <?php edit_comment_link( '<i class="material-icons">mode_edit</i> '.esc_html__( "Edit comment","evenz"), '<span class="edit-link">', '</span>' ); ?></span>
						</p>
						
						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="evenz-comment__c"><?php esc_html_e( 'Your comment is awaiting moderation.', "evenz" ); ?></p>
						<?php endif; ?>
						<div class="evenz-the-content evenz-comment__c">
							<?php comment_text(); ?>							
						</div>
						<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply evenz-comment__rlink">',
							'after'     => '</div>',
						) ) );
						?>	
					</div>	
			</article><!-- .comment-body -->
		<?php
		/* Yes, the LI is open and is correct in this way. */
		endif;
	}
}


