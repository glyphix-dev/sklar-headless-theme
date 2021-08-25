<?php

function register_child_menus() {
    register_nav_menus(
      array(
        'footer-menu' => __( 'Footer Menu' ),
      )
    );
  }
  add_action( 'init', 'register_child_menus' );

add_action('wp_enqueue_scripts','gx_load_styles',0,1000);
function gx_load_styles(){
    wp_enqueue_style( 'parent-theme', get_template_directory_uri().'/style.css', null, null, 'screen' );  
    wp_enqueue_style('child-theme', get_stylesheet_directory_uri() .'/dist/main.css', array('parent-theme'));
}

function create_menubar( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {

        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list  = '<nav id="'.sanitize_title($menu->name).'" aria-label="' . $menu->name . ' Navigation">' ."\n";
        $menu_list .= '<ul role="menubar" aria-label="' . $menu->name . ' Navigation">' ."\n";

        foreach( $menu_items as $menu_item ) {
            if( $menu_item->menu_item_parent == 0 ) {

                $parent = $menu_item->ID;

                $submenu_array = array();

                // create submenu menu item list
                foreach( $menu_items as $submenu ) {
                    if( $submenu->menu_item_parent == $parent ) {
                        $bool = true;
                        $submenu_array[] = '<li><a class="nav-link" role="menuitem" tabindex="0" href="' . $submenu->url . '">' . $submenu->title . '</a></li>' ."\n";
                    }
                }

                if( $bool == true && count( $submenu_array ) > 0 ) {
                    // this item has a dropdown
                    $menu_list .= '<li role="none">' ."\n";
                    $menu_list .= '<a href="#" class="dropdown-trigger" role="menuitem" tabindex="0" aria-haspopup="true" aria-expanded="false">' . $menu_item->title . '</a>' ."\n";

                    $menu_list .= '<ul id="' . sanitize_title($menu_item->title) . '-menu" role="menu" aria-label="' . $menu_item->title . '">' ."\n";
                    $menu_list .= implode( "\n", $submenu_array );
                    $menu_list .= '</ul>' ."\n";

                } else {
                    // this item doesn't have a dropdown
                    $menu_list .= '<li role="none">' ."\n";
                    $menu_list .= '<a class="nav-link" href="' . $menu_item->url . '" role="menuitem" tabindex="0">' . $menu_item->title . '</a>' ."\n";
                }


            // end <li>
            $menu_list .= '</li>' ."\n";
          }

        }

        $menu_list .= '</ul>' ."\n";
        $menu_list .= '</nav>' ."\n";

    } else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }

    echo $menu_list;
}


function wp_full_title_capitalize( $title, $sep, $seplocation ) {

    // Uppercases the entire title
    $title = ucwords( $title );

    return $title;

}
add_filter( 'wp_title', 'wp_full_title_capitalize',1000000 );


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


// staff unions

add_action( 'graphql_register_types', 'register_staff_union', 10, 1 );

function register_staff_union( $type_registry ) {
  register_graphql_union_type( 'GenreOrMovieUnion', [
    'typeNames'       => [ 'Genre', 'Movie' ],
    'resolveType' => function( $search_result ) use ( $type_registry ) {
      // Here we receive the object or array that's being resolved by the field
      // and we can determine what Type to return
      $type = null;

      if ( $search_result instanceof \WPGraphQL\Model\Term && $search_result->taxonomy === 'genre' ) {
        $type = 'Genre';
      } else if ( $search_result instanceof \WPGraphQL\Model\Post && $search_result->post_type === 'movie' ) {
        $type = 'Movie';
      }
      return $type;
    }
  ] );
}


?>