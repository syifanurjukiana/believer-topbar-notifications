<?php
/**
 * Plugin Name:       Believer Topbar Notifications
 * Plugin URI:        https://vaibhawkumarparashar.in/projects/believer-topbar-notifications
 * Description:       Responsive, customizable site-wide topbar that displays a message with configurable background and text colors. Hides automatically when empty.
 * Version:           1.0
 * Requires at least: 5.6
 * Requires PHP:      7.4
 * Author:            vaibhaw kumar
 * Author URI:        https://vaibhawkumarparashar.in
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       believer-topbar-notifications
 * Domain Path:       /languages
 * Update URI:        false
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'BTN_PLUGIN_FILE', __FILE__ );
define( 'BTN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BTN_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'BTN_VERSION', '1.0' );

add_action( 'plugins_loaded', function () {
	load_plugin_textdomain( 'believer-topbar-notifications', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}, 0 );

require_once BTN_PLUGIN_DIR . 'includes/class-btn-settings.php';
require_once BTN_PLUGIN_DIR . 'includes/class-btn-frontend.php';

register_activation_hook( __FILE__, function () {
	$defaults = array(
		'message'      => '',
		'bg_color'     => '#ffffff',
		'text_color'   => '#000000',
	);
	if ( get_option( 'btn_options' ) === false ) {
		add_option( 'btn_options', $defaults );
	}
});
