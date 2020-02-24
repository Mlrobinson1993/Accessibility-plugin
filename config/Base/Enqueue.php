<?php
/**
 * Plugin Name
 *
 * @package           Accessibility
 * @author            Michael Robinson
 * @copyright         2019 MRobinsonWebDev
 * @license           GPL-2.0-or-later
 *
 * */
require_once (__DIR__) . '/BaseController.php';

class Enqueue extends BaseController {

    public function register(){
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
    }

     function enqueueScripts()
    {
        wp_enqueue_style('mystyle', $this->plugin_url . 'style/mystyle.css', __FILE__);
        wp_enqueue_script('script', $this->plugin_url . 'script/script.js', __FILE__);
    }
}