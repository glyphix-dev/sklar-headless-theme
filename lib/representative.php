<?php

function setup_representative_matters () {
    //POST TYPE
    $Labels = array(
        'name'                => __( 'Representative Matters', 'sklar_kirsh' ),
        'singular_name'       => __( 'Representative Matter', 'sklar_kirsh' ),
        'menu_name'          => _x( 'Representative Matters', 'admin menu', 'sklar_kirsh' ),
    		'name_admin_bar'     => _x( 'Representative Matter', 'add new on admin bar', 'sklar_kirsh' ),
    		'add_new'            => _x( 'Add New', 'Representative Matter', 'sklar_kirsh' ),
    		'add_new_item'       => __( 'Add New Representative Matter', 'sklar_kirsh' ),
    		'new_item'           => __( 'New Representative Matter', 'sklar_kirsh' ),
    		'edit_item'          => __( 'Edit Representative Matter', 'sklar_kirsh' ),
    		'view_item'          => __( 'View Representative Matter', 'sklar_kirsh' ),
    		'all_items'          => __( 'All Representative Matters', 'sklar_kirsh' ),
    		'search_items'       => __( 'Search Representative Matters', 'sklar_kirsh' ),
    		'parent_item_colon'  => __( 'Parent Representative Matters:', 'sklar_kirsh' ),
    		'not_found'          => __( 'No Representative Matters found.', 'sklar_kirsh' ),
    		'not_found_in_trash' => __( 'No Representative Matters found in Trash.', 'sklar_kirsh' )
    );
    $Options = array(
        'labels'              => $Labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'show_ui'             => true,
        'query_var'           => true,
        'menu_position'       => 26,
        'rewrite'             => array( 'slug' => 'representative-matters', 'with_front' => false ),
        'has_archive'         => true,
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array( 'title', 'editor'),
        'taxonomies'          => array('category')
    );
    register_post_type( 'representative', $Options);
}
add_action('init', 'setup_representative_matters');


function get_matter_count($practice_id){
  $posts = get_posts(array(
                							'post_type' => 'representative',
                              'posts_per_page'   => -1,
                							'meta_query' => array(
                								array(
                									'key' => 'related_practice_areas', // name of custom field
                									'value' => '"' . $practice_id . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
                									'compare' => 'LIKE'
                								)
                							)
                						));
  return sizeof($posts);
}

function is_prior_matter($matter_id){
  return get_field('matter_orignation',$matter_id);
}

 ?>
