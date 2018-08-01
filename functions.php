<?php

if (!class_exists('Timber')) {
    add_action('admin_notices', function () {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="'.esc_url(admin_url('plugins.php#timber')).'">'.esc_url(admin_url('plugins.php')).'</a></p></div>';
    });

    add_filter('template_include', function ($template) {
        return get_stylesheet_directory().'/static/no-timber.html';
    });

    return;
}

\Timber\Timber::$dirname = array('templates', 'views');

class UnifySite extends \Timber\Site
{
    function __construct()
    {
        add_action('after_setup_theme', array($this, 'add_theme_supports'));

        add_action('admin_init', array($this, 'add_editor_style'));

        register_nav_menus(array(
            'legal' => 'Legal Links Menu',
            'social' => 'Social Links Menu',
        ));

        add_action('wp_enqueue_scripts', array($this, 'add_stylesheets'));
        add_action('wp_enqueue_scripts', array($this, 'add_javascript'));
        add_action('wp_footer', array($this, 'add_default_script'));

        add_action('widgets_init', array($this, 'add_widgets'));

        add_filter('timber_context', array($this, 'add_to_context'));
        add_filter('get_twig', array($this, 'add_to_twig'));
        add_action('init', array($this, 'register_post_types'));
        add_action('init', array($this, 'register_taxonomies'));
        parent::__construct();
    }

    function add_theme_supports()
    {
        /*
         * Using a custom logo allows site owners to upload an image for their website, which can be
         * placed at the top of their website. It can be uploaded from Appearance > Header, in your
         * admin panel.
         */
        add_theme_support('custom-logo');

        /*
         * A Post Format is used by a theme for presenting posts in a certain format and style.
         */
        add_theme_support('post-formats');


        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        add_theme_support('menus');

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // WooCommerce setup
        add_theme_support('woocommerce');
    }

    function add_stylesheets()
    {
        wp_enqueue_style('unify-css-boostrap',     get_stylesheet_directory_uri().'/static/vendor/bootstrap/bootstrap.min.css', array(), wp_get_theme()->get('Version'));
        wp_enqueue_style('unify-css-icon-hs',      get_stylesheet_directory_uri().'/static/vendor/icon-hs/style.css', array(), wp_get_theme()->get('Version'));
        wp_enqueue_style('unify-css-icon-line-pro',get_stylesheet_directory_uri().'/static/vendor/icon-line-pro/style.css', array(), wp_get_theme()->get('Version'));
        wp_enqueue_style('unify-css-icon-awesome', get_stylesheet_directory_uri().'/static/vendor/icon-awesome/css/font-awesome.min.css', array(), wp_get_theme()->get('Version'));
        wp_enqueue_style('unify-css-hamburgers',   get_stylesheet_directory_uri().'/static/vendor/hamburgers/hamburgers.min.css', array(), wp_get_theme()->get('Version'));
        wp_enqueue_style('unify-css-hs-megamenu',  get_stylesheet_directory_uri().'/static/vendor/hs-megamenu/src/hs.megamenu.css', array(), wp_get_theme()->get('Version'));
        wp_enqueue_style('unify-css-unify',        get_stylesheet_directory_uri().'/static/css/unify.css', array(), wp_get_theme()->get('Version'));
    }

    function add_javascript()
    {
        wp_enqueue_script('unify-js-jquery',        get_stylesheet_directory_uri().'/static/vendor/jquery/jquery.min.js', array(), wp_get_theme()->get('Version'), false);
        wp_enqueue_script('unify-js-jquery-migrate',get_stylesheet_directory_uri().'/static/vendor/jquery-migrate/jquery-migrate.min.js', array(), wp_get_theme()->get('Version'), true);
        wp_enqueue_script('unify-js-popper',        get_stylesheet_directory_uri().'/static/vendor/popper.min.js', array(), wp_get_theme()->get('Version'), true);
        wp_enqueue_script('unify-js-bootstrap',     get_stylesheet_directory_uri().'/static/vendor/bootstrap/bootstrap.min.js', array(), wp_get_theme()->get('Version'), true);
        wp_enqueue_script('unify-js-hs-megamenu',   get_stylesheet_directory_uri().'/static/vendor/hs-megamenu/src/hs.megamenu.js', array(), wp_get_theme()->get('Version'), true);
        wp_enqueue_script('unify-js-hs.core',       get_stylesheet_directory_uri().'/static/js/hs.core.js', array(), wp_get_theme()->get('Version'), true);
        wp_enqueue_script('unify-js-hs.header',     get_stylesheet_directory_uri().'/static/js/components/hs.header.js', array(), wp_get_theme()->get('Version'), true);
        wp_enqueue_script('unify-js-hs.hamburgers', get_stylesheet_directory_uri().'/static/js/helpers/hs.hamburgers.js', array(), wp_get_theme()->get('Version'), true);
        wp_enqueue_script('unify-js-hs.go-to',      get_stylesheet_directory_uri().'/static/js/components/hs.go-to.js', array(), wp_get_theme()->get('Version'), true);
    }

    function add_default_script()
    {
        echo <<<EOF
<script>
    $(document).on('ready', function () {
        // initialization of go to
        $.HSCore.components.HSGoTo.init('.js-go-to');
    });

    $(window).on('load', function () {
        // initialization of header
        $.HSCore.components.HSHeader.init($('#js-header'));
        $.HSCore.helpers.HSHamburgers.init('.hamburger');

        // initialization of HSMegaMenu component
        $('.js-mega-menu').HSMegaMenu({
            event: 'hover',
            pageContainer: $('.container'),
            breakpoint: 991
        });
    });
</script>
EOF;
    }

    function add_widgets()
    {
        register_sidebar(array(
            'name'          => 'Sidebar',
            'id'            => 'sidebar-1',
            'description'   => 'Add widgets here to appear in your sidebar on blog posts and archive pages.',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
        register_sidebar(array(
            'name'          => 'Footer column 1',
            'id'            => 'footer-1',
            'description'   => 'Add widgets here to appear in your footer.',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
        register_sidebar(array(
            'name'          => 'Footer column 2',
            'id'            => 'footer-2',
            'description'   => 'Add widgets here to appear in your footer.',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
        register_sidebar(array(
            'name'          => 'Footer column 3',
            'id'            => 'footer-3',
            'description'   => 'Add widgets here to appear in your footer.',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
        register_sidebar(array(
            'name'          => 'Footer column 4',
            'id'            => 'footer-4',
            'description'   => 'Add widgets here to appear in your footer.',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }

    function add_editor_style()
    {
        add_editor_style('custom-editor-style.css');
    }

    function register_post_types()
    {
        // this is where you can register custom post types
    }

    function register_taxonomies()
    {
        // this is where you can register custom taxonomies
    }

    function add_to_context($context)
    {
        // I am a value set in your functions.php file
        // These values are available everytime you call Timber::get_context();
        $context['menu']['primary']  = new \Timber\Menu('primary');
        $context['menu']['legal']  = new \Timber\Menu('legal');
        $context['menu']['social']  = new \Timber\Menu('social');
        $context['dynamic_sidebar']['sidebar_1'] = \Timber\Timber::get_widgets('sidebar-1');
        $context['dynamic_sidebar']['footer_1'] = \Timber\Timber::get_widgets('footer-1');
        $context['dynamic_sidebar']['footer_2'] = \Timber\Timber::get_widgets('footer-2');
        $context['dynamic_sidebar']['footer_3'] = \Timber\Timber::get_widgets('footer-3');
        $context['dynamic_sidebar']['footer_4'] = \Timber\Timber::get_widgets('footer-4');
        $context['site']  = $this;

        return $context;
    }

    /**
     * @param \Twig_Environment $twig
     *
     * @return mixed
     */
    function add_to_twig($twig)
    {
        /* this is where you can add your own functions to twig */
        $twig->addExtension(new Twig_Extension_StringLoader());
        //$twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));

        return $twig;
    }
}

function timber_set_product($post)
{
    global $product;

    if (is_woocommerce()) {
        $product = wc_get_product($post->ID);
    }
}

new UnifySite();
