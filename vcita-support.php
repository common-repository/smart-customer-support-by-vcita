<?php
/*
Plugin Name: Smart Customer Support by vCita
Plugin URI: http://www.vcita.com
Description: No need to be online 24/7 -  add  vCita Customer Support widgets to your website to handle support by your schedule.
Version: 1.0.0
Author: vCita.com
Author URI: http://www.vcita.com
*/

/* --- Static initializer for Wordpress hooks --- */

// Check if vCita plugin already installed.
if (vcita_next_gen_check_plugin_available('vcita_widget') || vcita_next_gen_check_plugin_available('vcita_scheduler')) {
	add_action('admin_notices', 'vcita_next_gen_installed_warning');
} else {
	define('VCITA_SERVER_BASE', "www.vcita.com"); /* Don't include the protocol, added dynamically */
	define('VCITA_WIDGET_VERSION', '1.0.0');
	define('VCITA_WIDGET_PLUGIN_NAME', 'Smart Customer Support by vCita');
	define('VCITA_WIDGET_KEY', 'vcita_support');
	define('VCITA_WIDGET_API_KEY', 'WP-V-CUST');
	define('VCITA_WIDGET_MENU_NAME', 'vCita Customer Support');
	define('VCITA_WIDGET_SHORTCODE', 'vCitaCustomerSupport');
	define('VCITA_WIDGET_UNIQUE_ID', 'smart-customer-support-by-vcita');
	define('VCITA_WIDGET_UNIQUE_LOCATION', __FILE__);
	define('VCITA_WIDGET_CONTACT_FORM_WIDGET', 'false');
	define('VCITA_WIDGET_SHOW_EMAIL_PRIVACY', 'true');
	
	require_once(WP_PLUGIN_DIR."/".VCITA_WIDGET_UNIQUE_ID."/vcita-functions.php");

	
	/* --- Static initializer for Wordpress hooks --- */

	add_action('plugins_loaded', 'vcita_init');
	add_shortcode(VCITA_WIDGET_SHORTCODE,'vcita_add_contact');
	add_action('admin_menu', 'vcita_admin_actions');
	add_action('wp_head', 'vcita_add_active_engage');
}

/** 
 * Notify about other vCita plugin already available
 */ 
function vcita_next_gen_installed_warning() {
	echo "<div id='vcita-warning' class='error'><p><B>".__("vCita Plugin is already installed")."</B>".__(', please delete "<B>Meeting Scheduler by vCita</B>" or "<B>Contact Form by vCita</B>" and use the available "<B>Smart Customer Support by vCita</B>" plugin')."</p></div>";
}

/**
 * Check if the requested plugin is already available
 */
function vcita_next_gen_check_plugin_available($plugin_key) {
	$other_widget_parms = (array) get_option($plugin_key); // Check the key of the other plugin

	// Check if vCita plugin already installed.
	return (isset($other_widget_parms['version']) || 
		    isset($other_widget_parms['uid']) || 
		    isset($other_widget_parms['email']));
}
?>