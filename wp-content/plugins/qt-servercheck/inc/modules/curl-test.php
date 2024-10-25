<?php  
/**
				 * =============================================================
				 * CURL module test
				 * =============================================================
				 */
				?>
				<div class="qt-servercheck__test">
					<h3>CURL module test</h3>
					<?php
					if(qt_servercheck_servercheck_isCurl()){
						echo '<p class="qt-servercheck__success">PASSED</p>';
					} else {
						echo '<p class="qt-servercheck__fail">FAIL</p>';
						echo '<p>This is unusual, and means you cannot connect with the external servers. Please contact the support for alternative solutions.</p>';
						return;
					}
					?>
				</div>

				<?php