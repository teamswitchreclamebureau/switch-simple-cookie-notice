<?php

/**
 * @package WebSquad Cookies
 */

 /**

	Plugin name: WebSquad Cookies
	Plugin URI: https://websquad.nl/
	Description: Cookie notice for WebSquad websites
	Version: 0.0.1
	Author: Switch Reclamebureau
	Author URI: https://switchreclamebureau.nl/

  */

if (!defined('ABSPATH')) {
	die;
}

class WebsquadCookies {
	
	function __construct() {
		@require_once 'settings.php';

		function addToFooter() {
			$websquad_cookies_settings_options = get_option( 'websquad_cookies_settings_option_name' );
			$cookie_text = $websquad_cookies_settings_options['cookie_text_0'];
			$cookie_button_text = $websquad_cookies_settings_options['button_text_1'];
			$cookie_button_classes = $websquad_cookies_settings_options['button_classes_2'];
			echo '<div class="switchcookie disabled"><p>'.$cookie_text.'</p><a class="button '.$cookie_button_classes.'" id="switchcookiebutton">'.$cookie_button_text.'</a></div>';
		}
		add_action( 'wp_footer', 'addToFooter', 100 );

		function my_custom_script_load(){
			wp_enqueue_script( 'websquad-cookies-script', plugin_dir_url( __FILE__ ) . '/websquad-cookies.js', array( 'jquery' ) );
		}
		add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );
	}

	function activate() {
		echo "Thank you for using WebSquad Cookies.";
	}

	function deactivate() {

	}

	function uninstall() {

	}
}

// initialize plugin
if (class_exists('WebsquadCookies')) {
	$websquadCookies = new WebsquadCookies();
}

// activate hook
register_activation_hook( __FILE__, array( $websquadCookies , 'activate' ) );

// deactivate hook
register_deactivation_hook( __FILE__, array( $websquadCookies , 'deactivate' ) );