<?php
/**
 * @package evenz
 * @version 1.0.0
 * 
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 *  
 */

if ( post_password_required() )
	return;

if ( ( comments_open() || '0' != get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<!-- ==================================== COMMENTS START ========= -->
	<div id="comments" class="comments-area comments-list evenz-part-post-comments evenz-card  evenz-paper">
		
		<?php if ( have_comments() ) : ?>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<nav id="comment-nav-below" class="evenz-comment__navigation evenz-comment__navigation__top" role="navigation">
					<p class="evenz-itemmetas evenz-comment__navlinks">
					<span class="evenz-comment__previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', "evenz" ) ); ?></span>
					<span class="evenz-comment__next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', "evenz" ) ); ?></span>
					</p>
				</nav>
			<?php endif; // check for comment navigation ?>
				<ol class="evenz-comment-list">
					<?php
					wp_list_comments( array( 'callback' => 'evenz_s_comment' ) );
					?>
				</ol>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
					
			<nav id="comment-nav-below" class="evenz-comment__navigation" role="navigation">
				<p class="evenz-itemmetas evenz-comment__navlinks">
				<span class="evenz-comment__previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', "evenz" ) ); ?></span>
				<span class="evenz-comment__next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', "evenz" ) ); ?></span>
				</p>
			</nav>
			<hr class="evenz-spacer-s">
			<?php endif; // check for comment navigation ?>
		<?php endif; // have_comments ?>
		<?php
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="evenz-comment__closed"><?php esc_html_e( 'Comments are closed.', "evenz" ); ?></p>
		<?php endif; ?>
		<?php

		/*
		*
		*     Custom parameters for the comment form
		*
		*/
		$required_text = esc_html__('Required fields are marked *',"evenz");
		if(!isset ($consent) ) { 
			$consent = ''; 
		}
		$args = array(
			'id_form'           => 'evenz-commentform',
			'id_submit'         => 'evenz-submit',
			'class_form'		=> 'evenz-form-wrapper evenz-commentform',
			'title_reply_to'    => esc_html__( 'Leave a Reply to %s', "evenz" ),
			'cancel_reply_before' 	=> '<span class="evenz-commentform__cancelreply">',
			'cancel_reply_after'	=> '</span>',
			'cancel_reply_link' 	=> '<span class="evenz-comment__cancelreply">'.esc_html__( 'Cancel', 'evenz' ).'</span>',
			'label_submit'      => esc_html__( 'Post Comment' ,"evenz" ),
			'class_submit'		=> 'evenz-btn evenz-btn__l',
			
			'title_reply'       => esc_html__( 'Leave a reply', "evenz" ),
			'title_reply_before' => '<h4><span>',
			'title_reply_after'   => '</span></h4>',
			
			'must_log_in' => '<p class="must-log-in evenz-mustlogin evenz-small">' .
				esc_html__( 'You must be logged in to post a comment.' , "evenz").
				' '.'<a href="'.wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ).'">'.esc_html__( 'Log in now' , "evenz").'</a>'.
				'</p>',
			'logged_in_as' => '<p class="evenz-small">' .
				sprintf(
					esc_html__( 'Logged in as ','evenz')
					.' <a href="%1$s">%2$s</a>. '
					.'<a href="%3$s" title="'.esc_attr__('Log out of this account','evenz').'">'
					.' '.esc_html__('Log out?','evenz')
					.'</a>',
					admin_url( 'profile.php' ),
					$user_identity,
					wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) )
				) . '</p>',
			'comment_notes_before' => '<p class="evenz-small">'.esc_html__( "Your email address will not be published. Required fields are marked *", "evenz" ).'</p>',
			'comment_notes_after' => '',


			'comment_field' 	=>  '
				<div class="evenz-fieldset">
					<label for="comment" >'.esc_html__( "Comment*", 'evenz').'</label>
					<textarea id="comment" name="comment" required="required"></textarea>
				</div>',

			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author'  => '
					<div class="evenz-fieldset evenz-fieldset__half">
						<label for="author" >'.esc_html__( "Name*", 'evenz').'</label>
						<input id="author" name="author" type="text" required="required"  value="' . esc_attr( $commenter['comment_author'] ) .'" />
						
					</div>',
				'email'  => '
					<div class="evenz-fieldset evenz-fieldset__half">
						<label for="email" >'.esc_html__( "Email*", 'evenz').'</label>
						 <input id="email" name="email" type="text" required="required"  value="' . esc_attr( $commenter['comment_author_email'] ) .'" />
					</div>',
				'url'  => '
					<div class="evenz-fieldset">
						<label for="url" >'.esc_html__( "Url", 'evenz').'</label>
						 <input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'" />
					</div>'
				)
			),
		);


		// If comments are closed and there are comments, let's leave a little note, shall we?
		if (  comments_open() && post_type_supports( get_post_type(), 'comments' ) ) :?>
				<?php  
				comment_form($args); 
				?>
		<?php endif; ?>

	</div><!-- #comments -->
	<!-- ==================================== COMMENTS END ========= -->
<?php endif; ?>
