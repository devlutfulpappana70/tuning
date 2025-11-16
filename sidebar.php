<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package TUNING
 * @since TUNING 1.0
 */

if ( tuning_sidebar_present() ) {
	
	$tuning_sidebar_type = tuning_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $tuning_sidebar_type && ! tuning_is_layouts_available() ) {
		$tuning_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $tuning_sidebar_type ) {
		// Default sidebar with widgets
		$tuning_sidebar_name = tuning_get_theme_option( 'sidebar_widgets' );
		tuning_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $tuning_sidebar_name ) ) {
			dynamic_sidebar( $tuning_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$tuning_sidebar_id = tuning_get_custom_sidebar_id();
		do_action( 'tuning_action_show_layout', $tuning_sidebar_id );
	}
	$tuning_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $tuning_out ) ) {
		$tuning_sidebar_position    = tuning_get_theme_option( 'sidebar_position' );
		$tuning_sidebar_position_ss = tuning_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $tuning_sidebar_position );
			echo ' sidebar_' . esc_attr( $tuning_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $tuning_sidebar_type );

			$tuning_sidebar_scheme = apply_filters( 'tuning_filter_sidebar_scheme', tuning_get_theme_option( 'sidebar_scheme' ) );
			if ( ! empty( $tuning_sidebar_scheme ) && ! tuning_is_inherit( $tuning_sidebar_scheme ) && 'custom' != $tuning_sidebar_type ) {
				echo ' scheme_' . esc_attr( $tuning_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="tuning_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'tuning_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $tuning_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$tuning_title = apply_filters( 'tuning_filter_sidebar_control_title', 'float' == $tuning_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'tuning' ) : '' );
				$tuning_text  = apply_filters( 'tuning_filter_sidebar_control_text', 'above' == $tuning_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'tuning' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $tuning_title ); ?>"><?php echo esc_html( $tuning_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'tuning_action_before_sidebar', 'sidebar' );
				tuning_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $tuning_out ) );
				do_action( 'tuning_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'tuning_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
