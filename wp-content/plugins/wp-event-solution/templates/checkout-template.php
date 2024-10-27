<?php 

if( wp_is_block_theme() ){
    block_header_area();
    wp_head();
}else{
    wp_head();
    get_header();
}

// purchase module script
wp_enqueue_script( 'etn-module-purchase');
?>

<div id="eventin-checkout" style="width: 100%;"></div>

<?php 
    if( wp_is_block_theme() ){
        block_footer_area();
        wp_footer();
    }else{
        wp_footer();
        get_footer();
    }
?>
 