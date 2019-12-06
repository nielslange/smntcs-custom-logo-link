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
		jQuery(document).ready(function ($) {
			$(".custom-logo-link").attr("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
			$(".site-title > a").attr("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
		});
	</script>
	<?php
	if ( get_option( 'smntcs_custom_logo_link_target' ) ) {
		?>
		<script>
			jQuery(document).ready(function ($) {
				$(".custom-logo-link").attr("target", "_blank");
				$(".site-title > a").attr("target", "_blank");
			});
		</script> 
		<?php
	} else {
		?>
		<script>
			jQuery(document).ready(function ($) {
				$(".custom-logo-link").attr("target", "_self");
				$(".site-title > a").attr("target", "_self");
			});
		</script> 
		<?php
	}
}
