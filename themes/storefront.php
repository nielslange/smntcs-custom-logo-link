<?php
/**
 * Handle custom logo link for Storefront themes
 *
 * ✅ Storefront:        https://wordpress.org/themes/storefront/
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
				document.querySelector(".site-title a").setAttribute("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
			}
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
				if ( document.querySelector(".site-title a") ) {
					document.querySelector(".site-title a").setAttribute("target", "_blank");
				}
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
				if ( document.querySelector(".site-title a") ) {
					document.querySelector(".site-title a").setAttribute("target", "_self");
				}
				if ( document.querySelector("a.custom-logo-link") ) {
					document.querySelector("a.custom-logo-link").setAttribute("target", "_self");
				}
			});
		</script> 
		<?php
	}
}
