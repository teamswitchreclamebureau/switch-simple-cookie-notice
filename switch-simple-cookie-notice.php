<?php

/**
 * @package Switch - Simple Cookie Notice
 */

 /**

	Plugin name: Switch - Simple Cookie Notice
	Plugin URI: https://github.com/RLKevin/switch-simple-cookie-notice
	Description: Simple cookie notice plugin for Wordpress, made by Team Switch Reclamebureau
	Version: 0.4.2
	Author: Team Switch
	Author URI: https://teamswitch.nl/

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

			if (function_exists('icl_t')) {
				@$cookie_title = icl_t( WEBSQUAD_COOKIES_TEXT_DOMAIN, 'Cookie Title 0', $websquad_cookies_settings_options['cookie_title_0'] );
				@$cookie_text = icl_t( WEBSQUAD_COOKIES_TEXT_DOMAIN, 'Cookie Text 0', $websquad_cookies_settings_options['cookie_text_0'] );
				@$cookie_button_1 = icl_t( WEBSQUAD_COOKIES_TEXT_DOMAIN, 'Button Text 1', $websquad_cookies_settings_options['button_text_1'] );
				@$cookie_button_2 = icl_t( WEBSQUAD_COOKIES_TEXT_DOMAIN, 'Button Text 2', $websquad_cookies_settings_options['button_text_2'] );
				// $cookie_button_3 = icl_t( WEBSQUAD_COOKIES_TEXT_DOMAIN, 'Button Text 3', $websquad_cookies_settings_options['button_text_3'] );
			} else {
				$cookie_title = $websquad_cookies_settings_options['cookie_title_0'];
				$cookie_text = $websquad_cookies_settings_options['cookie_text_0'];
				$cookie_button_1 = $websquad_cookies_settings_options['button_text_1'];
				$cookie_button_2 = $websquad_cookies_settings_options['button_text_2'];
				// $cookie_button_3 = $websquad_cookies_settings_options['button_text_3'];
			}

			echo '
			<div class="cookie-notice disabled">
				<img src="' . plugin_dir_url( __FILE__ ) . '/cookie.svg" alt="">
				<div>
					<p>
						<strong>'. $cookie_title . '</strong>
					</p>
					<p>'. $cookie_text . '</p>
				</div>
				<div class="cookie-buttons">
					<button id="cookiebuttonAccept" class="button accepted">'. $cookie_button_1 . '</button>
					<button id="cookiebuttonDecline" class="button declined">'. $cookie_button_2 . '</button>
					<span>Powered by <a href="https://teamswitch.nl" target="_blank">Team Switch</a>.</span>
				</div>
			</div>
			';
		}
		add_action('wp_footer', 'addToFooter', 10);


		function addToHead(){
			echo '
			<script>
				console.log("Switch - Simple Cookie Notice is active");

				// Set up Google Analytics gtag
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}

				function getCookie(name) {
					var nameEQ = name + "=";
					var ca = document.cookie.split(";");
					for (var i = 0; i < ca.length; i++) {
						var c = ca[i];
						while (c.charAt(0) === " ") c = c.substring(1, c.length);
						if (c.indexOf(nameEQ) === 0)
							return c.substring(nameEQ.length, c.length);
					}
					return null;
				}

				if (getCookie("cookies-ok")) {
					var consent = "granted";
				}else{
					var consent = "denied";
				}

				// Set default consent to "denied" as a placeholder
				// Determine actual values based on your own requirements
				gtag("consent", "default", {
					"ad_storage": consent,
					"ad_user_data": consent,
					"ad_personalization": consent,
					"analytics_storage": consent,
					"functionality_storage": consent,
					"personalization_storage": consent,
					"security_storage": "granted"
				});
			</script>
			<link rel="stylesheet" href="' . plugin_dir_url( __FILE__ ) . '/css/style.css" type="text/css">
			';
		}

		// function add_action_to_head(){
			add_action('wp_head', 'addToHead', 1 );
		// }

		// add_action('acf/init', 'add_action_to_head', 1 );

		function my_custom_script_load(){
			wp_enqueue_script( 'websquad-cookies-script', plugin_dir_url( __FILE__ ) . '/switch-cookies.js', array( 'jquery' ) );
		}
		add_action( 'wp_enqueue_scripts', 'my_custom_script_load', 1 );
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