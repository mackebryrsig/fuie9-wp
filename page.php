<?php get_header(); ?>
<div id="main" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php if ( have_rows( 'page_components' ) && ! post_password_required() ) : ?>
			<?php while ( have_rows( 'page_components' ) ) : the_row(); ?>
				<?php get_template_part( 'templates/components/' . get_row_layout() ); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	<?php endwhile; ?>
</div><!-- /#main -->
<?php get_footer(); ?>