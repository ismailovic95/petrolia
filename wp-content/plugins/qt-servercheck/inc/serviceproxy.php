<?php  

/**
 * 
 * URL where the connector is
 * 
 */
$url = 'https://qt-servercheck.qantumthemes.xyz/proxycheck.php';


/**
 * 
 * This is a check on the post data
 * 
 */
if(!isset($_POST)) { 
	die('No data received.'); 
}


/**
 * 
 * Data check, anything bad, we stop 
 * 
 */
$required = array(
	'ttg_connector_envato_pc',
	'ttg_connector_website_url',
	'ttg_connector_iid',
	'ttg_connector_person',
);
foreach( $required as $fieldname ){
	if(!array_key_exists($fieldname, $_POST)) {
		die('Some data is missing.');
	}
}
foreach( $required as $fieldname ){
	if('' == $_POST[$fieldname] ) {
		die('Some data is empty.');
	}
}
$query = http_build_query(
			array(
				'ttg_connector_envato_pc' 		=> $_POST['ttg_connector_envato_pc'],
				'ttg_connector_website_url' 	=> $_POST['ttg_connector_website_url'],
				'ttg_connector_iid' 			=> $_POST['ttg_connector_iid'],
				'ttg_connector_person'			=> $_POST['ttg_connector_person']
			)
		);


/**
 * 
 * Building the call
 * 
 */
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url );
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $query );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


/**
 * 
 * Getting the response
 * 
 */
$server_output = curl_exec($ch);
$error    = curl_error($ch);

curl_close ($ch);



// THAT'S ALL
?>