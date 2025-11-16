<?php
/**
 * The template to display default site footer
 *
 * @package TUNING
 * @since TUNING 1.0.10
 */

$tuning_footer_id = tuning_get_custom_footer_id();
$tuning_footer_meta = get_post_meta( $tuning_footer_id, 'trx_addons_options', true );
if ( ! empty( $tuning_footer_meta['margin'] ) ) {
	tuning_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( tuning_prepare_css_value( $tuning_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $tuning_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $tuning_footer_id ) ) ); ?>
						<?php
						$tuning_footer_scheme = tuning_get_theme_option( 'footer_scheme' );
						if ( ! empty( $tuning_footer_scheme ) && ! tuning_is_inherit( $tuning_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $tuning_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'tuning_action_show_layout', $tuning_footer_id );
	?>
</footer><!-- /.footer_wrap -->
