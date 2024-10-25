<?php  


/**
 * 
 * This is a check on the post data
 * 
 */
if(!isset($_POST)) { 
	die('No data received.'); 
}

echo 'PROXY WORKING CORRECTLY';
echo '<pre>';
print_r( $_POST );
echo '</pre>';




?>