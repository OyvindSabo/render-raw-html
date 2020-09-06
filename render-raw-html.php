<?php
/**
 * Plugin Name: Render Raw HTML
 * Plugin URI: https://github.com/OyvindSabo/render-raw-html
 * Version: 0.2.1
 * Author: Øyvind Sæbø
 * Author URI: http://oyvindsabo.com/
 * Description: A plugin for WordPress that enables you to serve a single HTML document, e.g. a single-page application, without interference from themes or global styles.
 * License: GPL2
 * Text Domain: render-raw-html
 *
 * Copyright (C) 2020 Øyvind Sæbø
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

call_user_func(function () {
    // Plugin details
    $pluginName = 'render-raw-html';
    $pluginDisplayName = 'Render Raw HTML';
    $pluginVersion = '0.1.0';
    $pluginFolder = plugin_dir_path(__FILE__);
    $pluginUrl = plugin_dir_url(__FILE__);
    $plugin_db_welcome_dismissed_key = $pluginName . '_welcome_dismissed_key';

    $renderUserSubmittedHTML = function ($currentHTML) {
        $userSubmittedHTML = get_option('raw_html_to_render');
        return empty($userSubmittedHTML)
        ? $currentHTML
        : wp_unslash($userSubmittedHTML);
    };

    // Initialize output buffering.
    $setUpBuffer = function () use ($renderUserSubmittedHTML) {
        if (is_admin()) {
            return;
        }
        ob_start($renderUserSubmittedHTML);
    };

    $registerSettings = function () use ($pluginName) {
        register_setting($pluginName, 'raw_html_to_render', 'trim');
    };

    // Output the Administration Panel
    // Save POSTed data from the Administration Panel into a WordPress option
    $adminPanel = function () use ($pluginName, $plugin_db_welcome_dismissed_key, $pluginFolder, $pluginDisplayName) {
        // only ad min user can access this page
        if (!current_user_can('administrator')) {
            echo '<p>' . __('Sorry, you are not allowed to access this page.', $pluginName) . '</p>';
            return;
        }

        // Save Settings
        if (isset($_REQUEST['submit'])) {
            // Check nonce
            if (!isset($_REQUEST[$pluginName . '_nonce'])) {
                // Missing nonce
                $errorMessage = 'nonce field is missing. Settings NOT saved.';
            } elseif (!wp_verify_nonce($_REQUEST[$pluginName . '_nonce'], $pluginName)) {
                // Invalid nonce
                $errorMessage = 'Invalid nonce specified. Settings NOT saved.';
            } else {
                // Save
                // $_REQUEST has already been slashed by wp_magic_quotes in wp-settings
                // so do nothing before saving
                update_option('raw_html_to_render', isset($_REQUEST['raw_html_to_render']) ? $_REQUEST['raw_html_to_render'] : '');
                update_option($plugin_db_welcome_dismissed_key, 1);
                $message = __('Settings Saved.', $pluginName);
            }
        }

        // Get latest settings
        $settings = array(
            'raw_html_to_render' => esc_html(wp_unslash(get_option('raw_html_to_render'))),
        );

        // Load Settings Form
        include_once $pluginFolder . '/views/settings.php';
    };

    // Register the plugin settings panel
    $adminPanelsAndMetaBoxes = function () use ($pluginDisplayName, $pluginName, $adminPanel) {
        add_submenu_page('options-general.php', $pluginDisplayName, $pluginDisplayName, 'manage_options', $pluginName, $adminPanel);
    };

    $withSettingsLink = function ($links) use ($pluginName) {
        $myLinks = array('<a href="options-general.php?page=' . $pluginName . '">Settings</a>');
        return array_merge($links, $myLinks);
    };

    // Hooks
    add_action('wp', $setUpBuffer, 10, 0);
    add_action('admin_init', $registerSettings);
    add_action('admin_menu', $adminPanelsAndMetaBoxes);
    add_filter('plugin_action_links_' . plugin_basename(__FILE__), $withSettingsLink);
});
