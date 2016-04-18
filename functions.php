<?php
// Textdomain
if ( ! defined( 'THEME_TEXTDOMAIN' ) ) {
	define( 'THEME_TEXTDOMAIN', 'who-cares' );
}

// Dependencies
require_once( 'inc/who-cares-helpers.php' );
require_once( 'inc/tinymce.php' );
require_once( 'inc/widgets.php' );

// Theme-specific
if ( ! function_exists( 'who_cares_setup' ) ) {
    function who_cares_setup() {
        load_theme_textdomain( THEME_TEXTDOMAIN, get_template_directory() . '/languages' );
        add_editor_style();
        add_theme_support( 'post-thumbnails' );
        register_nav_menu( 'primary', __( 'Primary Menu', THEME_TEXTDOMAIN ) );
    }
}
add_action( 'after_setup_theme', 'who_cares_setup' );

// Register and enqueue scripts/styles
function who_cares_enqueue_scripts() {
	if ( ! is_admin() ) {
	    wp_register_script( 'app', get_template_directory_uri().'/assets/js/app.min.js', array( 'jquery'), '1.0', true );
	    wp_enqueue_script( 'app' );

        wp_register_style( 'style', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0' );
        wp_enqueue_style( 'style' );

    }
}
add_action( 'wp_enqueue_scripts', 'who_cares_enqueue_scripts' );