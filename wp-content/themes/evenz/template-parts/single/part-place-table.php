<?php
/**
 * Table of place details
 * 
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

/**
 * 
 * List of public fields added with the QT Places plugin
 * 
 */
$details = array(
	
	'qt_location' 	=> esc_html__( 'Location', 'evenz' ),
	'qt_country' 	=> esc_html__( 'Country', 'evenz' ),
	'qt_address' 	=> esc_html__( 'Address', 'evenz' ),
	'qt_city' 		=> esc_html__( 'City', 'evenz' ),
	'qt_link' 		=> esc_html__( 'Link', 'evenz' ),
	'qt_phone' 		=> esc_html__( 'Phone', 'evenz' ),
	'qt_email' 		=> esc_html__( 'Email', 'evenz' ),
);


?>
<div class="evenz-place-table">
	<table>
		<?php  
		/**
		 * 
		 * Display the fields
		 * 
		 */
		foreach( $details as $key => $label ){
			$data = get_post_meta( $post->ID, $key, true);
			if( $data ){

				// Link the URL
				if('qt_link' == $key ){
					$data = '<a href="'.esc_url( $data ).'" target="_blank" rel="nofollow">'.wp_kses_post( $data ).'</a>';
				}

				// Link the phone call
				if('qt_phone' == $key ){
					$data = '<a href="tel:'.esc_attr( $data ).'" rel="nofollow">'.wp_kses_post( $data ).'</a>';
				}

				// Link the email
				if('qt_email' == $key ){
					$data = '<a href="mailto:'.esc_attr( $data ).'" rel="nofollow">'.wp_kses_post( $data ).'</a>';
				}

				?>
				<tr class="evenz-meta evenz-place-table__<?php echo esc_attr($key); ?>">
					<th>
						<?php echo esc_html( $label ); ?>
					</th>
					<td>
						<?php echo wp_kses_post( $data ); ?>
					</td>
				</tr>
				<?php 
			} 
		}
		?>
	</table>
</div>