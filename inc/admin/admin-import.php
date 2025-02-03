<?php
/**
* The yhsshu_Admin_Import class
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class yhsshu_Admin_Import extends yhsshu_Admin_Page {

	public function __construct() {

		$this->id = 'yhsshu-import-demos';
		$this->page_title = esc_html__( 'Import Demos', 'yhsshu' );
		$this->menu_title = esc_html__( 'Import Demos', 'yhsshu' );
		$this->parent = 'yhsshu';
		//$this->position = '10';

		parent::__construct();
	}

	public function display() {
		include_once( get_template_directory() . '/inc/admin/views/admin-demos.php' );
	}


	public function save() {

	}
}
new yhsshu_Admin_Import;