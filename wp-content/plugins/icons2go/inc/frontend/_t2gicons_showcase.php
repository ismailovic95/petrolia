<?php
/**
 * @package t2gicons
 * @author Themes2Go
 * @textdomain t2gicons
 * Showcase frontend function
 */
if(!function_exists("t2gicons_showcase")){
	function t2gicons_showcase($atts) {

		$t2gicons_families = t2gicons_families();
		$shapes = array("none", "circle", "square", "rsquare", "rhombus", "circle-border", "square-border", "rsquare-border", "rhombus-border");
		$colors = array("red","pink","purple","deep-purple","indigo","blue","light-blue","cyan","teal","green","light-green","lime","yellow","amber","orange","deep-orange","brown","grey","blue-grey","black","white");
		$bgcolors = $colors;


		$total = 0;
		$set = count($t2gicons_families);
		foreach($t2gicons_families as $family){
			$total = $total +  count( $family['classes']);
		}

		ob_start();
		?>
		<div class="t2gicons-showcase">
			<h2>Icons2Go (<?php echo esc_attr($set); ?> <?php echo esc_attr__("icon sets", "t2gicons"); ?> - <?php echo esc_attr($total) ?> <?php echo esc_attr__("icons", "t2gicons"); ?>)</h2>
			
			<h4><?php echo ucfirst(esc_attr__("icon sets", "t2gicons")); ?></h4>
			<ul>
				<?php  
				
				foreach($t2gicons_families as $family){
					$icons = $family['classes'];
					$total = $total +  count($icons);
					?>
					<li><a href="#link-<?php echo esc_attr($family['options_name']); ?>"><?php echo esc_attr($family['label']); ?> (<?php echo count($icons); ?> <?php echo esc_attr__("icons", "t2gicons"); ?>)</a></li>
					<?php
				}
				?>
			</ul>

			<?php  
			foreach($t2gicons_families as $family){
				$icons = $family['classes'];
				?>
				<div id="link-<?php echo esc_attr($family['options_name']); ?>" class="t2gicons-showcase-section">
					<h3><?php echo esc_attr($family['label']); ?> (<?php echo count($icons); ?> <?php echo esc_attr__("icons", "t2gicons"); ?>)</h3>
					<p>
						<?php 
						foreach ($icons as $i){
							echo do_shortcode('[t2gicons icontype="'.$i.'" align="left" size="120" fontsize="90" bgcolor="blue" color="white" shape="rsquare" classes="t2gicons-showcaseicon"] ' );

						}
						?>
					</p>
					<a href="#top"><?php echo esc_attr__("Top","t2gicons"); ?> </a>
				</div>
				<?php 
			}
			?>
			
			
		

		</div>
		<?php  

		
		return ob_get_clean();
	}
}


add_shortcode("t2gicons-showcase","t2gicons_showcase");





if(!function_exists("t2gicons_showcasestyles")){
	function t2gicons_showcasestyles($atts) {

		$t2gicons_families = t2gicons_families();
		$shapes = array("none", "circle", "square", "rsquare", "rhombus", "circle-border", "square-border", "rsquare-border", "rhombus-border");
		$colors = array("red","pink","purple","deep-purple","indigo","blue","light-blue","cyan","teal","green","light-green","lime","yellow","amber","orange","deep-orange","brown","grey","blue-grey","black","white");
		$bgcolors = $colors;


		$total = 0;
		$set = count($t2gicons_families);
		foreach($t2gicons_families as $family){
			$total = $total +  count( $family['classes']);
		}

		ob_start();
		?>
		<div class="t2gicons-showcase">
			
			<h4><?php echo ucfirst(esc_attr__("icon styles", "t2gicons")); ?></h4>
			<ul>
				<?php  
				
				foreach($shapes as $shape){
					?>
					<li><a href="#link-<?php echo esc_attr($shape); ?>"><?php echo esc_attr($shape); ?></a></li>
					<?php
				}
				?>
			</ul>
			<?php   
			foreach($shapes as $shape){ 
				?>
				<div id="link-<?php echo esc_attr($shape); ?>" class="t2gicons-showcase-section">
					<h3><?php echo  esc_attr("Shape: ","t2gicons").' '.esc_attr($shape); ?></h3>
					<p>
						<?php  
						foreach($colors as $color){
							if($color == "white" &&  ($shape == "circle-border" || $shape == "rsquare-border" || $shape == "square-border" || $shape == "rhombus-border" )) { 
								continue; 
							}
							
							if($shape == "none"){
								echo do_shortcode('[t2gicons icontype="t2gicon-sport-winning-star-laurel-branch" align="left" size="120" fontsize="90" color="'.$color.'" shape="'.$shape.'" classes="t2gicons-showcaseicon"] ' );
							} else {
								foreach($bgcolors as $bgcolor){
									if($bgcolor != $color) {
										echo do_shortcode('[t2gicons icontype="t2gicon-sport-winning-star-laurel-branch" align="left" size="120" fontsize="90" bgcolor="'.$bgcolor.'" color="'.$color.'" shape="'.$shape.'" classes="t2gicons-showcaseicon"] ' );
									}
								}
							}
						}
					?>
					</p>
				</div>
			<?php 
			} ?>
			<a href="#top"><?php echo esc_attr__("Top","t2gicons"); ?> </a>
		</div>
		<?php  
		return ob_get_clean();
	}
}


add_shortcode("t2gicons-showcasestyles","t2gicons_showcasestyles");