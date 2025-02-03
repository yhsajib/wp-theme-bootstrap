<?php

if( !defined( 'ABSPATH' ) )
	exit; 

class yhsshu_Admin_Templates extends yhsshu_Base{

	public function __construct() {
		$this->add_action( 'admin_menu', 'register_page', 20 );
	}
 
	public function register_page() {
		add_submenu_page(
			'yhsshu',
		    esc_html__( 'Templates', 'yhsshu' ),
		    esc_html__( 'Templates', 'yhsshu' ),
		    'manage_options',
		    'edit.php?post_type=yhsshu-template',
		    false
		);
	}
}
new yhsshu_Admin_Templates;
