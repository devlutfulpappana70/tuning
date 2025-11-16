<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package TUNING
 * @since TUNING 1.0.10
 */

// Footer sidebar
$tuning_footer_name    = tuning_get_theme_option( 'footer_widgets' );
$tuning_footer_present = ! tuning_is_off( $tuning_footer_name ) && is_active_sidebar( $tuning_footer_name );
if ( $tuning_footer_present ) {
	tuning_storage_set( 'current_sidebar', 'footer' );
	$tuning_footer_wide = tuning_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $tuning_footer_name ) ) {
		dynamic_sidebar( $tuning_footer_name );
	}
	$tuning_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $tuning_out ) ) {
		$tuning_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $tuning_out );
		$tuning_need_columns = true;   //or check: strpos($tuning_out, 'columns_wrap')===false;
		if ( $tuning_need_columns ) {
			$tuning_columns = max( 0, (int) tuning_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $tuning_columns ) {
				$tuning_columns = min( 4, max( 1, tuning_tags_count( $tuning_out, 'aside' ) ) );
			}
			if ( $tuning_columns > 1 ) {
				$tuning_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $tuning_columns ) . ' widget', $tuning_out );
			} else {
				$tuning_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $tuning_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'tuning_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $tuning_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $tuning_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'tuning_action_before_sidebar', 'footer' );
				tuning_show_layout( $tuning_out );
				do_action( 'tuning_action_after_sidebar', 'footer' );
				if ( $tuning_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $tuning_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'tuning_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
