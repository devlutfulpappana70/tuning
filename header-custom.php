<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package TUNING
 * @since TUNING 1.0.06
 */

$tuning_header_css   = '';
$tuning_header_image = get_header_image();
$tuning_header_video = tuning_get_header_video();
if ( ! empty( $tuning_header_image ) && tuning_trx_addons_featured_image_override( is_singular() || tuning_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$tuning_header_image = tuning_get_current_mode_image( $tuning_header_image );
}

$tuning_header_id = tuning_get_custom_header_id();
$tuning_header_meta = get_post_meta( $tuning_header_id, 'trx_addons_options', true );
if ( ! empty( $tuning_header_meta['margin'] ) ) {
	tuning_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( tuning_prepare_css_value( $tuning_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $tuning_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $tuning_header_id ) ) ); ?>
				<?php
				echo ! empty( $tuning_header_image ) || ! empty( $tuning_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
				if ( '' != $tuning_header_video ) {
					echo ' with_bg_video';
				}
				if ( '' != $tuning_header_image ) {
					echo ' ' . esc_attr( tuning_add_inline_css_class( 'background-image: url(' . esc_url( $tuning_header_image ) . ');' ) );
				}
				if ( is_single() && has_post_thumbnail() ) {
					echo ' with_featured_image';
				}
				if ( tuning_is_on( tuning_get_theme_option( 'header_fullheight' ) ) ) {
					echo ' header_fullheight tuning-full-height';
				}
				$tuning_header_scheme = tuning_get_theme_option( 'header_scheme' );
				if ( ! empty( $tuning_header_scheme ) && ! tuning_is_inherit( $tuning_header_scheme  ) ) {
					echo ' scheme_' . esc_attr( $tuning_header_scheme );
				}
				?>
">
	<?php

	// Background video
	if ( ! empty( $tuning_header_video ) ) {
		get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/header-video' ) );
	}

	// Custom header's layout
	do_action( 'tuning_action_show_layout', $tuning_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
