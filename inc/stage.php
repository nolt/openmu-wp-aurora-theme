<?php
/**
 * The "stage": the painted, animated background behind the whole site.
 *
 * One fixed element holds the sky, the parallax scenery layers, two canvases (northern
 * lights and snow/sparkles) and a veil that darkens it for readable text. assets/js/aurora.js
 * animates it; assets/css/stage.css lays it out. On the front page it is the full hero
 * scene, on other pages it is dimmed ("calm"). With prefers-reduced-motion the layers and
 * canvases are replaced by one flat poster picture.
 *
 * @package OpenMU_Aurora
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the scenery layers back to front: art file => parallax depth (how far the
 * layer sinks while the page scrolls; nearer layers move more).
 *
 * @return array<string, float>
 */
function openmu_aurora_stage_layers(): array {
	return array(
		'peaks-far'   => 0.10,
		'citadel'     => 0.18,
		'cliffs-near' => 0.32,
		'mist'        => 0.45,
	);
}

/**
 * Prints the stage right after the opening <body> tag.
 * Hooked to wp_body_open.
 */
function openmu_aurora_stage(): void {
	$sky = openmu_aurora_art_url( 'scene/sky.webp' );
	?>
	<div class="au-stage" data-au-stage aria-hidden="true">
		<div class="au-stage__sky"<?php echo '' !== $sky ? ' style="' . esc_attr( 'background-image:' . openmu_aurora_css_url( $sky ) ) . '"' : ''; ?>></div>
		<canvas class="au-stage__aurora" data-au-aurora></canvas>
		<?php foreach ( openmu_aurora_stage_layers() as $name => $depth ) : ?>
			<div class="au-layer au-layer--<?php echo esc_attr( $name ); ?>" data-depth="<?php echo esc_attr( (string) $depth ); ?>">
				<?php echo openmu_aurora_art_img( 'scene/' . $name . '.webp', '', '', 'eager' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>
			</div>
		<?php endforeach; ?>
		<canvas class="au-stage__snow" data-au-snow></canvas>
		<?php echo openmu_aurora_art_img( 'scene/hero-poster.webp', 'au-stage__poster', '', 'lazy' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>
		<div class="au-stage__veil" data-au-veil></div>
	</div>
	<?php
}
add_action( 'wp_body_open', 'openmu_aurora_stage' );
