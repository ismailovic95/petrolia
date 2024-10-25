<?php
/**
 * 
 * Display author and date for a post in archive
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/
?>
<span class="evenz-p-catz"><?php evenz_postcategories( 1 ); ?></span> <span class="evenz-p-auth"><?php the_author(); ?></span>