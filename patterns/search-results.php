<?php
/**
 * Title: Search results
 * Slug: openmu-aurora/search-results
 * Categories: openmu-aurora-pages
 * Description: Title band, a search field and the matching posts as cards.
 * Inserter: no
 *
 * @package OpenMU_Aurora
 */

?>
<?php echo openmu_aurora_page_hero( __( 'Search', 'openmu-aurora' ), '', '<!-- wp:query-title {"type":"search","level":1} /-->' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>
<!-- wp:group {"align":"full","className":"au-searchbar","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull au-searchbar">
	<!-- wp:search {"label":"<?php echo esc_attr__( 'Search', 'openmu-aurora' ); ?>","showLabel":false,"placeholder":"<?php echo esc_attr__( 'Search the news…', 'openmu-aurora' ); ?>","buttonText":"<?php echo esc_attr__( 'Search', 'openmu-aurora' ); ?>"} /-->
</div>
<!-- /wp:group -->

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
			<p class="has-text-align-center"><?php echo esc_html( __( 'Nothing found. Try another word.', 'openmu-aurora' ) ); ?></p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->
