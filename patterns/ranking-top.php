<?php
/**
 * Title: Top 5 ranking
 * Slug: openmu-aurora/ranking-top
 * Categories: openmu-aurora
 * Description: The five best characters in a glass panel, with a link to the full ranking.
 * Keywords: ranking, top, heroes, leaderboard
 * Viewport Width: 1440
 *
 * @package OpenMU_Aurora
 */

?>
<!-- wp:group {"tagName":"section","align":"full","className":"au-section au-ranking-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-section au-ranking-section">
	<!-- wp:group {"className":"au-section-head au-reveal","layout":{"type":"default"}} -->
	<div class="wp-block-group au-section-head au-reveal">
		<!-- wp:paragraph {"className":"au-eyebrow"} -->
		<p class="au-eyebrow"><?php esc_html_e( 'Hall of heroes', 'openmu-aurora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Top 5 characters', 'openmu-aurora' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'The strongest heroes on the server by resets and level. Select a name to see its equipment.', 'openmu-aurora' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"is-style-mu-window au-ranking-panel au-reveal","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide is-style-mu-window au-ranking-panel au-reveal">
		<!-- wp:openmu/ranking {"limit":5} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-ghost"} -->
	<div class="wp-block-button is-style-ghost"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_aurora_page_url( 'ranking' ) ); ?>"><?php esc_html_e( 'Full ranking', 'openmu-aurora' ); ?></a></div>
	<!-- /wp:button --></div>
	<!-- /wp:buttons -->
</section>
<!-- /wp:group -->
