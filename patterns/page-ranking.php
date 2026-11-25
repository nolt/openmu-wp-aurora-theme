<?php
/**
 * Title: Ranking page
 * Slug: openmu-aurora/page-ranking
 * Categories: openmu-aurora-pages
 * Description: Page body of the ranking page: title band, top characters in a glass panel and the page's own content.
 * Keywords: ranking, page
 * Viewport Width: 1440
 * Inserter: no
 *
 * @package OpenMU_Aurora
 */

?>
<?php echo openmu_aurora_page_hero( __( 'Hall of heroes', 'openmu-aurora' ), __( 'The strongest characters on the server, ordered by resets and level. Select a name to open the armory.', 'openmu-aurora' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>

<!-- wp:group {"tagName":"section","align":"full","className":"au-pagebody","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-pagebody">
	<!-- wp:group {"align":"wide","className":"is-style-mu-window","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide is-style-mu-window">
		<!-- wp:openmu/ranking {"limit":50} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-content {"layout":{"type":"constrained"}} /-->
</section>
<!-- /wp:group -->
