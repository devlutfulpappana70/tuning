<?php
/**
 * The template to display the socials in the footer
 *
 * @package TUNING
 * @since TUNING 1.0.10
 */


// Socials
if ( tuning_is_on( tuning_get_theme_option( 'socials_in_footer' ) ) ) {
	$tuning_output = tuning_get_socials_links();
	if ( '' != $tuning_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php tuning_show_layout( $tuning_output ); ?>
			</div>
		</div>
		<?php
	}
}
