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

namespace PluginConfig;

if( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
};


use PluginConfig;




final class Init {

    /*
    store all classes inside a array and returns the array of classes
    */

    public static function get_services(){
        return [
            Pages\AdminPage::class,
           Base\Enqueue::class,
           Base\SettingsLinks::class,
           Data\APIData::class
        ];
    }

    /*
    Loop through classes, initialise them and call the register() method on them if it exists

    */
    public static function register_services(){
        foreach( self::get_services() as $class){
            $service = self::instantiate($class);
            if(method_exists($service, 'register') ) {
                $service->register();
            }
        }
    }

    //initalise class

    private function instantiate($class){
        return new $class();
    }
}

// /*
// Plugin Name: practice plugin
// Plugin URI: https://www.mrobinsonwebdev.com
// Description: practice mcpracticeface
// Version: 0.1
// Author: Mike Robinson
// Author URI: https://www.mrobinsonwebdev.com
// */


// /*If access is attempted through any other means than the
// wordpress file system, terminate the process*/
// if (!defined('ABSPATH')) {
//     die;
// }

// if( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
//     require_once dirname( __FILE__ ) . '/vendor/autoload.php';
// };



// use PluginConfig\Base\Activate;
// use PluginConfig\Base\Deactivate;
// use PluginConfig\Pages\AdminPage;

// class pluginPractice
// {

//     //function types

//     //public: DEFAULT - can be access anywhere


//     //protected: can only be accessed inside the class or a class that extends the main parent class

//     //private: can only be accessed by the class itself, not an extension

//     //static method allows you to use the method without initialising the class
//     //e.g: we can call it without doing $practicePlugin = new pluginPractice();
//     //instead, we use pluginPractice::methodName(); - remember that $this wont work as expected,
//     //its not bound into its object with static methods


//     //constructor: the method which accepts parameters for arguments
//     public $pluginName;
//     function __construct(){
//         $this->pluginName = plugin_basename( __FILE__ );
//     }


//     function register()
//     {
//         add_action('admin_enqueue_scripts', array($this, 'enqueue'));

//         AdminPage::sendData();

//         add_filter( "plugin_action_links_$this->pluginName", array( $this, 'settings_links' ) );
//     }


//      public function settings_links( $links ){
//         $settingsLink = '<a href="admin.php?page=plugin_practice">Settings</a>';
//         array_push($links, $settingsLink);
//         return $links;
//      }

//     function activate()
//     {
//      Activate::activate();
//     }

//     function deactivate()
//     {
//     Deactivate::deactivate();
//     }

//     function enqueue()
//     {
//         wp_enqueue_style('mystyle', plugins_url('/style/mystyle.css', __FILE__));
//         wp_enqueue_script('script', plugins_url('/script/script.js', __FILE__));
//     }
// }

// //to use class we need to instanciate the class and store it inside a variable
// if (class_exists('pluginPractice')) {
//     $practicePlugin = new pluginPractice();
//     $practicePlugin->register();
// }



// //lifecycle functions
// // to access the private function, add an array as second paratemeter containing the class instance and the function name
// //activate
// register_activation_hook(__FILE__, array($practicePlugin, 'activate'));
// //deactivate
// register_deactivation_hook(__FILE__, array($practicePlugin, 'deactivate'));
