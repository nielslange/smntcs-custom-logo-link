<?php
/**
 * Handle custom logo link for Twenty theme series
 *
 * Storefront:        https://wordpress.org/themes/storefront/
 * Twenty Nineteen:   https://wordpress.org/themes/twentynineteen/
 * Twenty Seventeen:  https://wordpress.org/themes/twentyseventeen/
 * Twenty Sixteen:    https://wordpress.org/themes/twentysixteen/
 * Twenty Fifteen:    https://wordpress.org/themes/twentyfifteen/
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
			document.querySelector(".custom-logo-link").setAttribute("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
			document.querySelector(".site-title > a").setAttribute("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
		});
	</script>
	<?php
	if ( get_option( 'smntcs_custom_logo_link_target' ) ) {
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				document.querySelector(".custom-logo-link").setAttribute("target", "_blank");
				document.querySelector(".site-title > a").setAttribute("target", "_blank");
			});
		</script> 
		<?php
	} else {
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				document.querySelector(".custom-logo-link").setAttribute("target", "_self");
				document.querySelector(".site-title > a").setAttribute("target", "_self");
			});
		</script> 
		<?php
	}
}
