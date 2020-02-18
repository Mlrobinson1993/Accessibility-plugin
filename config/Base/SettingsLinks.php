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

use \PluginConfig\Base\BaseController;

class SettingsLinks extends BaseController
{
    public function register(){
        add_filter( "plugin_action_links_" . $this->plugin, array( $this, 'settings_links' ) );
    }



     public function settings_links( $links ){
        $settingsLink = '<a href="admin.php?page=practice_plugin">Settings</a>';
        array_push($links, $settingsLink);
        return $links;
     }


}
