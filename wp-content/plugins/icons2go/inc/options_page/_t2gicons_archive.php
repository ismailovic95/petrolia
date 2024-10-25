<?php
/**
 * @package t2gicons
 * @author Themes2Go
 * @textdomain t2gicons
 */


if (!function_exists('t2gicons_archive')){
function t2gicons_archive($echo = false){
	ob_start();
	$active = 'active';
	$t2gicons_families = t2gicons_families();
	?>
	<div  class="t2gicons-archive t2gicons-market ">
			<?php  
			foreach($t2gicons_families as $family){
				$icons = $family['classes'];
				?>
				<div id="t2gicons-section-<?php echo $family['options_name']; ?>" class="t2gicons-archive-section section scrollspy <?php if(get_option($family['options_name']) == '1') { ?> active <?php } else { ?> inactive <?php } ?>">
				<h6 class="t2gicons-form-section-title"><span><?php echo esc_attr($family['label']); ?> (<?php echo esc_attr(count($icons)); ?>)</span></h6>




					<?php  
					/**
					 *
					 * Saving functions
					 * 
					 */
					if ( ! empty( $_POST ) && check_admin_referer( 't2gicons_save', 't2giconsform_nonce' ) ) {
						
						$varname = $family['options_name'];
						if(isset($_POST[$varname])){
							if( $_POST[$varname] == "1"){
								if(!update_option($varname, "1")){
									?>
									<div class="card  red lighten-3">
										<div class="card-content white-text">
								        	<p><?php echo esc_attr__( "Impossible to activate the font. You may need admin permissions.", "t2gicons" ); ?></p>
								        </div>
								    </div>
									<?php  
								} else {
									update_option("t2gicons_plugin_configured", "1");
									?>
									<div class="card light-green lighten-3">
										<div class="card-content">
								        	<p><?php echo esc_attr__( 'Font actived.', 't2gicons' ); ?></p>
								        </div>
								    </div>
									<?php  
								}
							} elseif( $_POST[$varname] == "0"){
								
								if(isset($_POST["t2gicons-confirmationdeactivate-".$varname])){
									if( $_POST["t2gicons-confirmationdeactivate-".$varname ] == "confirm" ){
										if(!update_option($varname, "0")){
											?>
											<div class="card light-green lighten-3">
												<div class="card-content">
												    <p><?php echo esc_attr__( "Impossible to activate the font. You may need admin permissions.", "t2gicons" ); ?></p>
										        </div>
										    </div>
											<?php  
										} else {
											?>
										    <div class="card light-green lighten-3">
												<div class="card-content">
												        <p><?php echo esc_attr__( 'Font deactived.', 't2gicons' ); ?></p>
										        </div>
										    </div>
											<?php  

										}
									} 
								} else {
									?>
									<div class="card  red lighten-3">
										<div class="card-content white-text">
								        	<p><?php echo esc_attr__( "To deactivate a font set, check the security checkbox.", "t2gicons" ); ?></p>
								        </div>
								    </div>
									<?php
								}
							}
						}
						
					}

					?>
					<form method="post"  class="t2gicons-form" action="<?php echo esc_url($_SERVER["REQUEST_URI"]); ?>#t2gicons-section-<?php echo $family['options_name']; ?>">
				       
				        <?php wp_nonce_field( "t2gicons_save", "t2giconsform_nonce", true, true ); ?>
						<?php if(get_option($family['options_name']) == '1') { ?>
							<input type="hidden" name="<?php echo esc_attr($family['options_name']); ?>" value="0">
							<div class="input-field">
								<input type="checkbox" value="confirm" name="t2gicons-confirmationdeactivate-<?php echo esc_attr($family['options_name']); ?>" id="t2gicons-confirmationdeactivate-<?php echo esc_attr($family['options_name']); ?>" class="t2gicons-confirmdeactivate" data-target="t2gicons-deactbtn-<?php echo esc_attr($family['options_name']); ?>" />
		      					<label for="t2gicons-confirmationdeactivate-<?php echo esc_attr($family['options_name']); ?>"><?php echo esc_attr__("Deactivate", "t2gicons"); ?> <?php echo esc_attr($family['label']); ?>?</label>
      						</div>
							<div class="input-field">
								<input type="submit" id="t2gicons-deactbtn-<?php echo esc_attr($family['options_name']); ?>" name="submit" value="<?php echo esc_attr__("Deactivate ", "t2gicons"); ?><?php echo esc_attr($family['label']); ?>"  class="btn red darken-1 button-large t2gicons-hidden" />
							</div>
						<?php } else { ?>
							<input type="hidden" name="<?php echo esc_attr($family['options_name']); ?>" value="1">
							<div class="input-field">
								<p class="t2gicons-submit">
									<input type="submit" name="submit" value="<?php echo esc_attr__("Activate set", "t2gicons"); ?>"  class="btn btn-primary button-large  light-green darken-1" /> <a href="#" data-t2gicons-displaytarget="t2gicons-market-<?php echo esc_attr($family['options_name']); ?>" name="submit" value="<?php echo esc_attr__("Preview", "t2gicons"); ?>"  class="btn blue-grey lighten-3">PREVIEW</a>
								</p>
							</div>
						<?php } ?>
				    </form>

					<div class="t2gicons-archive-body t2gicons-iconset <?php if(get_option($family['options_name']) !== '1') { ?>t2gicons-hidden<?php }  ?>" id="t2gicons-market-<?php echo esc_attr($family['options_name']); ?>">
						<?php 
						foreach ($icons as $i){
							?>
							<a id="<?php echo esc_attr($i); ?>" href="#<?php echo esc_attr($i); ?>" data-set="<?php echo esc_attr($family['options_name']); ?>" data-setname="<?php echo esc_attr($family['label']); ?>" class="btn button t2gicons-iconbtn t2gicons-tooltipped qt-bookmarkicon" data-classtag="<?php echo esc_attr($i); ?>" data-position="top" data-delay="80"  data-t2gicons-tooltip="<?php echo esc_attr($i); ?>" data-icon="<?php echo esc_attr($i); ?>">
								<i class="<?php echo esc_attr($i); ?>"></i>
								<span class="t2gicons-tooltipname"><?php echo esc_attr($i); ?></span>
								<span class="t2gixons-bookmark-this"><i class="dashicons dashicons-star-filled"></i></span>

							</a>
							<?php 
						}
						?>
					</div>
				</div>
				<?php
				$active = '';
			}
			?>
	</div>
	
  	<?php
	if($echo == true){
		echo ob_get_clean();
		return;
	}
	return ob_get_clean();
}}


  ?>
