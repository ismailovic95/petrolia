<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 */

get_header(); 
?>
	<div id="evenz-pagecontent" class="evenz-pagecontent evenz-single evenz-single__fullwidth">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="evenz-maincontent">
			<div class="evenz-entrycontent">
			<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; endif; ?>
	</div>
<?php 
get_footer();