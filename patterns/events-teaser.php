<?php
/**
 * Title: Events teaser
 * Slug: openmu-aurora/events-teaser
 * Categories: openmu-aurora
 * Description: Short text next to the next few game events from the server schedule, with a link to the full list.
 * Keywords: events, schedule, blood castle, devil square
 * Viewport Width: 1440
 *
 * @package OpenMU_Aurora
 */

?>
<!-- wp:group {"tagName":"section","align":"full","className":"au-section au-events-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-section au-events-section">
	<!-- wp:columns {"align":"wide","verticalAlignment":"center","className":"au-split","style":{"spacing":{"blockGap":{"top":"2.5rem","left":"clamp(2rem, 5vw, 4.5rem)"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center au-split">
		<!-- wp:column {"verticalAlignment":"center","width":"38%","className":"au-reveal"} -->
		<div class="wp-block-column is-vertically-aligned-center au-reveal" style="flex-basis:38%">
			<!-- wp:paragraph {"className":"au-eyebrow"} -->
			<p class="au-eyebrow"><?php esc_html_e( 'On the clock', 'openmu-aurora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'Never miss an event', 'openmu-aurora' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?php esc_html_e( 'Blood Castle, Devil Square, Chaos Castle and the invasions start on a fixed schedule. Here are the next ones, in the site\'s time zone.', 'openmu-aurora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-ghost"} -->
			<div class="wp-block-button is-style-ghost"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_aurora_page_url( 'events' ) ); ?>"><?php esc_html_e( 'Full schedule', 'openmu-aurora' ); ?></a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"62%","className":"au-reveal"} -->
		<div class="wp-block-column is-vertically-aligned-center au-reveal" style="flex-basis:62%">
			<!-- wp:openmu/events {"limit":5} /-->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->
