<?php



///////////////////////////////////
// CPT: Staff
///////////////////////////////////
function setup_staff () {
    //POST TYPE
    $Labels = array(
        'name'                => __( 'Staff', 'sklar_kirsh' ),
        'singular_name'       => __( 'Staff', 'sklar_kirsh' ),
        'menu_name'          => _x( 'Staff', 'admin menu', 'sklar_kirsh' ),
    		'name_admin_bar'     => _x( 'Staff', 'add new on admin bar', 'sklar_kirsh' ),
    		'add_new'            => _x( 'Add New', 'Staff', 'sklar_kirsh' ),
    		'add_new_item'       => __( 'Add New Staff', 'sklar_kirsh' ),
    		'new_item'           => __( 'New Staff', 'sklar_kirsh' ),
    		'edit_item'          => __( 'Edit Staff', 'sklar_kirsh' ),
    		'view_item'          => __( 'View Staff', 'sklar_kirsh' ),
    		'all_items'          => __( 'All Staff', 'sklar_kirsh' ),
    		'search_items'       => __( 'Search Staff', 'sklar_kirsh' ),
    		'parent_item_colon'  => __( 'Parent Staff:', 'sklar_kirsh' ),
    		'not_found'          => __( 'No Staff found.', 'sklar_kirsh' ),
    		'not_found_in_trash' => __( 'No Staff found in Trash.', 'sklar_kirsh' )
    );
    $Options = array(
        'labels'              => $Labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'show_ui'             => true,
        'query_var'           => true,
        'menu_position'       => 23,
        'rewrite'             => array( 'slug' => 'Professionals', 'with_front' => false ),
        'has_archive'         => false,
        'capability_type'     => 'page',
        'hierarchical'        => false,
        'show_in_nav_menus'   => true,
    );
    register_post_type( 'Staff', $Options);
}
add_action('init', 'setup_Staff');

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

//include('partials/acf.php');

//Move Yost to the bottom of the page
// Move Yoast to bottom
add_filter( 'wpseo_metabox_prio', function() { return 'low'; } );


?>
