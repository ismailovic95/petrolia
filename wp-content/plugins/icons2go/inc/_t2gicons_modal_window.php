<?php  

/**
 *  This template creates the list of clickable icons to put in the TinyMCE editor
 */

if(!function_exists("t2gicons_modal_iconslist")){
function t2gicons_modal_iconslist() {
	if(t2gicons_function_enabled()  == false){
		return;
	}
	ob_start();
	?>
	<div class="t2gicons-framework t2gicons-modal" id="t2gicons-modalform">
		<div class="t2gicons-market" id="t2gicons-iconsmarket">
			<div class="t2gicons-header">
				<h2 class="t2gicons-modaltitle"><img src="<?php echo plugins_url( '../assets/icons2go-logo.png' , __FILE__ ); ?>" alt="Themes2Go logo"><?php echo esc_attr__("Add icon", "t2gicons"); ?></h2>
				<a href="#close" id="t2gicons-closemodal" class="t2gicons-closemodal"><span class="dashicons dashicons-no"></span> close</a>
			</div>
			<div class="row">
				<div class="col s12 m5">
					<h5><?php echo esc_attr__("Icon set", "t2gicons"); ?></h5>
					<div class="t2gicons-card">
						<div class="row">
							<div class="col s12 m6">
								<div class="input-field">
									<select class="t2gicons-selectfield" id="t2gicons_switch_set" name="t2gicons_switch_set">
										<?php  
										$t2gicons_families = t2gicons_families();
										/**
										 * we display the active sets first but let know the user that there are more ones, inactive
										 */
										foreach($t2gicons_families as $family){
											if(get_option($family['options_name']) == '1') {
												?>
												<option value="#<?php echo esc_attr($family['options_name']); ?>-tab"><?php echo esc_attr($family['label']); ?> <?php if(get_option($family['options_name']) !== '1') { echo esc_attr__("[Activate in plugin's settings]", "t2gicons"); } ?></option>
												<?php
											}
										}
										foreach($t2gicons_families as $family){
											if(get_option($family['options_name']) !== '1'){
												?>
												<option value="#<?php echo esc_attr($family['options_name']); ?>-tab" disabled><?php echo esc_attr($family['label']); ?> <?php if(get_option($family['options_name']) !== '1') { echo esc_attr__("[Disabled]", "t2gicons"); } ?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="col s12 m6">
								<div class="input-field">
									<i class="dashicons dashicons-search prefix"></i>
									<input placeholder="<?php echo esc_html__("Search in this set:", "t2gicons"); ?>" id="t2gicons_search" name="t2gicons_search" type="text">
								</div>
							</div>
						</div>
						<p class="t2gicons-note"><strong><?php echo esc_html__("NOTE:", "t2gicons"); ?></strong> <a href="<?php menu_page_url( 't2gicons_settings' ); ?>" target="_blank"><?php echo esc_html__("You can activate the disabled icon sets in Settings -> WPicons2Go", "t2gicons"); ?></a></p>
					</div>
					<div class="t2gicons-tabs">
						<?php  
						$active = 'active';
						foreach($t2gicons_families as $family){
							if(get_option($family['options_name']) == '1') {
								$icons = $family['classes'];
								?>
								<div class="t2gicons-tab t2gicons-card <?php echo esc_attr($active); ?>" id="<?php echo esc_attr($family['options_name']); ?>-tab">
									<div class="t2gicons-iconset ">
										<h6 class="t2gicons-familyname"><?php echo esc_attr($family['label']); ?> (<?php echo esc_attr(count($icons)); ?>)</h6>
											<?php
											foreach ($icons as $i){
											?>
											<a class="btn button t2gicons-iconbtn t2gicons-tooltipped t2gicons-iconselector" data-type="<?php echo esc_attr($family['options_name']); ?>" data-classtag="<?php echo esc_attr($i); ?>" data-position="top" data-delay="80" href="#" data-t2gicons-tooltip="<?php echo esc_attr($i); ?>" data-icontype="<?php echo esc_attr($i); ?>">
												<i class="<?php echo esc_attr($i); ?>"></i>
												<span class="t2gicons-tooltipname"><?php echo esc_attr($i); ?></span>
											</a>
											<?php 
											} 
											?>
									</div>
								</div>
								<?php
								$active = '';
							}
						}
						?>
					</div>
				</div>
				<div class="col s12 m3">
					<h5><?php echo esc_attr__("Settings", "t2gicons"); ?></h5>
					<form action="!#" class="t2gicons-form t2gicons-card" id="t2gicons-form">
						<div class="t2gicons-form-section">
							<h6 class="t2gicons-form-section-title"><span><?php echo esc_attr__("Icon", "t2gicons"); ?></span></h6>
							<div class="input-field">
						  		<label><?php echo esc_attr__("Alignment", "t2gicons"); ?></label>
								<select class="t2gicons-selectfield" id="t2gicons_input_align" name="t2gicons_alignment">
									<option value="default" disabled selected><?php echo esc_attr__("Default", "t2gicons"); ?></option>
									<option value="left"><?php echo esc_attr__("left", "t2gicons"); ?></option>
									<option value="right"><?php echo esc_attr__("right", "t2gicons"); ?></option>
									<option value="center" selected><?php echo esc_attr__("center", "t2gicons"); ?></option>
								</select>
						  	</div>
							<div class="input-field">
								<label><?php echo esc_attr__("Font size", "t2gicons"); ?></label>
								<select class="t2gicons-selectfield" id="t2gicons_input_fontsize" name="t2gicons_input_size">
									<?php  
									for($i = 1; $i <=20; $i++){
										?>
										<option value="<?php echo esc_attr($i*10); ?>" <?php if($i == 10){ ?>selected<?php } ?>><?php echo esc_attr($i*10); ?>px</option>
										<?php
									}
									?>
								</select>
						  	</div>
						  	<div class="input-field">
						  		<label for="t2gicons_input_color"><?php echo esc_attr__("Color", "t2gicons"); ?></label>
								<select class="t2gicons-selectfield" id="t2gicons_input_color" name="t2gicons_input_color">
									<option value="default"><?php echo esc_attr__("Default", "t2gicons"); ?></option>
									<option value="red" data-icon="<?php echo plugins_url( '../assets/color-icons/red.gif' , __FILE__ ); ?>" class="left circle" ><?php echo esc_attr__("Red", "t2gicons"); ?></option>
									<option value="pink" data-icon="<?php echo plugins_url( '../assets/color-icons/pink.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Pink", "t2gicons"); ?></option>
									<option value="purple" data-icon="<?php echo plugins_url( '../assets/color-icons/purple.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Purple", "t2gicons"); ?></option>
									<option value="deep-purple" data-icon="<?php echo plugins_url( '../assets/color-icons/deep-purple.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Deep Purple", "t2gicons"); ?></option>
									<option value="indigo" data-icon="<?php echo plugins_url( '../assets/color-icons/indigo.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Indigo", "t2gicons"); ?></option>
									<option value="blue" data-icon="<?php echo plugins_url( '../assets/color-icons/blue.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Blue", "t2gicons"); ?></option>
									<option value="light-blue" data-icon="<?php echo plugins_url( '../assets/color-icons/light-blue.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Light blue", "t2gicons"); ?></option>
									<option value="teal" data-icon="<?php echo plugins_url( '../assets/color-icons/teal.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Teal", "t2gicons"); ?></option>
									<option value="green" data-icon="<?php echo plugins_url( '../assets/color-icons/green.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Green", "t2gicons"); ?></option>
									<option value="light-green" data-icon="<?php echo plugins_url( '../assets/color-icons/light-green.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Light green", "t2gicons"); ?></option>
									<option value="lime" data-icon="<?php echo plugins_url( '../assets/color-icons/lime.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Lime", "t2gicons"); ?></option>
									<option value="yellow" data-icon="<?php echo plugins_url( '../assets/color-icons/yellow.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Yellow", "t2gicons"); ?></option>
									<option value="amber" data-icon="<?php echo plugins_url( '../assets/color-icons/amber.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Amber", "t2gicons"); ?></option>
									<option value="orange" data-icon="<?php echo plugins_url( '../assets/color-icons/orange.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Orange", "t2gicons"); ?></option>
									<option value="deep-orange" data-icon="<?php echo plugins_url( '../assets/color-icons/deep-orange.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Deep-orange", "t2gicons"); ?></option>
									<option value="brown" data-icon="<?php echo plugins_url( '../assets/color-icons/brown.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Brown", "t2gicons"); ?></option>
									<option value="grey" data-icon="<?php echo plugins_url( '../assets/color-icons/grey.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Grey", "t2gicons"); ?></option>
									<option value="blue-grey" data-icon="<?php echo plugins_url( '../assets/color-icons/blue-grey.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Blue grey", "t2gicons"); ?></option>
									<option value="black" data-icon="<?php echo plugins_url( '../assets/color-icons/black.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Black", "t2gicons"); ?></option>
									<option selected value="white" data-icon="<?php echo plugins_url( '../assets/color-icons/white.gif' , __FILE__ ); ?>" class="left circle" ><?php echo esc_attr__("White", "t2gicons"); ?></option>
								</select>
						  	</div>
						</div>
						<div class="t2gicons-form-section">
							<h6 class="t2gicons-form-section-title"><span><?php echo esc_attr__("Background", "t2gicons"); ?></span></h6>
							<div class="input-field">
								<label>Shape</label>
								<select class="t2gicons-selectfield" id="t2gicons_input_shape" name="t2gicons_input_shape">
									<option value="none"><?php echo esc_attr__("No background", "t2gicons"); ?></option>
									<option value="circle" data-icon="<?php echo plugins_url( '../assets/shape-icons/circle.gif' , __FILE__ ); ?>"  class="left"><?php echo esc_attr__("Circle", "t2gicons"); ?></option>
									<option value="square" data-icon="<?php echo plugins_url( '../assets/shape-icons/square.gif' , __FILE__ ); ?>"  class="left"><?php echo esc_attr__("Square", "t2gicons"); ?></option>
									<option selected value="rsquare" data-icon="<?php echo plugins_url( '../assets/shape-icons/rsquare.gif' , __FILE__ ); ?>"  class="left"><?php echo esc_attr__("Rounded square", "t2gicons"); ?></option>
									<option value="rhombus" data-icon="<?php echo plugins_url( '../assets/shape-icons/rhombus.gif' , __FILE__ ); ?>"  class="left"><?php echo esc_attr__("Rhombus", "t2gicons"); ?></option>
									<option value="circle-border" data-icon="<?php echo plugins_url( '../assets/shape-icons/circle-border.gif' , __FILE__ ); ?>"  class="left"><?php echo esc_attr__("Circle border", "t2gicons"); ?></option>
									<option value="square-border" data-icon="<?php echo plugins_url( '../assets/shape-icons/square-border.gif' , __FILE__ ); ?>"  class="left"><?php echo esc_attr__("Square border", "t2gicons"); ?></option>
									<option value="rsquare-border" data-icon="<?php echo plugins_url( '../assets/shape-icons/rsquare-border.gif' , __FILE__ ); ?>"  class="left"><?php echo esc_attr__("Rounded square border", "t2gicons"); ?></option>
									<option value="rhombus-border" data-icon="<?php echo plugins_url( '../assets/shape-icons/rhombus-border.gif' , __FILE__ ); ?>"  class="left"><?php echo esc_attr__("Rhombus border", "t2gicons"); ?></option>
								</select>
						  	</div>
						  	<div class="input-field">
						  		<label><?php echo esc_attr__("Size", "t2gicons"); ?></label>
								<select class="t2gicons-selectfield" id="t2gicons_input_size" name="t2gicons_input_size">
									<?php  
									for($i = 1; $i <=20; $i++){
										?>
										<option value="<?php echo esc_attr($i*10); ?>" <?php if($i == 20){ ?>selected<?php } ?>><?php echo esc_attr($i*10); ?>px</option>
										<?php
									}
									?>
								</select>
						  	</div>
						  	<div class="input-field">
						  		<label><?php echo esc_attr__("Background color", "t2gicons"); ?></label>
								<select class="t2gicons-selectfield" id="t2gicons_input_bgcolor" name="t2gicons_input_bgcolor">
									<option value=""  ><?php echo esc_attr__("Default", "t2gicons"); ?></option>
									<option value="red" data-icon="<?php echo plugins_url( '../assets/color-icons/red.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Red", "t2gicons"); ?></option>
									<option value="pink" data-icon="<?php echo plugins_url( '../assets/color-icons/pink.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Pink", "t2gicons"); ?></option>
									<option value="purple" data-icon="<?php echo plugins_url( '../assets/color-icons/purple.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Purple", "t2gicons"); ?></option>
									<option value="deep-purple" data-icon="<?php echo plugins_url( '../assets/color-icons/deep-purple.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Deep Purple", "t2gicons"); ?></option>
									<option value="indigo" data-icon="<?php echo plugins_url( '../assets/color-icons/indigo.gif' , __FILE__ ); ?>" class="left circle" ><?php echo esc_attr__("Indigo", "t2gicons"); ?></option>
									<option selected value="blue" data-icon="<?php echo plugins_url( '../assets/color-icons/blue.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Blue", "t2gicons"); ?></option>
									<option value="light-blue" data-icon="<?php echo plugins_url( '../assets/color-icons/light-blue.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Light blue", "t2gicons"); ?></option>
									<option value="teal" data-icon="<?php echo plugins_url( '../assets/color-icons/teal.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Teal", "t2gicons"); ?></option>
									<option value="green" data-icon="<?php echo plugins_url( '../assets/color-icons/green.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Green", "t2gicons"); ?></option>
									<option value="light-green" data-icon="<?php echo plugins_url( '../assets/color-icons/light-green.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Light green", "t2gicons"); ?></option>
									<option value="lime" data-icon="<?php echo plugins_url( '../assets/color-icons/lime.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Lime", "t2gicons"); ?></option>
									<option value="yellow" data-icon="<?php echo plugins_url( '../assets/color-icons/yellow.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Yellow", "t2gicons"); ?></option>
									<option value="amber" data-icon="<?php echo plugins_url( '../assets/color-icons/amber.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Amber", "t2gicons"); ?></option>
									<option value="orange" data-icon="<?php echo plugins_url( '../assets/color-icons/orange.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Orange", "t2gicons"); ?></option>
									<option value="deep-orange" data-icon="<?php echo plugins_url( '../assets/color-icons/deep-orange.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Deep-orange", "t2gicons"); ?></option>
									<option value="brown" data-icon="<?php echo plugins_url( '../assets/color-icons/brown.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Brown", "t2gicons"); ?></option>
									<option value="grey" data-icon="<?php echo plugins_url( '../assets/color-icons/grey.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Grey", "t2gicons"); ?></option>
									<option value="blue-grey" data-icon="<?php echo plugins_url( '../assets/color-icons/blue-grey.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Blue grey", "t2gicons"); ?></option>
									<option value="black" data-icon="<?php echo plugins_url( '../assets/color-icons/black.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("Black", "t2gicons"); ?></option>
									<option value="white" data-icon="<?php echo plugins_url( '../assets/color-icons/white.gif' , __FILE__ ); ?>" class="left circle"><?php echo esc_attr__("White", "t2gicons"); ?></option>
								</select>
						  	</div>
						</div>
						<div class="t2gicons-form-section">
							<h6 class="t2gicons-form-section-title"><span><?php echo esc_attr__("Link", "t2gicons"); ?></span></h6>
							<div class="t2gicons-clearfix t2gicons-link-preview">
								<p><a id="t2gicons_preview_icon_link" class="t2gicon-link" href="!#" target="_blank"><span class="t2gicons-link-value" id="t2gicons_preview_icon_link_text"><?php echo esc_attr__("Add your URL", "t2gicons"); ?></span></a></p>
								<input placeholder="Link URL" id="t2gicons_input_link" name="t2gicons_input_link" type="text">
								<span class="t2gicons-link-label"><?php echo esc_attr__("Open link in:", "t2gicons"); ?></span><br>
								<p>
									<input name="t2gicons_input_target" type="radio" value="_blank" id="t2gicons_input_target_blank" />
						      		<label for="t2gicons_input_target_blank" ><?php echo esc_attr__("New window", "t2gicons"); ?></label>
						      	</p>
						      	<p>
						      		<input name="t2gicons_input_target" type="radio" value="_top" id="t2gicons_input_target_top" />
						      		<label for="t2gicons_input_target_top" ><?php echo esc_attr__("Same window", "t2gicons"); ?></label>
						      	</p>
							</div>
						</div>
					</form>
				</div>
				<div class="col s12 m4">
					<h5><?php echo esc_attr__("Preview", "t2gicons"); ?></h5>
					<div class="t2gicons-pushpin-container">	
						<div id="t2gicons_pushpin" class="t2gicons-pushpin">
							<div id="t2gicons_preview_icon" class="t2gicons-card t2gicons-icon-preview" data-icontype="" data-size="200" data-fontsize="100" data-bgcolor="blue" data-color="white" data-shape="rsquare" data-align="center" data-link="" data-target="_blank" >
								<p class="t2gicons-clearfix">
									<i class=""></i>
								</p>
								<p class="t2gicons-classname" id="t2gicons_classname"></p>
								<p class="t2gicons-shortcode-content" id="t2gicons_shortcodecontent"></p>
							</div>
							<p>
								<a href="#" class="btn light-green darken-1" id="t2gicons_addicons" data-target="tinymce"><?php echo esc_attr__("ADD ICON", "t2gicons"); ?></a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php  
	echo ob_get_clean();
}}
add_action('admin_footer', 't2gicons_modal_iconslist', 999999);
