<?php

require_once (__DIR__) . '/../Api/SettingsApi.php';
require_once (__DIR__) . '/../Base/BaseController.php';
require_once (__DIR__) . '/../Api/callbacks/adminCallbacks.php';

class AdminPage extends BaseController
    {
	public $settings;

    public $pages = array();

    public $callbacks;

	public $subpages = array();

	public function register()
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new adminCallbacks();

		$this->setPages();

		$this->setSettings();

		$this->setSections();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();

    }

    public function setPages(){
        	$this->pages = array(
			array(
				'page_title' => 'A11Y Plugin',
				'menu_title' => 'A11Y',
				'capability' => 'manage_options',
				'menu_slug' => 'a11y_plugin',
				'callback' => array($this->callbacks, 'adminDashboard'),
				'icon_url' => 'dashicons-admin-site',
				'position' => 110
			)
		);
	}


	public function setSettings(){
		$args = array(
			array(
				'option_group' => 'a11y_headings',
				'option_name' => 'page_headings',
				'callback' => array( $this->callbacks, 'a11yHeadings' )
 			)
			);

		$this->settings->setSettings( $args );
	}

	public function setSections(){

		$args = array(
			array(
				'id' => 'a11y_admin_index',
				'title' => 'Accessibility Score',
				'callback' => array( $this->callbacks, 'a11yAdminSection' ),
				'page' => 'a11y_plugin'
				)
			);

				$this->settings->setSections( $args );
	}

}


