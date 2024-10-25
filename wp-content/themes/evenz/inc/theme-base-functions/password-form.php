<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/


/**
 * ======================================================
 * Custom password protected form
 * ------------------------------------------------------
 * Display the post password form using custom HTML
 * ======================================================
 */
if (!function_exists( 'evenz_password_form' )){
	add_filter( 'the_password_form', 'evenz_password_form' );
	function evenz_password_form() {
		global $post;
		$random_inputid = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		ob_start();
		?>
		<div class="evenz-form-wrapper">
			<form class="evenz-form" method="post" action="<?php echo get_option( 'siteurl' ); ?>/wp-login.php?action=postpass">
				<div class="evenz-row">
					<div class="evenz-col evenz-s12 evenz-m8 evenz-l9">
						<div class="evenz-fieldset">
							<input name="post_password" id="<?php echo esc_attr( $random_inputid ); ?>" type="password" placeholder="<?php esc_attr_e( 'Password', 'evenz' ); ?>" />
						</div>
					</div>
					<div class="evenz-col evenz-s12 evenz-m4 evenz-l3">
						<input type="submit" name="<?php esc_attr_e( "Submit", "evenz" ); ?>" class="evenz-btn evenz-btn__l evenz-btn__full evenz-btn-primary" value="<?php esc_attr_e( "Submit", "evenz" ); ?>" />
					</div>
				</div>
			</form>
		</div>
		<?php
		return ob_get_clean();
	}
}
