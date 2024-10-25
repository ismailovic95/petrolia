<h3>Modules details</h3>
<?php  


$loaded = get_loaded_extensions();
$required = array(
'curl',
'dom',
'exif',
'fileinfo',
'hash',
'json',
'mbstring',
'mysqli',
'sodium',
'openssl',
'pcre',
'imagick',
'xml',
'zip',
'filter',
'iconv',
'simplexml',
'xmlreader',
'zlib',
// 'ssh2'
);


// Fallbacks
if( !in_array( 'libsodium', $loaded ) ){
	$required[] = 'mcrypt';
}
if( !in_array( 'imagick', $loaded ) ){
	$required[] = 'gd';
}


?>


<table class="qt-servercheck__table">
	<tr>
		<th>Module</th>
		<th>Test</th>
	</tr>
	<tr>
		<td>Server software</td>
		<td><?php echo esc_html($_SERVER["SERVER_SOFTWARE"]); ?></td>
	</tr>

	<?php  
	/* PHP version */
	$phper = phpversion();
	$class = 'qt-servercheck__fail';
	$val = 'FAIL';
	if( version_compare($phper, '7.3', '>=' ) ){
		$class = 'qt-servercheck__success';
		$val = 'OK';
	}

	?>
	<tr>
		<td>PHP version</td>
		<td class="<?php echo $class; ?>"><?php echo esc_html($phper); echo ' '. esc_html($val); ?></td>
	</tr>
	<?php  
	foreach($required as $req){
		$class = 'qt-servercheck__fail';
		$val = 'FAIL';
		if( in_array( $req, $loaded ) ){
			$class = 'qt-servercheck__success';
			$val = 'OK';
		}
		?>
		<tr>
			<td><?php echo esc_html( $req ); ?></td>
			<td class="<?php echo $class; ?>"><?php echo esc_html($val); ?></td>
		</tr>
		<?php  
	}
	?>
</table>