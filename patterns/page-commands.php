<?php
/**
 * Title: Commands page
 * Slug: openmu-aurora/page-commands
 * Categories: openmu-aurora-pages
 * Description: Page body of the commands page: title band and a table of the chat commands players can use. Remove the commands your server has switched off.
 * Keywords: commands, chat, help, table
 * Viewport Width: 1440
 * Inserter: no
 *
 * @package OpenMU_Aurora
 */

/**
 * The commands every player can use (the list of OpenMU's chat command plugins that need no
 * game master rights). Each entry: command and arguments as typed => what it does. Command
 * names are never translated; only the description is.
 */
$openmu_aurora_commands = array(
	array( '/move <map>', __( 'Travels to a map, for example /move devias.', 'openmu-aurora' ) ),
	array( '/post <text>', __( 'Sends a message to all players on the server.', 'openmu-aurora' ) ),
	array( '/world <text>', __( 'Sends a message to the world chat, which players on all game servers can read.', 'openmu-aurora' ) ),
	array( '/add <str|agi|vit|ene|cmd> <points>', __( 'Adds level-up points to a stat, for example /add str 10. The last stat is command (Dark Lord).', 'openmu-aurora' ) ),
	array( '/addstr, /addagi, /addvit, /addene, /addcmd <points>', __( 'Shortcuts that add points to one stat, for example /addvit 20.', 'openmu-aurora' ) ),
	array( '/reset', __( 'Resets the character when it reaches the required level.', 'openmu-aurora' ) ),
	array( '/resetinfo', __( 'Shows the cost and the points granted for your next reset.', 'openmu-aurora' ) ),
	array( '/resetstats', __( 'Resets the stat points of your character.', 'openmu-aurora' ) ),
	array( '/pkclear', __( 'Clears your player-killer status for a fee.', 'openmu-aurora' ) ),
	array( '/offlevel', __( 'Keeps your character leveling in the world after you disconnect. The MU Helper must be running.', 'openmu-aurora' ) ),
	array( '/waiting', __( 'Lists the items that are waiting for free space in your inventory.', 'openmu-aurora' ) ),
	array( '/war <guild>', __( 'Sends a guild war request to the guild master of the given guild.', 'openmu-aurora' ) ),
	array( '/battlesoccer <guild>', __( 'Sends a battle soccer request to the guild master of the given guild.', 'openmu-aurora' ) ),
	array( '/shopprice <slot> <price> <currency>', __( 'Sets the price of an item in your personal store, for example /shopprice 1 10 bless. Without arguments it lists your prices.', 'openmu-aurora' ) ),
	array( '/npc, /openware', __( 'Opens the merchant window or your warehouse from anywhere, if the server offers it.', 'openmu-aurora' ) ),
	array( '/language <code>', __( 'Changes the language of your account, for example /language pl.', 'openmu-aurora' ) ),
	array( '/discord <link|unlink|notify>', __( 'Links your account to Discord. /discord link creates a code to enter in Discord, /discord unlink removes the link.', 'openmu-aurora' ) ),
	array( '/list', __( 'Lists the commands available to you, with their usage.', 'openmu-aurora' ) ),
	array( '/help <command>', __( 'Shows how to use one command, for example /help move.', 'openmu-aurora' ) ),
);
?>
<?php echo openmu_aurora_page_hero( __( 'Server', 'openmu-aurora' ), __( 'Type these in the game chat. Values in angle brackets are yours to fill in; some commands may be switched off on this server.', 'openmu-aurora' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>

<!-- wp:group {"tagName":"section","align":"full","className":"au-pagebody","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull au-pagebody">
	<!-- wp:group {"align":"wide","className":"is-style-mu-window au-commands","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide is-style-mu-window au-commands">
		<!-- wp:table {"className":"au-commands__table"} -->
		<figure class="wp-block-table au-commands__table"><table class="has-fixed-layout"><thead><tr><th><?php esc_html_e( 'Command', 'openmu-aurora' ); ?></th><th><?php esc_html_e( 'What it does', 'openmu-aurora' ); ?></th></tr></thead><tbody>
		<?php foreach ( $openmu_aurora_commands as $openmu_aurora_row ) : ?>
			<tr><td><code><?php echo esc_html( $openmu_aurora_row[0] ); ?></code></td><td><?php echo esc_html( $openmu_aurora_row[1] ); ?></td></tr>
		<?php endforeach; ?>
		</tbody></table></figure>
		<!-- /wp:table -->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-content {"layout":{"type":"constrained"}} /-->
</section>
<!-- /wp:group -->
