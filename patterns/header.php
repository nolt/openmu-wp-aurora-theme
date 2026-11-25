<?php
/**
 * Title: Aurora header
 * Slug: openmu-aurora/header
 * Description: Brand (emblem and site title), the fixed main menu with the Server submenu and the Play now button. Used by the header template part.
 * Inserter: no
 *
 * @package OpenMU_Aurora
 */

$openmu_aurora_emblem = openmu_aurora_art_img( 'logo/emblem.svg', 'au-brand__emblem', '', 'eager' );
?>
<!-- wp:group {"className":"au-header__bar","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group au-header__bar">
	<!-- wp:group {"className":"au-brand","layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group au-brand">
		<!-- wp:html -->
		<a class="au-brand__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" tabindex="-1" aria-hidden="true"><?php echo '' !== $openmu_aurora_emblem ? $openmu_aurora_emblem : '<span class="au-brand__mark"></span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?></a>
		<!-- /wp:html -->

		<!-- wp:site-title {"level":0} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:openmu-aurora/site-nav /-->
</div>
<!-- /wp:group -->
