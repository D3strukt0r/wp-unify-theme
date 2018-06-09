<?php

get_header();

while (have_posts()) {
    the_post();

?>

<!-- Content -->
<section class="g-py-50">
    <div class="container">
        <pre>single.php</pre><hr />
        <?php

        get_template_part('template-parts/post/content', get_post_format());

        the_post_navigation();

        ?>
    </div>
</section>
<!-- End Content -->

<!-- Blog Single Item Comments -->
<section class="container g-py-100">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <?php

            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) {
                comments_template();
            }

            ?>
        </div>
    </div>
</section>
<!-- End Blog Single Item Comments -->

<?php

}

get_footer();
