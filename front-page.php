<?php get_header(); ?>

<!-- Content -->
<div class="container g-pt-100 g-pb-20">
    <pre>front-page.php</pre><hr />
    <div class="row justify-content-between">
        <div class="col-lg-9 g-mb-80">
            <div class="g-pr-20--lg">

                <?php

                // Show the selected front page content.
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        get_template_part('template-parts/page/content', 'front-page');
                    }
                } else {
                    get_template_part('template-parts/post/content', 'none');
                }

                the_posts_navigation(array(
                    'prev_text' => 'Previous',
                    'next_text' => 'Next',
                ));

                ?>
                <!-- Pagination -->
                <nav id="stickyblock-end" class="text-center" aria-label="Page Navigation">
                    <ul class="list-inline">
                        <li class="list-inline-item float-left g-hidden-xs-down">
                            <a class="u-pagination-v1__item u-pagination-v1-4 g-brd-gray-light-v3 g-brd-primary--hover g-rounded-50 g-pa-7-16" href="#!" aria-label="Previous">
                                <span aria-hidden="true">
                                    <i class="fa fa-angle-left g-mr-5"></i> Previous
                                </span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="u-pagination-v1__item u-pagination-v1-4 u-pagination-v1-4--active g-rounded-50 g-pa-7-14" href="#!">1</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="u-pagination-v1__item u-pagination-v1-4 g-rounded-50 g-pa-7-14" href="#!">2</a>
                        </li>
                        <li class="list-inline-item float-right g-hidden-xs-down">
                            <a class="u-pagination-v1__item u-pagination-v1-4 g-brd-gray-light-v3 g-brd-primary--hover g-rounded-50 g-pa-7-16" href="#!" aria-label="Next">
                                <span aria-hidden="true">
                                    Next <i class="fa fa-angle-right g-ml-5"></i>
                                </span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Pagination -->
            </div>
        </div>
    </div>
</div>
<!-- End Blog Minimal Blocks -->

<?php get_footer(); ?>
