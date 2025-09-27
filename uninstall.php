<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
delete_option( 'btn_options' );
if ( function_exists( 'is_multisite' ) && is_multisite() ) {
	delete_site_option( 'btn_options' );
}