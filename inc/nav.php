<?php
/**
 * The header menu: a dynamic block (blocks/site-nav) whose items are the theme's fixed set
 * of pages (see openmu_aurora_site_pages() in site-setup.php).
 *
 * Why a PHP block and not core/navigation: the menu must be exactly this set, in this order,
 * with the labels taken from the page titles (so a translated or renamed page is followed),
 * a "Server" submenu that opens on hover, keyboard and touch, and a full-screen mobile
 * overlay. Core's navigation block would also let the plugin's "Sign in" label swap rewrite
 * the Account item; this menu keeps the page title.
 *
 * @package OpenMU_Aurora
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers the site-nav block from its block.json. Hooked to init.
 */
function openmu_aurora_register_blocks(): void {
	register_block_type( get_theme_file_path( 'blocks/site-nav' ) );
}
add_action( 'init', 'openmu_aurora_register_blocks' );

/**
 * Tells whether the current request belongs to a menu page (the page itself, or for News
 * also the posts, categories and the other archives).
 *
 * @param string $slug Page address.
 */
function openmu_aurora_nav_is_current( string $slug ): bool {
	switch ( $slug ) {
		case 'home':
			return is_front_page();
		case 'news':
			return is_home() || is_singular( 'post' ) || is_category() || is_tag() || is_date() || is_author() || is_search();
		default:
			return is_page( $slug );
	}
}

/**
 * Returns the menu as a tree: each entry has slug, label, icon, current and (for Server) children.
 *
 * @return array<int, array<string, mixed>>
 */
function openmu_aurora_nav_items(): array {
	$leaf = static function ( string $slug, string $fallback, string $icon ): array {
		return array(
			'slug'    => $slug,
			'label'   => openmu_aurora_page_title( $slug, $fallback ),
			'url'     => openmu_aurora_page_url( $slug ),
			'icon'    => $icon,
			'current' => openmu_aurora_nav_is_current( $slug ),
		);
	};

	$children = array(
		$leaf( 'ranking', __( 'Ranking', 'openmu-aurora' ), 'ranking' ),
		$leaf( 'mini-games', __( 'Mini games', 'openmu-aurora' ), 'minigames' ),
		$leaf( 'armory', __( 'Armory', 'openmu-aurora' ), 'armory' ),
		$leaf( 'events', __( 'Events', 'openmu-aurora' ), 'events' ),
		$leaf( 'commands', __( 'Commands', 'openmu-aurora' ), 'commands' ),
	);

	return array(
		$leaf( 'home', __( 'Home', 'openmu-aurora' ), '' ),
		$leaf( 'news', __( 'News', 'openmu-aurora' ), '' ),
		$leaf( 'download', __( 'Download', 'openmu-aurora' ), '' ),
		array(
			'slug'     => 'server',
			'label'    => __( 'Server', 'openmu-aurora' ),
			'icon'     => 'server',
			'current'  => in_array( true, wp_list_pluck( $children, 'current' ), true ),
			'children' => $children,
		),
		$leaf( 'account', __( 'Account', 'openmu-aurora' ), '' ),
	);
}
