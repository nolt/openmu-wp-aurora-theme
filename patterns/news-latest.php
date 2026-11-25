<?php
/**
 * Title: Latest news
 * Slug: openmu-aurora/news-latest
 * Categories: openmu-aurora, posts
 * Description: The three newest posts as painted cards; posts without a featured image get one of the theme's fallback pictures.
 * Keywords: news, posts, latest, blog
 * Viewport Width: 1440
 *
 * @package OpenMU_Aurora
 */

?>
<!-- wp:group {"tagName":"section","align":"full","className":"au-section au-news-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-section au-news-section">
	<!-- wp:group {"className":"au-section-head au-reveal","layout":{"type":"default"}} -->
	<div class="wp-block-group au-section-head au-reveal">
		<!-- wp:paragraph {"className":"au-eyebrow"} -->
		<p class="au-eyebrow"><?php esc_html_e( 'From the realm', 'openmu-aurora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Latest news', 'openmu-aurora' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":11,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","className":"au-news"} -->
	<div class="wp-block-query alignwide au-news">
		<!-- wp:post-template {"className":"au-news__grid","layout":{"type":"default"}} -->
			<!-- wp:group {"className":"au-card au-reveal","layout":{"type":"default"}} -->
			<div class="wp-block-group au-card au-reveal">
				<!-- wp:post-featured-image {"isLink":true,"className":"au-card__media"} /-->

				<!-- wp:group {"className":"au-card__body","layout":{"type":"default"}} -->
				<div class="wp-block-group au-card__body">
					<!-- wp:post-date {"className":"au-card__date"} /-->

					<!-- wp:post-title {"level":3,"isLink":true,"className":"au-card__title"} /-->

					<!-- wp:post-excerpt {"moreText":"","excerptLength":24,"className":"au-card__excerpt"} /-->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-ghost"} -->
	<div class="wp-block-button is-style-ghost"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_aurora_page_url( 'news' ) ); ?>"><?php esc_html_e( 'All news', 'openmu-aurora' ); ?></a></div>
	<!-- /wp:button --></div>
	<!-- /wp:buttons -->
</section>
<!-- /wp:group -->
