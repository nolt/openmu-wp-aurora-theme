<?php
/**
 * Title: Single post
 * Slug: openmu-aurora/post-single
 * Categories: openmu-aurora-pages
 * Description: A news article: title band with date and category, the painted featured image, the text and previous/next links.
 * Inserter: no
 *
 * @package OpenMU_Aurora
 */

?>
<!-- wp:group {"tagName":"section","align":"full","className":"au-pagehero au-pagehero--post","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-pagehero au-pagehero--post">
	<!-- wp:group {"className":"au-postmeta","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
	<div class="wp-block-group au-postmeta">
		<!-- wp:post-terms {"term":"category","className":"au-eyebrow"} /-->
		<!-- wp:post-date {"className":"au-postmeta__date"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-title {"level":1} /-->

	<!-- wp:html -->
	<div class="au-ornament" aria-hidden="true"></div>
	<!-- /wp:html -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","className":"au-pagebody","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-pagebody">
	<!-- wp:post-featured-image {"align":"wide","className":"au-post__media"} /-->

	<!-- wp:group {"className":"au-prose is-style-mu-window","layout":{"type":"constrained"}} -->
	<div class="wp-block-group au-prose is-style-mu-window">
		<!-- wp:post-content {"layout":{"type":"constrained"}} /-->

		<!-- wp:post-terms {"term":"post_tag","prefix":"<?php echo esc_attr__( 'Tags: ', 'openmu-aurora' ); ?>","className":"au-post__tags"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"au-postnav","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide au-postnav">
		<!-- wp:post-navigation-link {"type":"previous","label":"<?php echo esc_attr__( 'Previous', 'openmu-aurora' ); ?>","showTitle":true,"linkLabel":false} /-->

		<!-- wp:buttons -->
		<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-ghost"} -->
		<div class="wp-block-button is-style-ghost"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_aurora_page_url( 'news' ) ); ?>"><?php esc_html_e( 'All news', 'openmu-aurora' ); ?></a></div>
		<!-- /wp:button --></div>
		<!-- /wp:buttons -->

		<!-- wp:post-navigation-link {"type":"next","label":"<?php echo esc_attr__( 'Next', 'openmu-aurora' ); ?>","showTitle":true,"linkLabel":false} /-->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
