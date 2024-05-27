<?php

class MailsterRePermission {

	private $plugin_path;
	private $plugin_url;

	public function __construct() {

		$this->plugin_path = plugin_dir_path( MAILSTER_REPERMISSION_FILE );
		$this->plugin_url  = plugin_dir_url( MAILSTER_REPERMISSION_FILE );

		register_activation_hook( MAILSTER_REPERMISSION_FILE, array( &$this, 'activate' ) );

		load_plugin_textdomain( 'mailster-repermission' );

		add_action( 'init', array( &$this, 'init' ), 1 );
	}

	public function init() {

		if ( ! function_exists( 'mailster' ) ) {

			add_action( 'admin_notices', array( &$this, 'notice' ) );
			return;

		}

		add_filter( 'mailster_setting_sections', array( &$this, 'settings_tab' ), 1 );
		add_action( 'mailster_section_tab_repermission', array( &$this, 'settings' ) );
		add_action( 'mailster_click', array( &$this, 'click' ), 10, 4 );

		add_action( 'upgrader_process_complete', array( &$this, 'schedule_update_meta' ) );
		add_action( 'mailster_maybe_update_gdpr_meta_values', array( &$this, 'maybe_update_meta_values' ) );
	}

	public function settings_tab( $settings ) {

		$position = 4;
		$settings = array_slice( $settings, 0, $position, true ) +
					array( 'repermission' => 'Re-Permission' ) +
					array_slice( $settings, $position, null, true );

		return $settings;
	}


	public function settings() {

		include $this->plugin_path . '/views/settings.php';
	}

	public function click( $subscriber_id, $campaign_id, $target, $index ) {

		if ( ! $subscriber_id ) {
			return;
		}

		$repermission_ids = array_filter( array_map( 'trim', explode( ',', mailster_option( 'repermission_id' ) ) ), 'is_numeric' );

		if ( ! in_array( $campaign_id, $repermission_ids ) ) {
			return;
		}

		if ( ! $target ) {
			return;
		}

		if ( $target == mailster_option( 'repermission_link' ) ) {
			mailster( 'subscribers' )->update_meta( $subscriber_id, $campaign_id, 'gdpr', time() );
			mailster( 'subscribers' )->change_status( $subscriber_id, 1 );
		} elseif ( $target == mailster_option( 'repermission_unlink' ) ) {
			mailster( 'subscribers' )->unsubscribe( $subscriber_id, $campaign_id, __( 'Didn\'t give consent on the RePermission campaign', 'mailster-repermission' ) );
			mailster( 'subscribers' )->change_status( $subscriber_id, 2 );
		}
	}


	public function schedule_update_meta() {
		wp_schedule_single_event( time() + 10, 'mailster_maybe_update_gdpr_meta_values' );
	}

	public function maybe_update_meta_values() {

		global $wpdb;

		if ( $target = mailster_option( 'repermission_link' ) ) {

			$repermission_ids = array_filter( array_map( 'trim', explode( ',', mailster_option( 'repermission_id' ) ) ), 'is_numeric' );

			$sql = "INSERT INTO `{$wpdb->prefix}mailster_subscriber_meta` (subscriber_id, campaign_id, meta_key, meta_value) ( SELECT actions.subscriber_id, actions.campaign_id, 'gdpr', actions.timestamp FROM `{$wpdb->prefix}mailster_actions` AS actions LEFT JOIN {$wpdb->prefix}mailster_links as links ON links.ID = actions.link_id WHERE links.link = %s AND actions.campaign_id IN (" . implode( ',', $repermission_ids ) . ') ) ON DUPLICATE KEY UPDATE meta_value = actions.timestamp';

			$sql = $wpdb->prepare( $sql, $target );

			$wpdb->query( $sql );

			$sql = "INSERT INTO `{$wpdb->prefix}mailster_subscriber_meta` (subscriber_id, campaign_id, meta_key, meta_value) ( SELECT actions.subscriber_id, 0, 'gdpr', actions.timestamp FROM `{$wpdb->prefix}mailster_actions` AS actions LEFT JOIN {$wpdb->prefix}mailster_links as links ON links.ID = actions.link_id WHERE links.link = %s AND actions.campaign_id IN (" . implode( ',', $repermission_ids ) . ') ) ON DUPLICATE KEY UPDATE meta_value = actions.timestamp';

			$sql = $wpdb->prepare( $sql, $target );

			$wpdb->query( $sql );

		}
	}

	public function notice() {
		$msg = sprintf( esc_html__( 'You have to enable the %s to use the Re-Permission Add On!', 'mailster-repermission' ), '<a href="https://mailster.co/?utm_campaign=wporg&utm_source=wordpress.org&utm_medium=plugin&utm_term=Re-Permission">Mailster Newsletter Plugin</a>' );
		?>
		<div class="error"><p><strong><?php	echo $msg; ?></strong></p></div>
		<?php
	}

	public function activate() {

		if ( function_exists( 'mailster' ) ) {
		}
	}
}
