<?php if ( is_search() ) : ?>
	<?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', THEME_TEXTDOMAIN ); ?>
<?php else : ?>
	<?php _e( 'No posts was found', THEME_TEXTDOMAIN ); ?>
<?php endif; ?>