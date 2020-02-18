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

class Deactivate {
    public static function deactivate(){
        flush_rewrite_rules();
    }
}