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

final class Init {

    public function __construct(){

    }

    /*
    store all classes inside a array and returns the array of classes
    */

    public static function get_services(){
        require_once 'Pages/AdminPage.php';
        require_once 'Base/Enqueue.php';
        require_once 'Base/SettingsLinks.php';
        return [
            AdminPage::class,
            Enqueue::class,
            SettingsLinks::class,
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

    private static function instantiate($class){
        return new $class();
    }
}

