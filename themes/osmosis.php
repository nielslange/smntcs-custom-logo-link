<?php
/**
 * Handle custom logo link for Osmosis theme
 *
 * ✅ Osmosis: https://themeforest.net/item/osmosis-responsive-multipurpose-theme/9839949

 * @category   Plugin
 * @package    WordPress
 * @subpackage SMNTCS Custom Logo Link
 * @author     Niels Lange <info@nielslange.de>, Derek Smith <derek@timbre-design.com>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

if ( get_option( 'smntcs_custom_logo_link_url' ) ) { ?>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			if ( document.querySelector(".grve-logo a") ) {
				document.querySelector(".grve-logo a").setAttribute("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
			}
		});
	</script>
	<?php
	if ( get_option( 'smntcs_custom_logo_link_target' ) ) {
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				if ( document.querySelector(".grve-logo a") ) {
					document.querySelector(".grve-logo a").setAttribute("target", "_blank");
				}
			});
		</script> 
		<?php
	} else {
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				if ( document.querySelector(".grve-logo a") ) {
					document.querySelector(".grve-logo a").setAttribute("target", "_self");
				}
			});
		</script> 
		<?php
	}
}
