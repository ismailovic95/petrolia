<h3>Configuration details</h3>
<?php  
$ini_configuration = ini_get_all();
$relevant_fields_and_min_vals = array(
	'max_execution_time' 	=> '120',
	'max_file_uploads'		=> '20',
	'max_input_vars'		=> '1000',
	'max_input_time'		=> '200',
	'max_input_vars'		=> '2000',
	'post_max_size'			=>	'128',
	'upload_max_filesize'	=> '128',
	'file_uploads'			=> '1'
);

?>


<table class="qt-servercheck__table">
	<tr>
		<th>Module</td>
		<th>Global value</th>
		<th>Local value</th>
		<th>Required</th>
		<th>Test</th>
	</tr>
	<?php
		foreach($relevant_fields_and_min_vals as $key => $minval){
			$val = $ini_configuration[$key];
			$test = 'FAIL';
			$test_css = 'qt-servercheck__fail';

			$local_value = intval(str_replace('M','', $val['local_value']));
			if($local_value >= intval($minval)){
				$test = 'PASSED';
				$test_css = 'qt-servercheck__success';
			}
			?>
			<tr>
				<td><?php echo esc_html($key); ?></td>
				<td><?php echo esc_html($val['global_value']); ?></td>
				<td><?php echo esc_html($val['local_value']); ?></td>
				<td><?php echo esc_html($minval); ?></td>
				<td class="<?php echo esc_attr( $test_css ); ?>"><?php echo esc_html($test); ?></td>
			</tr>
			<?php
		}
	?>
</table>