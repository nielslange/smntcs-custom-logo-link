<?php
/**
 * Handle custom logo link for Sydney theme series
 *
 * Sydney: https://wordpress.org/themes/yydney/

 * @category   Plugin
 * @package    WordPress
 * @subpackage SMNTCS Custom Logo Link
 * @author     Niels Lange <info@nielslange.de>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

if ( get_option( 'smntcs_custom_logo_link_url' ) ) { ?>
	<script>
		jQuery(document).ready(function ($) {
			$(".site-header a").attr("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
		});
	</script>
	<?php
	if ( get_option( 'smntcs_custom_logo_link_target' ) ) {
		?>
		<script>
			jQuery(document).ready(function ($) {
				$(".site-header a").attr("target", "_blank");
			});
		</script> 
		<?php
	} else {
		?>
		<script>
			jQuery(document).ready(function ($) {
				$(".site-header a").attr("target", "_self");
			});
		</script> 
		<?php
	}
}
