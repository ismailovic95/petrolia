<?php  
/**
 * 
 * =============================================================
 * Server POST
 * =============================================================
 * 
 */

/**
*  Remote server IP
*/
function qt_servercheck_servercheck__person() {    
	$ipaddress = '';
	if (isset($_SERVER['HTTP_CLIENT_IP']))
	$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_X_FORWARDED']))
	$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_FORWARDED']))
	$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if(isset($_SERVER['REMOTE_ADDR']))
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
	$ipaddress = 'UNKNOWN';
	return $ipaddress;
}

?>
<h3>Server POST test</h3>
<div class="qt-servercheck__test">

	
	<?php
	$url = 'http://qantumthemes.xyz/t2gconnector-comm/connector-proxy/qt-servercheck.php';
	$args = array(
		'method'        => 'POST',
		'timeout'       => 45,
		'redirection'   => 5,
		'body'          => array( 
			'website_url' 	=> get_site_url(),
			'request_ip' 	=> qt_servercheck_servercheck__person(),
		),
	);
	$response = wp_remote_post(  $url , $args );
	if ( is_wp_error( $response ) ) {
		$error_message = $response->get_error_message();
		echo '<p class="qt-servercheck__fail">FAIL</p>';
	   	echo "<p>Something went wrong: ". wp_kses_post($error_message).'</p>';
	   	echo "<p>You can still perform the manual installation, please contac our support for the alternative solution. </p>";		  
	} else {
		echo '<p class="qt-servercheck__success">PASSED</p>';
		echo "<p>You can automatically validate your purchase code and update the plugins.</p>";	
		echo $response['body'];
	}
	?>
</div>


