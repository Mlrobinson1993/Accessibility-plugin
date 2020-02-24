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

class Deactivate {

    public function __construct(){

    }

    public static function deactivate(){
        flush_rewrite_rules();
    }
}