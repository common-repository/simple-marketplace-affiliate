<?php
/** 
 * Tab: API Options
 */

if( $active_tab == 'api' ) : 

$themeforest = sprintf( '<a href="https://themeforest.net/affiliate_program" target="_blank">%s</a>', __( 'Envato Marktplatz', 'eawp' ) );
$token = sprintf( '<a href="https://build.envato.com/create-token/" target="_blank">%s</a>', __( 'hier einen persönlichen Token anfordern', 'eawp' ) );
$text_1 = sprintf( __('Hier musst Du Einstellungen für die Verbindung zur Envato API vornehmen. Um die API verwenden zu können, musst Du ein Envato Konto erstellt haben und %s.', 'eawp'), $token );
$text_2 = sprintf( __('Deine Affiliate-ID erhälst Du in einem beliebigen %s unter "Affiliate".', 'eawp'), $themeforest );

?>

<h3><?php _e('Envato API', 'eawp') ?></h3>

<p><?php echo $text_1 . ' ' . $text_2; ?></p>

<form method="post" action="options.php">

	<?php settings_fields( 'eawp-api-settings-group' ); ?>
	<?php do_settings_sections( 'eawp-api-settings-group' ); ?>

	<table class="form-table">
		<tr valign="top">
			<th scope="row"><?php _e('Pers&ouml;nlicher Token', 'eawp'); ?></th>
			<td>
				<input type="text" name="eawp_token" class="regular-text" value="<?php echo esc_attr( get_option('eawp_token') ); ?>"/>
				<p class="description"><?php echo sprintf( __('Wenn Du noch keinen Token hast, kannst Du %s.', 'eawp'), $token ); ?></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e('Affiliate-ID', 'eawp'); ?></th>
			<td>
				<input type="text" name="eawp_ref" class="regular-text" value="<?php echo esc_attr( get_option('eawp_ref', '') ); ?>"/>
				<p class="description"><?php _e('F&uuml;ge hier Deine pers&ouml;nliche Envato Affiliate-ID ohne <code>?ref=</code> Tag ein.', 'eawp'); ?></p>
			</td>
		</tr>
	</table>

	<?php submit_button(); ?>

</form>

<?php endif; ?>
