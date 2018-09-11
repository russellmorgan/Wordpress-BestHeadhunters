<?php 
function bhh_scripts() {
  // Load our main stylesheet.
	wp_enqueue_style('bhh-style', get_stylesheet_uri());
}

add_action( 'wp_enqueue_scripts', 'bhh_scripts' );
?>