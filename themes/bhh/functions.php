<?php 
function bhh_scripts() {
  // Load our main stylesheet.
	wp_enqueue_style('bhh-style', get_stylesheet_uri());
}

function bhh_features() {
  add_theme_support('title-tag');
  register_nav_menu('headerLocation', 'Header');
  register_nav_menu('footerLocation', 'Footer');
}

add_action( 'wp_enqueue_scripts', 'bhh_scripts' );
add_action('after_setup_theme', 'bhh_features');
?>