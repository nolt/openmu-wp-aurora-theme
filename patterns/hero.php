<?php
/**
 * Title: Aurora hero
 * Slug: openmu-aurora/hero
 * Categories: openmu-aurora
 * Description: Full-screen opening of the front page over the painted, animated scene: headline, buttons and the live server status.
 * Keywords: hero, banner, start
 * Viewport Width: 1440
 *
 * @package OpenMU_Aurora
 */

?>
<!-- wp:group {"tagName":"section","align":"full","className":"au-hero","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-hero">
	<!-- wp:group {"className":"au-hero__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group au-hero__inner">
		<!-- wp:paragraph {"className":"au-eyebrow au-hero__eyebrow"} -->
		<p class="au-eyebrow au-hero__eyebrow"><?php esc_html_e( 'Season 6 · MU Online server', 'openmu-aurora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":1,"className":"au-hero__title"} -->
		<h1 class="wp-block-heading au-hero__title"><?php esc_html_e( 'Forge your legend beneath the', 'openmu-aurora' ); ?> <span class="au-gradient-text"><?php esc_html_e( 'northern lights', 'openmu-aurora' ); ?></span></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"au-hero__lead"} -->
		<p class="au-hero__lead"><?php esc_html_e( 'Choose a class, join the events and climb the ranking. Knights, wizards and elves of the ancient continent are waiting for you.', 'openmu-aurora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"className":"au-hero__buttons","layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons au-hero__buttons"><!-- wp:button {"className":"au-hero__cta"} -->
		<div class="wp-block-button au-hero__cta"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_aurora_page_url( 'download' ) ); ?>"><?php esc_html_e( 'Play now', 'openmu-aurora' ); ?></a></div>
		<!-- /wp:button -->

		<!-- wp:button {"className":"is-style-ghost"} -->
		<div class="wp-block-button is-style-ghost"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_aurora_page_url( 'account' ) ); ?>"><?php esc_html_e( 'Create an account', 'openmu-aurora' ); ?></a></div>
		<!-- /wp:button --></div>
		<!-- /wp:buttons -->

		<!-- wp:group {"className":"au-hero__status","layout":{"type":"default"}} -->
		<div class="wp-block-group au-hero__status">
			<!-- wp:openmu/server-status /-->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:html -->
	<a class="au-hero__cue" href="#classes"><span class="au-sr"><?php esc_html_e( 'Scroll to the classes', 'openmu-aurora' ); ?></span><span class="au-hero__cue-line" aria-hidden="true"></span></a>
	<!-- /wp:html -->
</section>
<!-- /wp:group -->
