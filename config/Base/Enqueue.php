<?php
/**
 * Plugin Name
 *
 * @package           myPLuginPractice
 * @author            Michael Robinson
 * @copyright         2019 MRobinsonWebDev
 * @license           GPL-2.0-or-later
 *
 * */
namespace PluginConfig\Base;

use PluginConfig\Base\BaseController;

class Enqueue extends BaseController {

    public function register(){
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

     function enqueue()
    {
        wp_enqueue_style('mystyle', $this->plugin_url . 'style/mystyle.css', __FILE__);
        wp_enqueue_script('script', $this->plugin_url . 'script/script.js', __FILE__);
    }
}