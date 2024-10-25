<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Off canvas
 */
?>
<nav id="evenz-overlay" class="evenz-overlay evenz-paper">
	<div class="evenz-overlay__closebar"><span class="evenz-btn evenz-btn__r"  data-evenz-switch="evenz-overlayopen" data-evenz-target="#evenz-body"> <i class="material-icons">close</i></span></div>

	<?php  
	/**
	 * =======================================================
	 * MOBILE ONLY
	 * 
	 */
	?>
	<div class="evenz-hide-on-large-only">
		<?php

		/**
		 * Remove any trace of megamenu classes to be very sure
		 */
		function evenz_nav_menu_css_class($classes) {
		    $custom_classes = array();
		    foreach($classes as $class) {
		        $class = str_replace('qt-megamenu-is', 'qt-megamenu-was', $class);
		        $custom_classes[] = $class;
		    }
		    return $custom_classes;
		}
		add_filter('nav_menu_css_class', 'evenz_nav_menu_css_class');


		/**
		 * Primary menu - mobile sidebar
		 */
		if ( has_nav_menu( 'evenz_menu_primary' ) ) { 
			?>
			<ul class="evenz-menu-tree">
				<?php
				wp_nav_menu( array (
					'theme_location' => 'evenz_menu_primary',
					'depth' => 3,
					'container' => false,
					'items_wrap' => '%3$s'
				) );
				?>
			</ul>
			<?php 
		} 

		/**
		 * Secondary menu - mobile sidebar
		 */
		if ( has_nav_menu( 'evenz_menu_secondary' ) ) { 
			?>
			<ul class="evenz-menu-tree evenz-menu-tree__secondary">
				<?php  
					wp_nav_menu( array(
						'theme_location' => 'evenz_menu_secondary',
						'depth' => 1,
						'container' => false,
						'items_wrap' => '%3$s'
					) );
				?>
			</ul>
			<?php 
		} 
		?>
	</div>
	<?php  
	/**
	 * 
	 * MOBILE ONLY END
	 * =======================================================
	 */
	?>

	<?php  
	/**
	 * =======================================================
	 * DESKTOP ONLY
	 * 
	 */
	?>
	<div class="evenz-hide-on-large-and-down">
		<?php 
		/**
		 * Primary menu - mobile sidebar
		 */
		if ( has_nav_menu( 'evenz_menu_desktop_off' ) ) { 
			?>
			<ul class="evenz-menu-tree">
				<?php
				wp_nav_menu( array (
					'theme_location' => 'evenz_menu_desktop_off',
					'depth' => 3,
					'container' => false,
					'items_wrap' => '%3$s'
				) );
				?>
			</ul>
			<?php 
		} 
		?>
	</div>
	<?php  
	/**
	 * 
	 * DESKTOP ONLY END
	 * =======================================================
	 */
	?>

	<?php  
	/**
	 * =======================================================
	 * OFF CANVAS SIDEBAR
	 * 
	 */
	if( is_active_sidebar( 'evenz-offcanvas-sidebar' ) ){
		?>
		<div id="evenz-sidebar-offcanvas" role="complementary" class="evenz-sidebar evenz-sidebar__secondary evenz-sidebar__offcanvas">
			<ul class="evenz-row">
				<?php dynamic_sidebar( 'evenz-offcanvas-sidebar' ); ?>
			</ul>
		</div>
		<?php 
	}
	/**
	 * 
	 * OFF CANVAS SIDEBAR END
	 * =======================================================
	 */
	?>
</nav>
<div class="evenz-overlay__pagemask" data-evenz-switch="evenz-overlayopen" data-evenz-target="#evenz-body"></div>