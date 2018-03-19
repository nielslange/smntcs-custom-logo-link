<?php
/*
Plugin Name: SMNTCS Custom Logo Link
Description: Allows to customize the logo link
Author: Niels Lange
Author URI: https://nielslange.com
Text Domain: smntcs-custom-logo-link
Domain Path: /languages/
Version: 1.0
Requires at least: 3.0
Tested up to: 4.9
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

/*  Copyright 2014-2016	Niels Lange (email : info@nielslange.de)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Avoid direct plugin access
if ( !defined( 'ABSPATH' ) ) exit;

// Load text domain
add_action('plugins_loaded', 'smntcs_custom_logo_link_load_textdomain');
function smntcs_custom_logo_link_load_textdomain() {
	load_plugin_textdomain( 'smntcs-custom-logo-link', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

// Add Google Search Console code to WordPress Customizer
add_action( 'customize_register', 'smntcs_custom_logo_link_register_customize' );
function smntcs_custom_logo_link_register_customize( $wp_customize ) {
	$wp_customize->add_section( 'smntcs_custom_logo_link_section', array(
		'priority' 			=> 200,
		'title' 			=> __('Logo Link', 'smntcs-custom-logo-link'),
	));

	$wp_customize->add_setting( 'smntcs_custom_logo_link_url', array(
		'type'				=> 'option',
		'sanitize_callback' => 'themeslug_sanitize_url',
	));

	$wp_customize->add_control( 'smntcs_custom_logo_link_url', array(
		'label' 			=> __('URL', 'smntcs-custom-logo-link'),
		'section' 			=> 'smntcs_custom_logo_link_section',
		'type' 				=> 'url',
		'input_attrs' 		=> array(
			'placeholder' 	=> __( 'http://www.google.com' ),
		),
	));

	$wp_customize->add_setting( 'smntcs_custom_logo_link_target', array(
		'default' 			=> false,
		'type'				=> 'option',
	));

	$wp_customize->add_control( 'smntcs_custom_logo_link_target', array(
		'label' 			=> __('Open link in new window', 'smntcs-custom-logo-link'),
		'section' 			=> 'smntcs_custom_logo_link_section',
		'type' 				=> 'checkbox',
	));
	function themeslug_sanitize_url( $url ) {
		return esc_url_raw( $url );
	}
}

// Add settings link on plugin page
add_filter("plugin_action_links_" . plugin_basename(__FILE__), 'smntcs_custom_logo_link_settings_link' );
function smntcs_custom_logo_link_settings_link($links) {
	$admin_url = admin_url( 'customize.php?autofocus[control]=smntcs_custom_logo_link_url' );
	$settings_link =  '<a href="' . $admin_url . '">' . __('Settings', 'smntcs-custom-logo-link') . '</a>';
	array_unshift($links, $settings_link);
	return $links;
}

// Customize logo link (if valid URL had been provided)
add_action('wp_head', 'smntcs_custom_logo_link_enqueue');
function smntcs_custom_logo_link_enqueue() {
	if ( get_option('smntcs_custom_logo_link_url') ) { ?>
        <script>
          jQuery(document).ready( function($){
            $(".custom-logo-link").attr("href", "<?php print(get_option('smntcs_custom_logo_link_url')); ?>");
            $(".site-title > a").attr("href", "<?php print(get_option('smntcs_custom_logo_link_url')); ?>");
          });
        </script> <?php
        if ( get_option('smntcs_custom_logo_link_url') ) { ?>
            <script>
              jQuery(document).ready( function($){
                $(".custom-logo-link").attr("target", "_blank");
                $(".site-title > a").attr("target", "_blank");
              });
            </script> <?php
		}
	}
}
