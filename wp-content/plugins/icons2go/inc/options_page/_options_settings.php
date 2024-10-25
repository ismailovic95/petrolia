<?php
/**
* @package t2gicons
* @author Themes2Go
* @textdomain t2gicons
*/
?>

<div class="row">
	<div class="col s12 m9">
		<div class="t2gicons-card">
			<p><?php echo esc_attr__("Tip: click on any icon to bookmark this icon set and remember which one you like. Bookmarks are not stored. Activate a set to make it available in the editor and frontend.", "t2gicons"); ?></p>
			<?php t2gicons_archive(true); ?>
		</div>
	</div>
	<div class="col s12 m3">
		<div class="t2gicons-pushpin-container-admin">
			<div class="t2gicons-pushpin-admin">
				<div class="t2gicons-card">
					<?php 
					$active_filter = false;
					foreach($t2gicons_families as $family){ 
						if(get_option($family['options_name']) == '1') { 
							$active_filter = true;
						}
					}
					?>
					<?php if($active_filter){ ?>
						<h6 class="t2gicons-form-section-title"><span><?php echo esc_attr__("Filter", "t2gicons"); ?></span></h6>
						<div class="input-field">
							<i class="dashicons dashicons-search prefix"></i>
							<input placeholder="<?php echo esc_html__("Search icon:", "t2gicons"); ?>" id="t2gicons_search" name="t2gicons_search" type="text">
						</div>
					<?php } ?>
					<h6 class="t2gicons-form-section-title"><span><?php echo esc_attr__("Navigate sets", "t2gicons"); ?></span></h6>
					<ul class="t2gicons-table-of-contents section table-of-contents">
					<?php  
					foreach($t2gicons_families as $family){
						?>
						<li>
							<a id="t2gicons-link-<?php echo esc_attr($family['options_name']);  ?>" href="#t2gicons-section-<?php echo $family['options_name']; ?>" class="qt-smoothscroll">
								<?php if(get_option($family['options_name']) == '1') { ?>
									<span class="icon dashicons dashicons-yes t2gicons-color-active"></span>
								<?php } else { ?>
									<span class="icon dashicons dashicons-no t2gicons-color-inactive"></span>
								<?php } ?>
								<span class="label"><?php echo esc_attr($family['label']); ?></span>
								<span class="label bookmarked   t2gicons-hidden">
									<i class="icon dashicons dashicons-star-filled amber-text accent-4"></i>
									<?php if(get_option($family['options_name']) !== '1') { ?>
									<i class="dashicons dashicons-warning deep-orange-text accent-2 "></i> Inactive
									<?php } ?>
								</span>
								
							</a>
						</li>
						<?php  
					}
					?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="t2gicons-pushpin-admin-bottom"></div>