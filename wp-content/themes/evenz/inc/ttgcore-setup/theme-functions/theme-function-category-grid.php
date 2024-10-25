<?php
/**
 * @package WordPress
 * @subpackage evenz
 * @version 1.0.0
 * Theme function for custom parts:
 * Category grid
 *
 * Example:
 * [qt-category-grid label="Posts|whatever" hide_empty="0|1" include="all|''|1,2,3" exclude="false|1,2,3" exclude="''|1,2,3" parent="1|0" child_of="false|1,2,3"]
*/

if(!function_exists( 'evenz_template_category_grid' )){
	function evenz_template_category_grid( $atts = array() ){
		extract( shortcode_atts( array(
			'amount'				=> '4',
			'taxonomy'				=> 'category',
			'cols_l'				=> '4',// cols desktop default
			'cols_m'				=> '3',// cols tablet default
			'label'					=> esc_html__( 'Posts', 'evenz' ),
			'hide_empty' 			=> 0, //can be 1, '1' too
			'include' 				=> 'all', //empty string(''), false, 0 don't work, and return empty array
			'exclude' 				=> false, //empty string(''), false, 0 don't work, and return empty array
			'exclude_tree' 			=> '', //empty string(''), false, 0 don't work, and return empty array
			'parent' 				=> '1', // if "1", will show only first level categories
			'child_of' 				=> false,
			'el_id'					=> 'qt-category-grid-'.get_the_ID(), // 
			'grid_id'				=> false, // required for compatibility with WPBakery Page Builder
		), $atts ) );

		// Hide empty categories
		if( $hide_empty == 0 ){
			$args['hide_empty'] = 0;
		} else {
			$args['hide_empty'] = 1;
		}
		// include only these
		if( $include !== 'all' && $include !== '' ){
			$args['include'] = array_map( 'trim', explode(',', $include) );
		}
		// esclude only these
		if( $exclude ){
			$args['exclude'] =  array_map( 'trim', explode(',', $exclude) );
		}
		// esclude all the cats under these IDs
		if( $exclude_tree ){
			$args['exclude_tree'] = array_map( 'trim', explode(',', $exclude_tree) );
		}
		// show only first level
		if( $parent == '1' ){
			$args['parent'] = 0;
		}
		// sub cats of a parent id
		if( $child_of ){
			$args['child_of'] = intval( $child_of );
			unset( $args['parent'] );
		}

		$args['taxonomy'] = $taxonomy;
		// get right post type for this taxonomy
		switch ($taxonomy){
			case "evenz_eventtype":
				$post_type = 'evenz_event';
				break;
			case "product_cat":
			case "product_tag":
				$post_type = 'product';
				break;
			default: 
				$post_type = 'post';
		}


		// Unique ID
		if(false === $grid_id){
			$grid_id = 'grid'.$el_id;
		}
		$grid_id = str_replace(':', '-', $grid_id);
		$cats = evenz_get_sorted_categories( 'id', $args, $taxonomy, $post_type  );
		ob_start();
		if( count($cats) > 0 ){
			
		?>

		<div id="<?php echo esc_attr( $grid_id ); ?>" class="evenz-container evenz-template-category-grid">
			<div class="evenz-row">
				<?php
				$amount = intval($amount);
				$index = 0;
				foreach($cats as $var => $val){

					if($index < $amount){

						$catid = $val->term_taxonomy_id; 
						$link = get_category_link( $catid );
						$name = $val->cat_name;
						

						if( 'category' == $taxonomy ){
							$tax_ob = get_category($catid);
							$count = $tax_ob->category_count;
						} else {
							$tax_ob = get_term($catid);
							$count = $tax_ob->count;
						}
						$image_id =  get_term_meta( $catid , 'qt_taxonomy_img_id', true );
						$tax_color = get_term_meta( $catid , 'qt_taxonomy_color', true );

						// Width
						
						$class_l = 12 / intval($cols_l);
						$class_m = 12 / intval($cols_m);

						?>

						<div class="evenz-col evenz-s12 evenz-m<?php echo esc_attr( $class_m ); ?> evenz-l<?php echo esc_attr( $class_l ); ?> evenz-catid-<?php echo esc_attr( $catid ); ?>">
							<a class="evenz-cat-card evenz-negative" href="<?php echo esc_url( $link ); ?>">
								<?php
								if( $image_id ){
									$img = wp_get_attachment_image_src ( $image_id, 'evenz-squared-m' ); 
									?><img src="<?php echo esc_url( $img[0] ); ?>" width="<?php echo esc_attr( $img[1] ); ?>" height="<?php echo esc_attr( $img[2] ); ?>" alt="<?php echo esc_attr( $name ); ?>" /><?php
								}
								?>
								<h6 class="evenz-caption__s"><?php echo esc_html( $name ); ?></h6>
							</a>
						</div>

						<?php
						$index ++;
					}
				}
				?>
			</div>
		</div>
		<?php
		}
		// Output end
		$output = ob_get_clean();
		return $output;
	}
}


// Set TTG Core shortcode functionality
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-category-grid","evenz_template_category_grid");
}



/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'evenz_template_category_grid_vc' );
if(!function_exists('evenz_template_category_grid_vc')){
function evenz_template_category_grid_vc() {
  vc_map( array(
	 "name" 		=> esc_html__( "Categories grid", "evenz" ),
	 "base" 		=> "qt-category-grid",
	 "icon" 		=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/category-grid.png' ),
	 "description" 	=> esc_html__( "Display a grid of categories", "evenz" ),
	 "category" 	=> esc_html__( "Theme shortcodes", "evenz"),
	 "params" 		=> array(
	 	array(
		   "type" 		=> "textfield",
		   "heading" 	=> esc_html__( "Max amount", "evenz" ),
		   "param_name" => "amount",
		   'std'		=> '4' // not translatable, is a dynamic parameter for the query
		),
		array(
		   "type" 		=> "textfield",
		   "heading" 	=> esc_html__( "Label for posts count", "evenz" ),
		   "param_name" => "label",
		   'std'		=> esc_html__( 'Posts', 'evenz' )
		),
		array(
			"type" 		=> "dropdown",
			"heading" 	=> esc_html__( "Hide empty categories", "evenz" ),
			"param_name"=> "hide_empty",
			'std'		=> 0,
			'value' 	=> array( 
				esc_html__( "No","evenz") 	=> 0,
				esc_html__( "Yes","evenz") 	=> "1",
				
				)			
			),
		array(
			"type" 		=> "dropdown",
			"heading" 	=> esc_html__( "Display sub-categories", "evenz" ),
			"param_name"=> "parent",
			'std'		=> '1',
			'value' 	=> array( 
				esc_html__( "No","evenz") 	=> "1",
				esc_html__( "Yes","evenz") 	=> "0",
				
				)			
			),


		array(
			"type" 		=> "dropdown",
			"heading" 	=> esc_html__( "Columns desktop", "evenz" ),
			"param_name"=> "cols_l",
			'std'		=> '4',
			'value' 	=> array( 
				'1', '2', '3', '4'
				)			
			),
		array(
			"type" 		=> "dropdown",
			"heading" 	=> esc_html__( "Columns medium screen", "evenz" ),
			"param_name"=> "cols_m",
			'std'		=> '3',
			'value' 	=> array( 
				'1', '2', '3'
				)			
			),

		array(
			"type" 		=> "dropdown",
			"heading" 	=> esc_html__( "Taxonomy", "evenz" ),
			"param_name"=> "taxonomy",
			'std'		=> 'category',
			'value' 	=> array( 
				esc_html__( "Category","evenz") 	=> "category",
				esc_html__( "Post tag","evenz") 	=> "post_tag",

				esc_html__( "WooCommerce categories","evenz") => "product_cat",
				esc_html__( "WooCommerce tags","evenz") => "product_tag",
				esc_html__( "Event types","evenz") => "evenz_eventtype",
				
				)			
			),

		

		array(
		   "type" 		=> "textfield",
		   "heading" 	=> esc_html__( "Include by id, comma separated", "evenz" ),
		   "param_name" => "include",
		   'std'		=> 'all' // not translatable, is a dynamic parameter for the query
		),
		array(
		   "type" 		=> "textfield",
		   "heading" 	=> esc_html__( "Exclude by id, comma separated", "evenz" ),
		   "param_name" => "exclude",
		   'std'		=> false // not translatable, is a dynamic parameter for the query
		),
		array(
		   "type" 		=> "textfield",
		   "heading" 	=> esc_html__( "Exclude entire tree by id, comma separated", "evenz" ),
		   "param_name" => "exclude",
		),
		array(
		   "type" 		=> "textfield",
		   "heading" 	=> esc_html__( "Child of (ID)", "evenz" ),
		   "param_name" => "child_of",
		),
	 )
  ) );
}}

