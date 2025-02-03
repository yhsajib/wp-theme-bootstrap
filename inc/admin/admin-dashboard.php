<?php
/**
* The yhsshu_Admin_Dashboard base class
*/

if( !defined( 'ABSPATH' ) )
	exit; 

class yhsshu_Admin_Dashboard extends yhsshu_Admin_Page {

	public function __construct() {
		$this->id = 'yhsshu';
		$this->page_title = yhsshu()->get_name();
		$this->menu_title = yhsshu()->get_name();
		$this->position = '50';

		parent::__construct();
	}

	public function display() {
		include_once( get_template_directory() . '/inc/admin/views/admin-dashboard.php' );
	}
 
	public function save() {

	}
}
new yhsshu_Admin_Dashboard;
