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

class Activate
{
    public static function activate(){
        flush_rewrite_rules();
    }
}