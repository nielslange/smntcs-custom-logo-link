<?php
/**
 * Handle custom logo link for Cuisine theme
 *
 * ✅ Cuisine: https://themeforest.net/item/cuisine-responsive-restaurant-wordpress-theme/15683899/

 * @category   Plugin
 * @package    WordPress
 * @subpackage SMNTCS Custom Logo Link
 * @author     Niels Lange <info@nielslange.de>, Derek Smith <derek@timbre-design.com>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

if ( get_option( 'smntcs_custom_logo_link_url' ) ) { ?>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			if ( document.querySelector("a.cuisine-navbar-brand") ) {
				document.querySelector("a.cuisine-navbar-brand").setAttribute("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
			}
		});
	</script>
	<?php
	if ( get_option( 'smntcs_custom_logo_link_target' ) ) {
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				if ( document.querySelector("a.cuisine-navbar-brand") ) {
					document.querySelector("a.cuisine-navbar-brand").setAttribute("target", "_blank");
				}
			});
		</script> 
		<?php
	} else {
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				if ( document.querySelector("a.cuisine-navbar-brand") ) {
					document.querySelector("a.cuisine-navbar-brand").setAttribute("target", "_self");
				}
			});
		</script> 
		<?php
	}
}
