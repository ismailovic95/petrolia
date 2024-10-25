<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

/**
 * ======================================================
 * Display logo or site name.
 * Native WP function is super buggy and doesn't support
 * live refreshing, while ours does.
 * ======================================================
 */
if(!function_exists('evenz_show_logo')){
function evenz_show_logo( $alternative = ''){
	$logo = get_theme_mod("evenz_logo".$alternative, '');
	ob_start();
	if($logo != ''){
		?>
		<img src="<?php echo esc_url( $logo ); ?>" class="evenz-logo<?php echo esc_attr( $alternative ); ?>" alt="<?php echo esc_attr( bloginfo('name') ); ?>">
		<?php
	}else{
		?>
		<span class="evenz-sitename evenz-logo<?php echo esc_attr( $alternative ); ?>"><?php bloginfo('name'); ?></span>
		<?php
	}
	return ob_get_clean();
}}
