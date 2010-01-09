<?php 
/*
Plugin Name: WP Post Limits
Plugin URI: http://www.ketlai.co.uk
Description: Set per-role limits on the number of posts a user can make on your wordpress blog
Author: James Stewart
Version: 1.0
Author URI: http://jystewart.net/process/
*/

function post_limits_check_capability($capabilities, $required_capability = FALSE, $arguments = array()) {
  $current_user = wp_get_current_user();
  if (! $current_user) {
    return FALSE;
  }
  
  /* Admin can do anything it wants! */
  if (array_search('administrator', $current_user->roles) !== FALSE) {
    return $capabilities;
  } 

  /* Anyone can edit their own posts */
  
  /* Check per-role limits */
  $limits = get_option('posts_per_role');

  $limit = 0;
  foreach ($current_user->roles as $role) {
    if (isset($limits[$role])) {
      if ($limits[$role] == -1) {
        return $capabilities;
      } else if ($limits[$role] > $limit) {
        $limit = $limits[$role];
      }
    }
  }
  
  $posts = get_posts(array('author' => $current_user->ID, 'post_status' => 'pending,publish'));
  $count_posts = count($posts);

  if ($count_posts >= $limit) {
    if (isset($_REQUEST['post_ID']) || isset($_REQUEST['post'])) {
      $post_id = isset($_REQUEST['post_ID']) ? $_REQUEST['post_ID'] : $_REQUEST['post'];
      $p = get_post($post_id);
      if ($p->post_author == $current_user->ID && ($p->post_status == 'draft' || $p->post_status == 'pending review')) {
        return $capabilities;
      }
    }
    unset($capabilities['edit_posts']);
  }
  
  return $capabilities;
}

function post_limits_menu() {
  global $user_level;
  get_currentuserinfo();
  if ($user_level < 10) {
    return;
  }

  if (function_exists('add_options_page')) {
    add_options_page(__('Post Limits'), __('Post Limits'), 1, __FILE__, 'post_limits_page');
  }
}

function post_limits_page() {
  global $wp_roles;

  if (! isset($wp_roles)) {
    $wp_roles = new WP_Roles();
  } 
  
  if (isset($_POST['role_limits']) && is_array($_POST['role_limits'])) {
    $options = array('posts_per_role' => $_POST['role_limits']);
    update_option('posts_per_role', $options['posts_per_role']);
    echo '<div class="updated"><p>' . __('Options saved') . '</p></div>';
  } else {
    $options = array('posts_per_role' => get_option('posts_per_role'));
  }
  
  include 'templates/options.tpl.php';
}

add_filter('user_has_cap', 'post_limits_check_capability');
add_action('admin_menu', 'post_limits_menu'); 
