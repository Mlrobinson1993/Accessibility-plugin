<?php
/**
 * Plugin Name
 *
 * @package           myPLuginPractice
 * @author            Michael Robinson
 * @copyright         2019 MRobinsonWebDev
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin Practice
 * Plugin URI:        https://mrobinsonwebdev.com
 * Description:       practicey mcpracticeface
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

register_activation_hook(__FILE__, array('PluginConfig\Base\Activate', 'activate' ) );
register_deactivation_hook(__FILE__, array('PluginConfig\Base\Deactivate', 'deactivate' ) );


if ( class_exists( 'PluginConfig\\Init' ) ) {
    PluginConfig\Init::register_services();
}
