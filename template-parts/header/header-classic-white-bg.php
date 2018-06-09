<!-- Header -->
<header id="js-header" class="u-header u-header--static u-header--show-hide u-header--change-appearance" data-header-fix-moment="300" data-header-fix-effect="slide">
    <div class="u-header__section u-header__section--light g-bg-white g-transition-0_3 g-py-10" data-header-fix-moment-exclude="g-bg-white g-py-10" data-header-fix-moment-classes="g-bg-white-opacity-0_8 u-shadow-v18 g-py-0">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Responsive Toggle Button -->
                <button class="navbar-toggler navbar-toggler-right btn g-line-height-1 g-brd-none g-pa-0 g-pos-abs g-right-0 g-top-3" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
                    <span class="hamburger hamburger--slider">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </span>
                </button>
                <!-- End Responsive Toggle Button -->

                <!-- Logo -->
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand d-flex">
                    <?php if ( get_theme_mod( 'wp_bootstrap_starter_logo' ) ): ?>
                        <img src="<?php echo esc_attr( get_theme_mod( 'wp_bootstrap_starter_logo' ) ); ?>"
                             alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    <?php else: ?>
                        <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
                    <?php endif; ?>
                </a>
                <!-- End Logo -->

                <!-- Navigation -->
                <?php if ( has_nav_menu( 'primary' ) ): ?>
                    <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'primary',
                        'container'       => 'div',
                        'container_id'    => 'navBar',
                        'container_class' => 'js-mega-menu collapse navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg',
                        'menu_class'      => 'navbar-nav text-uppercase g-font-weight-600 ml-auto',
                        'depth'           => 3,
                        'fallback_cb'     => 'unify_navwalker::fallback',
                        'walker'          => new unify_navwalker()
                    ));
                    ?>
                <?php endif; ?>
                <!-- End Navigation -->
            </div>
        </nav>
    </div>
</header>
<!-- End Header -->
