<?php
/**
 * Front to the WordPress application.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

/* Keep WordPress subdirectory path detection valid for rewritten front requests. */
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/wp/index.php';

/** Loads the WordPress Environment and Template. */
require __DIR__ . '/wp/wp-blog-header.php';
