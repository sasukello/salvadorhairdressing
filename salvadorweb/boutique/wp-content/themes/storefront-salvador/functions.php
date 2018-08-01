<?php
function storefront_child_styles_scripts() {
  //Enqueue parent stylesheet
  wp_enqueue_style( 'storefront-style', get_template_directory_uri().'/style.css' );
	
  //enqueue theme css
  wp_enqueue_style( 'storefront-child-style', get_stylesheet_directory_uri().'/style.css' );
	
}

add_action( 'wp_enqueue_scripts', 'storefront_child_styles_scripts' );


 ?>