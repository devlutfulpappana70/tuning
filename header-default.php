<?php
/**
 * The template to display default site header
 *
 * @package TUNING
 * @since TUNING 1.0
 */

$tuning_header_css   = '';
$tuning_header_image = get_header_image();
$tuning_header_video = tuning_get_header_video();
if ( ! empty( $tuning_header_image ) && tuning_trx_addons_featured_image_override( is_singular() || tuning_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$tuning_header_image = tuning_get_current_mode_image( $tuning_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $tuning_header_image ) || ! empty( $tuning_header_video ) ? ' with_bg_image' : ' without_bg_image';
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

	// Main menu
	get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/header-navi' ) );

	// Mobile header
	if ( tuning_is_on( tuning_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	if ( ! is_single() ) {
		get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/header-title' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
