<?php
/**
 * Handle custom logo link for ColorMag theme
 *
 * ✅ ColorMag: https://wordpress.org/themes/colormag/

 * @category   Plugin
 * @package    WordPress
 * @subpackage SMNTCS Custom Logo Link
 * @author     Niels Lange <info@nielslange.de>, Derek Smith <derek@timbre-design.com>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

if ( get_option( 'smntcs_custom_logo_link_url' ) ) { ?>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Site title link.
			if ( document.querySelector("#site-title a") ) {
				document.querySelector("#site-title a").setAttribute("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
			}
			// Site logo link.
			if ( document.querySelector("a.custom-logo-link") ) {
				document.querySelector("a.custom-logo-link").setAttribute("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
			}
		});
	</script>
	<?php
	if ( get_option( 'smntcs_custom_logo_link_target' ) ) {
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				// Site title link.
				if ( document.querySelector("#site-title a") ) {
					document.querySelector("#site-title a").setAttribute("target", "_blank");
				}
				// Site logo link.
				if ( document.querySelector("a.custom-logo-link") ) {
					document.querySelector("a.custom-logo-link").setAttribute("target", "_blank");
				}
			});
		</script>
		<?php
	} else {
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				// Site logo link.
				if ( document.querySelector("a.custom-logo-link") ) {
					document.querySelector("a.custom-logo-link").setAttribute("target", "_self");
				}
				// Site title link.
				if ( document.querySelector("#site-title a") ) {
					document.querySelector("#site-title a").setAttribute("target", "_self");
				}
			});
		</script>
		<?php
	}
}
