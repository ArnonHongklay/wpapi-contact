<?php

/**
 *    Plugin Name:      WP API CONTACT
 *    Plugin URI:       https://www.nonmadden.com
 *    Description:      WP API AUTH enables a UI to toggle endpoints in the REST API.
 *    Version:          1.0.0
 *    Author:           Non Madden
 *    Plugin URI:       https://github.com/nonmadden/wp-api-contact
 *    Author URI:       https://www.nonmadden.com
 *    License:          GPL-3.0+
 *    License URI:      http://www.gnu.org/licenses/gpl-3.0.txt
 *    Text Domain:      wp-api-contact
 *    Domain Path:      /languages
**/

if (! defined('WPINC')) {
    die;
}

if (! defined('ABSPATH')) {
    die("You can't do anything by accessing this file directly.");
}

if (!function_exists('is_plugin_active')) {
    require_once(ABSPATH . '/wp-admin/includes/plugin.php');
}

if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
    add_action('rest_api_init', 'register_rest_routes');
}

function register_rest_routes()
{
    if (!class_exists('WP_REST_Contact_Form_7_Controller')) {
        require_once plugin_dir_path(__FILE__) . '/includes/endpoints/class-wp-api-contact-controller.php';
    }

    $controller = new WP_REST_Contact_Form_7_Controller();
    $controller->register_routes();
}
