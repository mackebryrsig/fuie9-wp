<?php
// Rmove admin bar items
add_action( 'wp_before_admin_bar_render', function(){
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
    $wp_admin_bar->remove_menu( 'comments' );
});

// Widget settings
add_action( 'widgets_init', function(){
	// Remove widgets		
	unregister_widget('WP_Nav_Menu_Widget');
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Text');
}, 1 );

// Hide admin menu pages
add_action( 'admin_menu', function(){
	remove_menu_page( 'edit-comments.php' );
    if ( ! current_user_can( 'manage_options' ) ) {
        remove_menu_page( 'tools.php' );
        remove_submenu_page( 'themes.php', 'customize.php' );
    }	
});

// Filter for file names
add_filter( 'sanitize_file_name', function( $filename ){
	return remove_accents( $filename );
}, 10 );

// Remove WP version nr
add_filter( 'the_generator', function(){
	return '';
});

// Filter function to alter the length of excerpts
add_filter( 'excerpt_length', function( $length ) {
	return 25;
});

// Filter function to alter the ending of excerpts
add_filter( 'excerpt_more', function( $more ) {
	return '...';
});

// Default scripts
add_filter( 'wp_default_scripts', function( &$scripts ){
    if( ! is_admin() ) {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.12.0' );
    }	
});

// Page titles
function page_title() {
	if (is_home()) {
		if (get_option('page_for_posts', true)) {
			echo get_the_title(get_option('page_for_posts', true));
		} else {
			_e('Latest posts', THEME_TEXTDOMAIN);
		}
	} elseif (is_archive()) {
	$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
	if ($term) {
		echo $term->name;
	} elseif (is_post_type_archive()) {
		echo get_queried_object()->labels->name;
	} elseif (is_day()) {
		echo __('Archive: ', THEME_TEXTDOMAIN) . get_the_date();
	} elseif (is_month()) {
		echo __('Archive: ', THEME_TEXTDOMAIN) . get_the_date('F Y');
	} elseif (is_year()) {
		echo __('Archive: ', THEME_TEXTDOMAIN) . get_the_date('Y');
	} elseif (is_author()) {
		global $post; $author_id = $post->post_author;
		echo __('Author: ', THEME_TEXTDOMAIN) . get_the_author_meta('display_name', $author_id);
	} else {
		single_cat_title();
	}
	} elseif (is_search()) {
		echo __('Result: ', THEME_TEXTDOMAIN) . get_search_query();
	} elseif (is_404()) {
		echo __('404 Page not found', THEME_TEXTDOMAIN);
	} else {
		the_title();
	}
}

// oEmbed for responsive solution
function responsive_embed($html, $url, $attr, $post_ID) {
	$return = '<div class="video-container">'.$html.'</div>';
	return $return;
}
add_filter( 'embed_oembed_html', 'responsive_embed', 10, 4 );

// Remove Emojis
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Pre get posts filter
function who_cares_pre_get_posts( $query ) {
	if ( $query->is_main_query() && ! is_admin() ) {
		// Redirect empty searches to search page, not home
		if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
		   $query->is_search = true;
		   $query->is_home = false;
		}

		/*
			$query->set( 'posts_per_page', 7 );
			$query->set( 'nopaging', true );
			$query->set( 'orderby', 'menu_order' );
			$query->set( 'order', 'ASC' );
			$query->set( 'post_type', 'wptemplate_cpt' );
		*/
	}

	return $query;
}
add_filter( 'pre_get_posts', 'who_cares_pre_get_posts' );

// Admin head
add_action( 'admin_head', function() {
    echo "<style>
        	#wp-admin-bar-comments { display: none !important; }
        </style>";
});


// Buttons for Gravity forms instead of input[type="submit"]
add_filter( 'gform_submit_button', function( $button, $form ) {
   return "
       <button class='gform-button' id='gform_submit_button_{$form["id"]}'>
           " . $form['button']['text'] . "
       </button>";
}, 10, 2 );