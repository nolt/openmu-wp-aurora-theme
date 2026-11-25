<?php
/**
 * Title: Page with title band
 * Slug: openmu-aurora/page-generic
 * Categories: openmu-aurora-pages
 * Description: Title band and a readable column for the page's own content; used by every page without a dedicated template.
 * Keywords: page, content
 * Viewport Width: 1440
 * Inserter: no
 *
 * @package OpenMU_Aurora
 */

?>
<?php echo openmu_aurora_page_hero( get_bloginfo( 'name' ), '' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>

<!-- wp:group {"tagName":"section","align":"full","className":"au-pagebody","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-pagebody">
	<!-- wp:group {"className":"au-prose is-style-mu-window","layout":{"type":"constrained"}} -->
	<div class="wp-block-group au-prose is-style-mu-window">
		<!-- wp:post-content {"layout":{"type":"constrained"}} /-->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
