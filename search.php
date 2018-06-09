<?php get_header(); ?>

<!-- Content -->
<section class="g-py-50">
    <div class="container">

        <header class="page-header">
            <?php if ( have_posts() ) : ?>
                <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyseventeen' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            <?php else : ?>
                <h1 class="page-title"><?php _e( 'Nothing Found', 'twentyseventeen' ); ?></h1>
            <?php endif; ?>
        </header><!-- .page-header -->

        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

            <?php
            if ( have_posts() ) :
                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */
                    get_template_part( 'template-parts/post/content', 'excerpt' );

                endwhile; // End of the loop.

                the_posts_pagination();

            else : ?>

                <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyseventeen' ); ?></p>
                <?php
                    get_search_form();

            endif;
            ?>

            </main><!-- #main -->
        </div><!-- #primary -->
        <?php get_sidebar(); ?>
    </div>
</section>
<!-- End Content -->

<?php get_footer();
