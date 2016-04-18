<?php get_header(); ?>
<div id="main" role="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'templates/list/post' ); ?>
	<?php endwhile; else : ?>
		<?php get_template_part( 'templates/list/no-posts' ); ?>
	<?php endif; ?>
</div><!-- /#main -->
<?php get_footer(); ?>