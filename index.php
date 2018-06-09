<?php get_header(); ?>

<!-- Content -->
<section class="g-py-50">
	<div class="container">
        <pre>index.php</pre><hr />
		<?php if (is_home() && ! is_front_page()): ?>
            <header>
                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            </header>
        <?php else : ?>
            <header class="page-header">
                <h2 class="page-title">Posts</h2>
            </header>
		<?php endif; ?>
		<?php if (have_posts()): ?>
			<?php
			/* Start the Loop */
			while (have_posts()): the_post();
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part('template-parts/post/content', get_post_format());

			endwhile;

			the_posts_navigation();
			?>
		<?php else: ?>
			<?php get_template_part('template-parts/page/content', 'none'); ?>
		<?php endif; ?>

		<?php get_sidebar(); ?>
	</div>
</section>
<!-- End Content -->

<?php get_footer(); ?>
