<?php
/**
 * Title: Aurora footer
 * Slug: openmu-aurora/footer
 * Description: Rich footer: brand and server status, two link columns (explore, server) and a legal line. Used by the footer template part.
 * Inserter: no
 *
 * @package OpenMU_Aurora
 */

$openmu_aurora_emblem  = openmu_aurora_art_img( 'logo/emblem.svg', 'au-brand__emblem', '', 'lazy' );
$openmu_aurora_discord = openmu_aurora_discord_url();

/**
 * Link columns of the footer: heading => list of slug => default label.
 * The labels follow the page titles, like the header menu.
 */
$openmu_aurora_columns = array(
	__( 'Explore', 'openmu-aurora' ) => array(
		'home'     => __( 'Home', 'openmu-aurora' ),
		'news'     => __( 'News', 'openmu-aurora' ),
		'download' => __( 'Download', 'openmu-aurora' ),
		'account'  => __( 'Account', 'openmu-aurora' ),
	),
	__( 'Server', 'openmu-aurora' )  => array(
		'ranking'    => __( 'Ranking', 'openmu-aurora' ),
		'mini-games' => __( 'Mini games', 'openmu-aurora' ),
		'armory'     => __( 'Armory', 'openmu-aurora' ),
		'events'     => __( 'Events', 'openmu-aurora' ),
		'commands'   => __( 'Commands', 'openmu-aurora' ),
	),
);
?>
<!-- wp:group {"align":"full","className":"au-footer","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull au-footer">
	<!-- wp:html -->
	<div class="au-footer__glow" aria-hidden="true"></div>
	<!-- /wp:html -->

	<!-- wp:group {"align":"wide","className":"au-footer__top","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide au-footer__top">
		<!-- wp:group {"className":"au-footer__brand","layout":{"type":"default"}} -->
		<div class="wp-block-group au-footer__brand">
			<!-- wp:html -->
			<p class="au-footer__logo"><?php echo '' !== $openmu_aurora_emblem ? $openmu_aurora_emblem : '<span class="au-brand__mark"></span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?><span class="au-footer__name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span></p>
			<!-- /wp:html -->

			<!-- wp:paragraph {"className":"au-footer__tagline"} -->
			<p class="au-footer__tagline"><?php esc_html_e( 'A Season 6 MU Online server. Create a hero, join the events and climb the ranking.', 'openmu-aurora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:openmu/server-status /-->

			<?php if ( '' !== $openmu_aurora_discord ) : ?>
			<!-- wp:buttons -->
			<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-ghost"} -->
			<div class="wp-block-button is-style-ghost"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $openmu_aurora_discord ); ?>">Discord</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->
			<?php endif; ?>
		</div>
		<!-- /wp:group -->

		<?php foreach ( $openmu_aurora_columns as $openmu_aurora_heading => $openmu_aurora_links ) : ?>
		<!-- wp:group {"className":"au-footer__col","layout":{"type":"default"}} -->
		<div class="wp-block-group au-footer__col">
			<!-- wp:heading {"level":3,"className":"au-footer__heading"} -->
			<h3 class="wp-block-heading au-footer__heading"><?php echo esc_html( $openmu_aurora_heading ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:html -->
			<ul class="au-footer__links">
				<?php foreach ( $openmu_aurora_links as $openmu_aurora_slug => $openmu_aurora_label ) : ?>
					<li><a href="<?php echo esc_url( openmu_aurora_page_url( $openmu_aurora_slug ) ); ?>"><?php echo esc_html( openmu_aurora_page_title( $openmu_aurora_slug, $openmu_aurora_label ) ); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<!-- /wp:html -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"au-footer__bottom","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide au-footer__bottom">
		<!-- wp:paragraph {"className":"au-footer__legal"} -->
		<p class="au-footer__legal">
			<?php
			/* translators: 1: year, 2: site name. */
			echo esc_html( sprintf( __( '© %1$s %2$s. Fan-run server; MU Online and related names belong to their respective owners.', 'openmu-aurora' ), gmdate( 'Y' ), get_bloginfo( 'name' ) ) );
			?>
		</p>
		<!-- /wp:paragraph -->

		<!-- wp:html -->
		<p class="au-footer__credit"><span><?php esc_html_e( 'Theme: OpenMU Aurora', 'openmu-aurora' ); ?></span> <a class="au-footer__top-link" href="#"><?php esc_html_e( 'Back to top', 'openmu-aurora' ); ?> <span aria-hidden="true">↑</span></a></p>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
