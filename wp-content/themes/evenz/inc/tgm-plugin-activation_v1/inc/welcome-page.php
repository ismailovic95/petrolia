<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage Evenz
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function evenz_disable_activation_link(){
	ob_start();
	$evenz_iid = evenz_iid();
	if(isset($_GET)){
		if( isset( $_GET[ 'evenz-tgm-remove-act-nonce' ] ) && isset( $_GET[ 'evenz-tgm-remove-act' ] ) ){
			$nonce = $_GET[ 'evenz-tgm-remove-act-nonce' ];
			if ( wp_verify_nonce( $nonce, 'remove-act-nonce') ) {
			   	if( isset ($_GET[ 'evenz-tgm-remove-act-conf' ] ) ){
			   		if( $_GET[ 'evenz-tgm-remove-act-conf' ] == '2' ){
				   		delete_option( 'evenz_' . 'ac' . 'k_'. $evenz_iid );
				   	} else {
				   		esc_html_e( 'Invalid request', 'evenz' );
				   	}
			   	} else {
				   	/**
					 * 
					 * Allow to disable activation + confirmation
					 * @var [type]
					 * 
					 */
					$urladmin = admin_url( 'themes.php?page=evenz-welcome' );
					$url = add_query_arg(
				        array(
				        	'evenz-tgm-remove-act' => '1',
				        	'evenz-tgm-remove-act-conf' => '2',
				            'evenz-tgm-remove-act-nonce' => wp_create_nonce( 'remove-act-nonce' )
				        ),
				        $urladmin
				    );
					?>
					<p class="evenz-welcome__center"><?php esc_html_e("Please confirm to remove activation:", 'evenz') ?><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'click here', 'evenz' ); ?></a></p>
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
			$urladmin = admin_url( 'themes.php?page=evenz-welcome' );
			$url = add_query_arg(
		        array(
		        	'evenz-tgm-remove-act' => '1',
		            'evenz-tgm-remove-act-nonce' => wp_create_nonce( 'remove-act-nonce' )
		        ),
		        $urladmin
		    );
			?>
			<p class="evenz-welcome__center"><?php esc_html_e("To remove the activation from this website and use the purchase code in another website, ", 'evenz') ?><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'click here', 'evenz' ); ?></a></p>
			<?php
		}
		return ob_get_clean();
	}
	return;
}







/**
 * evenz Welcome Page
 * =============================================*/
if ( ! function_exists( 'evenz_welcome_page_content' ) ) {
	function evenz_welcome_page_content() {
		
		if(!is_admin()){
			return;
		}
		$evenz_iid = evenz_iid( true );
		$msg_rem = evenz_disable_activation_link();


		if(isset($_POST)){
			if(isset( $_POST['evenzpcode']) ){
				if ( ! isset( $_POST['name_of_nonce_field'] )   || ! wp_verify_nonce( $_POST['name_of_nonce_field'], 'name_of_my_action' ) ) {
				   	wp_die( esc_html_e('This request comes from an unidentified source. If you should not expect this error, please contact the theme author.', 'evenz') );
				    exit;
				} else {
					$tpc =  esc_attr( trim( $_POST['evenzpcode'] ) );
					if (preg_match("/^(\w{8})-((\w{4})-){3}(\w{12})$/", $tpc)) {
						$args = array(
							'method'        => 'POST',
							'timeout'       => 45,
							'redirection'   => 5,
							'httpversion'   => '1.0',
							'blocking'      => true,
							'user-agent' 	=> 'WordPress Connector',
							'headers'       => array(),
							'body'          => array( 
								'ttg_connector_envato_pc' 		=> $tpc,
								'ttg_connector_website_url' 	=> get_site_url(),
								'ttg_connector_iid' 			=> $evenz_iid,
								'ttg_connector_person'			=> evenz_person()
							),
						);
						$request = wp_remote_post(  evenz_connector_url() , $args );
						if( is_wp_error( $request ) ){
							$error_message = $response->get_error_message();
							add_action( 'admin_notices', 'evenz_plugins_conn__error' );
							return $error_message;
						} else {
							if( $request['response']['code'] == '200' ){
								$p = stripos($request['body'], 'error' );

								if( $p !== false ) {
									$msg = '<span class="evenz-welcome__msg__error">'.$request['body'].'</span>'. '<br>' . esc_html__('If you are sure that your code is correct, please retry late or use the Support section of the theme documentation. Thanks.', 'evenz');
								} else {
									$msg = '<span class="evenz-welcome__msg__success">'.esc_html__('Congratulations! Your purchase code was correctly verified!', 'evenz').'</span>';
									update_option( 'evenz_' . 'ac' . 'k_'. $evenz_iid , esc_attr( trim( $request['body'] ) ) ); // helps against thefts
								}
							} else {
								$msg = esc_html( $request['response']['code'] );
							}
						}				
					}  else {
						$msg = '<span class="evenz-welcome__msg__error">'.esc_html__('Sorry, this is not a valid purchase code.', 'evenz').'</span>';
					} 	
				}
			}
		}


		$current_theme = wp_get_theme();
		if( is_child_theme() ){
			$current_theme = $current_theme->parent();
		}
		$title = sprintf(
			esc_html__( 'Thank you for choosing %1$s %2$s', 'evenz' ),
			$current_theme->name,
			$current_theme->version
		);
		?>
		<div class="evenz-welcome">
			<div class="evenz-welcome__container">
				<div class="evenz-welcome__wrapper">
					<div class="evenz-welcome__logo">
						<img src="<?php echo esc_url( get_theme_file_uri('/inc/tgm-plugin-activation/img/logo.png' )); ?>" alt="<?php esc_attr_e('Logo','firlw'); ?>">
					</div>
					<h1 class="evenz-welcome__title"><?php echo esc_html( $title ); ?></h1>
					
					<?php
					$v = evenz_tgm_pcv( trim( $evenz_iid ) );
					if( isset( $msg ) ){
						?> <p class="evenz-welcome__center"> <?php echo wp_kses_post( $msg ); ?></p><?php
					}
					if( true == $v ) {
						?>
						<p class="evenz-welcome__description">
							<?php
							echo esc_html(
								sprintf(
									esc_html__( 'Very good! The %1$s license is active.', 'evenz' ),
										$current_theme->name
								)
							);
							?><br>


							<?php  
							/**
							 * Link including a force refresh
							 */
							$urladmin = admin_url( 'themes.php?page=evenz-tgmpa-install-plugins' );
							$url = add_query_arg(
						        array(
						        	'tgm-refresh-iid' => '1',
						            'tgmpa-force' => '1',
						            'tgmpa-force-nonce' => wp_create_nonce( 'tgmpa-force-nonce' )
						        ),
						        $urladmin
						    );


							?>
							<a href="<?php echo esc_url( $url ); ?>"><?php
							echo esc_html(
								sprintf(
									esc_html__( 'Go to %1$s Plugins ', 'evenz' ),
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
						<h4 class="evenz-welcome__center"><?php esc_html_e( 'Please copy here your purchase code to enjoy automatic plugins installation and demo import' , 'evenz' ); ?></h4>
						<form class="evenz-welcome__form" method="post" action="<?php echo admin_url() . 'themes.php?page=evenz-welcome'; ?>">
							<input type="text" name="evenzpcode" class="evenz-pcode" placeholder="<?php esc_attr_e('Your purchase code', 'evenz'); ?>">
							<?php wp_nonce_field( 'name_of_my_action', 'name_of_nonce_field' ); ?>
							<input type="submit" value="<?php esc_html_e('Verify', 'evenz'); ?>"  class="evenz-btn button button-primary">
						</form>
						<p class="evenz-welcome__center"><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'evenz' ); ?></a></p>
						<?php
					}
					?>
					
				</div>

			</div>
			

			<div class="evenz-welcome__container">
				<div class="evenz-welcome__info">
					<h3><?php esc_html_e('Activation process info and privacy', 'evenz'); ?></h3>
					<ul>
						<li><?php esc_html_e('We will validate your purchase code via Envato API using our server.', 'evenz'); ?></li>
						<li><?php esc_html_e('We will store your purchase code associated with the actual host.', 'evenz'); ?></li>
						<li><?php esc_html_e('You can activate this license on unlimited localhost / 127.0.0.1 installations', 'evenz'); ?></li>
						<li><?php esc_html_e('You can use the same purchse code on multiple subfolders / subdomains as per Envato licensing.', 'evenz'); ?></li>
						<li><?php esc_html_e("You can't activate the same purchase code on different domains.", 'evenz'); ?></li>
						<li><?php esc_html_e("We don't store any personal information except domain and purchase code.", 'evenz'); ?></li>
						<li><?php esc_html_e("You can request the deactivation of your purchase code via email in order to associate it with another domain.", 'evenz'); ?></li>
						<li><?php esc_html_e("For deactivations or activation issues: ", 'evenz'); ?><?php echo evenz_support_message() ?> <?php esc_html_e("[Mon - Fri 09-18]", 'evenz'); ?></li>
						<li><strong><?php esc_html_e("The activation is compliant with the Envato license regulations and Themeforest theme requirements.", 'evenz'); ?></strong></li>
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
if ( !function_exists( 'evenz_welcome_switched' ) ) {
	/**
	 * When we switch theme, we save a variable that will force
	 * redirect to the wizard on next page load
	 */
	add_action( 'after_switch_theme', 'evenz_welcome_switched', 1000 );
	function evenz_welcome_switched() {
		update_option( 'evenz_welcome_page', 'installer' );
	}
}


/**
 * Include the Welcome Page in the menu
 * =============================================*/
if ( ! function_exists( 'evenz_welcome_menupage' ) ) {
	add_action( 'admin_menu', 'evenz_welcome_menupage' );
	function evenz_welcome_menupage() {
		$current_theme = wp_get_theme();
		if( is_child_theme() ){
			$current_theme = $current_theme->parent();
		}
		$pid = evenz_iid();
		if($pid == 'pending'){
			return;
		}
		add_theme_page(
			sprintf( esc_html__( '%s Activation', 'evenz' ), $current_theme->name ),
			sprintf( esc_html__( '%s Activation', 'evenz' ),  $current_theme->name ),
			'manage_options',
			'evenz-welcome',
			'evenz_welcome_page_content'
		);
	}	
}