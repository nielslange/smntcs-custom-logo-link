<?php
/**
 * Handle custom logo link for Lore theme
 *
 * Neve: https://themeforest.net/item/lore-elegant-knowledge-base-wordpress-theme/16965024

 * @category   Plugin
 * @package    WordPress
 * @subpackage SMNTCS Custom Logo Link
 * @author     Niels Lange <info@nielslange.de>, Derek Smith <derek@timbre-design.com>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

if ( get_option( 'smntcs_custom_logo_link_url' ) ) { ?>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			if ( document.querySelector("a.header-title__link") ) {
				document.querySelector("a.header-title__link").setAttribute("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
			}
			if ( document.querySelector("a.header-logo__image") ) {
				document.querySelector("a.header-logo__image").setAttribute("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
			}
		});
	</script>
	<?php
	if ( get_option( 'smntcs_custom_logo_link_target' ) ) {
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				if ( document.querySelector("a.header-title__link") ) {
					document.querySelector("a.header-title__link").setAttribute("target", "_blank");
				}
				if (document.querySelector("a.header-logo__image")) {
					document.querySelector("a.header-logo__image").setAttribute("target", "_blank");
				}
			});
		</script> 
		<?php
	} else {
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				if ( document.querySelector("a.header-title__link") ) {
					document.querySelector("a.header-title__link").setAttribute("target", "_self");
				}
				if (document.querySelector("a.header-logo__image")) {
					document.querySelector("a.header-logo__image").setAttribute("target", "_self");
				}
			});
		</script> 
		<?php
	}
}
