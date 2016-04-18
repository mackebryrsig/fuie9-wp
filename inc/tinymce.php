<?php
// Editor style
function who_cares_editor_styles() {
    add_editor_style( get_template_directory_uri() . '/assets/css/editor-style.css' );
}
add_action( 'admin_init', 'who_cares_editor_styles' );

// Styles dropdown
function who_cares_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'who_cares_mce_editor_buttons' );

function who_cares_mce_before_init( $settings ) {
	$style_formats = array(
			array( 
			'title' => __( 'Text Styles', THEME_TEXTDOMAIN ),
			'items' => array(
				array(
					'title' => 'Preamble',
					'selector' => 'p',
					'classes' => 'preamble'
				),
				array(
					'title' => 'Quote',
					'selector' => 'p',
					'classes' => 'quote'
				),
			)
		)
	);
    $settings['style_formats'] = json_encode( $style_formats );
    return $settings;
}
add_filter( 'tiny_mce_before_init', 'who_cares_mce_before_init' );

// Remove TinyMCE buttons row 1
function who_cares_tinymce_remove_buttons_1( $buttons ){
	//unset( $buttons[0] ); // bold
	//unset( $buttons[1] ); // italic
	unset( $buttons[2] ); // strikethrough
	//unset( $buttons[3] ); // bullist
	//unset( $buttons[4] ); // numlist
	//unset( $buttons[5] ); // blockquote
	//unset( $buttons[6] ); // hr
	//unset( $buttons[7] ); // alignleft
	//unset( $buttons[8] ); // aligncenter
	//unset( $buttons[9] ); // alignright
	//unset( $buttons[10] ); // unlink
	unset( $buttons[11] ); // wp_more
	unset( $buttons[12] ); // spellchecker
	//unset( $buttons[13] ); // fullscreen
	//unset( $buttons[14] ); // wp_adv
	$buttons[] = 'table';
	return $buttons;
}
add_filter( 'mce_buttons', 'who_cares_tinymce_remove_buttons_1' );

// Remove TinyMCE buttons row 2
function who_cares_tinymce_remove_buttons_2( $buttons ) {
	//unset( $buttons[0] ); // Styleselect
	//unset( $buttons[1] ); // formatselect
	//unset( $buttons[2] ); // underline
	unset( $buttons[3] ); // alignjustify
	unset( $buttons[4] ); // forecolor
	//unset( $buttons[5] ); // pastetext
	//unset( $buttons[6] ); // removeformat
	unset( $buttons[7] ); // charmap
	unset( $buttons[8] ); // outdent
	unset( $buttons[9] ); // indent
	unset( $buttons[10] ); // undo
	unset( $buttons[11] ); // redo
	unset( $buttons[12] ); // wp_help
	return $buttons;
}
add_filter( 'mce_buttons_2', 'who_cares_tinymce_remove_buttons_2' );