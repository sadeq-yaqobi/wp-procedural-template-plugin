<?php
/*Plugin Name: sample plugin
Plugin URI: http://siteyar.net/plugins/
Description: پلاگین نمونه
Author: sadeq yaqobi
Version: 1.0.0
License: GPLv2 or later
Author URI: http://siteyar.net/sadeq-yaqobi/ */

#for security
defined('ABSPATH') || exit();

//defined required const
define('SP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SP_PLUGIN_URL', plugin_dir_url(__FILE__));
const SP_PLUGIN_INC = SP_PLUGIN_DIR . '_inc/';
const SP_PLUGIN_VIEW = SP_PLUGIN_DIR . 'view/';
const SP_PLUGIN_ASSETS_DIR = SP_PLUGIN_DIR . 'assets/';
const SP_PLUGIN_ASSETS_URL = SP_PLUGIN_URL . 'assets/';

/**
 * Register and enqueue frontend assets
 */
function sp_register_assets_front() {
    // Register and enqueue CSS
    wp_register_style('sp-style',SP_PLUGIN_ASSETS_URL . 'css/front/style.css',[],'1.0.0');
    wp_enqueue_style('sp-style');

    // Register and enqueue JavaScript
    wp_register_script('jquery-toast', SP_PLUGIN_ASSETS_URL . 'js/jquery.toast.min.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
    wp_enqueue_script('jquery-toast');
    wp_register_script('sp-main-js',SP_PLUGIN_ASSETS_URL . 'js/front/main.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
    wp_enqueue_script('sp-main-js');
    wp_register_script('sp-front-ajax',SP_PLUGIN_ASSETS_URL . 'js/front/front-ajax.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
    wp_enqueue_script('sp-front-ajax');

    // localize script
    wp_localize_script('sp-front-ajax', 'sp-ajax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        '_nonce' => wp_create_nonce()
    ]);
}

function sp_register_assets_admin() {
    // Register and enqueue CSS
    wp_register_style('sp-admin-style',SP_PLUGIN_ASSETS_URL . 'css/admin/admin-style.css',[],'1.0.0');
    wp_enqueue_style('sp-admin-style');

    // Register and enqueue JavaScript
    wp_register_script('sp-admin-js',SP_PLUGIN_ASSETS_URL . 'js/admin/admin-js.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
    wp_enqueue_script('sp-admin-js');
    wp_register_script('sp-admin-ajax',SP_PLUGIN_ASSETS_URL . 'js/admin/admin-ajax.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
    wp_enqueue_script('sp-admin-ajax');
}
add_action('wp_enqueue_scripts', 'sp_register_assets_front');
add_action('admin_enqueue_scripts', 'sp_register_assets_admin');
//activation and deactivation plugin hooks
function func1()
{
//    any work that needs to do when the plugin is activated like creating tables on database
}

function func2()
{
    //
}
register_activation_hook(__FILE__,func1());
register_deactivation_hook(__FILE__,func2());

//including
if (is_admin()) {
    include SP_PLUGIN_INC . 'admin/menus.php';
} else {
    include SP_PLUGIN_INC . 'front/form.php';
}
