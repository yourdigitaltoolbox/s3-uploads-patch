<?php

/**
 * Plugin Name: S3 Uploads Patch
 * Plugin URI:  https://yourdigitaltoolbox.com/
 * Description: A set of Elementor Widgets by Your Digital Toolbox
 * Author:      John Kraczek
 * Author URI:  https://yourdigitaltoolbox.com/
 * Version:     0.0.6
 * Text Domain: ydtb-S3-Uploads-Patch
 * Domain Path: /languages/
 * License:     GPLv3 or later (license.txt)
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

// check if the vendor directory exists, and load it if it does
$autoload = __DIR__ . '/vendor/autoload.php';
if (!file_exists(filename: $autoload)) {
    add_action(hook_name: 'admin_notices', callback: function (): void {
        $message = __(text: 'S3 Uploads Patch was downloaded from source and has not been built. Please run `composer install` inside the plugin directory <br> OR <br> install a released version of the plugin which will have already been built.', domain: 'ydtb-S3-Uploads-Patch');
        echo '<div class="notice notice-error">';
        echo '<p>' . $message . '</p>';
        echo '</div>';
    });
    return false;
}
require_once $autoload;

new YDTBS3PatchRoot\Plugin();
