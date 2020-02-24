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

class SettingsLinks extends BaseController
{
    public function register(){
        add_filter( "plugin_action_links_" . $this->plugin, array( $this, 'settings_links' ) );
    }



     public function settings_links( $links ){
        $settingsLink = '<a href="admin.php?page=a11y_plugin">Settings</a>';
        array_push($links, $settingsLink);
        return $links;
     }


}
