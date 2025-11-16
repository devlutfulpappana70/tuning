<?php
/**
 * The Header: Logo and main menu
 *
 * @package TUNING
 * @since TUNING 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( tuning_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'tuning_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'tuning_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('tuning_action_body_wrap_attributes'); ?>>

		<?php do_action( 'tuning_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'tuning_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('tuning_action_page_wrap_attributes'); ?>>

			<?php do_action( 'tuning_action_page_wrap_start' ); ?>

			<?php
			$tuning_full_post_loading = ( tuning_is_singular( 'post' ) || tuning_is_singular( 'attachment' ) ) && tuning_get_value_gp( 'action' ) == 'full_post_loading';
			$tuning_prev_post_loading = ( tuning_is_singular( 'post' ) || tuning_is_singular( 'attachment' ) ) && tuning_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $tuning_full_post_loading && ! $tuning_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="tuning_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'tuning_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to content", 'tuning' ); ?></a>
				<?php if ( tuning_sidebar_present() ) { ?>
				<a class="tuning_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'tuning_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to sidebar", 'tuning' ); ?></a>
				<?php } ?>
				<a class="tuning_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'tuning_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to footer", 'tuning' ); ?></a>

				<?php
				do_action( 'tuning_action_before_header' );

				// Header
				$tuning_header_type = tuning_get_theme_option( 'header_type' );
				if ( 'custom' == $tuning_header_type && ! tuning_is_layouts_available() ) {
					$tuning_header_type = 'default';
				}
				get_template_part( apply_filters( 'tuning_filter_get_template_part', "templates/header-" . sanitize_file_name( $tuning_header_type ) ) );

				// Side menu
				if ( in_array( tuning_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'tuning_action_after_header' );

			}
			?>

			<?php do_action( 'tuning_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( tuning_is_off( tuning_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $tuning_header_type ) ) {
						$tuning_header_type = tuning_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $tuning_header_type && tuning_is_layouts_available() ) {
						$tuning_header_id = tuning_get_custom_header_id();
						if ( $tuning_header_id > 0 ) {
							$tuning_header_meta = tuning_get_custom_layout_meta( $tuning_header_id );
							if ( ! empty( $tuning_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$tuning_footer_type = tuning_get_theme_option( 'footer_type' );
					if ( 'custom' == $tuning_footer_type && tuning_is_layouts_available() ) {
						$tuning_footer_id = tuning_get_custom_footer_id();
						if ( $tuning_footer_id ) {
							$tuning_footer_meta = tuning_get_custom_layout_meta( $tuning_footer_id );
							if ( ! empty( $tuning_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'tuning_action_page_content_wrap_class', $tuning_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'tuning_filter_is_prev_post_loading', $tuning_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( tuning_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'tuning_action_page_content_wrap_data', $tuning_prev_post_loading );
			?>>
				<?php
				do_action( 'tuning_action_page_content_wrap', $tuning_full_post_loading || $tuning_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'tuning_filter_single_post_header', tuning_is_singular( 'post' ) || tuning_is_singular( 'attachment' ) ) ) {
					if ( $tuning_prev_post_loading ) {
						if ( tuning_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'tuning_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$tuning_path = apply_filters( 'tuning_filter_get_template_part', 'templates/single-styles/' . tuning_get_theme_option( 'single_style' ) );
					if ( tuning_get_file_dir( $tuning_path . '.php' ) != '' ) {
						get_template_part( $tuning_path );
					}
				}

				// Widgets area above page
				$tuning_body_style   = tuning_get_theme_option( 'body_style' );
				$tuning_widgets_name = tuning_get_theme_option( 'widgets_above_page' );
				$tuning_show_widgets = ! tuning_is_off( $tuning_widgets_name ) && is_active_sidebar( $tuning_widgets_name );
				if ( $tuning_show_widgets ) {
					if ( 'fullscreen' != $tuning_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					tuning_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $tuning_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'tuning_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $tuning_body_style ? '_fullscreen' : ''; ?>">

					<?php do_action( 'tuning_action_content_wrap_start' ); ?>

					<div class="content">
						<?php
						do_action( 'tuning_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="tuning_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( tuning_is_singular( 'post' ) || tuning_is_singular( 'attachment' ) )
							&& $tuning_prev_post_loading 
							&& tuning_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'tuning_action_between_posts' );
						}

						// Widgets area above content
						tuning_create_widgets_area( 'widgets_above_content' );

						do_action( 'tuning_action_page_content_start_text' );
