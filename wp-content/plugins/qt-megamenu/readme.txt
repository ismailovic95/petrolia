/**
 * INSTRUCTIONS
 * ────────────────────────────────────────────────────────────
 * After the activation a new item will appear on the admin menu.
 * 1. In Page Builder > Role Manager - enable Page Builder for  qt__megamenu_page
 * 2. in PHP in the theme, add the megamenu tag:
 * ────────────────────────────────────────────────────────────
	
	if( function_exists('qt__megamenu_display')) {
		qt__megamenu_display();
	}
	
 * ────────────────────────────────────────────────────────────
 * 3. Add the the menu items the class qt-megamenu-is-XXXXXX
 * 
 */



NOTES:

PAGE BUILDER MENU ITEM
If you add items on the right side of page builder, add the class last to the menu element