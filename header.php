<?php

$requestedHeader = 'classic-dark-bg'; // TODO: Customizable by user

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php if (is_singular() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    } ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<main>
    <?php if (!is_page_template('blank-page.php') && !is_page_template('blank-page-with-container.php')) {
        get_template_part('template-parts/header/header', $requestedHeader);
    } ?>
