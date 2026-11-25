<?php
/**
 * OpenMU Aurora - theme bootstrap.
 *
 * Loads the theme's include files, each of which owns one concern:
 * - helpers.php     small functions used everywhere (art paths and URLs, inline icons, page lookup);
 * - setup.php       theme supports, styles and scripts, patterns, block styles, client assets filter;
 * - stage.php       the painted, animated background ("stage") printed after <body>;
 * - nav.php         the dynamic header menu block (openmu-aurora/site-nav);
 * - news-fallback.php  painted fallback pictures for posts without a featured image;
 * - site-setup.php  creates the pages and reading settings when the theme is activated.
 *
 * @package OpenMU_Aurora
 */

defined( 'ABSPATH' ) || exit;

/** Theme version, used as the cache-busting suffix of the CSS/JS files. */
const OPENMU_AURORA_VERSION = '1.0.0';

foreach ( array( 'helpers', 'setup', 'stage', 'nav', 'news-fallback', 'site-setup' ) as $openmu_aurora_file ) {
	require_once get_theme_file_path( 'inc/' . $openmu_aurora_file . '.php' );
}
unset( $openmu_aurora_file );
