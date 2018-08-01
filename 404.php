<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package     WordPress
 * @subpackage  Timber
 * @since       Timber 0.1
 */

$context = \Timber\Timber::get_context();
$context['body_class'] .= ' g-bg-gray-dark-v1 g-color-white';
\Timber\Timber::render('404.twig', $context);
