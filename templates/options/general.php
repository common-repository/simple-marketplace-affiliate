<?php
/** 
 * Tab: API Options
 */

if( $active_tab == 'general' ) : 

?>

<h3><?php _e('Allgemeine Einstellungen', 'eawp'); ?></h3>

<p><?php _e('Hier kannst Du allgemeine Einstellungen für das Plugin vornehmen.', 'eawp'); ?></p>

<form method="post" action="options.php">

	<?php settings_fields( 'eawp-general-settings-group' ); ?>
	<?php do_settings_sections( 'eawp-general-settings-group' ); ?>

	<table class="form-table">
		<tr valign="top">
			<th scope="row"><?php _e('Shortcode', 'eawp'); ?></th>
			<td>
				<select name="eawp_shortcode">
					<?php if ( esc_attr( get_option('eawp_shortcode') == 1 ) ) : ?>
					<option value="1" selected="selected">[eawp]</option>
					<option value="2">[envato]</option>					
					<?php else : ?>
					<option value="2" selected="selected">[envato]</option>	
					<option value="1">[eawp]</option>					
					<?php endif; ?>
				</select>
			</td>
		</tr>
	</table>

	<?php submit_button(); ?>

</form>

<?php endif; ?>