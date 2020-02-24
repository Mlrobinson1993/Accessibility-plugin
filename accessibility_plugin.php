<?php
/**
 * Plugin Name
 *
 * @package           Accessibility
 * @author            Michael Robinson
 * @copyright         2019 MRobinsonWebDev
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       A for Accessibility
 * Plugin URI:        https://mrobinsonwebdev.com
 * Description:       A plugin to tell you how accessibie your wordpress website is.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mikey Robinson
 * Author URI:        https://mrobinsonwebdev.com
 * Text Domain:       plugin-slug
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */


/*If access is attempted through any other means than the
wordpress file system, terminate the process*/
if (!defined('ABSPATH')) {
    die;
}



if( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
};

if (file_exists( dirname( __FILE__ ) . '/config/Base/Activate.php') ) {
    register_activation_hook(__DIR__, array('/config/Base/Activate.php', 'activate' ) );
}

if (file_exists( dirname( __FILE__ ) . '/config/Base/Deactivate.php') ) {
    register_deactivation_hook(__DIR__, array('/config/Base/Deactivate.php', 'deactivate' ) );
}


if( file_exists( dirname(__FILE__) . '/config/init.php' ) ){
   require_once dirname(__FILE__) . '/config/init.php';
}

if ( class_exists( 'Init' ) ) {
    Init::register_services();
 }


