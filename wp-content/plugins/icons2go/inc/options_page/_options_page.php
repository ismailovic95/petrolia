<?php
/**
 * @package t2gicons
 * @author Themes2Go
 * @textdomain t2gicons
 */

/**
 * Create options page
 */
add_action('admin_menu', 't2gicons_create_optionspage');
if(!function_exists('t2gicons_create_optionspage')){
	function t2gicons_create_optionspage() {
		add_options_page('Icons2go', 'Icons2go', 'manage_options', 't2gicons_settings', 't2gicons_options');
	}
}


/**
 *  Main options page content
 */
if(!function_exists('t2gicons_options')){
	function t2gicons_options() {

		$t2gicons_families = t2gicons_families();

		/**
		 *  We check if the use is qualified enough
		 */
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}


 
		/**
		 *  Options page content
		 */
		 ?>
		<div class="t2gicons-framework t2gicons-optionspage">
			<p class="right blue-grey-text lighten-3">V. <?php echo esc_attr(t2gicons_plugin_get_version()); ?></p>
			<h2 class="t2gicons-modaltitle"><img src="<?php echo plugins_url( '../../assets/icons2go-logo.png' , __FILE__ ); ?>" alt="Themes2Go logo"><?php echo esc_attr__("Settings", "t2gicons"); ?></h2>
			<p>
			<a href="#manual" class="t2gicons-smoothscroll"><?php echo esc_attr__("Manual", "t2gicons"); ?></a> | 
			<a href="#shortcode" class="t2gicons-smoothscroll"><?php echo esc_attr__("Shortcode settings", "t2gicons"); ?></a>
			</p>

			<?php  require plugin_dir_path( __FILE__ ) . '/_options_settings.php'; ?>
			<a id="manual"></a>
			<?php  require plugin_dir_path( __FILE__ ) . '/_options_manual.php'; ?> 
			<a id="shortcode"></a>
			<?php  require plugin_dir_path( __FILE__ ).'_options_shortcode_example.php'; ?>
			
			<a href="#top"><?php echo esc_attr__("Scroll to top", "t2gicons"); ?></a>
		</div>
		<?php 
	}
}