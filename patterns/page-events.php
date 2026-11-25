<?php
/**
 * Title: Events page
 * Slug: openmu-aurora/page-events
 * Categories: openmu-aurora-pages
 * Description: Page body of the events page: title band and the event schedule of every game server.
 * Keywords: events, page
 * Viewport Width: 1440
 * Inserter: no
 *
 * @package OpenMU_Aurora
 */

?>
<?php echo openmu_aurora_page_hero( __( 'Server', 'openmu-aurora' ), __( 'When the next Blood Castle, Devil Square, Chaos Castle and invasions start, in the site\'s time zone.', 'openmu-aurora' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>

<!-- wp:group {"tagName":"section","align":"full","className":"au-pagebody","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-pagebody">
	<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:openmu/events {"limit":12} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-content {"layout":{"type":"constrained"}} /-->
</section>
<!-- /wp:group -->
