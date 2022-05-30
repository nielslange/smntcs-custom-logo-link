<?php
/**
 * Handle custom logo link for the ColorMag theme
 *
 * ✅ https://wordpress.org/themes/colormag/

 * @category   Plugin
 * @package    WordPress
 * @subpackage SMNTCS Custom Logo Link
 * @author     Niels Lange <info@nielslange.de>, Derek Smith <derek@timbre-design.com>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

if ( get_option( 'smntcs_custom_logo_link_url' ) ) { ?>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			if ( document.querySelector("#site-title a") ) {
				const links = document.querySelectorAll("#site-title a");
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
				if ( document.querySelector("#site-title a") ) {
					const links = document.querySelectorAll("#site-title a");
					links.forEach( link => link.setAttribute("target", "_blank"));
				}
				if ( document.querySelector("a.custom-logo-link") ) {
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
				if ( document.querySelector("#site-title a") ) {
					const links = document.querySelectorAll("#site-title a");
					links.forEach( link => link.setAttribute("target", "_self"));
				}
				if ( document.querySelector("a.custom-logo-link") ) {
					const links = document.querySelectorAll("a.custom-logo-link");
					links.forEach( link => link.setAttribute("target", "_self"));
				}
			});
		</script>
		<?php
	}
}
