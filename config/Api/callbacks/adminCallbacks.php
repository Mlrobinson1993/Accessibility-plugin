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

 require_once (__DIR__) . '/../../Base/BaseController.php';

class AdminCallbacks extends BaseController
{
    public function adminDashboard(){
        return require_once( "$this->plugin_path/templates/admin.php" );
    }

    public function a11yAdminSection(){
        echo "<h3 class='page-url'>url:<span class='light'></span></h3>
         <h3 class='accessibility-errors'>Accessibility errors:<span class='light'>0</span></h3>
         <h3 class='accessibility-score'>___ of your website's elements are accessible</h3>";
    }

}