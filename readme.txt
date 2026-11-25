=== OpenMU Aurora ===
Contributors: nolt
Requires at least: 6.6
Tested up to: 7.1
Requires PHP: 8.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: block-patterns, full-site-editing, dark, custom-colors, translation-ready

A modern block theme for OpenMU (MU Online server emulator) websites: painted night-sky scenery, animated northern lights and frosted-glass panels.

== Description ==

OpenMU Aurora is a standalone block theme for sites of OpenMU game servers. It has a full-screen animated home page (parallax painted scenery, aurora ribbons, snow), a fixed menu with a Server submenu and a Play now button, templates for news, ranking, mini games, armory, events, commands, download, account, search and 404, and styles for every OpenMU WP Connect block. On activation it creates the pages and sets the front page and posts page. Polish translation included.

== Installation ==

1. Upload the theme folder to wp-content/themes/ or install the zip in Appearance > Themes.
2. Activate it. Pages, front page and posts page are set up automatically.
3. Install and activate the OpenMU WP Connect plugin for the server blocks.
4. Set the download links on the Download page.

== Frequently Asked Questions ==

= How do I show a Discord link in the footer? =
Add a filter: add_filter( 'openmu_aurora_discord_url', fn() => 'https://example.com/invite' );

= Does it make external requests? =
No. Fonts, artwork and scripts are bundled.

== Copyright ==

OpenMU Aurora, Copyright 2026 Nolt, GPL-2.0-or-later.
Fonts Marcellus SC and Manrope: SIL Open Font License 1.1 (assets/fonts).
Painted artwork: generated for this theme, see assets/art/README.md.
The theme ships no files of the MU Online game client. The armory shows class pictures and item
data only when you add them yourself, in the OpenMU WP Connect client folder (see the plugin's README).

== Changelog ==

= 1.0.0 =
* Initial release.
