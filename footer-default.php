<?php
/**
 * The template to display default site footer
 *
 * @package TUNING
 * @since TUNING 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$tuning_footer_scheme = tuning_get_theme_option( 'footer_scheme' );
if ( ! empty( $tuning_footer_scheme ) && ! tuning_is_inherit( $tuning_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $tuning_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/footer-socials' ) );

	// Copyright area
	get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
