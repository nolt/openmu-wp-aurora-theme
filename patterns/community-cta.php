<?php
/**
 * Title: Community call to action
 * Slug: openmu-aurora/community-cta
 * Categories: openmu-aurora, call-to-action
 * Description: A wide painted banner inviting visitors to join the community, with two buttons.
 * Keywords: community, cta, join, banner
 * Viewport Width: 1440
 *
 * @package OpenMU_Aurora
 */

$openmu_aurora_banner = openmu_aurora_art_url( 'banners/community.webp' );
?>
<!-- wp:group {"tagName":"section","align":"full","className":"au-section au-cta-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-section au-cta-section">
	<!-- wp:group {"align":"wide","className":"au-cta au-reveal","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide au-cta au-reveal"<?php echo '' !== $openmu_aurora_banner ? ' style="--au-cta-image:url(' . esc_url( $openmu_aurora_banner ) . ')"' : ''; ?>>
		<!-- wp:paragraph {"className":"au-eyebrow"} -->
		<p class="au-eyebrow"><?php esc_html_e( 'Join us', 'openmu-aurora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Your party is waiting', 'openmu-aurora' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'Make an account, find a group and see how far the northern lights will carry you. New players are always welcome.', 'openmu-aurora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons"><!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_aurora_page_url( 'account' ) ); ?>"><?php esc_html_e( 'Create an account', 'openmu-aurora' ); ?></a></div>
		<!-- /wp:button -->

		<!-- wp:button {"className":"is-style-ghost"} -->
		<div class="wp-block-button is-style-ghost"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_aurora_page_url( 'news' ) ); ?>"><?php esc_html_e( 'Read the news', 'openmu-aurora' ); ?></a></div>
		<!-- /wp:button --></div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
