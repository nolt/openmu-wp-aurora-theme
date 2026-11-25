<?php
/**
 * Title: Mini games page
 * Slug: openmu-aurora/page-mini-games
 * Categories: openmu-aurora-pages
 * Description: Page body of the mini games page: title band and the mini game leaderboards.
 * Keywords: mini-games, page
 * Viewport Width: 1440
 * Inserter: no
 *
 * @package OpenMU_Aurora
 */

?>
<?php echo openmu_aurora_page_hero( __( 'Server', 'openmu-aurora' ), __( 'Blood Castle, Devil Square, Chaos Castle and more: the best results of the last days.', 'openmu-aurora' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>

<!-- wp:group {"tagName":"section","align":"full","className":"au-pagebody","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-pagebody">
	<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:openmu/minigame-ranking /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-content {"layout":{"type":"constrained"}} /-->
</section>
<!-- /wp:group -->
