<?php

// Register Menu Post Type
function madwell_menu_post_type() {

	$labels = array(
		'name'                  => 'Menus',
		'singular_name'         => 'Menu',
		'menu_name'             => 'Menus',
		'name_admin_bar'        => 'Menus',
		'archives'              => 'Menu Archives',
		'parent_item_colon'     => 'Parent Menu:',
		'all_items'             => 'All Menus',
		'add_new_item'          => 'Add New Menu',
		'add_new'               => 'Add New',
		'new_item'              => 'New Menu',
		'edit_item'             => 'Edit Menu',
		'update_item'           => 'Update Menu',
		'view_item'             => 'View Menu',
		'search_items'          => 'Search Menu',
		'featured_image'        => 'Menu Image',
		'set_featured_image'    => 'Set menu image',
		'remove_featured_image' => 'Remove menu image',
		'use_featured_image'    => 'Use as menu image',
		'insert_into_item'      => 'Insert into menu',
		'uploaded_to_this_item' => 'Uploaded to this menu',
		'items_list'            => 'Menus list',
		'items_list_navigation' => 'Menus list navigation',
		'filter_items_list'     => 'Filter menus list',
	);
	$rewrite = array(
		'slug'                  => 'menu',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => 'Menu',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 10,
		'menu_icon'             => 'dashicons-clipboard',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'madwell_menu', $args );

}
add_action( 'init', 'madwell_menu_post_type', 0 );


// Register Menu Group Taxonomy
function madwell_menu_group() {

	$labels = array(
		'name'                       => _x( 'Menu Groups', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Menu Group', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Menu Group', 'text_domain' ),
		'all_items'                  => __( 'All Groups', 'text_domain' ),
		'parent_item'                => __( 'Parent Group', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Group:', 'text_domain' ),
		'new_item_name'              => __( 'New Group Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Group', 'text_domain' ),
		'edit_item'                  => __( 'Edit Group', 'text_domain' ),
		'update_item'                => __( 'Update Group', 'text_domain' ),
		'view_item'                  => __( 'View Group', 'text_domain' ),
		'separate_items_with_commas' => __( '', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove groups', 'text_domain' ),
		'choose_from_most_used'      => __( '', 'text_domain' ),
		'popular_items'              => __( 'Popular Groups', 'text_domain' ),
		'search_items'               => __( 'Search Groups', 'text_domain' ),
		'not_found'                  => __( '', 'text_domain' ),
		'no_terms'                   => __( '', 'text_domain' ),
		'items_list'                 => __( '', 'text_domain' ),
		'items_list_navigation'      => __( '', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'madwell_menu_group', array( 'madwell_menu' ), $args );

}
add_action( 'init', 'madwell_menu_group', 0 );