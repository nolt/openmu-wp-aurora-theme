<?php
/**
 * Title: Account page
 * Slug: openmu-aurora/page-account
 * Categories: openmu-aurora-pages
 * Description: Page body of the account page: title band and the player account block (log in, characters, password).
 * Keywords: account, page
 * Viewport Width: 1440
 * Inserter: no
 *
 * @package OpenMU_Aurora
 */

?>
<?php echo openmu_aurora_page_hero( __( 'Your account', 'openmu-aurora' ), __( 'Log in with your game account to see your characters, change the password or create a new account.', 'openmu-aurora' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>

<!-- wp:group {"tagName":"section","align":"full","className":"au-pagebody","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-pagebody">
	<!-- wp:group {"align":"wide","className":"is-style-mu-window au-account-panel","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide is-style-mu-window au-account-panel">
		<!-- wp:openmu/account /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-content {"layout":{"type":"constrained"}} /-->
</section>
<!-- /wp:group -->
