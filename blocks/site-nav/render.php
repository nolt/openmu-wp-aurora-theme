<?php
/**
 * Render template of the openmu-aurora/site-nav block: main menu, "Play now" button and the
 * mobile menu button. See inc/nav.php for why this is a PHP block.
 *
 * Markup contract with assets/js/aurora.js: [data-au-nav] is the <nav>, [data-au-nav-toggle]
 * the mobile button, [data-au-sub-toggle] the Server submenu button; the script only toggles
 * aria-expanded and the "is-open" classes.
 *
 * @package OpenMU_Aurora
 */

defined( 'ABSPATH' ) || exit;

$openmu_aurora_items = openmu_aurora_nav_items();
$openmu_aurora_play  = openmu_aurora_page_url( 'download' );
?>
<div class="au-navwrap">
	<nav id="au-nav" class="au-nav" aria-label="<?php esc_attr_e( 'Main menu', 'openmu-aurora' ); ?>" data-au-nav>
		<div class="au-nav__panel" id="au-nav-panel">
			<ul class="au-nav__list">
				<?php foreach ( $openmu_aurora_items as $openmu_aurora_item ) : ?>
					<?php if ( empty( $openmu_aurora_item['children'] ) ) : ?>
						<li class="au-nav__item<?php echo $openmu_aurora_item['current'] ? ' is-current' : ''; ?>">
							<a class="au-nav__link" href="<?php echo esc_url( $openmu_aurora_item['url'] ); ?>"<?php echo $openmu_aurora_item['current'] ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $openmu_aurora_item['label'] ); ?></a>
						</li>
					<?php else : ?>
						<li class="au-nav__item au-nav__item--parent<?php echo $openmu_aurora_item['current'] ? ' is-current' : ''; ?>" data-au-parent>
							<button type="button" class="au-nav__link au-nav__sub-toggle" aria-expanded="false" aria-controls="au-nav-sub" data-au-sub-toggle>
								<span><?php echo esc_html( $openmu_aurora_item['label'] ); ?></span>
								<svg class="au-nav__chevron" viewBox="0 0 12 8" width="10" height="7" aria-hidden="true" focusable="false"><path d="M1 1.5 6 6.5 11 1.5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</button>
							<ul class="au-nav__sub" id="au-nav-sub">
								<?php foreach ( $openmu_aurora_item['children'] as $openmu_aurora_child ) : ?>
									<li class="au-nav__subitem<?php echo $openmu_aurora_child['current'] ? ' is-current' : ''; ?>">
										<a class="au-nav__sublink" href="<?php echo esc_url( $openmu_aurora_child['url'] ); ?>"<?php echo $openmu_aurora_child['current'] ? ' aria-current="page"' : ''; ?>>
											<?php echo openmu_aurora_icon( $openmu_aurora_child['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>
											<span><?php echo esc_html( $openmu_aurora_child['label'] ); ?></span>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			<?php // The overlay on phones has its own copy of the button; the header one is hidden there. ?>
			<a class="au-btn au-btn--play au-nav__play-panel" href="<?php echo esc_url( $openmu_aurora_play ); ?>">
				<?php echo openmu_aurora_icon( 'play' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>
				<span><?php esc_html_e( 'Play now', 'openmu-aurora' ); ?></span>
			</a>
		</div>
	</nav>
	<div class="au-header__actions">
		<a class="au-btn au-btn--play au-nav__play" href="<?php echo esc_url( $openmu_aurora_play ); ?>">
			<?php echo openmu_aurora_icon( 'play' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>
			<span><?php esc_html_e( 'Play now', 'openmu-aurora' ); ?></span>
		</a>
		<button type="button" class="au-nav__toggle" aria-expanded="false" aria-controls="au-nav-panel" data-au-nav-toggle>
			<span class="au-sr"><?php esc_html_e( 'Menu', 'openmu-aurora' ); ?></span>
			<span class="au-nav__bars" aria-hidden="true"><i></i><i></i><i></i></span>
		</button>
	</div>
</div>
