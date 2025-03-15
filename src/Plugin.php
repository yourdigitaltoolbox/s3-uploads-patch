<?php

namespace YDTBS3PatchRoot;

use YDTBS3Patch\Utils\Updater;
use YDTBS3Patch\Providers\FunctionServiceProvider;

class Plugin
{
    private $plugin_path;

    public function __construct()
    {
        if (!$this->plugin_checks()) {
            // still run the safe providers like the updater if the plugin checks fail
            foreach ($this->safeProviders() as $service) {
                (new $service)->register();
            }
            return;
        }
        $this->register();
    }

    /**
     * Register the providers
     */

    protected function providers()
    {
        return [
            FunctionServiceProvider::class,
            Updater::class
        ];
    }

    protected function safeProviders()
    {
        return [
            Updater::class
        ];
    }

    /**
     * Run each providers' register function
     */

    protected function register()
    {
        foreach ($this->providers() as $service) {
            (new $service)->register();
        }
    }

    /**
     * Check if the plugin has been built + anything else you want to check prior to booting the plugin
     */

    public function plugin_checks()
    {
        if (!function_exists('is_plugin_active'))
            require_once(ABSPATH . '/wp-admin/includes/plugin.php');

        if (!file_exists(WPMU_PLUGIN_DIR . '/s3-uploads/s3-uploads.php') && !is_plugin_active('s3-uploads/s3-uploads.php')) {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error"><p>S3 Uploads must be installed and activated in either the plugins or mu-plugins directory for S3-Uploads-Patch plugin to work.</p></div>';
            });
            return false;
        }
        return true;
    }
}
