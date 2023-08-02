<?php

/**
 * @package Switch - Simple Cookie Notice
 */

 /**

	Plugin name: Switch - Simple Cookie Notice
	Plugin URI: https://github.com/RLKevin/switch-simple-cookie-notice
	Description: Simple cookie notice plugin for Wordpress, made by Team Switch Reclamebureau
	Version: 0.3.0
	Author: Kevin van Nieukerke
	Author URI: https://kevinvn.nl/

  */
  define( 'WEBSQUAD_COOKIES_TEXT_DOMAIN', 'websquad-cookies' );

if (!defined('ABSPATH')) {
	die;
}

class SwitchCookies {
	
	function __construct() {
		@require_once 'settings.php';

		function addToFooter() {
			$websquad_cookies_settings_options = get_option( 'websquad_cookies_settings_option_name' );
			$cookie_text = $websquad_cookies_settings_options['cookie_text_0'];
			$translated_cookie_text = icl_t( WEBSQUAD_COOKIES_TEXT_DOMAIN, 'Cookie Text 0', $websquad_cookies_settings_options['cookie_text_0'] );
			$cookie_button_text = $websquad_cookies_settings_options['button_text_1'];
			$translated_cookie_button_text = icl_t( WEBSQUAD_COOKIES_TEXT_DOMAIN, 'Button Text 1', $websquad_cookies_settings_options['button_text_1'] );
			$cookie_button_classes = $websquad_cookies_settings_options['button_classes_2'];
			$optional_cookie_button_text = $websquad_cookies_settings_options['button_text_3'];
			$translated_optional_cookie_button_text = icl_t( WEBSQUAD_COOKIES_TEXT_DOMAIN, 'Button Text 3', $websquad_cookies_settings_options['button_text_3'] );
			$optional_cookie_button_classes = $websquad_cookies_settings_options['button_classes_4'];
			$optional_cookie_url = $websquad_cookies_settings_options['button_url_5'];

			if ($optional_cookie_button_text) {
				echo '<div class="switchcookie disabled"><p>'.$translated_cookie_text.'</p><a class="'.$optional_cookie_button_classes.'" href="'.$optional_cookie_url.'" target="_blank">'.$translated_optional_cookie_button_text.'</a><a class="button '.$cookie_button_classes.'" id="switchcookiebutton">'.$translated_cookie_button_text.'</a></div>';
			} else {
				echo '<div class="switchcookie disabled"><p>'.$translated_cookie_text.'</p><a class="button '.$cookie_button_classes.'" id="switchcookiebutton">'.$translated_cookie_button_text.'</a></div>';
			}

		}
		add_action( 'wp_footer', 'addToFooter', 100 );

		function my_custom_script_load(){
			wp_enqueue_script( 'websquad-cookies-script', plugin_dir_url( __FILE__ ) . '/switch-cookies.js', array( 'jquery' ) );
		}
		add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );
	}

	function activate() {
		// echo "Thank you for using Switch - Simple Cookie Notice.";
	}

	function deactivate() {

	}

	function uninstall() {

	}
}

// initialize plugin
if (class_exists('SwitchCookies')) {
	$switchCookies = new SwitchCookies();
}

// activate hook
register_activation_hook( __FILE__, array( $switchCookies , 'activate' ) );

// deactivate hook
register_deactivation_hook( __FILE__, array( $switchCookies , 'deactivate' ) );