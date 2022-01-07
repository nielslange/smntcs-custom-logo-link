<?php
/**
 * Plugin Name: SMNTCS Custom Logo Link
 * Plugin URI: https://github.com/nielslange/smntcs-custom-logo-link
 * Description: Allows to customize the logo link
 * Author: Niels Lange <info@nielslange.de>
 * Author URI: https://nielslange.de
 * Text Domain: smntcs-custom-logo-link
 * Version: 1.15
 * Requires at least: 3.4
 * Requires PHP: 5.6
 * Tested up to: 5.7
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
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '¯\_(ツ)_/¯' );
}

/**
 * Load text domain
 */
function smntcs_custom_logo_link_load_textdomain() {
	load_plugin_textdomain( 'smntcs-custom-logo-link', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'smntcs_custom_logo_link_load_textdomain' );

/**
 * Add custom link section to WordPress Customizer
 *
 * @param WP_Customize_Manager $wp_customize The instance of WP_Customize_Manager.
 * @return void
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
				// phpcs:ignore WordPress.WP.I18n.MissingArgDomain
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
 */
function smntcs_custom_logo_link_sanitize_url( $url ) {
	return esc_url_raw( $url );
}

/**
 * Add settings link on plugin page
 *
 * @param array $links The original array with customizer links.
 * @return array The updated array with customizer links.
 */
function smntcs_custom_logo_link_settings_link( array $links ) {
	$admin_url     = admin_url( 'customize.php?autofocus[control]=smntcs_custom_logo_link_url' );
	$settings_link = sprintf( '<a href="%s">' . __( 'Settings', 'smntcs-custom-logo-link' ) . '</a>', $admin_url );
	array_unshift( $links, $settings_link );

	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'smntcs_custom_logo_link_settings_link' );

/**
 * Customize logo link (if valid URL had been provided)
 *
 * @return void
 */
function smntcs_custom_logo_link_enqueue() {
	switch ( get_template() ) {
		case 'astra':
			require_once plugin_dir_path( __FILE__ ) . 'themes/astra.php';
			break;
		case 'atomic-blocks':
			require_once plugin_dir_path( __FILE__ ) . 'themes/atomic-blocks.php';
			break;
		case 'blocksy':
			require_once plugin_dir_path( __FILE__ ) . 'themes/blocksy.php';
			break;
		case 'colormag':
			require_once plugin_dir_path( __FILE__ ) . 'themes/colormag.php';
			break;
		case 'education-hub':
			require_once plugin_dir_path( __FILE__ ) . 'themes/education-hub.php';
			break;
		case 'generatepress':
			require_once plugin_dir_path( __FILE__ ) . 'themes/generatepress.php';
			break;
		case 'hello-elementor':
			require_once plugin_dir_path( __FILE__ ) . 'themes/hello-elementor.php';
			break;
		case 'hestia':
			require_once plugin_dir_path( __FILE__ ) . 'themes/hestia.php';
			break;
		case 'neve':
			require_once plugin_dir_path( __FILE__ ) . 'themes/neve.php';
			break;
		case 'nevertheless':
			require_once plugin_dir_path( __FILE__ ) . 'themes/nevertheless.php';
			break;
		case 'oceanwp':
			require_once plugin_dir_path( __FILE__ ) . 'themes/oceanwp.php';
			break;
		case 'shapely':
			require_once plugin_dir_path( __FILE__ ) . 'themes/shapely.php';
			break;
		case 'suffice':
			require_once plugin_dir_path( __FILE__ ) . 'themes/suffice.php';
			break;
		case 'storefront':
			require_once plugin_dir_path( __FILE__ ) . 'themes/storefront.php';
			break;
		case 'sydney':
			require_once plugin_dir_path( __FILE__ ) . 'themes/sydney.php';
			break;
		case 'twentyfifteen':
		case 'twentysixteen':
		case 'twentyseventeen':
		case 'twentynineteen':
		case 'twentytwenty':
			require_once plugin_dir_path( __FILE__ ) . 'themes/twenty.php';
			break;
		case 'xi-portfolio':
			require_once plugin_dir_path( __FILE__ ) . 'themes/xi-portfolio.php';
			break;
		default:
			require_once plugin_dir_path( __FILE__ ) . 'themes/default.php';
			break;
	}

}
add_action( 'wp_head', 'smntcs_custom_logo_link_enqueue' );
