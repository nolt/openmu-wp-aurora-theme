<?php
/**
 * Sets the site up for the theme when it is activated, so it works out of the box.
 *
 * On activation (after_switch_theme):
 * 1. Templates and template parts of this theme that were changed in the site editor go
 *    back to the theme's files: a changed template wins over the theme's own, so earlier
 *    experiments would otherwise survive a new activation.
 * 2. The theme's pages are created (see openmu_aurora_site_pages()). A page that already
 *    has one of their addresses is kept as a draft copy under another address, so nothing
 *    is lost and a fresh page takes its place. Pages the theme created itself and nobody
 *    has written into since are reused, with the theme's title back.
 * 3. Settings > Reading shows the "home" page as the front page and "news" as the posts
 *    page. The previous setting is kept and restored when another theme is activated.
 *
 * The pages stay when the theme is switched off: they may have been edited by then.
 *
 * @package OpenMU_Aurora
 */

defined( 'ABSPATH' ) || exit;

/**
 * Post meta key that marks a page the theme created; its value is the page's address.
 */
const OPENMU_AURORA_PAGE_META = '_openmu_aurora_page';

/**
 * Option with the Reading settings from before the activation, restored on deactivation.
 */
const OPENMU_AURORA_READING_OPTION = 'openmu_aurora_previous_reading';

/**
 * Returns the theme's pages: address => title, in menu order.
 *
 * The addresses are fixed: the header menu (inc/nav.php) and the page templates
 * (templates/page-<address>.html) find the pages by them. Titles are in the site language.
 *
 * @return array<string, string>
 */
function openmu_aurora_site_pages(): array {
	return array(
		'home'       => __( 'Home', 'openmu-aurora' ),
		'news'       => __( 'News', 'openmu-aurora' ),
		'download'   => __( 'Download', 'openmu-aurora' ),
		'ranking'    => __( 'Ranking', 'openmu-aurora' ),
		'mini-games' => __( 'Mini games', 'openmu-aurora' ),
		'armory'     => __( 'Armory', 'openmu-aurora' ),
		'events'     => __( 'Events', 'openmu-aurora' ),
		'commands'   => __( 'Commands', 'openmu-aurora' ),
		'account'    => __( 'Account', 'openmu-aurora' ),
	);
}

/**
 * Runs the whole setup; hooked to after_switch_theme.
 */
function openmu_aurora_setup_site(): void {
	// Activation happens in wp-admin, where texts follow the admin's own language; the pages
	// are for visitors, so their titles use the site language.
	$switched = switch_to_locale( get_locale() );
	// The theme's own translations were loaded for the language of the request (English under
	// WP-CLI, the admin's language in wp-admin); load them again for the site language.
	unload_textdomain( 'openmu-aurora', true );
	load_theme_textdomain( 'openmu-aurora', get_theme_file_path( 'languages' ) );

	openmu_aurora_reset_templates();
	$page_ids = openmu_aurora_create_pages();
	openmu_aurora_set_reading( $page_ids );

	if ( $switched ) {
		restore_previous_locale();
	}
}
add_action( 'after_switch_theme', 'openmu_aurora_setup_site' );

/**
 * Deletes the site editor's changes to this theme's templates and template parts.
 *
 * Only entries that override a file of the theme are deleted; templates the admin created
 * as new ones stay.
 */
function openmu_aurora_reset_templates(): void {
	$changed = get_posts(
		array(
			'post_type'      => array( 'wp_template', 'wp_template_part' ),
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'no_found_rows'  => true,
			// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- runs once, on activation.
			'tax_query'      => array(
				array(
					'taxonomy' => 'wp_theme',
					'field'    => 'name',
					'terms'    => get_stylesheet(),
				),
			),
		)
	);

	foreach ( $changed as $post ) {
		$folder = 'wp_template' === $post->post_type ? 'templates' : 'parts';
		if ( file_exists( get_theme_file_path( $folder . '/' . $post->post_name . '.html' ) ) ) {
			wp_delete_post( $post->ID, true );
		}
	}
}

/**
 * Creates the theme's pages, setting earlier pages with the same addresses aside.
 *
 * @return array<string, int> Page id by address, for the pages that are in place.
 */
function openmu_aurora_create_pages(): array {
	$ids   = array();
	$order = 0;

	foreach ( openmu_aurora_site_pages() as $slug => $title ) {
		$existing = get_page_by_path( $slug );

		if ( $existing && openmu_aurora_is_untouched_page( $existing, $slug ) ) {
			// Same state as a fresh page: published, the theme's title (a renamed menu item
			// comes back too) and its place in the menu order.
			wp_update_post(
				wp_slash(
					array(
						'ID'          => $existing->ID,
						'post_status' => 'publish',
						'post_title'  => $title,
						'menu_order'  => $order,
					)
				)
			);
			$ids[ $slug ] = $existing->ID;
			++$order;
			continue;
		}

		if ( $existing ) {
			openmu_aurora_set_page_aside( $existing, $slug );
		}

		$id = wp_insert_post(
			wp_slash(
				array(
					'post_type'    => 'page',
					'post_status'  => 'publish',
					'post_name'    => $slug,
					'post_title'   => $title,
					'post_content' => '',
					'menu_order'   => $order,
					'meta_input'   => array( OPENMU_AURORA_PAGE_META => $slug ),
				)
			),
			true
		);
		++$order;

		if ( ! is_wp_error( $id ) ) {
			$ids[ $slug ] = $id;
		}
	}

	return $ids;
}

/**
 * Tells whether a page is one the theme created and nobody has written into since.
 *
 * The theme's pages start without text (their sections come from the page templates), so
 * any text means somebody worked on the page and it is set aside rather than reused.
 *
 * @param WP_Post $page Page found by the address.
 * @param string  $slug The address.
 * @return bool
 */
function openmu_aurora_is_untouched_page( WP_Post $page, string $slug ): bool {
	return get_post_meta( $page->ID, OPENMU_AURORA_PAGE_META, true ) === $slug
		&& '' === trim( $page->post_content );
}

/**
 * Keeps an earlier page as a draft copy, so its address is free for the theme's page.
 *
 * The copy gets the address "<address>-backup-<date>" and the date in its title. As a draft
 * it is neither in the menu nor on the site; the admin finds it under Pages > Drafts.
 *
 * @param WP_Post $page The earlier page.
 * @param string  $slug Its address.
 */
function openmu_aurora_set_page_aside( WP_Post $page, string $slug ): void {
	$backup_slug = wp_unique_post_slug( $slug . '-backup-' . wp_date( 'Ymd' ), $page->ID, 'draft', 'page', $page->post_parent );

	wp_update_post(
		wp_slash(
			array(
				'ID'          => $page->ID,
				'post_status' => 'draft',
				'post_name'   => $backup_slug,
				'post_title'  => sprintf(
					/* translators: 1: page title, 2: date. */
					__( '%1$s (backup %2$s)', 'openmu-aurora' ),
					'' !== $page->post_title ? $page->post_title : $slug,
					wp_date( get_option( 'date_format' ) )
				),
			)
		)
	);
	delete_post_meta( $page->ID, OPENMU_AURORA_PAGE_META );
}

/**
 * Shows the "home" page as the front page and "news" as the posts page.
 *
 * The settings from before are stored once (a second activation must not store the
 * theme's own), for openmu_aurora_restore_reading().
 *
 * @param array<string, int> $page_ids Page id by address.
 */
function openmu_aurora_set_reading( array $page_ids ): void {
	if ( empty( $page_ids['home'] ) || empty( $page_ids['news'] ) ) {
		return;
	}

	if ( false === get_option( OPENMU_AURORA_READING_OPTION ) ) {
		add_option(
			OPENMU_AURORA_READING_OPTION,
			array(
				'show_on_front'  => get_option( 'show_on_front' ),
				'page_on_front'  => (int) get_option( 'page_on_front' ),
				'page_for_posts' => (int) get_option( 'page_for_posts' ),
			),
			'',
			false
		);
	}

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $page_ids['home'] );
	update_option( 'page_for_posts', $page_ids['news'] );
}

/**
 * Restores the Reading settings from before the theme when another theme is activated.
 *
 * Runs while this theme is still loaded (switch_theme fires in the request that switches).
 * Settings the admin changed by hand in the meantime are left alone.
 */
function openmu_aurora_restore_reading(): void {
	$previous = get_option( OPENMU_AURORA_READING_OPTION );
	delete_option( OPENMU_AURORA_READING_OPTION );
	if ( ! is_array( $previous ) ) {
		return;
	}

	$home = get_page_by_path( 'home' );
	if ( ! $home || (int) get_option( 'page_on_front' ) !== $home->ID ) {
		return;
	}

	update_option( 'show_on_front', $previous['show_on_front'] );
	update_option( 'page_on_front', $previous['page_on_front'] );
	update_option( 'page_for_posts', $previous['page_for_posts'] );
}
add_action( 'switch_theme', 'openmu_aurora_restore_reading' );
