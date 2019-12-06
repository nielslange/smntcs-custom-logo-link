<?php
/**
 * Plugin Name: SMNTCS Custom Logo Link
 * Plugin URI: https://github.com/nielslange/smntcs-custom-logo-link
 * Description: Allows to customize the logo link
 * Author: Niels Lange <info@nielslange.de>
 * Author URI: https://nielslange.de
 * Text Domain: smntcs-custom-logo-link
 * Version: 1.5
 * Requires at least: 3.4
 * Tested up to: 5.2
 * Requires PHP: 5.6
 * License: GPL3+
 * License URI: https://www.gnu.org/licenses/gpl.html
 *
 * @category   Plugin
 * @package    WordPress
 * @subpackage SMNTCS Custom Logo Link
 * @author     Niels Lange <info@nielslange.de>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

/**
 * Avoid direct plugin access
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '¯\_(ツ)_/¯' );
}

/**
 * Load text domain
 *
 * @since 1.0.0
 */
function smntcs_custom_logo_link_load_textdomain() {
	load_plugin_textdomain( 'smntcs-custom-logo-link', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'smntcs_custom_logo_link_load_textdomain' );

/**
 * Add Google Search Console code to WordPress Customizer
 *
 * @param WP_Customize_Manager $wp_customize The instance of WP_Customize_Manager.
 * @return void
 * @since 1.0.0
 */
function smntcs_custom_logo_link_register_customize( $wp_customize ) {
	$wp_customize->add_section(
		'smntcs_custom_logo_link_section',
		array(
			'priority' => 200,
			'title'    => __( 'Logo Link', 'smntcs-custom-logo-link' ),
		)
	);

	$wp_customize->add_setting(
		'smntcs_custom_logo_link_url',
		array(
			'type'              => 'option',
			'sanitize_callback' => 'smntcs_custom_logo_link_sanitize_url',
		)
	);

	$wp_customize->add_control(
		'smntcs_custom_logo_link_url',
		array(
			'label'       => __( 'URL', 'smntcs-custom-logo-link' ),
			'section'     => 'smntcs_custom_logo_link_section',
			'type'        => 'url',
			'input_attrs' => array(
				'placeholder' => __( 'http://www.google.com' ),
			),
		)
	);

	$wp_customize->add_setting(
		'smntcs_custom_logo_link_target',
		array(
			'default' => false,
			'type'    => 'option',
		)
	);

	$wp_customize->add_control(
		'smntcs_custom_logo_link_target',
		array(
			'label'   => __( 'Open link in new window', 'smntcs-custom-logo-link' ),
			'section' => 'smntcs_custom_logo_link_section',
			'type'    => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'smntcs_custom_logo_link_register_customize' );

/**
 * Sanitize URL
 *
 * @param string $url The original URL.
 * @return string $url The updated URL.
 * @since 1.0.0
 */
function smntcs_custom_logo_link_sanitize_url( $url ) {
	return esc_url_raw( $url );
}

/**
 * Add settings link on plugin page
 *
 * @param string $links The original settings link on the plugin page.
 * @return string $links The updated settings link on the plugin page.
 * @since 1.0.0
 */
function smntcs_custom_logo_link_settings_link( $links ) {
	$admin_url     = admin_url( 'customize.php?autofocus[control]=smntcs_custom_logo_link_url' );
	$settings_link = '<a href="' . $admin_url . '">' . __( 'Settings', 'smntcs-custom-logo-link' ) . '</a>';
	array_unshift( $links, $settings_link );

	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'smntcs_custom_logo_link_settings_link' );

/**
 * Customize logo link (if valid URL had been provided)
 *
 * @return void
 * @since 1.5.0
 */
function smntcs_custom_logo_link_enqueue() {
	switch ( get_template() ) {
		case 'storefront':
		case 'twentynineteen':
		case 'twentyseventeen':
		case 'twentysixteen':
		case 'twentyfifteen':
			require_once 'themes/twenty.php';
			break;
		case 'sydney':
			require_once 'themes/sydney.php';
			break;
	}
}
add_action( 'wp_head', 'smntcs_custom_logo_link_enqueue' );
