<?php
/**
 * Search results page
 *
 * @package     WordPress
 * @subpackage  Timber
 * @since       Timber 0.1
 */

$templates = array('search.twig', 'archive.twig', 'index.twig');

$context          = \Timber\Timber::get_context();
$context['title'] = 'Search results for '.get_search_query();
$context['posts'] = new \Timber\PostQuery();

\Timber\Timber::render($templates, $context);
