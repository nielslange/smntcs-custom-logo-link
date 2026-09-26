<?php
/**
 * Plugin Name:         SMNTCS Custom Logo Link
 * Plugin URI:          https://github.com/nielslange/smntcs-custom-logo-link
 * Description:         Points the site logo and site title to any URL you choose instead of the home page.
 * Author:              Niels Lange <info@nielslange.de>
 * Author URI:          https://nielslange.de
 * Text Domain:         smntcs-custom-logo-link
 * Version:             2.5
 * Requires at least:   5.7
 * Requires PHP:        7.4
 * License:             GPL v2 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package SMNTCS_Custom_Logo_Link
 */

defined( 'ABSPATH' ) || exit;

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
			'description' => __( 'A full URL such as https://example.com, or a relative one such as /en/ or a single dot for the current directory.', 'smntcs-custom-logo-link' ),
			'type'        => 'text',
			'input_attrs' => array(
				'placeholder' => 'https://example.com',
			),
		)
	);

	$wp_customize->add_setting(
		'smntcs_custom_logo_link_target',
		array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => 'wp_validate_boolean',
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
 * Full URLs go through esc_url_raw(). Relative URLs that start with a dot,
 * a slash, a question mark or a hash are kept as they are, minus any
 * characters that are not allowed in a URL.
 *
 * @param string $url The original URL.
 * @return string $url The updated URL.
 */
function smntcs_custom_logo_link_sanitize_url( $url ) {
	$url = trim( (string) $url );

	if ( '' === $url ) {
		return '';
	}

	if ( preg_match( '#^(\.{1,2}(/|$)|/(?!/)|\?|\#)#', $url ) ) {
		return (string) preg_replace( '#[^a-z0-9\-~+_.?\#=!&;,/:%@$|*()\[\]]#i', '', $url );
	}

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
 * Get the saved logo link URL.
 *
 * @return string The URL, or an empty string when none is set.
 */
function smntcs_custom_logo_link_get_url() {
	return smntcs_custom_logo_link_sanitize_url( (string) get_option( 'smntcs_custom_logo_link_url' ) );
}

/**
 * Get the link target.
 *
 * @return string Either _blank or _self.
 */
function smntcs_custom_logo_link_get_target() {
	return get_option( 'smntcs_custom_logo_link_target' ) ? '_blank' : '_self';
}

/**
 * Get the CSS selectors of the logo and site title links for the active theme.
 *
 * @return string[] The CSS selectors.
 */
function smntcs_custom_logo_link_get_selectors() {
	$themes = array(
		'colormag'      => array( '#site-title a', 'a.custom-logo-link' ),
		'customify'     => array( '.site-branding a', '.site-title a' ),
		'generatepress' => array( '.main-title a', '.site-logo a' ),
		'hestia'        => array( '.title-logo-wrapper a' ),
		'kadence'       => array( '.site-branding a.brand' ),
		'neve'          => array( '.site-logo a' ),
		'oceanwp'       => array( '#site-logo-inner a' ),
		'shapely'       => array( 'a.custom-logo-link' ),
		'sydney'        => array( '.site-title a' ),
		'yuki'          => array( '.yuki-site-branding a', '.site-title a' ),
	);

	$default   = array( '.site-title a', 'a.custom-logo-link', '.wp-block-site-title a', '.wp-block-site-logo a' );
	$template  = get_template();
	$selectors = $themes[ $template ] ?? $default;

	/**
	 * Filters the CSS selectors of the links that get the custom URL.
	 *
	 * @param string[] $selectors The CSS selectors.
	 * @param string   $template  The active parent theme.
	 */
	return (array) apply_filters( 'smntcs_custom_logo_link_selectors', $selectors, $template );
}

/**
 * Rewrite the first link in a piece of HTML.
 *
 * @param string $html The HTML.
 * @return string The HTML with the custom URL and target.
 */
function smntcs_custom_logo_link_rewrite_html( $html ) {
	$url = smntcs_custom_logo_link_get_url();

	if ( '' === $url || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
		return $html;
	}

	$processor = new WP_HTML_Tag_Processor( $html );
	if ( ! $processor->next_tag( array( 'tag_name' => 'A' ) ) ) {
		return $html;
	}

	$processor->set_attribute( 'href', $url );
	$processor->set_attribute( 'target', smntcs_custom_logo_link_get_target() );

	return $processor->get_updated_html();
}
add_filter( 'get_custom_logo', 'smntcs_custom_logo_link_rewrite_html' );
add_filter( 'render_block_core/site-logo', 'smntcs_custom_logo_link_rewrite_html' );
add_filter( 'render_block_core/site-title', 'smntcs_custom_logo_link_rewrite_html' );

/**
 * Update the logo links that the theme prints without core functions.
 *
 * @return void
 */
function smntcs_custom_logo_link_enqueue() {
	$url = smntcs_custom_logo_link_get_url();

	if ( '' === $url ) {
		return;
	}

	$config = array(
		'url'       => $url,
		'target'    => smntcs_custom_logo_link_get_target(),
		'selectors' => implode( ',', smntcs_custom_logo_link_get_selectors() ),
	);

	$script = sprintf(
		'document.addEventListener( "DOMContentLoaded", function () { var c = %s; document.querySelectorAll( c.selectors ).forEach( function ( a ) { a.setAttribute( "href", c.url ); a.setAttribute( "target", c.target ); if ( "_blank" === c.target && -1 === a.rel.indexOf( "noopener" ) ) { a.rel = ( a.rel + " noopener" ).trim(); } } ); } );',
		wp_json_encode( $config )
	);

	wp_print_inline_script_tag( $script, array( 'id' => 'smntcs-custom-logo-link' ) );
}
add_action( 'wp_head', 'smntcs_custom_logo_link_enqueue', 10, 0 );
