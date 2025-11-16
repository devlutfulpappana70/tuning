<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package TUNING
 * @since TUNING 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$tuning_copyright_scheme = tuning_get_theme_option( 'copyright_scheme' );
if ( ! empty( $tuning_copyright_scheme ) && ! tuning_is_inherit( $tuning_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $tuning_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$tuning_copyright = tuning_get_theme_option( 'copyright' );
			if ( ! empty( $tuning_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$tuning_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $tuning_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$tuning_copyright = tuning_prepare_macros( $tuning_copyright );
				// Display copyright
				echo wp_kses( nl2br( $tuning_copyright ), 'tuning_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
