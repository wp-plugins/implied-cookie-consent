<?php
/*
Plugin Name: Implied Cookie Consent
Plugin URI: http://wordpress.org/extend/plugins/implied-cookie-consent
Description: Displays an unobtrusive cookie information bar when a user first visits the site.
Version: 1.2
Author: Stefan Senk
Author URI: http://www.senktec.com
License: GPL2


Copyright 2014  Stefan Senk  (email : info@senktec.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once plugin_dir_path(__FILE__) . 'icc-admin.php';
register_activation_hook(__FILE__, 'icc_activation');

add_action('wp_enqueue_scripts', function(){
	wp_enqueue_script( 'jquery' );

	wp_register_script('jquery_cookie_js', plugins_url('jquery.cookie.js', __FILE__ ));
	wp_enqueue_script('jquery_cookie_js');

	wp_register_script('implied_cookie_consent_js', plugins_url('implied-cookie-consent.js', __FILE__ ));
	wp_enqueue_script('implied_cookie_consent_js');

	wp_register_style('implied_cookie_consent_css', plugins_url('implied-cookie-consent.css', __FILE__ ));
	wp_enqueue_style('implied_cookie_consent_css');
});

add_action('wp_footer', function(){
	$options = get_option( 'implied_cookie_consent' );
	$html = '<div id="icc_message" style="background-color: ' . $options['bgcolor'] . ';">' . do_shortcode( stripslashes( $options['message'] ) ) . '</div>';
	echo apply_filters('icc_message_html', $html);
});

add_shortcode('icc_dismiss', function() {
	$html = '<span class="icc_dismiss_button">&#9746;</span>';
	return apply_filters('icc_dismiss_button', $html);
});

add_shortcode('icc_delete', function() {
	$html = '<span class="icc_delete_button">' . __('Delete cookies and leave', 'implied-cookie-consent' ) . '</span>';
	return apply_filters('icc_delete_button', $html);
});

