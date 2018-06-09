<?php

$requestedFooter = 'classic'; // TODO: Customizable by user

?>
    <?php get_template_part('template-parts/footer/footer', $requestedFooter); ?>

    <!-- Go To Top -->
    <a class="js-go-to u-go-to-v1" href="#"
       data-type="fixed"
       data-position='{
           "bottom": 15,
           "right": 15
         }'
       data-offset-top="300"
       data-compensation="#js-header"
       data-show-effect="zoomIn">
        <i class="hs-icon hs-icon-arrow-top"></i>
    </a>
    <!-- End Go To Top -->
</main>
<?php wp_footer(); ?>
</body>
</html>
