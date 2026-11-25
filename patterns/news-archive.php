<?php
/**
 * Title: News archive
 * Slug: openmu-aurora/news-archive
 * Categories: openmu-aurora-pages
 * Description: Title band and a grid of all posts with pagination; used by the posts page, categories, tags and dates.
 * Inserter: no
 *
 * @package OpenMU_Aurora
 */

?>
<?php echo openmu_aurora_page_hero( __( 'News', 'openmu-aurora' ), __( 'Updates, events and announcements from the realm.', 'openmu-aurora' ), is_home() ? '<!-- wp:heading {"level":1} --><h1 class="wp-block-heading">' . esc_html( get_the_title( (int) get_option( 'page_for_posts' ) ) ) . '</h1><!-- /wp:heading -->' : '<!-- wp:query-title {"type":"archive","level":1} /-->' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>

<!-- wp:group {"tagName":"section","align":"full","className":"au-pagebody","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-pagebody">
	<!-- wp:query {"queryId":21,"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide","className":"au-news au-news--archive"} -->
	<div class="wp-block-query alignwide au-news au-news--archive">
		<!-- wp:post-template {"className":"au-news__grid","layout":{"type":"default"}} -->
				<!-- wp:group {"className":"au-card au-reveal","layout":{"type":"default"}} -->
				<div class="wp-block-group au-card au-reveal">
					<!-- wp:post-featured-image {"isLink":true,"className":"au-card__media"} /-->

					<!-- wp:group {"className":"au-card__body","layout":{"type":"default"}} -->
					<div class="wp-block-group au-card__body">
						<!-- wp:post-date {"className":"au-card__date"} /-->

						<!-- wp:post-title {"level":2,"isLink":true,"className":"au-card__title"} /-->

						<!-- wp:post-excerpt {"moreText":"","excerptLength":26,"className":"au-card__excerpt"} /-->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"center"}} -->
			<!-- wp:query-pagination-previous /-->

			<!-- wp:query-pagination-numbers /-->

			<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center"><?php echo esc_html( __( 'There are no posts here yet.', 'openmu-aurora' ) ); ?></p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->
