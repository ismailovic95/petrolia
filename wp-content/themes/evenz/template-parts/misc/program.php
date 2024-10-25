<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * 
 * Display a program for multi schedules
 * 
*/


$program = evenz_program_display( $post->ID , false); // no output
if( $program && $program !== ''){

	?>
	<div class="evenz-event-program evenz-spacer-m">
		<h5 class="evenz-caption evenz-caption__s"><span><?php esc_html_e( 'Program' , 'evenz' ); ?></span></h5>
		<?php  
		echo wp_kses_post( $program );
		?>
	</div>
	<hr class="evenz-spacer-m">
	<?php
} 