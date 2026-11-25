<?php
/**
 * Small helpers shared by the theme's PHP files, patterns and templates.
 *
 * @package OpenMU_Aurora
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the absolute path of a file in assets/art/ (painted artwork, logo, icons, ornaments).
 *
 * @param string $relative Path inside assets/art/, e.g. "scene/sky.webp".
 */
function openmu_aurora_art_path( string $relative ): string {
	return get_theme_file_path( 'assets/art/' . ltrim( $relative, '/' ) );
}

/**
 * Tells whether an art file exists. Art is generated separately from the code, so every
 * use checks first: a missing file falls back to a CSS gradient instead of a broken image.
 *
 * @param string $relative Path inside assets/art/.
 */
function openmu_aurora_art_exists( string $relative ): bool {
	static $cache = array();
	if ( ! isset( $cache[ $relative ] ) ) {
		$cache[ $relative ] = is_file( openmu_aurora_art_path( $relative ) );
	}
	return $cache[ $relative ];
}

/**
 * Returns the address of an art file, or an empty string when the file does not exist.
 * The file's modification time is appended so a regenerated picture is not served from cache.
 *
 * @param string $relative Path inside assets/art/.
 */
function openmu_aurora_art_url( string $relative ): string {
	if ( ! openmu_aurora_art_exists( $relative ) ) {
		return '';
	}
	return add_query_arg( 'v', (string) filemtime( openmu_aurora_art_path( $relative ) ), get_theme_file_uri( 'assets/art/' . ltrim( $relative, '/' ) ) );
}

/**
 * Returns the intrinsic size of an art image as width/height attributes (empty when unknown),
 * so the browser can reserve space before the picture loads.
 *
 * @param string $relative Path inside assets/art/.
 */
function openmu_aurora_art_size_attrs( string $relative ): string {
	if ( ! openmu_aurora_art_exists( $relative ) ) {
		return '';
	}
	$size = wp_getimagesize( openmu_aurora_art_path( $relative ) );
	return is_array( $size ) ? sprintf( ' width="%d" height="%d"', (int) $size[0], (int) $size[1] ) : '';
}

/**
 * Prints an <img> for an art file, or nothing when the file does not exist.
 *
 * @param string $relative Path inside assets/art/.
 * @param string $class_name CSS class(es) of the image.
 * @param string $alt Alternative text; empty marks the picture as decorative.
 * @param string $loading "lazy" or "eager".
 * @return string Escaped markup (empty string when the file is missing).
 */
function openmu_aurora_art_img( string $relative, string $class_name = '', string $alt = '', string $loading = 'lazy' ): string {
	$url = openmu_aurora_art_url( $relative );
	if ( '' === $url ) {
		return '';
	}
	return sprintf(
		'<img class="%1$s" src="%2$s" alt="%3$s"%4$s loading="%5$s" decoding="async" />',
		esc_attr( $class_name ),
		esc_url( $url ),
		esc_attr( $alt ),
		openmu_aurora_art_size_attrs( $relative ), // Built from integers only.
		'eager' === $loading ? 'eager' : 'lazy'
	);
}

/**
 * Returns an icon placeholder span; the picture comes from the CSS mask rules that
 * openmu_aurora_icon_css() prints for the SVG files that exist, so it takes the text colour.
 *
 * @param string $name Icon file name without extension, e.g. "ranking".
 * @return string Escaped markup.
 */
function openmu_aurora_icon( string $name ): string {
	return '<span class="au-ico au-ico--' . esc_attr( sanitize_html_class( $name ) ) . '" aria-hidden="true"></span>';
}

/**
 * Builds the CSS that depends on which art files exist: every icons/*.svg becomes a mask on
 * its .au-ico--<name> class (a mask, not an <img>, lets one SVG take the colour of the text
 * around it) and the two ornaments become custom properties.
 */
function openmu_aurora_icon_css(): string {
	$css = '';
	// Ornaments: the thin divider (under page titles) and the corner flourish of framed pictures.
	foreach ( array(
		'ornaments/divider.svg'      => '--au-divider',
		'ornaments/frame-corner.svg' => '--au-corner',
	) as $file => $property ) {
		if ( openmu_aurora_art_exists( $file ) ) {
			$css .= sprintf( ':root{%1$s:url("%2$s")}', $property, esc_url( openmu_aurora_art_url( $file ) ) );
		}
	}
	// With the art present the CSS-drawn fallbacks (hairline, corner brackets) step aside.
	if ( openmu_aurora_art_exists( 'ornaments/divider.svg' ) ) {
		$css .= '.au-ornament::before{display:none}';
	}
	if ( openmu_aurora_art_exists( 'ornaments/frame-corner.svg' ) ) {
		$css .= '.au-corner{border:0!important;background:var(--au-corner) center/contain no-repeat}.au-corner--tr{transform:scaleX(-1)}.au-corner--bl{transform:scaleY(-1)}.au-corner--br{transform:scale(-1)}';
	}
	$files = glob( openmu_aurora_art_path( 'icons' ) . '/*.svg' );
	if ( ! $files ) {
		return $css;
	}
	foreach ( $files as $file ) {
		$name = basename( $file, '.svg' );
		$css .= sprintf( '.au-ico--%1$s{--au-mask:url("%2$s")}', sanitize_html_class( $name ), esc_url( openmu_aurora_art_url( 'icons/' . $name . '.svg' ) ) );
	}
	return $css;
}

/**
 * Returns the address of a page of the theme's fixed set (see inc/site-setup.php) by its slug.
 * Falls back to the plain path so patterns also work before the page exists.
 *
 * @param string $slug Page address, e.g. "download".
 */
function openmu_aurora_page_url( string $slug ): string {
	$page = get_page_by_path( $slug );
	return $page ? get_permalink( $page ) : home_url( '/' . $slug . '/' );
}

/**
 * Returns the title of a page of the theme's fixed set, or the given default when the page is missing.
 *
 * @param string $slug    Page address.
 * @param string $fallback Title to use when there is no such page.
 */
function openmu_aurora_page_title( string $slug, string $fallback ): string {
	$page = get_page_by_path( $slug );
	return $page && '' !== $page->post_title ? get_the_title( $page ) : $fallback;
}

/**
 * Returns the address of the optional community (Discord) invitation, empty by default.
 * A site sets it with add_filter( 'openmu_aurora_discord_url', ... ); nothing is shown while it is empty.
 */
function openmu_aurora_discord_url(): string {
	/**
	 * Filters the community invitation link shown in the footer.
	 *
	 * @param string $url Address; empty hides the link.
	 */
	return (string) apply_filters( 'openmu_aurora_discord_url', '' );
}

/**
 * Returns the block markup of the title band that opens every subpage: eyebrow, page title
 * (the post-title block, so it follows the page), lead text and a thin ornament.
 *
 * @param string $eyebrow Small label above the title.
 * @param string $lead    One or two sentences under the title.
 * @param string $title   Block markup of the title; the default follows the current page's title.
 * @return string Block markup (the text arguments are escaped here).
 */
function openmu_aurora_page_hero( string $eyebrow, string $lead, string $title = '<!-- wp:post-title {"level":1} /-->' ): string {
	return '<!-- wp:group {"tagName":"section","align":"full","className":"au-pagehero","layout":{"type":"constrained"}} -->' . "\n"
		. '<section class="wp-block-group alignfull au-pagehero">'
		. '<!-- wp:paragraph {"className":"au-eyebrow"} --><p class="au-eyebrow">' . esc_html( $eyebrow ) . '</p><!-- /wp:paragraph -->'
		. $title
		. ( '' !== $lead ? '<!-- wp:paragraph {"className":"au-pagehero__lead"} --><p class="au-pagehero__lead">' . esc_html( $lead ) . '</p><!-- /wp:paragraph -->' : '' )
		. '<!-- wp:html --><div class="au-ornament" aria-hidden="true"></div><!-- /wp:html -->'
		. '</section>' . "\n" . '<!-- /wp:group -->';
}
