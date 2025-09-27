<?php
if ( ! defined( 'ABSPATH' ) ) exit;

final class BTN_Settings {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin' ) );
	}

	public function add_menu() {
		add_options_page(
			__( 'Believer Topbar', 'believer-topbar-notifications' ),
			__( 'Believer Topbar', 'believer-topbar-notifications' ),
			'manage_options',
			'btn-settings',
			array( $this, 'render_page' )
		);
	}

	public function register_settings() {
		register_setting( 'btn_settings_group', 'btn_options', array( $this, 'sanitize' ) );

		add_settings_section(
			'btn_main',
			__( 'Topbar Settings', 'believer-topbar-notifications' ),
			function () {
				echo '<p>' . esc_html__( 'Enter a message to display in the topbar. If empty, the topbar will not show.', 'believer-topbar-notifications' ) . '</p>';
			},
			'btn-settings'
		);

		add_settings_field(
			'btn_message',
			__( 'Message', 'believer-topbar-notifications' ),
			array( $this, 'field_message' ),
			'btn-settings',
			'btn_main'
		);

		add_settings_field(
			'btn_bg_color',
			__( 'Background Color', 'believer-topbar-notifications' ),
			array( $this, 'field_bg_color' ),
			'btn-settings',
			'btn_main'
		);

		add_settings_field(
			'btn_text_color',
			__( 'Text Color', 'believer-topbar-notifications' ),
			array( $this, 'field_text_color' ),
			'btn-settings',
			'btn_main'
		);
	}

	public function sanitize( $input ) {
		$output = get_option( 'btn_options', array() );
		$output['message']    = isset( $input['message'] ) ? wp_kses_post( $input['message'] ) : '';
		$output['bg_color']   = isset( $input['bg_color'] ) ? sanitize_hex_color( $input['bg_color'] ) : '#ffffff';
		$output['text_color'] = isset( $input['text_color'] ) ? sanitize_hex_color( $input['text_color'] ) : '#000000';
		return $output;
	}

	public function field_message() {
		$opts = get_option( 'btn_options' );
		printf(
			'<textarea name="btn_options[message]" rows="3" class="large-text" placeholder="%s">%s</textarea>',
			esc_attr__( 'Type the announcement text…', 'believer-topbar-notifications' ),
			esc_textarea( $opts['message'] ?? '' )
		);
	}

	public function field_bg_color() {
		$opts = get_option( 'btn_options' );
		$val  = $opts['bg_color'] ?? '#ffffff';
		printf(
			'<input type="text" name="btn_options[bg_color]" value="%s" class="btn-color-field" data-default-color="#ffffff" />',
			esc_attr( $val )
		);
	}

	public function field_text_color() {
		$opts = get_option( 'btn_options' );
		$val  = $opts['text_color'] ?? '#000000';
		printf(
			'<input type="text" name="btn_options[text_color]" value="%s" class="btn-color-field" data-default-color="#000000" />',
			esc_attr( $val )
		);
	}

	public function render_page() {
		if ( ! current_user_can( 'manage_options' ) ) return;
		echo '<div class="wrap">';
		echo '<h1>' . esc_html__( 'Believer Topbar Notifications', 'believer-topbar-notifications' ) . '</h1>';
		echo '<form method="post" action="options.php">';
		settings_fields( 'btn_settings_group' );
		do_settings_sections( 'btn-settings' );
		submit_button( __( 'Save Changes', 'believer-topbar-notifications' ) );
		echo '</form></div>';
	}

	public function enqueue_admin( $hook ) {
		if ( 'settings_page_btn-settings' !== $hook ) return;
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script(
			'btn-admin',
			BTN_PLUGIN_URL . 'assets/js/admin.js',
			array( 'wp-color-picker' ),
			BTN_VERSION,
			true
		);
	}
}
new BTN_Settings();