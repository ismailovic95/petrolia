<?php
/**
 * @package t2gicons
 * @author Themes2Go
 * @textdomain t2gicons
 * Showcase frontend function
 */
if(!function_exists("t2gicons_editor")){
	function t2gicons_editor($atts) {
		ob_start();
		wp_enqueue_style( 't2gicons_backend_Style');
		wp_enqueue_script( 't2gicons_backend_Script');


		?>
		<div class="t2gicons-framework">
			<a id="t2gicons-openmodal" href="#!" class="btn btn-large btn-primary">
			OPEN ICONS EDITOR EXAMPLE
			</a>
		</div>
		
		<?php


		// t2gicons_modal_iconslist();
		add_action("wp_footer", "t2gicons_modal_iconslist");

		return ob_get_clean();
	}
}


add_shortcode("t2gicons-editor","t2gicons_editor");