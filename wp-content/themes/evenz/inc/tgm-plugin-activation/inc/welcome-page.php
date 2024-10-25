<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage qtt
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function qtt_disable_activation_link(){
	
	ob_start();
	$qtt_iid = qtt_iid();
	if(isset($_GET)){
		if( isset( $_GET[ 'qtt-tgm-remove-act-nonce' ] ) && isset( $_GET[ 'qtt-tgm-remove-act' ] ) ){
			$nonce = $_GET[ 'qtt-tgm-remove-act-nonce' ];
			if ( wp_verify_nonce( $nonce, 'remove-act-nonce') ) {
			   	if( isset ($_GET[ 'qtt-tgm-remove-act-conf' ] ) ){
			   		if( $_GET[ 'qtt-tgm-remove-act-conf' ] == '2' ){
				   		delete_option( 'qtt_' . 'ac' . 'k_'. $qtt_iid );
				   	} else {
				   		esc_html_e( 'Invalid request', 'qtt' );
				   	}
			   	} else {
				   	/**
					 * 
					 * Allow to disable activation + confirmation
					 * @var [type]
					 * 
					 */
					$urladmin = admin_url( 'themes.php?page=qtt-welcome' );
					$url = add_query_arg(
				        array(
				        	'qtt-tgm-remove-act' => '1',
				        	'qtt-tgm-remove-act-conf' => '2',
				            'qtt-tgm-remove-act-nonce' => wp_create_nonce( 'remove-act-nonce' )
				        ),
				        $urladmin
				    );
					?>
					<p class="qtt-welcome__center"><?php esc_html_e("Please confirm to remove activation:", 'qtt') ?><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'click here', 'qtt' ); ?></a></p>
					<?php
				}
			} else {
				echo 'Invalid';
			}
		} else {

			/**
			 * 
			 * Allow to disable activation
			 * @var [type]
			 * 
			 */
			$urladmin = admin_url( 'themes.php?page=qtt-welcome' );
			$url = add_query_arg(
		        array(
		        	'qtt-tgm-remove-act' => '1',
		            'qtt-tgm-remove-act-nonce' => wp_create_nonce( 'remove-act-nonce' )
		        ),
		        $urladmin
		    );
			?>
			<p class="qtt-welcome__center"><?php esc_html_e("To remove the activation, ", 'qtt') ?><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'click here', 'qtt' ); ?></a></p>
			<?php
		}
		return ob_get_clean();
	}
	return;
}


/**
 * qtt Welcome Page
 * =============================================*/
if ( ! function_exists( 'qtt_welcome_page_content' ) ) {
	function qtt_welcome_page_content() {
		
		if(!is_admin()){
			return;
		}
		$qtt_iid = qtt_iid( true );
		$msg_rem = qtt_disable_activation_link();

		/**
		 * =======================================
		 * @since  Connector v3
		 * New data is stored
		 * =======================================
		 */

		$ttg_iswpms = is_multisite() ? 1 : 0;
		$ttg_ismain = is_main_site();
		$ttg_neturl = network_site_url();
		$ttg_is_subsite = (get_site_url() == network_site_url())? 0 : 1;

		if(isset($_POST)){
			if(isset( $_POST['qttpcode']) ){
				if ( ! isset( $_POST['nonce_verify_pc'] )   || ! wp_verify_nonce( $_POST['nonce_verify_pc'], 'action_verify' ) ) {
				   	wp_die( esc_html_e('This request comes from an unidentified source. If you should not expect this error, please contact the theme author.', 'qtt') );
				    exit;
				} else {
					$tpc =  esc_attr( trim( $_POST['qttpcode'] ) );
					if (preg_match("/^(\w{8})-((\w{4})-){3}(\w{12})$/", $tpc)) {
						
						/**
						 * =======================================
						 * @since  Connector v3
						 * $bodydata: array
						 * =======================================
						 */
						$bodydata = array( 
							'ttg_connector_envato_pc' 		=> $tpc,
							'ttg_connector_website_url' 	=> get_site_url(),
							'ttg_connector_iid' 			=> $qtt_iid,
							'ttg_connector_person'			=> qtt_person(),
							'ttg_connector_abspath'			=> ABSPATH,
							'ttg_connector_iswpms'			=> $ttg_iswpms,
							'ttg_connector_ismain'			=> $ttg_ismain,
							'ttg_connector_neturl'			=> $ttg_neturl,
							'ttg_connector_subsite'			=> $ttg_is_subsite
						);

						
						$args = array(
							'method'        => 'POST',
							'timeout'       => 45,
							'redirection'   => 5,
							'httpversion'   => '1.0',
							'blocking'      => true,
							'user-agent' 	=> 'WordPress Connector',
							'headers'       => array(),
							'body'          => $bodydata // Since Connector V3
						);

						$request = wp_remote_post(  qtt_connector_url() , $args );
						if( is_wp_error( $request ) ){
							$error_message = $request->get_error_message();
							add_action( 'admin_notices', 'qtt_plugins_conn__error' );
							return $error_message;
						} else {
							/**
							 * =======================================
							 * @since  Connector v3
							 * New messages
							 * =======================================
							 */
							if( $request['response']['code'] == '200' ){
								if( stripos( strtolower( $request['body'] ) , 'error' )  !== false  ) {
									$msg = '<span class="qtt-welcome__msg__error">'.$request['body'].'</span><br>';
									$msg .= qtt_support_message();
								} else {
									$msg = '<span class="qtt-welcome__msg__success">'.esc_html__('Congratulations! Your purchase code was correctly verified!', 'qtt').'</span>';
									echo '<style>.qtt-welcome__notice {display: none !important;}</style>';
									update_option( 'qtt_' . 'ac' . 'k_'. $qtt_iid , esc_attr( trim( $request['body'] ) ) ); // helps against thefts
								}
							} else {
								$msg = esc_html( $request['response']['code'] );
							}
						}				
					}  else {
						$msg = '<span class="qtt-welcome__msg__error">'.esc_html__('Sorry, this is not a valid purchase code.', 'qtt').'</span>';
					} 	
				}
			}
		}


		$current_theme = wp_get_theme();
		if( is_child_theme() ){
			$current_theme = $current_theme->parent();
		}
		$title = sprintf(
			esc_html__( 'Thank you for choosing %1$s %2$s', 'qtt' ),
			$current_theme->name,
			$current_theme->version
		);
		?>
		<div class="qtt-welcome">
			<div class="qtt-welcome__container">
				<div class="qtt-welcome__wrapper">
					<div class="qtt-welcome__logo">
						<img src="<?php echo esc_url( get_theme_file_uri('/inc/tgm-plugin-activation/img/logo.png' )); ?>" alt="<?php esc_attr_e('Logo','firlw'); ?>">
					</div>
					<h1 class="qtt-welcome__title"><?php echo esc_html( $title ); ?></h1>
					
					<?php
					$v = qtt_tgm_pcv( trim( $qtt_iid ) );
					if( isset( $msg ) ){
						?> <p class="qtt-welcome__center"> <?php echo wp_kses_post( $msg ); ?></p><?php
					}
					if( true == $v ) {
						?>
						<p class="qtt-welcome__description">
							<?php
							echo esc_html(
								sprintf(
									esc_html__( 'Very good! The %1$s license is active.', 'qtt' ),
										$current_theme->name
								)
							);
							?><br>
							<?php  
							/**
							 * Link including a force refresh
							 */
							$urladmin = admin_url( 'themes.php?page='.qtt_tgmpa_page() );
							$url = add_query_arg(
						        array(
						        	'tgm-refresh-iid' => '1',
						            'tgmpa-force' => '1',
						            'tgmpa-force-nonce2' => wp_create_nonce( 'tgmpa-force-nonce2' ),
						            'tgmpa-force-nonce' => wp_create_nonce( 'tgmpa-force-nonce' )
						        ),
						        $urladmin
						    );
							?>
							<a href="<?php echo esc_url( $url ); ?>"><?php
							echo esc_html(
								sprintf(
									esc_html__( 'Go to %1$s Plugins ', 'qtt' ),
										$current_theme->name
								)
							);
							?></a>
						</p>
						<?php
						if( isset( $msg_rem ) ){
							echo wp_kses_post( $msg_rem ) ;
						}
					} else {
						?>
						<h4 class="qtt-welcome__center"><?php esc_html_e( 'Please copy here your purchase code to enjoy automatic plugins installation and demo import' , 'qtt' ); ?></h4>
						<form class="qtt-welcome__form" method="post" action="<?php echo admin_url() . 'themes.php?page=qtt-welcome'; ?>">
							<input type="text" name="qttpcode" class="qtt-pcode" placeholder="<?php esc_attr_e('Your purchase code', 'qtt'); ?>">
							<?php wp_nonce_field( 'action_verify', 'nonce_verify_pc' ); ?>
							<input type="submit" value="<?php esc_html_e('Verify', 'qtt'); ?>"  class="qtt-btn button button-primary">
						</form>
						<p class="qtt-welcome__center"><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'qtt' ); ?></a></p>
						<?php
					}
					?>
				</div>
			</div>
			<div class="qtt-welcome__container">
				<div class="qtt-welcome__info">
					<h3><?php esc_html_e('Activation process info and privacy', 'qtt'); ?></h3>
					<ul>
						<li><?php esc_html_e("We will check your purchase code via Envato API", 'vice'); ?></li>
						<li><?php esc_html_e('You can activate this license on a staging localhost / 127.0.0.1 or *.local installation.', 'vice'); ?></li>
						<li>You have to purchase/own a license for each publicly accessible domain install of the theme.</li>
						<li>Regardless of whether the installation domain is a sub domain or not, if it is publicly accessible, it requires a license.</li>
						<li>If you installed this website in a local environment or staging subdomain, is allowed to move the license once the staging installation is deleted. <?php echo qtt_support_message() ?> <?php esc_html_e("[Mon - Fri 09-18]", 'vice'); ?>.</li>
						<li>Staging installations are considered on local IPs, subdomains as test.site.com or staging.site.com or hidden subdomains, or local domains (as mysite.local). Online installations in root domains are not considered test installations.</li>
						<li><strong><?php esc_html_e("The activation is compliant with the Envato license regulations and Themeforest theme requirements.", 'vice'); ?></strong></li>
						<li>For more information please check the Envato regular license definitions here -> http://themeforest.net/licenses/terms/regular</li>
					</ul>
				</div>
			</div>
		</div>
		<?php
	}
}


/**
 *  Redirect to Welcome Page after the theme activation
 * =============================================*/
if ( !function_exists( 'qtt_welcome_switched' ) ) {
	/**
	 * When we switch theme, we save a variable that will force
	 * redirect to the wizard on next page load
	 */
	add_action( 'after_switch_theme', 'qtt_welcome_switched', 1000 );
	function qtt_welcome_switched() {
		update_option( 'qtt_welcome_page', 'installer' );
	}
}


/**
 * Include the Welcome Page in the menu
 * =============================================*/
if ( ! function_exists( 'qtt_welcome_menupage' ) ) {
	add_action( 'admin_menu', 'qtt_welcome_menupage' );
	function qtt_welcome_menupage() {
		$current_theme = wp_get_theme();
		if( is_child_theme() ){
			$current_theme = $current_theme->parent();
		}
		$pid = qtt_iid();
		if($pid == 'pending'){
			return;
		}

		add_theme_page(
			sprintf( esc_html__( '%s Activation', 'qtt' ), $current_theme->name ),
			sprintf( esc_html__( '%s Activation', 'qtt' ),  $current_theme->name ),
			'manage_options',
			'qtt-welcome',
			'qtt_welcome_page_content'
		);

		/**
		 * =======================================
		 * @since  Connector v3
		 * New menu link
		 * =======================================
		 */
		add_menu_page(
			 $current_theme->name,
			 $current_theme->name,
			'manage_options',
			'qtt-welcome',
			'qtt_welcome_page_content',
			get_theme_file_uri('/img/icon-qt.png' ),
			0 // Order ID
		);
	}	
}

/**
 * Include the Welcome Page in the menu
 * =============================================*/
if ( ! function_exists( 'qtt_welcome_footer' ) ) {
	add_action( 'wp_footer', 'qtt_welcome_footer', 1000 );
	function qtt_welcome_footer() {
		$ac = get_option( 'qtt_' . 'ac' . 'k_'. qtt_iid()  );
		if($ac){
			echo '<!-- QT CSS ID '. md5( $ac ) .' -->';
		}
	}
}

