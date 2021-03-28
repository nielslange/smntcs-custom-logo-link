<?php
/**
 * Handle custom logo link for GeneratePress theme
 *
 * ✅ GeneratePress: https://wordpress.org/themes/generatepress/

 * @category   Plugin
 * @package    WordPress
 * @subpackage SMNTCS Custom Logo Link
 * @author     Niels Lange <info@nielslange.de>, Derek Smith <derek@timbre-design.com>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

if ( get_option( 'smntcs_custom_logo_link_url' ) ) { ?>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			if ( document.querySelector(".main-title a") ) {
				document.querySelector(".main-title a").setAttribute("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
			}
			if ( document.querySelector(".site-logo a") ) {
				document.querySelector(".site-logo a").setAttribute("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
			}
		});
	</script>
	<?php
	if ( get_option( 'smntcs_custom_logo_link_target' ) ) {
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				if ( document.querySelector(".main-title a") ) {
					document.querySelector(".main-title a").setAttribute("target", "_blank");
				}
				if ( document.querySelector(".site-logo a") ) {
					document.querySelector(".site-logo a").setAttribute("target", "_blank");
				}
			});
		</script>
		<?php
	} else {
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				if ( document.querySelector(".main-title a") ) {
					document.querySelector(".main-title a").setAttribute("target", "_self");
				}
				if ( document.querySelector(".site-logo a") ) {
					document.querySelector(".site-logo a").setAttribute("target", "_self");
				}
			});
		</script>
		<?php
	}
}
