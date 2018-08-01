<?php
/**
 * The Template for displaying all single posts
 *
 * @package     WordPress
 * @subpackage  Timber
 * @since       Timber 0.1
 */

$context         = \Timber\Timber::get_context();
$post            = \Timber\Timber::query_post();
$context['post'] = $post;

if (post_password_required($post->ID)) {
    \Timber\Timber::render('single-password.twig', $context);
} else {
    \Timber\Timber::render(array('single-'.$post->ID.'.twig', 'single-'.$post->post_type.'.twig', 'single.twig'), $context);
}
