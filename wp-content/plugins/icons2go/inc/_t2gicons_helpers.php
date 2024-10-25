<?php
/**
 * @package t2gicons
 * @author Themes2Go
 * @textdomain t2gicons
 *
 * 
 *	Helper functions
 */


/**
 *
 *	Function to detect if the icons are enabled for the specific posttype
 * 
 */
if(!function_exists('t2gicons_function_enabled')){
	function t2gicons_function_enabled() {
		/**
		 * 
		 * We need to control if we are in the correct editor page to not overload the performance
		 */
		if(function_exists('get_current_screen')){
			$screen = get_current_screen();
			/**
			 * We do NOT use the icons if we are not in the editor
			 */
			if ($screen->base != "post" ) {
				return false;
			}
		}

		/**
		 * If we are still here, means we load the icons admin
		 */
		return true;
		
	}
}

