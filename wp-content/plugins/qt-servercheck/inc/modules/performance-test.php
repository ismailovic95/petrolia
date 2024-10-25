<?php  
/**
 * 
 * =============================================================
 * PHP benchmark
 * =============================================================
 * 
 */
?>
<div class="qt-servercheck__test">
	<?php  
	echo '<h2>Testing your server performance</h2>';
	require plugin_dir_path( __FILE__ ) . '/bench-class/bench-class.php';
	benchmark::run();
	?>
</div>

<p>Results will be cached for 20 seconds</p>
