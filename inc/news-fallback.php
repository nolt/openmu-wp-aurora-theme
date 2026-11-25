<?php
/**
 * Painted fallback pictures for news posts without a featured image.
 *
 * The news grids render core/post-featured-image; a post with no picture would show an empty
 * gap. This filter fills it with one of four painted pictures (assets/art/news/fallback-1..4.webp),
 * chosen by the post ID so a post always gets the same one and neighbouring posts differ.
 * While the art files do not exist yet, a CSS gradient tile (.au-fallback--N) is used.
 *
 * @package OpenMU_Aurora
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the number (1-4) of the fallback picture for a post.
 *
 * @param int $post_id Post ID.
 */
function openmu_aurora_fallback_number( int $post_id ): int {
	return ( $post_id % 4 ) + 1;
}

/**
 * Builds the markup that replaces an empty featured image block.
 *
 * @param int  $post_id Post ID.
 * @param bool   $link        Whether the picture links to the post (the block's isLink setting).
 * @param string $extra_class The block's own CSS class(es) (its className setting), kept on the figure.
 * @return string Escaped markup.
 */
function openmu_aurora_fallback_figure( int $post_id, bool $link, string $extra_class = '' ): string {
	$number = openmu_aurora_fallback_number( $post_id );
	$file   = 'news/fallback-' . $number . '.webp';
	$img    = openmu_aurora_art_img( $file, 'au-fallback__img', '', 'lazy' );
	$inner  = '' !== $img ? $img : '<span class="au-fallback__tile" aria-hidden="true"></span>';

	if ( $link ) {
		$inner = sprintf(
			'<a href="%1$s" aria-label="%2$s" tabindex="-1">%3$s</a>',
			esc_url( get_permalink( $post_id ) ),
			esc_attr( get_the_title( $post_id ) ),
			$inner
		);
	}

	return '<figure class="wp-block-post-featured-image au-fallback au-fallback--' . (int) $number . ( '' !== $extra_class ? ' ' . esc_attr( $extra_class ) : '' ) . '">' . $inner . '</figure>';
}

/**
 * Replaces the empty output of a featured image block with the painted fallback.
 * Hooked to render_block_core/post-featured-image.
 *
 * @param string   $content Rendered block (empty when the post has no picture).
 * @param array    $block   Parsed block.
 * @param WP_Block $instance Block instance (carries the post in its context).
 * @return string
 */
function openmu_aurora_featured_image_fallback( string $content, array $block, WP_Block $instance ): string {
	if ( '' !== trim( $content ) ) {
		return $content;
	}
	$post_id = (int) ( $instance->context['postId'] ?? 0 );
	if ( ! $post_id ) {
		return $content;
	}
	return openmu_aurora_fallback_figure( $post_id, ! empty( $block['attrs']['isLink'] ), (string) ( $block['attrs']['className'] ?? '' ) );
}
add_filter( 'render_block_core/post-featured-image', 'openmu_aurora_featured_image_fallback', 10, 3 );
