<?php

/**
 * Plugin Name: Great React PLUGIN
 * Author: Stephen Okpeku
 * Description: WordPress React Plugin Boilerplate with MVC Structure, shortcode:[great-react-plugin]
 * Version: 1.0
 * Text Domain: Great React PLUGIN
 * Text Domain: Great React PLUGIN
 */

defined('ABSPATH') or die('You are not allowed to access this page');

require_once plugin_dir_path(__FILE__) . 'Controller/viewController.php';

use Controller\viewController;


class Great_React_Plugin
{
    public function __construct()
    {
        add_action('init', array($this, 'create_custom_post_types'));
        add_shortcode('great-react-plugin', array($this, 'renderView')); // this is to register the shortcode [great-react-plugin] and this is the first page user see when the plugin is opened
        add_action('admin_menu', array($this, 'register_admin_menu'));

        add_action('wp_enqueue_scripts', array($this, 'connect_css')); // css or tailwind it load on frontend
        add_action('admin_enqueue_scripts', array($this, 'connect_css')); // css or tailwind it load on admin



        // Enqueue for both frontend AND admin
        add_action('wp_enqueue_scripts', array($this, 'my_react_plugin_enqueue_assets'));
        add_action('admin_enqueue_scripts', array($this, 'my_react_plugin_enqueue_assets'));
        // Enqueue for both frontend AND admin
    }

    function my_react_plugin_enqueue_assets($hook)
    {
        $is_admin = is_admin();
        // Only load on our plugin's admin page or when shortcode is used
        if ($is_admin && $hook !== 'toplevel_page_great-react-plugin') {
            return;
        }

        // Check if asset file exists
        $asset_file_path = plugin_dir_path(__FILE__) . 'build/index.asset.php';

        if (!file_exists($asset_file_path)) {
            error_log('Great React Plugin: Asset file not found at ' . $asset_file_path);
            return;
        }

        $asset_file = include($asset_file_path);

        // Enqueue the built script - load in footer
        wp_enqueue_script(
            'great-react-plugin-script',
            plugin_dir_url(__FILE__) . 'build/index.js',
            $asset_file['dependencies'],
            $asset_file['version'],
            array('in_footer' => true, 'strategy' => 'defer')
        );

        // Enqueue styles if you have any
        $css_file = plugin_dir_path(__FILE__) . 'build/index.css';
        if (file_exists($css_file)) {
            wp_enqueue_style(
                'great-react-plugin-style',
                plugin_dir_url(__FILE__) . 'build/index.css',
                array(),
                $asset_file['version']
            );
        }

        // this is for dynamic url to know when you are the admin or theme
        // const baseUrl = window.GreatReactData?.baseUrl || '/';
        wp_localize_script('great-react-plugin-script', 'GreatReactData', [
            'isAdmin' => $is_admin,
            'baseUrl' => $is_admin
                ? admin_url('admin.php?page=great-react-plugin')
                : home_url('great-react-plugin') // Also removed leading slash
        ]);
    }

    public function connect_css()
    {
        // this is for html
        // wp_enqueue_style(
        //     'tailwind-css',
        //     'https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css',
        //     [],
        //     '3.3.2'
        // );

        //  this is for react js
        wp_enqueue_style(
            'tailwind-css',
            plugin_dir_url(__FILE__) . 'build/index.css',
            [],
            '1.0'
        );
    }

    public function create_custom_post_types()
    {
        $args = array(
            "public" => true,
            "has_archive" => true,
            "supports" => array("title"),
            "exclude_from_search" => true,
            "publicly_queryable" => false,
            "capability" => "manage_options",
            "labels" => array(
                "name" => "Contact Form",
                "singular_name" => "Contact form Entry"
            ),
            "menu_icon" => "dashicons-welcome-view-site"
        );
        register_post_type("great-react-plugin", $args);
    }

    public function renderView()
    {
        // Add debugging
        error_log('Great React Plugin: renderView called');

        ob_start();
        $controller = new viewController();
        $controller->render();
        // $controller->renderStories();
        $output = ob_get_clean();

        // Log if output is empty
        if (empty($output)) {
            error_log('Great React Plugin: renderView output is empty!');
        } else {
            error_log('Great React Plugin: renderView output length: ' . strlen($output));
        }

        return $output;
    }

    public function register_admin_menu()
    {
        // this is for the index page
        $hook = add_menu_page(
            'Great React Plugin', // Page title
            'Great React Plugin', // Menu title
            'manage_options',     // Capability required
            'great-react-plugin',  // Slug (used in URL)
            array($this, 'admin_page_callback'), // Callback function to display page
            'dashicons-welcome-learn-more' // Icon  or use this icon dashicons-admin-generic
        );

        //  this is for sub page or other page in html not react js
        add_submenu_page(
            'Great React Plugin',      // Parent slug
            'Great React Plugin',        // Page title
            'My Sub Menu',              // Submenu title
            'manage_options',           // Capability required
            'stories',       // Submenu slug
            array($this, 'stories_page_content'),
            // 'my_plugin_sub_page_content' // Callback function to render content
        );

        error_log('Great React Plugin: Menu registered with hook: ' . $hook);
    }

    public function admin_page_callback()
    {
        error_log('Great React Plugin: admin_page_callback called');

        $controller = new viewController();
        return  $controller->render();
    }

    public function stories_page_content()
    {
        error_log('Great React Plugin: stories_page_content called');
        $controller = new viewController();
        return  $controller->renderStories();
    }
}

add_action('plugins_loaded', function () {
    new Great_React_Plugin();
});
