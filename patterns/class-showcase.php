<?php
/**
 * Title: Class showcase
 * Slug: openmu-aurora/class-showcase
 * Categories: openmu-aurora
 * Description: Interactive showcase of the seven classes with painted portraits, role meters and signature skills. Tabs work with mouse, touch, swipe and keyboard.
 * Keywords: classes, heroes, characters, showcase
 * Viewport Width: 1440
 *
 * @package OpenMU_Aurora
 */

/**
 * The classes shown (base classes, Season 6 skills): slug (also the portrait file name) => text, meters (1-5) and skills.
 * Class names and skill names stay English as in the game.
 */
$openmu_aurora_classes      = array(
	'dark-knight'     => array(
		'name'   => 'Dark Knight',
		'short'  => 'DK',
		'role'   => __( 'Frontline guardian', 'openmu-aurora' ),
		'text'   => __( 'Heavy armour, two-handed steel and the stamina to hold any line. The Dark Knight stands first in every fight and leads every charge.', 'openmu-aurora' ),
		'meters' => array( 4, 5, 1, 2 ),
		'skills' => array( 'Twisting Slash', 'Impale', 'Cyclone', 'Swell Life' ),
	),
	'dark-wizard'     => array(
		'name'   => 'Dark Wizard',
		'short'  => 'DW',
		'role'   => __( 'Arcane artillery', 'openmu-aurora' ),
		'text'   => __( 'Fire, ice and storm on command. Area spells melt whole crowds, at the price of thin armour and careful positioning.', 'openmu-aurora' ),
		'meters' => array( 5, 1, 4, 1 ),
		'skills' => array( 'Evil Spirit', 'Hellfire', 'Ice', 'Twister' ),
	),
	'fairy-elf'       => array(
		'name'   => 'Fairy Elf',
		'short'  => 'FE',
		'role'   => __( 'Marksman and healer', 'openmu-aurora' ),
		'text'   => __( 'Swift arrows from a distance and blessings for the whole group. A good elf keeps friends alive and enemies out of reach.', 'openmu-aurora' ),
		'meters' => array( 3, 2, 5, 5 ),
		'skills' => array( 'Triple Shot', 'Penetration', 'Heal', 'Greater Damage' ),
	),
	'dark-lord'       => array(
		'name'   => 'Dark Lord',
		'short'  => 'DL',
		'role'   => __( 'Commander', 'openmu-aurora' ),
		'text'   => __( 'Strength, command and a loyal Dark Raven at his side. Earth-splitting blows and bursts of fire, and a battle cry that sharpens the whole party.', 'openmu-aurora' ),
		'meters' => array( 4, 3, 3, 4 ),
		'skills' => array( 'Fire Burst', 'Earthshake', 'Electric Spike', 'Increase Critical Damage' ),
	),
	'magic-gladiator' => array(
		'name'   => 'Magic Gladiator',
		'short'  => 'MG',
		'role'   => __( 'Spellblade', 'openmu-aurora' ),
		'text'   => __( 'Sword and spell in a single hand. The Magic Gladiator cuts through the front line with blades of fire and answers a crowd with a storm.', 'openmu-aurora' ),
		'meters' => array( 4, 3, 3, 1 ),
		'skills' => array( 'Fire Slash', 'Spiral Slash', 'Twisting Slash', 'Gigantic Storm' ),
	),
	'summoner'        => array(
		'name'   => 'Summoner',
		'short'  => 'SU',
		'role'   => __( 'Curses and spirits', 'openmu-aurora' ),
		'text'   => __( 'Lightning, curses and stolen life. The Summoner weakens and puts enemies to sleep while the book does the killing from a safe distance.', 'openmu-aurora' ),
		'meters' => array( 4, 1, 4, 3 ),
		'skills' => array( 'Drain Life', 'Chain Lightning', 'Sleep', 'Berserker' ),
	),
	'rage-fighter'    => array(
		'name'   => 'Rage Fighter',
		'short'  => 'RF',
		'role'   => __( 'Unarmed brawler', 'openmu-aurora' ),
		'text'   => __( 'No weapon but gauntlets and fury. Fast combo strikes and a roar that shakes the ground make the Rage Fighter a master of close combat.', 'openmu-aurora' ),
		'meters' => array( 5, 3, 1, 1 ),
		'skills' => array( 'Killing Blow', 'Chain Drive', 'Dark Side', 'Dragon Roar' ),
	),
);
$openmu_aurora_meter_labels = array(
	__( 'Offense', 'openmu-aurora' ),
	__( 'Defense', 'openmu-aurora' ),
	__( 'Reach', 'openmu-aurora' ),
	__( 'Support', 'openmu-aurora' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","anchor":"classes","className":"au-section au-showcase-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-section au-showcase-section" id="classes">
	<!-- wp:group {"className":"au-section-head au-reveal","layout":{"type":"default"}} -->
	<div class="wp-block-group au-section-head au-reveal">
		<!-- wp:paragraph {"className":"au-eyebrow"} -->
		<p class="au-eyebrow"><?php esc_html_e( 'Choose your path', 'openmu-aurora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Seven heroes, one continent', 'openmu-aurora' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'Every class plays differently. Pick the one that fits you; you can always start another.', 'openmu-aurora' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:html -->
	<div class="au-showcase alignwide au-reveal" data-au-showcase data-active="dark-knight">
		<div class="au-showcase__tabs" role="tablist" aria-label="<?php esc_attr_e( 'Classes', 'openmu-aurora' ); ?>">
			<?php foreach ( $openmu_aurora_classes as $openmu_aurora_slug => $openmu_aurora_class ) : ?>
				<button type="button" class="au-showcase__tab" role="tab" id="au-tab-<?php echo esc_attr( $openmu_aurora_slug ); ?>" aria-controls="au-panel-<?php echo esc_attr( $openmu_aurora_slug ); ?>" aria-selected="false" tabindex="-1" data-class="<?php echo esc_attr( $openmu_aurora_slug ); ?>">
					<?php // The monogram is always there; the round portrait crop covers it once the picture exists. ?>
					<span class="au-showcase__tab-badge" aria-hidden="true">
						<span class="au-showcase__tab-mono"><?php echo esc_html( $openmu_aurora_class['short'] ); ?></span>
						<?php echo openmu_aurora_art_img( 'characters/' . $openmu_aurora_slug . '.webp', 'au-showcase__tab-img', '', 'lazy' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>
					</span>
					<span class="au-showcase__tab-name"><?php echo esc_html( $openmu_aurora_class['name'] ); ?></span>
				</button>
			<?php endforeach; ?>
		</div>

		<div class="au-showcase__stage" data-au-tilt>
			<div class="au-showcase__aura" aria-hidden="true"></div>
			<span class="au-corner au-corner--tl" aria-hidden="true"></span><span class="au-corner au-corner--tr" aria-hidden="true"></span><span class="au-corner au-corner--bl" aria-hidden="true"></span><span class="au-corner au-corner--br" aria-hidden="true"></span>
			<?php foreach ( $openmu_aurora_classes as $openmu_aurora_slug => $openmu_aurora_class ) : ?>
				<figure class="au-fig au-fig--<?php echo esc_attr( $openmu_aurora_slug ); ?>">
					<?php
					$openmu_aurora_portrait = openmu_aurora_art_img( 'characters/' . $openmu_aurora_slug . '.webp', 'au-fig__img', $openmu_aurora_class['name'], 'lazy' );
					echo '' !== $openmu_aurora_portrait ? $openmu_aurora_portrait : '<span class="au-fig__placeholder" aria-hidden="true"></span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper.
					?>
				</figure>
			<?php endforeach; ?>
		</div>

		<div class="au-showcase__side">
			<div class="au-showcase__panels">
				<?php foreach ( $openmu_aurora_classes as $openmu_aurora_slug => $openmu_aurora_class ) : ?>
					<article class="au-class" role="tabpanel" id="au-panel-<?php echo esc_attr( $openmu_aurora_slug ); ?>" aria-labelledby="au-tab-<?php echo esc_attr( $openmu_aurora_slug ); ?>">
						<h3 class="au-class__name"><?php echo esc_html( $openmu_aurora_class['name'] ); ?></h3>
						<p class="au-class__role"><?php echo esc_html( $openmu_aurora_class['role'] ); ?></p>
						<p class="au-class__text"><?php echo esc_html( $openmu_aurora_class['text'] ); ?></p>
						<ul class="au-class__meters">
							<?php foreach ( $openmu_aurora_meter_labels as $openmu_aurora_i => $openmu_aurora_label ) : ?>
								<li>
									<span class="au-class__meter-label"><?php echo esc_html( $openmu_aurora_label ); ?></span>
									<span class="au-meter" role="img" aria-label="<?php echo esc_attr( sprintf( /* translators: 1: rating 1-5. */ __( '%d out of 5', 'openmu-aurora' ), $openmu_aurora_class['meters'][ $openmu_aurora_i ] ) ); ?>">
										<?php for ( $openmu_aurora_n = 1; $openmu_aurora_n <= 5; $openmu_aurora_n++ ) : ?>
											<i<?php echo $openmu_aurora_n <= $openmu_aurora_class['meters'][ $openmu_aurora_i ] ? ' class="is-on"' : ''; ?>></i>
										<?php endfor; ?>
									</span>
								</li>
							<?php endforeach; ?>
						</ul>
						<ul class="au-class__skills" aria-label="<?php esc_attr_e( 'Signature skills', 'openmu-aurora' ); ?>">
							<?php foreach ( $openmu_aurora_class['skills'] as $openmu_aurora_skill ) : ?>
								<li><?php echo esc_html( $openmu_aurora_skill ); ?></li>
							<?php endforeach; ?>
						</ul>
					</article>
				<?php endforeach; ?>
			</div>

			<p class="au-showcase__cta"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_aurora_page_url( 'account' ) ); ?>"><?php esc_html_e( 'Start your journey', 'openmu-aurora' ); ?></a></p>
		</div>
	</div>
	<!-- /wp:html -->
</section>
<!-- /wp:group -->
