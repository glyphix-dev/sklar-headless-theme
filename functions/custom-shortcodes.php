<?php
function cptui_register_my_cpts() {

	/**
	 * Post Type: Careers.
	 */

	$labels = [
		"name" => __( "Careers", "custom-post-type-ui" ),
		"singular_name" => __( "Career", "custom-post-type-ui" ),
		"menu_name" => __( "Careers", "custom-post-type-ui" ),
		"all_items" => __( "All Careers", "custom-post-type-ui" ),
		"add_new" => __( "Add new", "custom-post-type-ui" ),
		"add_new_item" => __( "Add new Career", "custom-post-type-ui" ),
		"edit_item" => __( "Edit Career", "custom-post-type-ui" ),
		"new_item" => __( "New Career", "custom-post-type-ui" ),
		"view_item" => __( "View Career", "custom-post-type-ui" ),
		"view_items" => __( "View Careers", "custom-post-type-ui" ),
		"search_items" => __( "Search Careers", "custom-post-type-ui" ),
		"not_found" => __( "No Careers found", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "No Careers found in trash", "custom-post-type-ui" ),
		"parent" => __( "Parent Career:", "custom-post-type-ui" ),
		"featured_image" => __( "Featured image for this Career", "custom-post-type-ui" ),
		"set_featured_image" => __( "Set featured image for this Career", "custom-post-type-ui" ),
		"remove_featured_image" => __( "Remove featured image for this Career", "custom-post-type-ui" ),
		"use_featured_image" => __( "Use as featured image for this Career", "custom-post-type-ui" ),
		"archives" => __( "Career archives", "custom-post-type-ui" ),
		"insert_into_item" => __( "Insert into Career", "custom-post-type-ui" ),
		"uploaded_to_this_item" => __( "Upload to this Career", "custom-post-type-ui" ),
		"filter_items_list" => __( "Filter Careers list", "custom-post-type-ui" ),
		"items_list_navigation" => __( "Careers list navigation", "custom-post-type-ui" ),
		"items_list" => __( "Careers list", "custom-post-type-ui" ),
		"attributes" => __( "Careers attributes", "custom-post-type-ui" ),
		"name_admin_bar" => __( "Career", "custom-post-type-ui" ),
		"item_published" => __( "Career published", "custom-post-type-ui" ),
		"item_published_privately" => __( "Career published privately.", "custom-post-type-ui" ),
		"item_reverted_to_draft" => __( "Career reverted to draft.", "custom-post-type-ui" ),
		"item_scheduled" => __( "Career scheduled", "custom-post-type-ui" ),
		"item_updated" => __( "Career updated.", "custom-post-type-ui" ),
		"parent_item_colon" => __( "Parent Career:", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Careers", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => "careers",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "careers", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "page-attributes" ],
		"show_in_graphql" => true,
		"graphql_single_name" => "Career",
		"graphql_plural_name" => "Careers",
	];

	register_post_type( "careers", $args );

	/**
	 * Post Type: Attorneys.
	 */

	$labels = [
		"name" => __( "Attorneys", "custom-post-type-ui" ),
		"singular_name" => __( "Attorney", "custom-post-type-ui" ),
		"menu_name" => __( "Attorneys", "custom-post-type-ui" ),
		"all_items" => __( "All Attorneys", "custom-post-type-ui" ),
		"add_new" => __( "Add new", "custom-post-type-ui" ),
		"add_new_item" => __( "Add new Attorney", "custom-post-type-ui" ),
		"edit_item" => __( "Edit Attorney", "custom-post-type-ui" ),
		"new_item" => __( "New Attorney", "custom-post-type-ui" ),
		"view_item" => __( "View Attorney", "custom-post-type-ui" ),
		"view_items" => __( "View Attorneys", "custom-post-type-ui" ),
		"search_items" => __( "Search Attorneys", "custom-post-type-ui" ),
		"not_found" => __( "No Attorneys found", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "No Attorneys found in trash", "custom-post-type-ui" ),
		"parent" => __( "Parent Attorney:", "custom-post-type-ui" ),
		"featured_image" => __( "Featured image for this Attorney", "custom-post-type-ui" ),
		"set_featured_image" => __( "Set featured image for this Attorney", "custom-post-type-ui" ),
		"remove_featured_image" => __( "Remove featured image for this Attorney", "custom-post-type-ui" ),
		"use_featured_image" => __( "Use as featured image for this Attorney", "custom-post-type-ui" ),
		"archives" => __( "Attorney archives", "custom-post-type-ui" ),
		"insert_into_item" => __( "Insert into Attorney", "custom-post-type-ui" ),
		"uploaded_to_this_item" => __( "Upload to this Attorney", "custom-post-type-ui" ),
		"filter_items_list" => __( "Filter Attorneys list", "custom-post-type-ui" ),
		"items_list_navigation" => __( "Attorneys list navigation", "custom-post-type-ui" ),
		"items_list" => __( "Attorneys list", "custom-post-type-ui" ),
		"attributes" => __( "Attorneys attributes", "custom-post-type-ui" ),
		"name_admin_bar" => __( "Attorney", "custom-post-type-ui" ),
		"item_published" => __( "Attorney published", "custom-post-type-ui" ),
		"item_published_privately" => __( "Attorney published privately.", "custom-post-type-ui" ),
		"item_reverted_to_draft" => __( "Attorney reverted to draft.", "custom-post-type-ui" ),
		"item_scheduled" => __( "Attorney scheduled", "custom-post-type-ui" ),
		"item_updated" => __( "Attorney updated.", "custom-post-type-ui" ),
		"parent_item_colon" => __( "Parent Attorney:", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Attorneys", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "attorney", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => true,
		"graphql_single_name" => "Attorney",
		"graphql_plural_name" => "Attorneys",
	];

	register_post_type( "attorney", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );


?>