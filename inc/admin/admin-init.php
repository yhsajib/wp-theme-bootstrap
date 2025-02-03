<?php
/**
* The yhsshu_Admin initiate the theme admin
*/

if( !defined( 'ABSPATH' ) )
	exit; 
include_once get_template_directory() . '/inc/classes/class-base.php';
include_once get_template_directory() . '/inc/admin/libs/tgmpa/class-tgm-plugin-activation.php' ; 
include_once get_template_directory() . '/inc/admin/admin-require-plugins.php'; 

class yhsshu_Admin extends yhsshu_Base{

	public function __construct() {

		$this->add_action( 'init', 'init', 7 ); 
		$this->add_action( 'admin_enqueue_scripts', 'enqueue', 99 );
		$this->add_action( 'admin_init', 'save_plugins' );
		$this->add_action( 'admin_menu', 'fix_parent_menu', 999 ); 
	}

	public function init() {
		 
		// Merlin
		require_once get_template_directory() . '/inc/admin/libs/merlin/class-merlin.php';
		require_once get_template_directory() . '/inc/admin/libs/merlin/merlin-config.php';

		require_once get_template_directory() . '/inc/admin/updater/register-admin.php';
		require_once get_template_directory() . '/inc/admin/admin-page.php';
		require_once get_template_directory() . '/inc/admin/admin-dashboard.php';
		require_once get_template_directory() . '/inc/admin/admin-plugins.php' ;
		require_once get_template_directory() . '/inc/admin/admin-import.php';
		if( class_exists('yhsshutheme_Core'))
			include_once( get_template_directory() . '/inc/admin/admin-templates.php' ) ;
		
	}
 
	public function enqueue() {
		$yhsshu_server_info = apply_filters( 'yhsshu_server_info', ['api_url' => ''] ) ;
		wp_enqueue_style( 'yhsshu-dashboard', get_template_directory_uri() . '/inc/admin/assets/css/dashboard.css' );

		if ( ! did_action( 'wp_enqueue_media' ) ) {
	        wp_enqueue_media();
	    }
		wp_enqueue_script( 'yhsshu-admin', get_template_directory_uri() . '/inc/admin/assets/js/admin.js', array( 'jquery'), false, true );
		wp_localize_script( 'yhsshu-admin', 'yhsshu_admin', array(
			'ajaxurl'        => admin_url( 'admin-ajax.php' ),
			'wpnonce'        => wp_create_nonce( 'merlin_nonce' ),
			'api_url' 		 => $yhsshu_server_info['api_url'],
			'theme_slug'     => yhsshu()->get_slug()
		));
	}
	  
	public function save_plugins() {

        if ( !current_user_can( 'edit_theme_options' ) ) {
            return;
        }

		// Deactivate Plugin
        if ( isset( $_GET['yhsshu-deactivate'] ) && 'deactivate-plugin' == sanitize_text_field($_GET['yhsshu-deactivate']) ) {

			check_admin_referer( 'yhsshu-deactivate', 'yhsshu-deactivate-nonce' );

			$plugins = TGM_Plugin_Activation::$instance->plugins;

			foreach( $plugins as $plugin ) {
				if ( $plugin['slug'] == sanitize_text_field($_GET['plugin']) ) {

					deactivate_plugins( $plugin['file_path'] );

                    wp_redirect( admin_url( 'admin.php?page=' . sanitize_text_field($_GET['page']) ) );
					exit;
				}
			}
		}

		// Activate plugin
		if ( isset( $_GET['yhsshu-activate'] ) && 'activate-plugin' == sanitize_text_field($_GET['yhsshu-activate']) ) {

			check_admin_referer( 'yhsshu-activate', 'yhsshu-activate-nonce' );

			$plugins = TGM_Plugin_Activation::$instance->plugins;

			foreach( $plugins as $plugin ) {
				if ( $plugin['slug'] == sanitize_text_field($_GET['plugin']) ) {

					activate_plugin( $plugin['file_path'] );

					wp_redirect( admin_url( 'admin.php?page=' . sanitize_text_field($_GET['page']) ) );
					exit;
				}
			}
		}
    }

    public function fix_parent_menu() {

        if ( !current_user_can( 'edit_theme_options' ) ) {
            return;
        }
		 
		global $submenu;

		$submenu['yhsshu'][0][0] = yhsshu()->get_name().' '.esc_html__( 'Dashboard', 'yhsshu' );

		remove_submenu_page( 'themes.php', 'tgmpa-install-plugins' );
		remove_submenu_page( 'tools.php', 'redux-about' );
	}
}
 
new yhsshu_Admin;

