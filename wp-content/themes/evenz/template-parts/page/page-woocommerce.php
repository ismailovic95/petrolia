<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

get_header('shop'); 
?>
	<div class="evenz-maincontent">
		<div class="evenz-entrycontent">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; endif; ?>
		</div>
	</div>
<?php 
get_footer('shop');