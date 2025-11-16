<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package TUNING
 * @since TUNING 1.0
 */

							do_action( 'tuning_action_page_content_end_text' );
							
							// Widgets area below the content
							tuning_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'tuning_action_page_content_end' );
							?>
						</div>
						<?php
						
						do_action( 'tuning_action_after_page_content' );

						// Show main sidebar
						get_sidebar();

						do_action( 'tuning_action_content_wrap_end' );
						?>
					</div>
					<?php

					do_action( 'tuning_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$tuning_body_style = tuning_get_theme_option( 'body_style' );
					$tuning_widgets_name = tuning_get_theme_option( 'widgets_below_page' );
					$tuning_show_widgets = ! tuning_is_off( $tuning_widgets_name ) && is_active_sidebar( $tuning_widgets_name );
					$tuning_show_related = tuning_is_single() && tuning_get_theme_option( 'related_position' ) == 'below_page';
					if ( $tuning_show_widgets || $tuning_show_related ) {
						if ( 'fullscreen' != $tuning_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $tuning_show_related ) {
							do_action( 'tuning_action_related_posts' );
						}

						// Widgets area below page content
						if ( $tuning_show_widgets ) {
							tuning_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $tuning_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'tuning_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'tuning_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! tuning_is_singular( 'post' ) && ! tuning_is_singular( 'attachment' ) ) || ! in_array ( tuning_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="tuning_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'tuning_action_before_footer' );

				// Footer
				$tuning_footer_type = tuning_get_theme_option( 'footer_type' );
				if ( 'custom' == $tuning_footer_type && ! tuning_is_layouts_available() ) {
					$tuning_footer_type = 'default';
				}
				get_template_part( apply_filters( 'tuning_filter_get_template_part', "templates/footer-" . sanitize_file_name( $tuning_footer_type ) ) );

				do_action( 'tuning_action_after_footer' );

			}
			?>

			<?php do_action( 'tuning_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'tuning_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'tuning_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>