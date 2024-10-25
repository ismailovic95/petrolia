<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
*/

/* Gets the taxonomy associated with any post type for other queries
=============================================*/
if(!function_exists('evenz_get_type_taxonomy')){
function evenz_get_type_taxonomy($posttype){
	if($posttype != ''){
		switch($posttype){
			case "product":
				$taxonomy = 'product_cat';
				break;
			case "evenz_event":
				$taxonomy = 'evenz_eventtype';
				break;
			case "evenz_member":
				$taxonomy = 'evenz_membertype';
				break;
			case "evenz_testimonial":
				$taxonomy = 'evenz_testimonialcat';
				break;
			default:
				$taxonomy = 'category';
		}
	}
	return $taxonomy;
}}