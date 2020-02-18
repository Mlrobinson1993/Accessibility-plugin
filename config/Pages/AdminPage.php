<?php

namespace PluginConfig\Pages;

use \PluginConfig\Base\BaseController;

class AdminPage extends BaseController {


    public function register(){
        add_action( 'admin_menu', array( $this, 'add_admin_pages') );
    }

    public function add_admin_pages(){
        add_menu_page( 'Practice Plugin','Practice', 'manage_options', 'practice_plugin', array($this, 'admin_index'), 'dashicons-store', 110 );
    }

    public function admin_index(){
        require_once $this->plugin_path . '/templates/admin.php';
    }

}