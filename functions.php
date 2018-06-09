<?php

function unify_starter_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WP Bootstrap Starter, use a find and replace
	 * to change 'wp-bootstrap-starter' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'unify', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'unify' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wp_bootstrap_starter_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	function unify_add_editor_styles() {
		add_editor_style( 'custom-editor-style.css' );
	}
	add_action( 'admin_init', 'unify_add_editor_styles' );

}
add_action( 'after_setup_theme', 'unify_starter_setup' );

function unify_enqueue_styles() {
	// Load parent
    //$parent_style = 'wp-bootstrap-starter';
    //wp_enqueue_style($parent_style, get_template_directory_uri().'/style.css');
    //wp_enqueue_style('child-style', get_stylesheet_directory_uri().'/style.css', array($parent_style), wp_get_theme()->get('Version'));

    // Load Unify
	wp_enqueue_style('unify-css-boostrap',     get_stylesheet_directory_uri().'/assets/vendor/bootstrap/bootstrap.min.css', array(), '');
	wp_enqueue_style('unify-css-icon-hs',      get_stylesheet_directory_uri().'/assets/vendor/icon-hs/style.css', array(), '');
	wp_enqueue_style('unify-css-icon-line-pro',get_stylesheet_directory_uri().'/assets/vendor/icon-line-pro/style.css', array(), '');
	wp_enqueue_style('unify-css-icon-awesome', get_stylesheet_directory_uri().'/assets/vendor/icon-awesome/css/font-awesome.min.css', array(), '');
	wp_enqueue_style('unify-css-hamburgers',   get_stylesheet_directory_uri().'/assets/vendor/hamburgers/hamburgers.min.css', array(), '');
	wp_enqueue_style('unify-css-hs-megamenu',  get_stylesheet_directory_uri().'/assets/vendor/hs-megamenu/src/hs.megamenu.css', array(), '');
	wp_enqueue_style('unify-css-unify',        get_stylesheet_directory_uri().'/assets/css/unify.css', array(), '');

	wp_enqueue_script('unify-js-jquery',        get_stylesheet_directory_uri().'/assets/vendor/jquery/jquery.min.js', array(), '', false);
	wp_enqueue_script('unify-js-jquery-migrate',get_stylesheet_directory_uri().'/assets/vendor/jquery-migrate/jquery-migrate.min.js', array(), '', true);
	wp_enqueue_script('unify-js-popper',        get_stylesheet_directory_uri().'/assets/vendor/popper.min.js', array(), '', true);
	wp_enqueue_script('unify-js-bootstrap',     get_stylesheet_directory_uri().'/assets/vendor/bootstrap/bootstrap.min.js', array(), '', true);
	wp_enqueue_script('unify-js-hs-megamenu',   get_stylesheet_directory_uri().'/assets/vendor/hs-megamenu/src/hs.megamenu.js', array(), '', true);
	wp_enqueue_script('unify-js-hs.core',       get_stylesheet_directory_uri().'/assets/js/hs.core.js', array(), '', true);
	wp_enqueue_script('unify-js-hs.header',     get_stylesheet_directory_uri().'/assets/js/components/hs.header.js', array(), '', true);
	wp_enqueue_script('unify-js-hs.hamburgers', get_stylesheet_directory_uri().'/assets/js/helpers/hs.hamburgers.js', array(), '', true);
	wp_enqueue_script('unify-js-hs.go-to',      get_stylesheet_directory_uri().'/assets/js/components/hs.go-to.js', array(), '', true);


}
add_action('wp_enqueue_scripts', 'unify_enqueue_styles');

function unify_default_script() {
	echo '<script>
      $(document).on(\'ready\', function () {
        // initialization of go to
        $.HSCore.components.HSGoTo.init(\'.js-go-to\');
      });

      $(window).on(\'load\', function () {
        // initialization of header
        $.HSCore.components.HSHeader.init($(\'#js-header\'));
        $.HSCore.helpers.HSHamburgers.init(\'.hamburger\');

        // initialization of HSMegaMenu component
        $(\'.js-mega-menu\').HSMegaMenu({
          event: \'hover\',
          pageContainer: $(\'.container\'),
          breakpoint: 991
        });
      });
    </script>';
}
add_action('wp_footer', 'unify_default_script');

register_nav_menus( array(
	'unify-social' => 'Social Links Menu',
	'unify-copyright' => 'Copyright Links Menu',
) );

function get_menu_items_by_registered_slug($menu_slug) {
	$menu_items = array();
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_slug ] ) ) {
		$menu = get_term( $locations[ $menu_slug ] );
		$menu_items = wp_get_nav_menu_items($menu->term_id);
	}
	return $menu_items;
}

class unify_navwalker extends Walker_Nav_Menu {

    private $style = '';

    public function __construct($style = '') {
        $this->style = $style;
    }

    /**
     * @see Walker::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Depth of the item. Used for padding
     * @param array  $args   An array of additional arguments.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        if ($depth === 0) {
            $output .= '<ul class="hs-sub-menu list-unstyled g-text-transform-none g-brd-top g-brd-primary g-brd-top-2 g-min-width-200 g-mt-20 g-mt-10--lg--scrolling '.$this->style.'">';
        } elseif ($depth === 1) {
            $output .= '<ul class="hs-sub-menu list-unstyled g-brd-top g-brd-primary g-brd-top-2 g-min-width-200 g-my-2 '.$this->style.'">';
        }
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param object $item   The data object.
     * @param int    $depth  Depth of the item.
     * @param array  $args   An array of additional arguments.
     * @param int    $id     ID of the current item.
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        /**
         * Dividers, Headers or Disabled
         * =============================
         * Determine whether the item is a Divider, Header, Disabled or regular
         * menu item. To prevent errors we use the strcasecmp() function to so a
         * comparison that is not case sensitive. The strcasecmp() function returns
         * a 0 if the strings are equal.
         */
        if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
            $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
        } else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
        } else {

            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            //$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

            // Menu in root
            if($args->has_children && $depth === 0) { $class_names .= ' nav-item hs-has-sub-menu g-mx-20--lg'; }
            // Submenu
            elseif($args->has_children && $depth > 0) {$class_names .= ' dropdown-item hs-has-sub-menu'; }
            // Items in root
            elseif ($depth === 0) { $class_names .= ' nav-item g-mx-20--lg'; }
            // Items in dropdown
            elseif ($depth > 0) { $class_names .= ' dropdown-item'; }

            if ( in_array( 'current-menu-item', $classes ) )
                $class_names .= ' active';

            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names .'>';

            $atts = array();
            $atts['title']  = ! empty( $item->title )  ? $item->title  : '';
            $atts['target'] = ! empty( $item->target ) ? $item->target : '';
            $atts['rel']    = ! empty( $item->xfn )    ? $item->xfn    : '';
            $atts['href']   = ! empty( $item->url )    ? $item->url    : '';

            // If item has_children add atts to a.

            if ( $args->has_children ) {
                $atts['href']   		= '#';
                $atts['class']			= 'nav-link g-px-0';
                $atts['aria-haspopup'] = 'true';
                $atts['aria-expanded'] = 'false';
                $atts['aria-controls'] = 'nav-submenu-'.$item->ID;
            } else {
                $atts['href'] = ! empty( $item->url ) ? $item->url : '';
                $atts['class'] = 'nav-link px-0';
            }
            if ($depth > 0 && !in_array('menu-item-has-children', $classes)) {
                $atts['class']         = 'nav-link g-px-0';
            }elseif($depth > 0 && in_array('menu-item-has-children', $classes)){
                $atts['class']			= 'nav-link g-px-0';
            }

            /*
            if ($depth === 0) {
                $atts['class'] = 'nav-link';
            }
            if ($depth === 0 && in_array('menu-item-has-children', $classes)) {
                $atts['class']       .= ' dropdown-toggle';
                $atts['data-toggle']  = 'dropdown';
            }
            if ($depth > 0) {
                $atts['class'] = 'dropdown-item';
            }
            if (in_array('current-menu-item', $item->classes)) {
                $atts['class'] .= ' active';
            }
            */

            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );



            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;

            /*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
            if ( ! empty( $item->attr_title ) )
                $item_output .= '<a'. $attributes .'>';
            else
                $item_output .= '<a'. $attributes .'>';

            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= ( $args->has_children ) ? '</a>' : '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

    /**
     * Traverse elements to create list from elements.
     *
     * Display one element if the element doesn't have any children otherwise,
     * display the element and its children. Will only traverse up to the max
     * depth and no ignore elements under that depth.
     *
     * This method shouldn't be called directly, use the walk() method instead.
     *
     * @see Walker::start_el()
     * @since 2.5.0
     *
     * @param object $element Data object
     * @param array $children_elements List of elements to continue traversing.
     * @param int $max_depth Max depth to traverse.
     * @param int $depth Depth of current element.
     * @param array $args
     * @param string $output Passed by reference. Used to append additional content.
     * @return null Null on failure with no changes to parameters.
     */
    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
            $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

    /**
     * Menu Fallback
     * =============
     * If this function is assigned to the wp_nav_menu's fallback_cb variable
     * and a manu has not been assigned to the theme location in the WordPress
     * menu manager the function with display nothing to a non-logged in user,
     * and will add a link to the WordPress menu manager if logged in as an admin.
     *
     * @param array $args passed from the wp_nav_menu function.
     *
     */
    public static function fallback( $args ) {
        //if ( current_user_can( 'manage_options' ) ) {

        extract( $args );

        $fb_output = null;

        if ( $container ) {
            $fb_output = '<' . $container;

            if ( $container_id )
                $fb_output .= ' id="' . $container_id . '"';

            if ( $container_class )
                $fb_output .= ' class="' . $container_class . '"';

            $fb_output .= '>';
        }

        $fb_output .= '<ul';

        if ( $menu_id )
            $fb_output .= ' id="' . $menu_id . '"';

        if ( $menu_class )
            $fb_output .= ' class="' . $menu_class . '"';

        $fb_output .= '>';
        $fb_output .= '<li class="nav-item"><a href="#" class="nav-link">Home</a></li>';
        $fb_output .= '<li class="nav-item"><a href="#" class="nav-link">About Us</a></li>';
        $fb_output .= '<li class="nav-item"><a href="#" class="nav-link">Gallery</a></li>';
        $fb_output .= '<li class="nav-item"><a href="#" class="nav-link">Contact Us</a></li>';
        /*$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';*/
        $fb_output .= '</ul>';

        if ( $container )
            $fb_output .= '</' . $container . '>';

        echo $fb_output;
        //}
    }
}


function unify_starter_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wp-bootstrap-starter' ),
		'id'            => 'sidebar-1',
		'description'   => 'Add widgets here.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => 'Footer 1',
		'id'            => 'footer-1',
		'description'   => 'Add widgets here.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => 'Footer 2',
		'id'            => 'footer-2',
		'description'   => 'Add widgets here.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => 'Footer 3',
		'id'            => 'footer-3',
		'description'   => 'Add widgets here.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => 'Footer 4',
		'id'            => 'footer-4',
		'description'   => 'Add widgets here.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'unify_starter_widgets_init' );
