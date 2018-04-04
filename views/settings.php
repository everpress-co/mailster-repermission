<table class="form-table">
	<tr valign="top">
		<th scope="row">&nbsp;</th>
		<td><p class="description"><?php echo sprintf( __( 'Please follow %s for your Re-Permission Campaign!', 'mailster-repermission' ), '<a href="https://kb.mailster.co/implementing-a-re-permission-program-for-gdpr/" class="external">this guide</a>' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Re-Permission Campaign ID' , 'mailster-repermission' ) ?></th>
		<td><input type="text" name="mailster_options[repermission_id]" value="<?php echo esc_attr( mailster_option( 'repermission_id' ) ); ?>" class="small-text">
		<span class="howto"><?php esc_html_e( 'The ID of your Re-Permission campaign.' , 'mailster-repermission' ) ?></span>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Link', 'mailster-repermission' ) ?></th>
		<td><input type="text" name="mailster_options[repermission_link]" value="<?php echo esc_attr( mailster_option( 'repermission_link' ) ); ?>" class="regular-text" placeholder="https://example.com/thanks-for-your-consent/">
		<p class="howto"><?php esc_html_e( 'The link people have to click for re-permission.' , 'mailster-repermission' ) ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Custom Field', 'mailster-repermission' ) ?></th>
		<td>
		<?php $fields = mailster()->get_custom_fields(); ?>
		<select name="mailster_options[repermission_field]">
		<option value="0" <?php selected( ! mailster_option( 'repermission_field' ) )?>><?php esc_html_e( 'choose', 'mailster-repermission' ); ?></option>
		<?php foreach ( $fields as $id => $field ) : ?>
			<option value="<?php echo esc_attr( $id ) ?>" <?php selected( mailster_option( 'repermission_field' ), $id )?>><?php echo esc_html( $field['name'] ) ?></option>
		<?php endforeach; ?>
		</select>
		<p class="howto"><?php esc_html_e( 'The custom field which gets set if the link is clicked. Preferable a checkbox.' , 'mailster-repermission' ) ?></p>
		</td>
	</tr>
</table>

