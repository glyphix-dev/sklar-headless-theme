<?php
/*
 *  Author: Nate Arnold<hello@natearnold.me>
 *  Custom functions, support, custom post types and more.
 */

add_theme_support( "post-thumbnails" );

function remove_menus() {
    remove_menu_page( "index.php" ); //Dashboard
    remove_menu_page( "jetpack" ); //Jetpack*
    remove_menu_page( "edit-comments.php" ); //Comments
}

add_action( "admin_menu", "remove_menus" );

// Remove Admin bar
// function remove_admin_bar()
// {
//     return false;
// }

include_once("functions/custom-post-types.php");
include_once("functions/custom-shortcodes.php");
include_once("functions/custom-taxonomies.php");

function headless_custom_menu_order( $menu_ord ) {
    if ( !$menu_ord ) return true;

    return array(
        "edit.php?post_type=page", // Pages
        "edit.php", // Posts
        "edit.php?post_type=custom_posts", // Custom Post Type
        "separator1", // First separator

        "upload.php", // Media
        "themes.php", // Appearance
        "plugins.php", // Plugins
        "users.php", // Users
        "separator2", // Second separator

        "tools.php", // Tools
        "options-general.php", // Settings
        "separator-last", // Last separator
    );
}
add_filter( "custom_menu_order", "headless_custom_menu_order", 10, 1 );
add_filter( "menu_order", "headless_custom_menu_order", 10, 1 );

function headless_disable_feed() {
    wp_die( __('No feed available, please visit our <a href="'. get_bloginfo("url") .'">homepage</a>!') );
}

add_action("do_feed", "headless_disable_feed", 1);
add_action("do_feed_rdf", "headless_disable_feed", 1);
add_action("do_feed_rss", "headless_disable_feed", 1);
add_action("do_feed_rss2", "headless_disable_feed", 1);
add_action("do_feed_atom", "headless_disable_feed", 1);
add_action("do_feed_rss2_comments", "headless_disable_feed", 1);
add_action("do_feed_atom_comments", "headless_disable_feed", 1);

// Return `null` if an empty value is returned from ACF.
if (!function_exists("acf_nullify_empty")) {
  function acf_nullify_empty($value, $post_id, $field) {
      if (empty($value)) {
          return null;
      }
      return $value;
  }
}
add_filter("acf/format_value", "acf_nullify_empty", 100, 3);


$excerpt_length = 55;

/*Remove empty paragraph tags from the_content*/
function removeEmptyParagraphs($content) {

    $pattern = "/<p[^>]*><\\/p[^>]*>/";
    $content = preg_replace($pattern, '', $content);
    //$content = str_replace("<p>&nbsp;</p>","",$content);
    return $content;
}

add_filter('the_content', 'removeEmptyParagraphs',99999);

function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_query_vars_filter($vars) {
  $vars[] = 'rel';
  return $vars;
}
add_filter( 'query_vars', 'custom_query_vars_filter' );

add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
    // add your extension to the array
    $existing_mimes['vcf'] = 'text/x-vcard';
    return $existing_mimes;
}

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function get_area_children($post_id,$posts){
  $children = [];
  foreach ($posts as $key => $post) {
    echo $post->post_parent.":".$post->post_title.":".$post_id.'<br/>';
    if($post->post_parent == $post_id){
      echo "matched above";
      array_push($children,$post);
    }
  }
  return $children;
}




/* REORDER MENU ITEMS
 * http://code.tutsplus.com/articles/customizing-your-wordpress-admin--wp-24941
 *************************************************************/
add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
add_filter('menu_order', 'custom_menu_order');
function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;

    return array(
        'index.php', // Dashboard
        'separator1', // First separator
        'edit.php?post_type=background_slider', // Custom post types moved using post_type=cpt name
        'edit.php', // Posts
        'edit.php?post_type=page', // Pages ls
        'upload.php', // Media
        'link-manager.php', // Links
        'edit-comments.php', // Comments
        'separator2', // Second separator
        'themes.php', // Appearance
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
        'separator-last', // Last separator
    );
}

function custom_excerpt_length( $length ) {
  global $excerpt_length;
  if($excerpt_length){
    return $excerpt_length;
  }else{
    return $length;
  }
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'mobile-menu' => __( 'Mobile Menu' ),
      'disclaimer-menu' => __( 'Disclaimer Menu' ),
    )
  );
}
add_action( 'init', 'register_my_menus' );

//Add custom classes to the nav ITEMS
function my_secondary_menu_classes( $classes, $item, $args ) {
    //print_r($item);
    switch ($item->object) {
      case 'page':
        $classes[] = "page";
        $classes[] =  "nav-item-".sanitize_title($item->title);
        break;
      case 'staff':
        $classes[] = "staff";
        $classes[] = "nav-item-".sanitize_title($item->title);
        break;
      default:
        $classes[] = $item->post_name;
        $classes[] = "nav-item-".sanitize_title($item->title);
        break;
    }
    $class;
    return $classes;
}

add_filter( 'nav_menu_css_class', 'my_secondary_menu_classes', 10, 3 );

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
        'show_in_graphql' => true,
	));
}
$site_options = get_fields('option');


add_action( 'pre_get_posts', 'custom_query_vars' );
function custom_query_vars( $query ) {
  if ( $query->is_main_query()) {
    if ( isset($query->query['post_type'])) {
      $rel = get_query_var('rel');
      switch ($query->query['post_type']) {
        case 'representative':
          $meta_query = array(
                    array(
                      'key'     => 'related_practice_areas',
                      'value'   => $rel,
                      'compare' => 'LIKE'
                    ),
                  );
          $query->set( 'meta_query', $meta_query );
          break;
        case 'clients':
          $query->set( 'posts_per_page', '-1' );
          break;
        case 'post':
          //$query->set( 'posts_per_page', '20' );
          break;
        default:
          //$query->set( 'posts_per_page', '20' );
          break;
      }
    }
    if ( isset($query->query['pagename'])) {
      switch ($query->query['pagename']) {
        case 'press':
          //print_r($query);
          $idObj = get_category_by_slug('recent-deals');
          $query->set( 'category__not_in', array($idObj->term_id) );
          break;

        default:
          # code...
          break;
      }
    }
  }
  return $query;
}

/***********************************************************************
* @Author: Boutros AbiChedid
* @Date:   July 5, 2011
* @Website: http://bacsoftwareconsulting.com/
* @Description: Function that counts the number of Words in a Post.
* @Tested on: WordPress version 3.1.3
***********************************************************************/
function get_post_word_count($post){
    //Variable: Additional characters which will be considered as a 'word'
    $char_list = ''; /** MODIFY IF YOU LIKE.  Add characters inside the single quotes. **/
    //$char_list = '0123456789'; /** If you want to count numbers as 'words' **/
    //$char_list = '&@'; /** If you want count certain symbols as 'words' **/
    return str_word_count(strip_tags($post->post_content), 0, $char_list);
}

function cmp_post_title($a, $b)
{
    return strcmp($a->post_title, $b->post_title);
}

function cmp_attorney_last($a, $b)
{
    return strcmp($a->acf['last_name'], $b->acf['last_name']);
}

function get_menu_item_children($parent_id,$post_type){
    $children = array();
    // grab the posts children
    $posts = get_posts( array( 'numberposts' => -1, 'post_status' => 'publish', 'post_type' => $post_type, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' =>$parent_id, 'suppress_filters' => false ));
    // now grab the grand children
    foreach( $posts as $child ){
        // recursion!! hurrah
        $gchildren = get_menu_item_children($child->ID,$post_type);
        // merge the grand children into the children array
        if( !empty($gchildren) ) {
            //create_function('$o', 'return $o->object_id;')
            $childIds = array_map(function($o){return $o->object_id;}, $gchildren);
            $children = array_merge($children, $gchildren);
        }
    }
    // merge in the direct descendants we found earlier
    $children = array_merge($children,$posts);
    return $children;
}

function get_posts_children($parent_id,$post_type){
    $children = array();
    // grab the posts children
    $posts = get_posts( array( 'numberposts' => -1, 'post_type' => $post_type, 'post_parent' => $parent_id, 'suppress_filters' => false ));
    //print_r($posts);
    // now grab the grand children
    foreach( $posts as $child ){
        // recursion!! hurrah
        $gchildren = get_posts_children($child->ID,$post_type);
        // merge the grand children into the children array
        if( !empty($gchildren) ) {
            $childIds = array_map(create_function('$o', 'return $o->ID;'), $gchildren);
            $children = array_merge($children, $childIds);
        }
    }
    // merge in the direct descendants we found earlier
    $children = array_merge($children,$posts);
    return $children;
}

/*
 * This filter fixes an issue where the blog page is highlighted as a menu item
 * for archives/singles of other post types.
 */
add_filter('nav_menu_css_class', 'mytheme_custom_type_nav_class', 10, 2);

function mytheme_custom_type_nav_class($classes, $item) {
  $post_type = get_post_type();
	// Remove current_page_parent from classes if the current item is the blog page
	// Note: The object_id property seems to be the ID of the menu item's target.
	if ($post_type != 'post' && $item->object_id == get_option('page_for_posts')) {
    	$current_value = "current_page_parent";
    	$classes = array_filter($classes, function ($element) use ($current_value) { return ($element != $current_value); } );
	}

	// Now look for post-type-<name> in the classes. A menu item with this class
	// should be given a class that will highlight it.
	$this_type_class = 'post-type-' . $post_type;
	if (in_array( $this_type_class, $classes )) {
    	array_push($classes, 'current_page_parent');
	};
	return $classes;
}

function nav_class_force_parent($classes, $item){
  global $post;
  $post_type = get_post_type();
  $menuChildren = array_map(function($o){return intval(get_post_meta($o->ID,"_menu_item_object_id")[0]);}, get_menu_item_children($item->ID,'nav_menu_item'));
  $childIDS = array_map(function($o){return $o->ID;}
  , get_posts_children($item->object_id,$post_type));
  foreach($menuChildren as $key => $menuchild){
    $menuChildren[$key] = $menuchild;
  }
  if ($post && in_array( $post->ID, $childIDS ) || $post && in_array($post->post_parent,$menuChildren)) {
      array_push($classes, 'current_page_parent');
  };
  return $classes;
}
add_filter('nav_menu_css_class', 'nav_class_force_parent', 20, 2);

function get_attorney_name($attorney){
  $attorney->acf = get_fields($attorney);
  $first_name = $attorney->acf['first_name'];
  $middle_name = '';
  if($attorney->acf['middle_name']){
    $middle_name = ' '.$attorney->acf['middle_name'];
  }
  $last_name = ' '.$attorney->acf['last_name'];
  return $first_name.$middle_name.$last_name;
}


include 'lib/acf_bidirectional_relationship.php';
include 'lib/cat-walker.php';
include 'lib/representative.php';

add_filter( 'gx_get_pdf_title', 'filter_pdf_title', 10, 1 );
function filter_pdf_title( $title ) {
  global $wp_query;
  $rel = get_query_var('rel');
  $rels = get_post_ancestors( $rel );
  $cat = '';
  foreach ($rels as $key => $ancestor):
    $cat .= get_the_title($ancestor).'-';
  endforeach;
  //rtrim($cat,"-");
  switch (true) {
    case $wp_query->is_tag:
		case $wp_query->is_tax:
		case $wp_query->is_archive:
      $title = sanitize_title(wp_specialchars_decode($title.'-'.$cat.get_the_title($rel)));
      break;
    default:
      # code...
      break;
  }
  return strtolower( 'SK-'.$title );
}





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



//Move Yost to the bottom of the page
// Move Yoast to bottom
add_filter( 'wpseo_metabox_prio', function() { return 'low'; } );


?>
