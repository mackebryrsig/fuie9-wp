<?php
// Sidebars
if ( function_exists( 'register_sidebar' ) ) { 
    register_sidebar( array(
        'name' => __( 'Sidebar', THEME_TEXTDOMAIN ),
        'id' => 'sidebar',
        'description' => __('Widget area for sidebar', THEME_TEXTDOMAIN ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));      
}