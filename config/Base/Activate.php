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

class Activate {

    public function __construct(){
    }

    public static function activate(){
        flush_rewrite_rules();
    }
}