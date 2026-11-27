<?php
/**
 * Title: Download page
 * Slug: openmu-aurora/page-download
 * Categories: openmu-aurora-pages
 * Description: Page body of the download page: title band, a painted banner, a card for each way to get the game and the minimum requirements. Set each button's link to your download address and delete the options you do not offer.
 * Keywords: download, client, launcher
 * Viewport Width: 1440
 * Inserter: no
 *
 * @package OpenMU_Aurora
 */

$openmu_aurora_banner = openmu_aurora_art_url( 'banners/download.webp' );

/** The ways to get the game: icon, name, short description, system, hint, button label. */
$openmu_aurora_options = array(
	array( 'download', __( 'Launcher', 'openmu-aurora' ), __( 'Installs the game and keeps it up to date.', 'openmu-aurora' ), __( 'Linux and Windows', 'openmu-aurora' ), __( 'Recommended for most players', 'openmu-aurora' ), __( 'Download the launcher', 'openmu-aurora' ) ),
	array( 'shield', __( 'Full client: Windows', 'openmu-aurora' ), __( 'The whole game in one archive.', 'openmu-aurora' ), __( '64-bit Windows', 'openmu-aurora' ), __( 'For players who update by hand', 'openmu-aurora' ), __( 'Download for Windows', 'openmu-aurora' ) ),
	array( 'crystal', __( 'Full client: Linux', 'openmu-aurora' ), __( 'The whole game in one archive.', 'openmu-aurora' ), __( '64-bit Linux', 'openmu-aurora' ), __( 'For players who update by hand', 'openmu-aurora' ), __( 'Download for Linux', 'openmu-aurora' ) ),
);
?>
<?php echo openmu_aurora_page_hero( __( 'Get the game', 'openmu-aurora' ), __( 'Pick one. All of them connect to the same server.', 'openmu-aurora' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>

<!-- wp:group {"tagName":"section","align":"full","className":"au-pagebody","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-pagebody">
	<!-- wp:group {"align":"wide","className":"au-banner au-reveal","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide au-banner au-reveal"<?php echo '' !== $openmu_aurora_banner ? ' style="' . esc_attr( '--au-banner-image:' . openmu_aurora_css_url( $openmu_aurora_banner ) ) . '"' : ''; ?>>
		<!-- wp:paragraph {"className":"au-eyebrow"} -->
		<p class="au-eyebrow"><?php esc_html_e( 'Ready in minutes', 'openmu-aurora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Download, log in, play', 'openmu-aurora' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'Install the game, sign in with your account and step into the world. No account yet? Create one first, it takes a minute.', 'openmu-aurora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-ghost"} -->
		<div class="wp-block-button is-style-ghost"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_aurora_page_url( 'account' ) ); ?>"><?php echo esc_html( openmu_aurora_player_logged_in() ? __( 'My account', 'openmu-aurora' ) : __( 'Create an account', 'openmu-aurora' ) ); ?></a></div>
		<!-- /wp:button --></div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"au-downloads","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide au-downloads">
		<?php foreach ( $openmu_aurora_options as $openmu_aurora_option ) : ?>
		<!-- wp:group {"className":"au-download-card is-style-mu-window au-reveal","layout":{"type":"default"}} -->
		<div class="wp-block-group au-download-card is-style-mu-window au-reveal">
			<!-- wp:html -->
			<span class="au-download-card__icon"><?php echo openmu_aurora_icon( $openmu_aurora_option[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?></span>
			<!-- /wp:html -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><?php echo esc_html( $openmu_aurora_option[1] ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?php echo esc_html( $openmu_aurora_option[2] ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"au-download-card__meta"} -->
			<p class="au-download-card__meta"><?php echo esc_html( sprintf( /* translators: %s: operating system. */ __( 'System: %s', 'openmu-aurora' ), $openmu_aurora_option[3] ) ); ?><br /><span><?php echo esc_html( $openmu_aurora_option[4] ); ?></span></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons"><!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html( $openmu_aurora_option[5] ); ?></a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"is-style-mu-window","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide is-style-mu-window">
		<!-- wp:heading {"level":3} -->
		<h3 class="wp-block-heading"><?php esc_html_e( 'Minimum requirements', 'openmu-aurora' ); ?></h3>
		<!-- /wp:heading -->

		<!-- wp:table -->
		<figure class="wp-block-table"><table class="has-fixed-layout"><tbody>
			<tr><td><?php esc_html_e( 'System', 'openmu-aurora' ); ?></td><td><?php esc_html_e( '64-bit Windows 10 or later, or 64-bit Linux', 'openmu-aurora' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Processor', 'openmu-aurora' ); ?></td><td><?php esc_html_e( 'Dual core, 2 GHz', 'openmu-aurora' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Memory', 'openmu-aurora' ); ?></td><td><?php esc_html_e( '4 GB RAM', 'openmu-aurora' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Graphics', 'openmu-aurora' ); ?></td><td><?php esc_html_e( 'Any graphics card with OpenGL support', 'openmu-aurora' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Disk space', 'openmu-aurora' ); ?></td><td><?php esc_html_e( '2 GB free', 'openmu-aurora' ); ?></td></tr>
		</tbody></table></figure>
		<!-- /wp:table -->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-content {"layout":{"type":"constrained"}} /-->
</section>
<!-- /wp:group -->
