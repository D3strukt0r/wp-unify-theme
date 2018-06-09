<?php get_header(); ?>

<!-- Content -->
<section class="g-py-50">
	<div class="container">
        <pre>page.php</pre><hr />
		<?php

        while (have_posts()) {
            the_post();

            get_template_part('template-parts/page/content', 'page');

            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
        }

		?>
	</div>
</section>
<!-- End Content -->

<?php get_footer(); ?>
