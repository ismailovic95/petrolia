<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */
?>

<div id="evenz-headerbar" class="evenz-headerbar <?php if( get_theme_mod('evenz_header_sticky') ){ ?> evenz-headerbar__sticky <?php } ?>" <?php if( get_theme_mod('evenz_header_sticky') ){ ?> data-evenz-stickyheader <?php } ?>>
	<div id="evenz-headerbar-content" class="evenz-headerbar__content evenz-paper">
		<?php  
		/**
		 * Secondary Header
		 * ============================= */
		if( get_theme_mod('evenz_sec_head_on') ){
			get_template_part( 'template-parts/header/secondary-header' );
		}

		/**
		 * Menu
		 * ============================= */
		get_template_part( 'template-parts/header/menu' );
		?>
	</div>
</div>

<?php  
/**
 * Off canvas
 * ============================= */
get_template_part( 'template-parts/header/offcanvas' );

