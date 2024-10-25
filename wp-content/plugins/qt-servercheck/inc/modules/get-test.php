<?php  
/**
				 * 
				 * =============================================================
				 * Server GET
				 * =============================================================
				 * 
				 */				
				?>
				<h3>Server GET test</h3>
				<div class="qt-servercheck__test">
					
					<?php  
					// HTML
					
					$url = 'http://qantumthemes.xyz/t2gconnector-comm/connector-proxy/qt-servercheck-get.html';
					$response = wp_remote_get( $url );
					if ( is_wp_error( $response ) ) {
						$error_message = $response->get_error_message();
						echo '<p class="qt-servercheck__fail">FAIL</p>';
					   	echo "<p>Something went wrong: ". wp_kses_post($error_message).'</p>';
					   	echo "<p>You won't be able to use automatic updates and installations. Please check the support section of the manual for an alternative solution</p>";		  
					} else {
						echo '<p class="qt-servercheck__success">PASSED</p>';
						echo "<p>It seems your server can correctly download the plugins from our repository.</p>";	
						echo $response['body'];
					}
					?>
				</div>