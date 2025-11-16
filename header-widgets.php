<?php
/**
 * The template to display the widgets area in the header
 *
 * @package TUNING
 * @since TUNING 1.0
 */

// Header sidebar
$tuning_header_name    = tuning_get_theme_option( 'header_widgets' );
$tuning_header_present = ! tuning_is_off( $tuning_header_name ) && is_active_sidebar( $tuning_header_name );
if ( $tuning_header_present ) {
	tuning_storage_set( 'current_sidebar', 'header' );
	$tuning_header_wide = tuning_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $tuning_header_name ) ) {
		dynamic_sidebar( $tuning_header_name );
	}
	$tuning_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $tuning_widgets_output ) ) {
		$tuning_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $tuning_widgets_output );
		$tuning_need_columns   = strpos( $tuning_widgets_output, 'columns_wrap' ) === false;
		if ( $tuning_need_columns ) {
			$tuning_columns = max( 0, (int) tuning_get_theme_option( 'header_columns' ) );
			if ( 0 == $tuning_columns ) {
				$tuning_columns = min( 6, max( 1, tuning_tags_count( $tuning_widgets_output, 'aside' ) ) );
			}
			if ( $tuning_columns > 1 ) {
				$tuning_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $tuning_columns ) . ' widget', $tuning_widgets_output );
			} else {
				$tuning_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $tuning_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'tuning_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $tuning_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $tuning_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'tuning_action_before_sidebar', 'header' );
				tuning_show_layout( $tuning_widgets_output );
				do_action( 'tuning_action_after_sidebar', 'header' );
				if ( $tuning_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $tuning_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'tuning_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
