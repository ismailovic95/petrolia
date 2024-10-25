<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage qtt
 **/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function qtt_message_tgm ( ){
	ob_start();
	$item_remote = qtt_iid();	
    
	$v = qtt_tgm_pcv( $item_remote );
	
	/**
	 * Display message
	 */
	if(!$v) {
		?>
		<p class="qtt-welcome__activation-msg">
			<a href="<?php echo admin_url().'themes.php?page=qtt-welcome'; ?>"><?php esc_html_e( 'Please activate your license', 'qtt' ); ?></a> 
			<?php esc_html_e("to install the premium plugins and demo contents", 'qtt') ?>
		</p>
		<?php
	}

	/**
	 * Display the product ID if set in remote
	 */
	if('pending' !== $item_remote) {
		?>
		<p><?php esc_html_e('Item ID: ','qtt'); echo esc_html( $item_remote ); ?></p>
		<?php
	}

	/**
	 * Display a force refresh link. Can be used every 30 seconds.
	 * Triggers product ID update as well
	 */
    if( get_transient( 'qtt_tgm_refreshed' ) ){
		?>
		<p><?php esc_html_e("The plugins list is up to date.", 'qtt') ?></p>
		<?php
	} else {
		$urladmin = admin_url( 'themes.php?page='.qtt_tgmpa_page() );
		$url = add_query_arg(
	        array(
	        	'tgm-refresh-iid' => '1',
	            'tgmpa-force' => '1',
	            'tgmpa-force-nonce' => wp_create_nonce( 'tgmpa-force-nonce' )
	        ),
	        $urladmin
	    );
		?>
		<p><?php esc_html_e("If you just updated your theme, please ", 'qtt') ?><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'Try to refresh clicking here', 'qtt' ); ?></a></p>
		<?php
	}

	return ob_get_clean();
}