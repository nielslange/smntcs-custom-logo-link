<?php
/**
 * Handle custom logo link for the Neve theme
 *
 * ✅ https://wordpress.org/themes/neve/

 * @category   Plugin
 * @package    WordPress
 * @subpackage SMNTCS Custom Logo Link
 * @author     Niels Lange <info@nielslange.de>, Derek Smith <derek@timbre-design.com>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

$target = get_option( 'smntcs_custom_logo_link_target' ) ? '_blank' : '_self';

if ( get_option( 'smntcs_custom_logo_link_url' ) ) { ?>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const logos = document.querySelectorAll(".site-logo a");
			if ( !! logos.length ) {
				logos.forEach( logo => {
					logo.setAttribute("href", "<?php print( esc_url( get_option( 'smntcs_custom_logo_link_url' ) ) ); ?>");
					logo.setAttribute("target", "<?php echo esc_attr( $target ); ?>");
				} );
			}
		});
	</script>
	<?php
}
