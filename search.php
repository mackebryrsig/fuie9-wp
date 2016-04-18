<?php get_header(); ?>
	<?php printf( __( 'Search Results for: %s', THEME_TEXTDOMAIN ), get_search_query() ); ?>
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'templates/list/search' ); ?>
		<?php endwhile; ?>
	<?php else : ?>
		<?php get_template_part( 'templates/list/no-posts' ); ?>
	<?php endif; ?>
<?php get_footer(); ?>