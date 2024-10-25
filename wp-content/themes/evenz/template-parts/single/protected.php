<?php
/**
 * Protected post
 * 
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/
?>
<div class="evenz-section">
	<div class="evenz-container">
		<div class="evenz-entrycontent">
			<div class="evenz-card evenz-pad evenz-paper">
				<div class="evenz-single__pwform">
					<h6 class="evenz-caption"><?php esc_html_e( "This post is protected, please insert the password", 'evenz' ); ?></h6>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
</div>