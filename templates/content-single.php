<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class(); ?>>
		<header>
			<?php get_template_part( 'templates/entry-meta' ); ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>

		</header>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<?php #comments_template( '/templates/comments.php' ); ?>
	</article>
<?php endwhile; ?>
