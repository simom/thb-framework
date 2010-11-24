<?php

/*
* tutte le opzioni per customizzare la sezione admin
*/
// remove dashboard widget
function remove_dashboard_widgets(){
	global$wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); 
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

// remove selected widget
function remove_some_wp_widgets(){
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Search');
  unregister_widget('WP_Widget_Recent_Comments');
}
add_action('widgets_init','remove_some_wp_widgets', 1);

// remove menu items
function remove_menu_items() {
  global $menu;
  $restricted = array(__('Links'), __('Comments'), __('Media'),
  __('Plugins'), __('Tools'), __('Users'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
      unset($menu[key($menu)]);}
    }
  }

add_action('admin_menu', 'remove_menu_items');


// remove sub menu items
function remove_submenus() {
  global $submenu;
  unset($submenu['index.php'][10]); // Removes 'Updates'.
  unset($submenu['themes.php'][5]); // Removes 'Themes'.
  unset($submenu['options-general.php'][15]); // Removes 'Writing'.
  unset($submenu['options-general.php'][25]); // Removes 'Discussion'.
  unset($submenu['edit.php'][16]); // Removes 'Tags'.    
}

add_action('admin_menu', 'remove_submenus');

// remove editor
function remove_editor_menu() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}

add_action('_admin_menu', 'remove_editor_menu', 1);

// remove meta
function customize_meta_boxes() {
  /* Removes meta boxes from Posts */
  remove_meta_box('postcustom','post','normal');
  remove_meta_box('trackbacksdiv','post','normal');
  remove_meta_box('commentstatusdiv','post','normal');
  remove_meta_box('commentsdiv','post','normal');
  remove_meta_box('tagsdiv-post_tag','post','normal');
  remove_meta_box('postexcerpt','post','normal');
  /* Removes meta boxes from pages */
  remove_meta_box('postcustom','page','normal');
  remove_meta_box('trackbacksdiv','page','normal');
  remove_meta_box('commentstatusdiv','page','normal');
  remove_meta_box('commentsdiv','page','normal'); 
}

add_action('admin_init','customize_meta_boxes');

// remove action from dropdown
function custom_favorite_actions($actions) {
  unset($actions['edit-comments.php']);
  return $actions;
}

add_filter('favorite_actions', 'custom_favorite_actions');


// customize footer
function modify_footer_admin () {
  echo 'Created by <a href="http://example.com">Simone</a>.';
  echo 'Powered by<a href="http://WordPress.org">WordPress</a>.';
}

add_filter('admin_footer_text', 'modify_footer_admin');


// custom admin logo
function custom_logo() {
  echo '<style type="text/css">
    #header-logo { background-image: url('.get_bloginfo('template_directory').'/images/admin_logo.png) !important; }
    </style>';
}

add_action('admin_head', 'custom_logo');

function custom_login_logo() {
  echo '<style type="text/css">
    h1 a { background-image:url('.get_bloginfo('template_directory').'/images/login_logo.png) !important; }
    </style>';
}

add_action('login_head', 'custom_login_logo');


// remove core upgrade
add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

// customize editor style
add_editor_style('css/editor-style.css');

//Custom Login Page
function custom_login() {
echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/custom-login/custom-login.css" />';
}
add_action('login_head', 'custom_login');

// remove admin style
//remove_action('admin_print_styles', 'print_admin_styles', 20);

// add custom style
function my_wp_admin_css() {
  echo '<link rel="stylesheet" href="/wp-admin.css" type="text/css" />';
}
add_action('admin_print_styles','my_wp_admin_css');

?>