<table class="form-table">
	<tr valign="top">
		<th scope="row">&nbsp;</th>
		<td><p class="description"><?php printf( esc_html__( 'Please follow %s for your Re-Permission Campaign!', 'mailster-repermission' ), '<a href="https://kb.mailster.co/implementing-a-re-permission-program-for-gdpr/" class="external">' . esc_html__( 'this guide', 'mailster-repermission' ) . '</a>' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Re-Permission Campaign ID', 'mailster-repermission' ); ?></th>
		<td><input type="text" name="mailster_options[repermission_id]" value="<?php echo esc_attr( mailster_option( 'repermission_id' ) ); ?>" class="regular-text">
		<span class="howto"><?php esc_html_e( 'The ID of your Re-Permission campaign. You can use multiple IDs seperated with a comma. (12,34,56)', 'mailster-repermission' ); ?></span>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Consent Link', 'mailster-repermission' ); ?></th>
		<td><input type="text" name="mailster_options[repermission_link]" value="<?php echo esc_attr( mailster_option( 'repermission_link' ) ); ?>" class="regular-text" placeholder="https://example.com/thanks-for-your-consent/">
		<p class="howto"><?php esc_html_e( 'The link people have to click for re-permission.', 'mailster-repermission' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'No Consent Link', 'mailster-repermission' ); ?></th>
		<td><input type="text" name="mailster_options[repermission_unlink]" value="<?php echo esc_attr( mailster_option( 'repermission_unlink' ) ); ?>" class="regular-text" placeholder="https://example.com/sorry-to-see-you-gone/">
		<p class="howto"><?php esc_html_e( 'The link people have click to opt out.', 'mailster-repermission' ); ?></p>
		</td>
	</tr>
</table>

