<?php
/**
 * 
 *
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

$date = get_post_meta($post->ID, 'evenz_date',true);
$day = '';
$monthyear = '';

if($date && $date != ''){
	$day = date( "d", strtotime( $date ));
	$monthyear=esc_attr(date_i18n("M Y",strtotime($date)));
}

$country = get_post_meta($post->ID, 'qt_country',true);


$classes = array( 'evenz-post','evenz-post__card','evenz-post__card--event','evenz-darkbg','evenz-negative' );
?>
<article <?php post_class( $classes ); ?>>
	<div class="evenz-bgimg evenz-bgimg--full evenz-duotone">
		<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'evenz-squared-m', array( 'class' => 'evenz-post__thumb') ); } ?>
	</div>
	<div class="evenz-post__headercont">
		<?php  
		get_template_part( 'template-parts/shared/actions' ); 
		?>
		<h5 class="evenz-post__card--event__bigdate evenz-post__event__d evenz-capfont">
			<i class="material-icons">today</i>
			<span><?php echo esc_html( $day ); ?></span>
			<span><?php echo esc_html( $monthyear ); ?></span>
		</h5>
		<div class="evenz-post__card__cap">
				
				<?php
				/**
				 * Country
				 */

				if ($country && $country !== ''){
					?><p class="evenz-meta evenz-small cutme"><?php echo get_the_term_list( $post->ID, 'evenz_eventtype' , '<i class="material-icons evenz">label</i>', ' / ', ''); ?> <i class="material-icons">my_location</i><?php echo esc_html( $country ); ?></p><?php 
				}
				
				?>
			
			<h3 class="evenz-post__title evenz-cutme-t-3 evenz-h3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div>
	</div>
	<span class="evenz-hov"></span>
</article>