<?php
/**
 * Handle default custom logo link for the following themes:
 *
 * ✅ https://wordpress.org/themes/astra/
 * ✅ https://wordpress.org/themes/customify/
 * ✅ https://wordpress.org/themes/education-hub/
 * ✅ https://wordpress.org/themes/hello-elementor/
 * ✅ https://wordpress.org/themes/nevertheless/
 * ✅ https://wordpress.org/themes/storefront/
 * ✅ https://wordpress.org/themes/suffice/
 * ✅ https://wordpress.org/themes/twentyfifteen/
 * ✅ https://wordpress.org/themes/twentysixteen/
 * ✅ https://wordpress.org/themes/twentyseventeen/
 * ✅ https://wordpress.org/themes/twentynineteen/
 * ✅ https://wordpress.org/themes/twentytwenty/
 * ✅ https://wordpress.org/themes/xi-portfolio/
 *
 * @category   Plugin
 * @package    WordPress
 * @subpackage SMNTCS Custom Logo Link
 * @author     Niels Lange <info@nielslange.de>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

if ( get_option( 'smntcs_custom_logo_link_url' ) ) { ?>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			if ( document.querySelector(".site-title a") ) {
				const links = document.querySelectorAll(".site-title a");
				links.forEach(link => link.setAttribute("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>"));
			}
			if ( document.querySelector("a.custom-logo-link") ) {
				const links = document.querySelectorAll("a.custom-logo-link");
				links.forEach(link => link.setAttribute("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>"));
			}
		});
	</script>
	<?php
	if ( get_option( 'smntcs_custom_logo_link_target' ) ) {
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				if ( document.querySelector(".site-title a") ) {
					const links = document.querySelectorAll(".site-title a");
					links.forEach( link => link.setAttribute("target", "_blank"));
				}
				if (document.querySelector("a.custom-logo-link")) {
					const links = document.querySelectorAll("a.custom-logo-link");
					links.forEach( link => link.setAttribute("target", "_blank"));
				}
			});
		</script>
		<?php
	} else {
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				if ( document.querySelector(".site-title a") ) {
					const links = document.querySelectorAll(".site-title a");
					links.forEach( link => link.setAttribute("target", "_self"));
				}
				if (document.querySelector("a.custom-logo-link")) {
					const links = document.querySelectorAll("a.custom-logo-link");
					links.forEach( link => link.setAttribute("target", "_self"));
				}
			});
		</script>
		<?php
	}
}
