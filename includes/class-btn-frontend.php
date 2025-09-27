<?php
if ( ! defined( 'ABSPATH' ) ) exit;

final class BTN_Frontend {
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend' ) );
		add_action( 'wp_body_open', array( $this, 'render_topbar' ) );
	}

	public function enqueue_frontend() {
		wp_enqueue_style( 'btn-topbar', BTN_PLUGIN_URL . 'assets/css/topbar.css', array(), BTN_VERSION, 'all' );
	}

	public function render_topbar() {
		$opts = get_option( 'btn_options' );
		$message = isset( $opts['message'] ) ? trim( wp_kses_post( $opts['message'] ) ) : '';
		if ( $message === '' ) return;

		$bg   = isset( $opts['bg_color'] ) ? sanitize_hex_color( $opts['bg_color'] ) : '#ffffff';
		$text = isset( $opts['text_color'] ) ? sanitize_hex_color( $opts['text_color'] ) : '#000000';

		printf(
			'<div class="btn-topbar" style="--btn-bg:%1$s;--btn-text:%2$s;"><div class="btn-container"><div class="btn-text">%3$s</div></div></div>',
			esc_attr( $bg ),
			esc_attr( $text ),
			wp_kses_post( $message )
		);
	}
}
new BTN_Frontend();