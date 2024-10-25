<?php  
/**
 *  Visual Composer integration
 */



if(!function_exists('qtplaces_custom_types_list')){
	function qtplaces_custom_types_list(){

		$args = array(
		   'public'   => true,
		   '_builtin' => false
		);
		$post_types = get_post_types( $args, 'names' ); 
		$allowedTypes = array();
		foreach ( $post_types as $post_type ) {
			if(get_option('qtmaps_typeselect_'.$post_type) == '1'){
				$allowedTypes[] = $post_type;
			}		   
		}

		$allowedTypes[] = 'post';
		$allowedTypes[] = 'page';
		$allowedTypes[] = 'event';
		$allowedTypes[] = 'place';

		$allowedTypes =array_unique($allowedTypes);

		return $allowedTypes;

	}
}





if(!function_exists('qtplaces_get_terms_array')) {
function qtplaces_get_terms_array( ) {
	$cats = get_terms(array(
		'hide_empty'=>false,
	));
	$result = array();
	if(is_wp_error( $cats ) || 0 === $cats){
		$result = array();
	}
	$current_taxonomy = '';
	foreach ( $cats as $cat )	{
		if( $cat->taxonomy == 'nav_menu'){
			continue;
		}
		$result[] = array(
			'value' => $cat->taxonomy.':'.$cat->slug,
			'label' => '['. str_replace('_', ' ', $cat->taxonomy) .'] <strong>'.$cat->name.'</strong>',
		);
	}
	return $result;
}}













add_action( 'vc_before_init', 'qtplaces_main_shortcode_vc' );
if(!function_exists('qtplaces_main_shortcode_vc')){
	function qtplaces_main_shortcode_vc() {

		/**
		 * 
		 * ===============================================
		 * Special query values and parameters
		 * ===============================================
		 * 
		 */
		$postTypes = get_post_types( array() );
		$postTypesList = array();
		$excludedPostTypes = array(
			'revision',
			'nav_menu_item',
			'custom_css',
			'customize_changeset',
			'vc_grid_item',
			'oembed_cache',
			'attachment',
		);
		if ( is_array( $postTypes ) && ! empty( $postTypes ) ) {
			foreach ( $postTypes as $postType ) {
				if ( ! in_array( $postType, $excludedPostTypes ) ) {
					$label = ucfirst( $postType );
					$postTypesList[] = array(
						$postType,
						$label,
					);
				}
			}
		}
		$postTypesList[] = array(
			'custom',
			__( 'Custom query', 'qt-places' ),
		);
		$postTypesList[] = array(
			'ids',
			__( 'List of IDs', 'qt-places' ),
		);


		$taxonomiesForFilter = array();

		if ( 'vc_edit_form' === vc_post_param( 'action' ) ) {
			$vcTaxonomiesTypes = vc_taxonomies_types();
			if ( is_array( $vcTaxonomiesTypes ) && ! empty( $vcTaxonomiesTypes ) ) {
				foreach ( $vcTaxonomiesTypes as $t => $data ) {
					if ( 'post_format' !== $t && is_object( $data ) ) {
						$taxonomiesForFilter[ $data->labels->name . ' [' . $t . ']' ] = $t;
					}
				}
			}
		}


		/**
		 * 
		 * ===============================================
		 * Mapping Page Builder shortcode
		 * ===============================================
		 * 
		 */
  		vc_map( 
  			array(
				"name" => esc_html__( "QT-Places Map", "qt-places" ),
				"base" => "qtplaces",
				// "icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/post-grid.png' ),
				"description" => esc_html__( "List of venues", "qt-places" ),
				"category" => esc_html__( "QT-Places", "qt-places"),
				"params" => 
					array(

						array(
							"group" 	=> esc_html__( "Data Settings", "qt-places" ),
							'type' => 'checkbox',
							'heading' => esc_html__( 'Debug parameters', 'qt-places' ),
							'param_name' => 'debug',
							
						),
						array(
							"group" 	=> esc_html__( "Data Settings", "qt-places" ),
							'type' => 'dropdown',
							'heading' => esc_html__( 'Post type', 'qt-places' ),
							'param_name' => 'posttype',
							'value' => qtplaces_custom_types_list(),
							'std' => 'post',
							'admin_label' => true,
						),


						array(
							'group' => esc_html__( 'Data Settings', 'qt-places' ),
							'type' 			=> 'autocomplete',
							'heading' => esc_html__( 'Narrow data source', 'qt-places' ),
							'description' => esc_html__( 'Enter categories, tags, formats or custom taxonomies.', 'qt-places' ),
							'param_name' 	=> 'tax_filter',
							'admin_label' => true,
							'settings'		=> array( 
								'values' 		 => qtplaces_get_terms_array() ,
								'multiple'       => true,
								'sortable'       => true,
					      		'min_length'     => 1,
					      		'groups'         => false,  // In UI show results grouped by groups
					      		'unique_values'  => true,  // In UI show results except selected. NB! You should manually check values in backend
					      		'display_inline' => true, // In UI show results inline view),
							),
							'dependency' => array(
								'element' => 'post_type',
								'value_not_equal_to' => array(
									'ids',
									'custom',
								),
							),
						),


						array(
							'group' => esc_html__( 'Data Settings', 'qt-places' ),
							'type' => 'textfield',
							'heading' => esc_html__( 'Total items', 'qt-places' ),
							'param_name' => 'limit',
							'std' => 10,
							'value' => 10,
							'description' => esc_html__( 'Set max limit for items in grid or enter -1 to display all (limited to 200).', 'qt-places' ),
							'dependency' => array(
								'element' => 'post_type',
								'value_not_equal_to' => array(
									'ids',
									'custom',
								),
							),
						),
						
						

						//////////////////////////////////// 
						/// DESIGN
						/// ////////////////////////////////
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Template', 'qt-places' ),
							'param_name' => 'template',
							'group' => esc_html__( 'Map design', 'qt-places' ),
							'value' => array(
								esc_html__( 'Fixed sidebar', 'qt-places' ) => '1',
								esc_html__( 'Sidebar left', 'qt-places' ) => '2',
								esc_html__( 'Sidebar right', 'qt-places' ) => '3',
							),
						),

						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Menu state', 'qt-places' ),
							'param_name' => 'open',
							'group' => esc_html__( 'Map design', 'qt-places' ),
							'std'=>'1',
							'value' => array(
								esc_html__( 'Open', 'qt-places' ) => '1',
								esc_html__( 'Closed', 'qt-places' ) => '0',
							),
						),

						

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Height desktop (px)', 'qt-places' ),
							'param_name' => 'mapheight',
							'group' => esc_html__( 'Map design', 'qt-places' ),
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Height mobile (px)', 'qt-places' ),
							'param_name' => 'mapheightmobile',
							'group' => esc_html__( 'Map design', 'qt-places' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Images in list menu', 'qt-places' ),
							'param_name' => 'listimages',
							'std'=>true,
							'value' => array(
								esc_html__( 'Show', 'qt-places' ) => true,
								esc_html__( 'Hide', 'qt-places' ) => false,
							),
							'group' => esc_html__( 'Map design', 'qt-places' ),
						),
						array(
							
							'heading' => esc_html__( 'Show filters', 'qt-places' ),
							'param_name' => 'showfilters',
							'type' => 'dropdown',
							'std'=>true,
							'value' => array(
								esc_html__( 'Show', 'qt-places' ) => true,
								esc_html__( 'Hide', 'qt-places' ) => false,
							),
							'group' => esc_html__( 'Map design', 'qt-places' ),
						),

						array(
							
							'heading' => esc_html__( 'Filters taxonomy', 'qt-places' ),
							'param_name' => 'taxonomy',
							'type' => 'dropdown',
							'std'=>'pcategory',
							'value' => $taxonomiesForFilter,
							'group' => esc_html__( 'Map design', 'qt-places' ),
						),




						


						array(
							'type' => 'checkbox',
							'heading' => esc_html__( 'Mouse wheel', 'qt-places' ),
							'param_name' => 'mousewheel',
							'group' => esc_html__( 'Map design', 'qt-places' ),
						),

						array(
							'heading' => esc_html__( 'Auto zoom on click', 'qt-places' ),
							'param_name' => 'autozoom',
							'group' => esc_html__( 'Map design', 'qt-places' ),
							'type' => 'dropdown',
							'std' => 0,
							'value' => array(
								esc_html__( 'No', 'qt-places' ) => 0,
								esc_html__( 'Yes, zoom on detail', 'qt-places' ) => '1',
							),
						),

						array(
							'type' => 'checkbox',
							'heading' => esc_html__( 'Street view allow', 'qt-places' ),
							'param_name' => 'streetview',
							'group' => esc_html__( 'Map design', 'qt-places' ),
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Text for "Get Directions" link', 'qt-places' ),
							'param_name' => 'getdirections',
							'group' => esc_html__( 'Map design', 'qt-places' ),
						),

						//////////////////////////////////// 
						/// COLORS
						/// ////////////////////////////////
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Colors', 'qt-places' ),
							'param_name' => 'mapcolor',
							'group' => esc_html__( 'Colors', 'qt-places' ),
							'value' => array(
								esc_html__( 'Dark', 'qt-places' ) => 'dark',
								esc_html__( 'Light', 'qt-places' ) => 'light',
								esc_html__( 'Natural', 'qt-places' ) => 'normal',
							),
						),
						array(
						   "type" => "colorpicker",
						   "heading" => esc_html__( "Buttons text color", "evenz" ),
						  'group' => esc_html__( 'Colors', 'qt-places' ),
						   "param_name" => "buttoncolor"
						),
						array(
						   "type" => "colorpicker",
						   "heading" => esc_html__( "Buttons background color", "evenz" ),
						  'group' => esc_html__( 'Colors', 'qt-places' ),
						   "param_name" => "buttonbackground"
						),
						array(
						   "type" => "colorpicker",
						   "heading" => esc_html__( "List background color", "evenz" ),
						  'group' => esc_html__( 'Colors', 'qt-places' ),
						   "param_name" => "listbackground"
						),
						array(
						   "type" => "colorpicker",
						   "heading" => esc_html__( "Marker text color", "evenz" ),
						  'group' => esc_html__( 'Colors', 'qt-places' ),
						   "param_name" => "markercolor"
						),
						
					),
				
			)
  		);
	}
}