<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage qtt
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Error notices
 */



function qtt_plugins_refresh__success() {
	?>
	<div class="notice notice-success is-dismissible">
		<h4><?php esc_html_e( 'The plugins list was successfully updated', 'qtt' ); ?></h4>
	</div>
	<?php
}


// refreshing too fast
function qtt_tgm_remote_refreshed__message(){
	?>
	<div class="notice notice-warning is-dismissible">
		<h4><?php esc_html_e( 'Refreshing the page too often. Please wait a a few seconds to avoid overloads.', 'qtt' ); ?></h4>
	</div>
	<?php
}

// allow refresh
function qtt_plugins_notice__refresh() {
	$urladmin = admin_url( 'themes.php?page='.qtt_tgmpa_page() );
	$url = add_query_arg(
		array(
			'tgmpa-force' => '1',
			'tgmpa-force-nonce2' => wp_create_nonce( 'tgmpa-force-nonce2' ),
			'tgmpa-force-nonce' => wp_create_nonce( 'tgmpa-force-nonce' )
		),
		$urladmin
	);
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'qtt Notice', 'qtt' ); ?></h3>
		<p><?php esc_html_e( 'The stored list of required plugins is empty, do you want to try again?', 'qtt' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email providing the Envato purchase code.', 'qtt' ); ?> <?php echo qtt_support_message(); ?></p>
		<p><?php esc_html_e( 'If you already tried this, please wait some time, the server can be under maintainance.', 'qtt' ); ?></p>
		<p><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'Try to refresh clicking here', 'qtt' ); ?></a></p>
	</div>
	<?php
}


// Activation notice
function qtt_plugins_notice__activationnag() {
	$scr = get_current_screen();
	if( $scr->id !== 'appearance_page_'.qtt_tgmpa_page() &&  $scr->id !== 'appearance_page_qtt-welcome' && !qtt_tgm_pcv( qtt_iid() ) ){
		
		$current_theme = wp_get_theme();
		if( is_child_theme() ){
			$current_theme = $current_theme->parent();
		}
		$title = sprintf(
			esc_html__( 'Thank you for choosing %1$s', 'qtt' ),
			$current_theme->name
		);

		?>
		<div class="notice notice-success is-dismissible qtt-welcome__notice">
			<img src="<?php echo esc_url( get_theme_file_uri( '/inc/tgm-plugin-activation/img/logo.png' ) ); ?>" alt="<?php esc_attr_e('Logo','firlw'); ?>">
			<h3><?php echo wp_strip_all_tags( $title ); ?></h3>
			<p><a href="<?php echo admin_url().'themes.php?page=qtt-welcome'; ?>"><?php esc_html_e( 'Please activate your license', 'qtt' ); ?></a> <?php esc_html_e("to install the premium plugins and demo contents", 'qtt') ?></p>
		</div>
		<?php
	}
}
add_action( 'admin_notices', 'qtt_plugins_notice__activationnag' );





/**
 * Add a one time only admin notice to check the documentation and support
 */
if(!function_exists('qtt_manual_notice')){
	add_action( 'admin_notices', 'qtt_manual_link_notice' );
	function qtt_manual_link_notice() {

		$dismissed = get_option( 'qtt_manual_dismissed', false );
		
		if( !$dismissed && isset( $_POST ) ){
			if(array_key_exists('qtt_dismiss_docu_link', $_POST) && array_key_exists('qtt_manual_dismiss', $_POST)){
				if($_POST['qtt_dismiss_docu_link'] == 'yes'){
					if ( ! wp_verify_nonce( $_POST['qtt_manual_dismiss'], 'qtt_action_dismiss_notice' ) ) {
						wp_die('Verification error. The theme security system triggered a block. Please go back to your admin home.');
					} else {
						add_option( 'qtt_manual_dismissed', '1', '', 'yes' );
						$dismissed = true;
					}
				}
			}
		}
		
		if( !$dismissed ){
			?>
			<div class="notice notice-success qtt-welcome__notice">
				<img src="<?php echo esc_url( get_theme_file_uri( '/inc/tgm-plugin-activation/img/docs.png' ) ); ?>" alt="<?php esc_attr_e('Logo','firlw'); ?>">
				<form class="qtt-notice__form" method="post" action="<?php echo admin_url(); ?>">
					<input type="hidden" name="qtt_dismiss_docu_link" id="qtt_dismiss_docu_link"  value="yes">
					<?php wp_nonce_field( 'qtt_action_dismiss_notice', 'qtt_manual_dismiss' ); ?>
					<h3><?php esc_html_e( 'Theme documentation and support', 'qtt' ); ?></h3>
					<p><?php esc_html_e("New to this theme? Please check our", 'qtt') ?> <a href="<?php echo qtt_connector_documentation_url(); ?>" target="_blank"><?php esc_html_e( 'documentation and support', 'qtt' ); ?></a>. </p>
					<input type="submit" value="<?php esc_html_e('Dismiss notice for good', 'qtt'); ?>"  class="qtt-btn button button-primary">
				</form>
			</div>
			<?php
		}
	}
}







// generic error
function qtt_plugins_notice__error() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'qtt Notice', 'qtt' ); ?></h3>
		<p><?php esc_html_e( 'We are experiencing an error while searching for the required plugins. Please make sure your server or firewall are not blocking outgoing requests to our server.', 'qtt' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email, providing the Envato purchase code.', 'qtt' ); ?> <?php echo qtt_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'qtt' ); ?></a></p>
	</div>
	<?php
}
// generic error
function qtt_plugins_notice__nolist() {
	?>
	<div class="notice notice-warning is-dismissible">
		<h3><?php esc_html_e( 'qtt Notice', 'qtt' ); ?></h3>
		<p><?php esc_html_e( 'It seems the list of plugins is actually empty. You can try searching again in a couple of minutes.', 'qtt' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email, providing the Envato purchase code.', 'qtt' ); ?> <?php echo qtt_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'qtt' ); ?></a></p>
	</div>
	<?php
}

// database error
function qtt_plugins_update_error() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'qtt TGM Notice', 'qtt' ); ?></h3>
		<p><?php esc_html_e( 'There is some issue while saving data in your database, please check database permissions', 'qtt' ); ?></p>
		<p><?php esc_html_e( 'If you need support please check the Support section of your manual.', 'qtt' ); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'qtt' ); ?></a></p>
	</div>
	<?php
}

// connection error
function qtt_plugins_conn__error() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'qtt Notice', 'qtt' ); ?></h3>
		<p><?php esc_html_e( 'Your server is being blocked while searching for plugins. Please make sure your server or firewall are not blocking outgoing requests to our server.', 'qtt' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email at, providing the Envato purchase code.', 'qtt' ); ?> <?php echo qtt_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'qtt' ); ?></a></p>
	</div>
	<?php
}


// connection error server
function qtt_plugins_conn__error_server() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'qtt TGM Notice', 'qtt' ); ?></h3>
		<p><?php esc_html_e( 'Sorry, our server is temporary unable to retreive the plugins list. You may try in a few minutes or contact our helpdesk at, providing the Envato purchase code.', 'qtt' ); ?> <?php echo qtt_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'qtt' ); ?></a></p>
	</div>
	<?php
}

// product ID missing
function qtt_plugins_id_miss() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'qtt TGM Notice', 'qtt' ); ?></h3>
		<p><?php esc_html_e( 'Your server is not able to parse the product ID. Your firewall or server settings are blocking the request.', 'qtt' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email, providing the Envato purchase code.', 'qtt' ); ?> <?php echo qtt_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'qtt' ); ?></a></p>
	</div>
	<?php
}

// product ID missing
function qtt_plugins_id_miss_server() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'qtt TGM Notice', 'qtt' ); ?></h3>
		<p><?php esc_html_e( 'Sorry, our server is not able to handle your request. You may try in a few minutes or contact our helpdesk, providing the Envato purchase code.', 'qtt' ); ?> <?php echo qtt_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'qtt' ); ?></a></p>
	</div>
	<?php
}

// Server responding wrong
function qtt_plugins_conn__error_sever() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'Activation required', 'qtt' ); ?></h3>
		<p><?php esc_html_e( 'Premium plugins require a valid purchase code activation.', 'qtt' ); ?> <?php echo qtt_support_message(); ?></p>
	</div>
	<?php
}


// Check if a purchase code is stored and if its structure is valid
function qtt_tgm_pcv ( $req = false ){
	if(!is_admin()){
		return;
	}
	if(  trim($req) == 'pending' ){
		return true;
	}
	$rid = trim( $req );
	$rok = get_option( 'qtt_ack_'.trim( $rid ) );
	if( $rok ){
		return true;
	}
	return false;
}