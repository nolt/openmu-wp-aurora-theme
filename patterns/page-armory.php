<?php
/**
 * Title: Armory page
 * Slug: openmu-aurora/page-armory
 * Categories: openmu-aurora-pages
 * Description: Page body of the armory page: title band, character search and the equipment view.
 * Keywords: armory, page
 * Viewport Width: 1440
 * Inserter: no
 *
 * @package OpenMU_Aurora
 */

?>
<?php echo openmu_aurora_page_hero( __( 'Server', 'openmu-aurora' ), __( 'Look up any character: class, level and every piece of equipment, with the in-game item details.', 'openmu-aurora' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>

<!-- wp:group {"tagName":"section","align":"full","className":"au-pagebody","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-pagebody">
	<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:openmu/armory /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-content {"layout":{"type":"constrained"}} /-->
</section>
<!-- /wp:group -->
