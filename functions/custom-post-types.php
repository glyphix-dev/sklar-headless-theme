<?php
///////////////////////////////////
// CPT: Practice Areas
///////////////////////////////////
function setup_areas () {
  //POST TYPE
  $Labels = array(
      'name'                => __( 'Practice Areas', 'sklar_kirsh' ),
      'singular_name'       => __( 'Practice Area', 'sklar_kirsh' ),
      'menu_name'          => _x( 'Practice Areas', 'admin menu', 'sklar_kirsh' ),
      'name_admin_bar'     => _x( 'Practice Area', 'add new on admin bar', 'sklar_kirsh' ),
      'add_new'            => _x( 'Add New', 'Practice Area', 'sklar_kirsh' ),
      'add_new_item'       => __( 'Add New Practice Area', 'sklar_kirsh' ),
      'new_item'           => __( 'New Practice Area', 'sklar_kirsh' ),
      'edit_item'          => __( 'Edit Practice Area', 'sklar_kirsh' ),
      'view_item'          => __( 'View Practice Area', 'sklar_kirsh' ),
      'all_items'          => __( 'All Practice Areas', 'sklar_kirsh' ),
      'search_items'       => __( 'Search Practice Areas', 'sklar_kirsh' ),
      'parent_item_colon'  => __( 'Parent Practice Areas:', 'sklar_kirsh' ),
      'not_found'          => __( 'No Practice Areas found.', 'sklar_kirsh' ),
      'not_found_in_trash' => __( 'No Practice Areas found in Trash.', 'sklar_kirsh' )
  );
  $Options = array(
      'labels'              => $Labels,
      'public'              => true,
      'publicly_queryable'  => true,
      'exclude_from_search' => false,
      'show_ui'             => true,
      'query_var'           => true,
      'menu_position'       => 24,
      'rewrite'             => array( 'slug' => 'practice-areas', 'with_front' => false ),
      'has_archive'         => false,
      'capability_type'     => 'page',
      'hierarchical'        => true,
      'supports'            => array( 'title', 'editor', 'category', 'page-attributes','page-template'),
      'taxonomies'          => array('category'),
  );
  register_post_type( 'areas', $Options);
}
add_action('init', 'setup_areas');

///////////////////////////////////
// CPT: Clients
///////////////////////////////////
function setup_clients () {
  //POST TYPE
  $Labels = array(
      'name'                => __( 'Clients', 'sklar_kirsh' ),
      'singular_name'       => __( 'Client', 'sklar_kirsh' ),
      'menu_name'          => _x( 'Clients', 'admin menu', 'sklar_kirsh' ),
      'name_admin_bar'     => _x( 'Client', 'add new on admin bar', 'sklar_kirsh' ),
      'add_new'            => _x( 'Add New', 'Client', 'sklar_kirsh' ),
      'add_new_item'       => __( 'Add New Client', 'sklar_kirsh' ),
      'new_item'           => __( 'New Client', 'sklar_kirsh' ),
      'edit_item'          => __( 'Edit Client', 'sklar_kirsh' ),
      'view_item'          => __( 'View Client', 'sklar_kirsh' ),
      'all_items'          => __( 'All Clients', 'sklar_kirsh' ),
      'search_items'       => __( 'Search Clients', 'sklar_kirsh' ),
      'parent_item_colon'  => __( 'Parent Clients:', 'sklar_kirsh' ),
      'not_found'          => __( 'No Clients found.', 'sklar_kirsh' ),
      'not_found_in_trash' => __( 'No Clients found in Trash.', 'sklar_kirsh' )
  );
  $Options = array(
      'labels'              => $Labels,
      'public'              => true,
      'publicly_queryable'  => true,
      'exclude_from_search' => false,
      'show_ui'             => true,
      'query_var'           => true,
      'menu_position'       => 24,
      'rewrite'             => array( 'slug' => 'clients', 'with_front' => false ),
      'has_archive'         => true,
      'capability_type'     => 'page',
      'hierarchical'        => false,
      'supports'            => array( 'title','category'),
      'taxonomies'          => array(),
      'show_in_graphql' => true,
      'graphql_single_name' => 'clients',
      'graphql_plural_name' => 'allClients',

  );
  register_post_type( 'clients', $Options);
}
add_action('init', 'setup_clients');



function setup_testimonials () {
  //POST TYPE
  $Labels = array(
      'name'                => __( 'Testimonials', 'sklar_kirsh' ),
      'singular_name'       => __( 'Testimonial', 'sklar_kirsh' ),
      'menu_name'          => _x( 'Testimonials', 'admin menu', 'sklar_kirsh' ),
      'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'sklar_kirsh' ),
      'add_new'            => _x( 'Add New', 'Testimonial', 'sklar_kirsh' ),
      'add_new_item'       => __( 'Add New Testimonial', 'sklar_kirsh' ),
      'new_item'           => __( 'New Testimonial', 'sklar_kirsh' ),
      'edit_item'          => __( 'Edit Testimonial', 'sklar_kirsh' ),
      'view_item'          => __( 'View Testimonial', 'sklar_kirsh' ),
      'all_items'          => __( 'All Testimonials', 'sklar_kirsh' ),
      'search_items'       => __( 'Search Testimonials', 'sklar_kirsh' ),
      'parent_item_colon'  => __( 'Parent Testimonials:', 'sklar_kirsh' ),
      'not_found'          => __( 'No Testimonials found.', 'sklar_kirsh' ),
      'not_found_in_trash' => __( 'No Testimonials found in Trash.', 'sklar_kirsh' )
  );
  $Options = array(
      'labels'              => $Labels,
      'public'              => true,
      'publicly_queryable'  => true,
      'exclude_from_search' => false,
      'show_ui'             => true,
      'query_var'           => true,
      'menu_position'       => 27,
      'rewrite'             => array( 'slug' => 'testimonials', 'with_front' => false ),
      'has_archive'         => false,
      'capability_type'     => 'page',
      'hierarchical'        => false,
      'supports'            => array( 'title', 'editor', 'page-attributes'),
      'taxonomies'          => array(),
      'show_in_graphql' => true,
      'graphql_single_name' => 'testimonial',
      'graphql_plural_name' => 'testimonials',
  );
  register_post_type( 'testimonial', $Options);
}
add_action('init', 'setup_testimonials');

add_filter( 'register_post_type_args', function( $args, $post_type ) {
  if ( 'staff' === $post_type ) {
    $args['show_in_graphql'] = true;
    $args['graphql_single_name'] = 'staff';
    $args['graphql_plural_name'] = 'allStaff';
  }

  if ( 'areas' === $post_type ) {
      $args['show_in_graphql'] = true;
      $args['graphql_single_name'] = 'areas';
      $args['graphql_plural_name'] = 'areas';
  }

  if ( 'clients' === $post_type ) {
      $args['show_in_graphql'] = true;
      $args['graphql_single_name'] = 'client';
      $args['graphql_plural_name'] = 'clients';
  }

  if ( 'testimonial' === $post_type ) {
      $args['show_in_graphql'] = true;
      $args['graphql_single_name'] = 'testimonial';
      $args['graphql_plural_name'] = 'allTestimonials';
  }

    if ( 'representative' === $post_type ) {
      $args['show_in_graphql'] = true;
      $args['graphql_single_name'] = 'matter';
      $args['graphql_plural_name'] = 'allMatters';
  }

  if ( 'careers' === $post_type ) {
      $args['show_in_graphql'] = true;
      $args['graphql_single_name'] = 'careers';
      $args['graphql_plural_name'] = 'allCareers';
  }

  return $args;

}, 100000000, 2 );

/**
* Add the wp-editor back into WordPress after it was removed in 4.2.2.
*
* @see https://wordpress.org/support/topic/you-are-currently-editing-the-page-that-shows-your-latest-posts?replies=3#post-7130021
* @param $post
* @return void
*/
function fix_no_editor_on_posts_page($post) {

  if( $post->ID != get_option( 'page_for_posts' ) ) { return; }

  remove_action( 'edit_form_after_title', '_wp_posts_page_notice' );
  add_post_type_support( 'page', 'editor' );

}

// This is applied in a namespaced file - so amend this if you're not namespacing
add_action( 'edit_form_after_title', __NAMESPACE__ . '\\fix_no_editor_on_posts_page', 0 );


/*
* Increase perPage for product categories. This is needed to build out the sidebar accordion.
*/

add_filter( 'graphql_connection_max_query_amount', function ( int $max_amount, $source, array $args, $context, $info ) {
return 500;
}, 10, 5 );




?>