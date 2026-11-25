<?php
/**
 * Title: How to start
 * Slug: openmu-aurora/how-to-start
 * Categories: openmu-aurora, call-to-action
 * Description: Four numbered steps from account to first event, each with an icon and a link.
 * Keywords: start, guide, steps, how to
 * Viewport Width: 1440
 *
 * @package OpenMU_Aurora
 */

/** The steps: icon, heading, text, link slug and link label. */
$openmu_aurora_steps = array(
	array( 'user', __( 'Create an account', 'openmu-aurora' ), __( 'Pick a login and a password. The same account works in the game and on this site.', 'openmu-aurora' ), 'account', __( 'Register', 'openmu-aurora' ) ),
	array( 'download', __( 'Download the client', 'openmu-aurora' ), __( 'Get the game from the download page and connect to the server.', 'openmu-aurora' ), 'download', __( 'Download', 'openmu-aurora' ) ),
	array( 'sword', __( 'Create a hero', 'openmu-aurora' ), __( 'Log in, choose a class and step onto the first map. Type /list in the chat to see the commands.', 'openmu-aurora' ), 'commands', __( 'Commands', 'openmu-aurora' ) ),
	array( 'events', __( 'Join the events', 'openmu-aurora' ), __( 'Blood Castle, Devil Square and invasions run on a schedule. Gather a group and take part.', 'openmu-aurora' ), 'events', __( 'Schedule', 'openmu-aurora' ) ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"au-section au-steps-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-section au-steps-section">
	<!-- wp:group {"className":"au-section-head au-reveal","layout":{"type":"default"}} -->
	<div class="wp-block-group au-section-head au-reveal">
		<!-- wp:paragraph {"className":"au-eyebrow"} -->
		<p class="au-eyebrow"><?php esc_html_e( 'New here?', 'openmu-aurora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'How to start', 'openmu-aurora' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'Four steps from the first click to your first event.', 'openmu-aurora' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:html -->
	<ol class="au-steps alignwide" data-au-stagger>
		<?php foreach ( $openmu_aurora_steps as $openmu_aurora_i => $openmu_aurora_step ) : ?>
			<li class="au-step au-glass au-reveal">
				<span class="au-step__num" aria-hidden="true"><?php echo esc_html( (string) ( $openmu_aurora_i + 1 ) ); ?></span>
				<span class="au-step__icon"><?php echo openmu_aurora_icon( $openmu_aurora_step[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?></span>
				<h3 class="au-step__title"><?php echo esc_html( $openmu_aurora_step[1] ); ?></h3>
				<p class="au-step__text"><?php echo esc_html( $openmu_aurora_step[2] ); ?></p>
				<a class="au-step__link" href="<?php echo esc_url( openmu_aurora_page_url( $openmu_aurora_step[3] ) ); ?>"><?php echo esc_html( $openmu_aurora_step[4] ); ?> <span aria-hidden="true">→</span></a>
			</li>
		<?php endforeach; ?>
	</ol>
	<!-- /wp:html -->
</section>
<!-- /wp:group -->
