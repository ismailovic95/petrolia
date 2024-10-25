<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage Evenz
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Error notices
 */



function evenz_plugins_refresh__success() {
	?>
	<div class="notice notice-success is-dismissible">
		<h4><?php esc_html_e( 'Evenz - The plugins list was successfully updated', 'evenz' ); ?></h4>
	</div>
	<?php
}


// refreshing too fast
function evenz_tgm_remote_refreshed__message(){
	?>
	<div class="notice notice-warning is-dismissible">
		<h4><?php esc_html_e( 'Refreshing the page too often. Please wait a a few seconds to avoid overloads.', 'evenz' ); ?></h4>
	</div>
	<?php
}

// allow refresh
function evenz_plugins_notice__refresh() {
	$urladmin = admin_url( 'themes.php?page=evenz-tgmpa-install-plugins' );
	$url = add_query_arg(
		array(
			'tgmpa-force' => '1',
			'tgmpa-force-nonce' => wp_create_nonce( 'tgmpa-force-nonce' )
		),
		$urladmin
	);
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'Evenz Notice', 'evenz' ); ?></h3>
		<p><?php esc_html_e( 'The stored list of required plugins is empty, do you want to try again?', 'evenz' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email providing the Envato purchase code.', 'evenz' ); ?> <?php echo evenz_support_message(); ?></p>
		<p><?php esc_html_e( 'If you already tried this, please wait some time, the server can be under maintainance.', 'evenz' ); ?></p>
		<p><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'Try to refresh clicking here', 'evenz' ); ?></a></p>
	</div>
	<?php
}


// Activation notice
function evenz_plugins_notice__activationnag() {
	$scr = get_current_screen();
	if( $scr->id !== 'appearance_page_evenz-tgmpa-install-plugins' &&  $scr->id !== 'appearance_page_evenz-welcome' && !evenz_tgm_pcv( evenz_iid() ) ){

		$current_theme = wp_get_theme();
		if( is_child_theme() ){
			$current_theme = $current_theme->parent();
		}
		$title = sprintf(
			esc_html__( 'Thank you for choosing %1$s', 'qtt' ),
			$current_theme->name
		);

		
		?>
		<div class="notice notice-success is-dismissible evenz-welcome__notice">
			<img src="<?php echo esc_url( get_theme_file_uri( '/inc/tgm-plugin-activation/img/logo.png' ) ); ?>" alt="<?php esc_attr_e('Logo','firlw'); ?>">
			<h3><?php echo wp_strip_all_tags( $title ); ?></h3>
			<p><a href="<?php echo admin_url().'themes.php?page=evenz-welcome'; ?>"><?php esc_html_e( 'Please activate your license', 'evenz' ); ?></a> <?php esc_html_e("to install the premium plugins and demo contents", 'evenz') ?></p>
		</div>
		<?php
	}
}
add_action( 'admin_notices', 'evenz_plugins_notice__activationnag' );



// generic error
function evenz_plugins_notice__error() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'Evenz Notice', 'evenz' ); ?></h3>
		<p><?php esc_html_e( 'We are experiencing an error while searching for the required plugins. Please make sure your server or firewall are not blocking outgoing requests to our server.', 'evenz' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email, providing the Envato purchase code.', 'evenz' ); ?> <?php echo evenz_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'evenz' ); ?></a></p>
	</div>
	<?php
}
// generic error
function evenz_plugins_notice__nolist() {
	?>
	<div class="notice notice-warning is-dismissible">
		<h3><?php esc_html_e( 'Evenz Notice', 'evenz' ); ?></h3>
		<p><?php esc_html_e( 'It seems the list of plugins is actually empty. You can try searching again in a couple of minutes.', 'evenz' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email, providing the Envato purchase code.', 'evenz' ); ?> <?php echo evenz_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'evenz' ); ?></a></p>
	</div>
	<?php
}

// database error
function evenz_plugins_update_error() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'Evenz TGM Notice', 'evenz' ); ?></h3>
		<p><?php esc_html_e( 'There is some issue while saving data in your database, please check database permissions', 'evenz' ); ?></p>
		<p><?php esc_html_e( 'If you need support please check the Support section of your manual.', 'evenz' ); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'evenz' ); ?></a></p>
	</div>
	<?php
}

// connection error
function evenz_plugins_conn__error() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'Evenz Notice', 'evenz' ); ?></h3>
		<p><?php esc_html_e( 'Your server is being blocked while searching for plugins. Please make sure your server or firewall are not blocking outgoing requests to our server.', 'evenz' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email at, providing the Envato purchase code.', 'evenz' ); ?> <?php echo evenz_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'evenz' ); ?></a></p>
	</div>
	<?php
}


// connection error server
function evenz_plugins_conn__error_server() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'Evenz TGM Notice', 'evenz' ); ?></h3>
		<p><?php esc_html_e( 'Sorry, our server is temporary unable to retreive the plugins list. You may try in a few minutes or contact our helpdesk at, providing the Envato purchase code.', 'evenz' ); ?> <?php echo evenz_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'evenz' ); ?></a></p>
	</div>
	<?php
}

// product ID missing
function evenz_plugins_id_miss() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'Evenz TGM Notice', 'evenz' ); ?></h3>
		<p><?php esc_html_e( 'Your server is not able to parse the product ID. Your firewall or server settings are blocking the request.', 'evenz' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email, providing the Envato purchase code.', 'evenz' ); ?> <?php echo evenz_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'evenz' ); ?></a></p>
	</div>
	<?php
}

// product ID missing
function evenz_plugins_id_miss_server() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'Evenz TGM Notice', 'evenz' ); ?></h3>
		<p><?php esc_html_e( 'Sorry, our server is not able to handle your request. You may try in a few minutes or contact our helpdesk, providing the Envato purchase code.', 'evenz' ); ?> <?php echo evenz_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'evenz' ); ?></a></p>
	</div>
	<?php
}

// Server responding wrong
function evenz_plugins_conn__error_sever() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'Activation required', 'evenz' ); ?></h3>
		<p><?php esc_html_e( 'Premium plugins require a valid purchase code activation.', 'evenz' ); ?> <?php echo evenz_support_message(); ?></p>
	</div>
	<?php
}


// Check if a purchase code is stored and if its structure is valid
function evenz_tgm_pcv ( $req = false ){
	if(!is_admin()){
		return;
	}
	if(  trim($req) == 'pending' ){
		return true;
	}
	$rid = trim( $req );
	$rok = get_option( 'evenz_ack_'.trim( $rid ) );
	if( $rok ){
		return true;
	}
	return false;
}