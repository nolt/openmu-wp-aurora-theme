<?php
/**
 * Title: Page not found
 * Slug: openmu-aurora/not-found
 * Categories: openmu-aurora-pages
 * Description: The 404 page: a large 404, a short message, search and two ways back.
 * Inserter: no
 *
 * @package OpenMU_Aurora
 */

?>
<!-- wp:group {"tagName":"section","align":"full","className":"au-pagehero au-notfound","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-pagehero au-notfound">
	<!-- wp:paragraph {"className":"au-notfound__code"} -->
	<p class="au-notfound__code" aria-hidden="true">404</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":1} -->
	<h1 class="wp-block-heading"><?php esc_html_e( 'This path is lost in the snow', 'openmu-aurora' ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"au-pagehero__lead"} -->
	<p class="au-pagehero__lead"><?php esc_html_e( 'The page you are looking for does not exist or has moved. Try a search, or head back to a safe town.', 'openmu-aurora' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:search {"label":"<?php echo esc_attr__( 'Search', 'openmu-aurora' ); ?>","showLabel":false,"placeholder":"<?php echo esc_attr__( 'Search the news…', 'openmu-aurora' ); ?>","buttonText":"<?php echo esc_attr__( 'Search', 'openmu-aurora' ); ?>"} /-->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons"><!-- wp:button -->
	<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the home page', 'openmu-aurora' ); ?></a></div>
	<!-- /wp:button -->

	<!-- wp:button {"className":"is-style-ghost"} -->
	<div class="wp-block-button is-style-ghost"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_aurora_page_url( 'news' ) ); ?>"><?php esc_html_e( 'Read the news', 'openmu-aurora' ); ?></a></div>
	<!-- /wp:button --></div>
	<!-- /wp:buttons -->
</section>
<!-- /wp:group -->
