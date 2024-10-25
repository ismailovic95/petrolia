<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/
?>
<span class="evenz-p-catsext"><i class="material-icons evenz">label</i><?php evenz_postcategories( 1 ); ?></span> <span class="evenz-date"><i class="material-icons">today</i><?php echo get_the_date( get_option( 'date_format' ) ); ?></span>