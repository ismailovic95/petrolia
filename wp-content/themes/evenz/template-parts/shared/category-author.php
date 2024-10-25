<?php
/**
 * 
 * Display author and date for a post
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

?>
<span class="evenz-p-catz"><?php evenz_postcategories( 10 ); ?></span> <span class="evenz-p-auth"><?php the_author(); ?></span>