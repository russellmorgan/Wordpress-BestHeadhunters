<?php

function job_post_types() {
    register_post_type('job', array(
      'rewrite' => array('slug' => 'jobs'),
      'public' => true,
      'menu_icon' => 'dashicons-calendar',
      'show_in_nav_menus' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'excerpt'),
      'labels' => array(
        'name' => 'Jobs',
        'add_new_item' => 'Add a new job opening',
        'edit_item' => 'Edit existing job opening',
        'all_items' => 'All Jobs',
        'singular_name' => 'Job'
      )
    ));
  }

  add_action('init', 'job_post_types');

  ?>