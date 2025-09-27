## Believer Topbar Notifications

Responsive WordPress plugin that displays a site‑wide announcement bar at the very top of every page. Add a custom message and colors from a simple settings page. If the message is empty, the topbar stays hidden by default.

## Features
Auto‑hide when message is empty

Custom message (HTML allowed and sanitized)

Background and text color pickers with sensible defaults

Lightweight, responsive, sticky topbar

Settings page built on the WordPress Settings API

Translation‑ready and follows WordPress coding standards

## Requirements
WordPress 5.6 or higher

PHP 7.4 or higher

## Installation
Upload the folder believer-topbar-notifications to wp-content/plugins/

Activate the plugin in WordPress → Plugins

Go to Settings → Believer Topbar

Enter a Message and choose colors, then Save

Clear the Message to hide the bar site‑wide

## Usage
Message: Content shown inside the topbar; leave empty to hide the bar

Background Color: Sets the bar background; default #ffffff

Text Color: Sets the bar text; default #000000

## Uninstall
Deleting the plugin removes all plugin options from the database automatically (uninstall.php cleanup runs on delete)

## Files and structure
believer-topbar-notifications.php

includes/

class-btn-settings.php

class-btn-frontend.php

assets/

css/topbar.css

js/admin.js

languages/

believer-topbar-notifications.pot

uninstall.php

README.md

## Developer notes
Output hook: wp_body_open

Enqueues: wp_enqueue_scripts (frontend), admin_enqueue_scripts (color picker)

Security: sanitize_hex_color for colors; wp_kses_post for message; escaping on output

i18n: load_plugin_textdomain with .pot scaffolded in /languages

## Roadmap
Dismiss/close button

Per‑role visibility controls

Schedule start/end time window

Gutenberg block for previewing the topbar in editor

## Changelog
1.0.0 — Initial release

## Support
Open an issue with WordPress version, steps to reproduce, and screenshots or a short screen recording

## Professional services
Need customizations for WordPress or WooCommerce, create custom plugins according to your requirements, or enhancements to this plugin than contact us freely throughout this email: imvaibhaw@gmail.com

## License
GPL‑2.0‑or‑later © vaibhaw kumar