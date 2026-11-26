<?php
/**
 * Theme setup: supports, styles and scripts, pattern categories and block styles.
 *
 * @package OpenMU_Aurora
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers theme features and loads the translations.
 * Hooked to after_setup_theme.
 */
function openmu_aurora_setup(): void {
	load_theme_textdomain( 'openmu-aurora', get_theme_file_path( 'languages' ) );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	// The editor shows the dark theme with the same fonts and glass panels.
	add_editor_style( 'assets/css/editor.css' );

	// Card picture of the news grids (16:10); WordPress crops uploads to it.
	add_image_size( 'openmu-aurora-card', 960, 600, true );
}
add_action( 'after_setup_theme', 'openmu_aurora_setup' );

/**
 * Returns the front-end stylesheets of the theme, in load order: handle => file in assets/css/.
 *
 * @return array<string, string>
 */
function openmu_aurora_styles(): array {
	return array(
		'openmu-aurora-base'     => 'base.css',     // Tokens, typography, buttons, forms, glass panels.
		'openmu-aurora-stage'    => 'stage.css',    // Painted background: layers, canvases, veil.
		'openmu-aurora-header'   => 'header.css',   // Sticky header, menu, mobile overlay.
		'openmu-aurora-sections' => 'sections.css', // Hero, showcase, news, steps, CTA, footer, page bands.
		'openmu-aurora-blocks'   => 'blocks.css',   // OpenMU WP Connect blocks.
	);
}

/**
 * Loads the stylesheets and the one small script of the theme.
 * Hooked to wp_enqueue_scripts.
 */
function openmu_aurora_enqueue(): void {
	$previous = array();
	foreach ( openmu_aurora_styles() as $handle => $file ) {
		$path = get_theme_file_path( 'assets/css/' . $file );
		wp_enqueue_style( $handle, get_theme_file_uri( 'assets/css/' . $file ), $previous, (string) filemtime( $path ) );
		$previous = array( $handle );
	}

	// Icons and other masks that depend on which art files exist.
	wp_add_inline_style( 'openmu-aurora-base', openmu_aurora_icon_css() );

	$script = get_theme_file_path( 'assets/js/aurora.js' );
	wp_enqueue_script(
		'openmu-aurora',
		get_theme_file_uri( 'assets/js/aurora.js' ),
		array(),
		(string) filemtime( $script ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'openmu_aurora_enqueue' );

/**
 * Prints the early <head> extras: a "js" class on <html> (so reveal animations only hide
 * content when the script will actually run; taken back if it never starts) and preloads of
 * the two fonts.
 * Hooked to wp_head at priority 1, before any stylesheet.
 */
function openmu_aurora_head(): void {
	// Printed through core, so a Content Security Policy plugin can add its nonce to the tag.
	// Fail-safe: when the theme script has not started after four seconds (blocked, failed to
	// load), the "js" class goes again, so the .au-reveal sections it would fade in are shown.
	wp_print_inline_script_tag( "(function(d){d.classList.add('js');setTimeout(function(){if(!d.classList.contains('au-ready')){d.classList.remove('js');}},4000);})(document.documentElement);" );
	foreach ( array( 'marcellus-sc.woff2', 'manrope-var.woff2' ) as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin />' . "\n",
			esc_url( get_theme_file_uri( 'assets/fonts/' . $font ) )
		);
	}
}
add_action( 'wp_head', 'openmu_aurora_head', 1 );

/**
 * Prints the favicon link from the theme's own SVG when the site has no Site Icon set.
 * Hooked to wp_head.
 */
function openmu_aurora_favicon(): void {
	$url = openmu_aurora_art_url( 'logo/favicon.svg' );
	if ( '' !== $url && ! has_site_icon() ) {
		printf( '<link rel="icon" href="%s" type="image/svg+xml" />' . "\n", esc_url( $url ) );
	}
}
add_action( 'wp_head', 'openmu_aurora_favicon' );

/**
 * Adds body classes: "au-home" on the front page (full hero scene), "au-calm" elsewhere
 * (the quieter subpage background).
 *
 * @param string[] $classes Body classes so far.
 * @return string[]
 */
function openmu_aurora_body_class( array $classes ): array {
	$classes[] = is_front_page() ? 'au-home' : 'au-calm';
	return $classes;
}
add_filter( 'body_class', 'openmu_aurora_body_class' );

/**
 * Leaves out the OpenMU plugin's blocks on a page that still asks for its password.
 *
 * The page templates place the plugin's blocks (ranking, armory, account ...) next to the
 * page's own content, not inside it, so the password form of the content would not cover
 * them. Hooked to render_block.
 *
 * @param mixed                $content Rendered block; not typed, another filter may hand over null.
 * @param array<string, mixed> $block   Parsed block.
 * @return mixed The block, or an empty string on a locked page.
 */
function openmu_aurora_hide_plugin_blocks_on_locked_page( $content, array $block ) {
	if ( str_starts_with( (string) ( $block['blockName'] ?? '' ), 'openmu/' ) && is_singular() && post_password_required( get_queried_object_id() ) ) {
		return '';
	}
	return $content;
}
add_filter( 'render_block', 'openmu_aurora_hide_plugin_blocks_on_locked_page', 10, 2 );

/**
 * Registers the pattern categories of the theme's inserter section.
 * Hooked to init.
 */
function openmu_aurora_pattern_categories(): void {
	register_block_pattern_category(
		'openmu-aurora',
		array( 'label' => __( 'OpenMU Aurora', 'openmu-aurora' ) )
	);
	register_block_pattern_category(
		'openmu-aurora-pages',
		array( 'label' => __( 'OpenMU Aurora pages', 'openmu-aurora' ) )
	);
}
add_action( 'init', 'openmu_aurora_pattern_categories' );

/**
 * Registers the block style variations: the glass panel (also the class the plugin's event
 * and mini game windows carry), outlined buttons and framed images.
 * Hooked to init.
 */
function openmu_aurora_block_styles(): void {
	register_block_style(
		'core/group',
		array(
			'name'  => 'mu-window',
			'label' => __( 'Glass panel', 'openmu-aurora' ),
		)
	);
	register_block_style(
		'core/button',
		array(
			'name'  => 'ghost',
			'label' => __( 'Glass outline', 'openmu-aurora' ),
		)
	);
	register_block_style(
		'core/image',
		array(
			'name'  => 'framed',
			'label' => __( 'Framed', 'openmu-aurora' ),
		)
	);
}
add_action( 'init', 'openmu_aurora_block_styles' );
