<?php  
/**
 * 
 * SPECIAL FILTER FOR THE MENU EFFECT
 * 
 */
add_filter('nav_menu_item_args', function ($args, $item, $depth) {
        $title             = apply_filters('the_title', $item->title, $item->ID);
        $args->link_before = '<span>';
        $args->link_after  = '</span>';
    return $args;
}, 10, 3);
