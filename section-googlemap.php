<div class="front_page_section front_page_section_googlemap<?php
	$tuning_scheme = tuning_get_theme_option( 'front_page_googlemap_scheme' );
	if ( ! empty( $tuning_scheme ) && ! tuning_is_inherit( $tuning_scheme ) ) {
		echo ' scheme_' . esc_attr( $tuning_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( tuning_get_theme_option( 'front_page_googlemap_paddings' ) );
	if ( tuning_get_theme_option( 'front_page_googlemap_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$tuning_css      = '';
		$tuning_bg_image = tuning_get_theme_option( 'front_page_googlemap_bg_image' );
		if ( ! empty( $tuning_bg_image ) ) {
			$tuning_css .= 'background-image: url(' . esc_url( tuning_get_attachment_url( $tuning_bg_image ) ) . ');';
		}
		if ( ! empty( $tuning_css ) ) {
			echo ' style="' . esc_attr( $tuning_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$tuning_anchor_icon = tuning_get_theme_option( 'front_page_googlemap_anchor_icon' );
	$tuning_anchor_text = tuning_get_theme_option( 'front_page_googlemap_anchor_text' );
if ( ( ! empty( $tuning_anchor_icon ) || ! empty( $tuning_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_googlemap"'
									. ( ! empty( $tuning_anchor_icon ) ? ' icon="' . esc_attr( $tuning_anchor_icon ) . '"' : '' )
									. ( ! empty( $tuning_anchor_text ) ? ' title="' . esc_attr( $tuning_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_googlemap_inner
		<?php
		$tuning_layout = tuning_get_theme_option( 'front_page_googlemap_layout' );
		echo ' front_page_section_layout_' . esc_attr( $tuning_layout );
		if ( tuning_get_theme_option( 'front_page_googlemap_fullheight' ) ) {
			echo ' tuning-full-height sc_layouts_flex sc_layouts_columns_middle';
		}
		?>
		"
			<?php
			$tuning_css      = '';
			$tuning_bg_mask  = tuning_get_theme_option( 'front_page_googlemap_bg_mask' );
			$tuning_bg_color_type = tuning_get_theme_option( 'front_page_googlemap_bg_color_type' );
			if ( 'custom' == $tuning_bg_color_type ) {
				$tuning_bg_color = tuning_get_theme_option( 'front_page_googlemap_bg_color' );
			} elseif ( 'scheme_bg_color' == $tuning_bg_color_type ) {
				$tuning_bg_color = tuning_get_scheme_color( 'bg_color', $tuning_scheme );
			} else {
				$tuning_bg_color = '';
			}
			if ( ! empty( $tuning_bg_color ) && $tuning_bg_mask > 0 ) {
				$tuning_css .= 'background-color: ' . esc_attr(
					1 == $tuning_bg_mask ? $tuning_bg_color : tuning_hex2rgba( $tuning_bg_color, $tuning_bg_mask )
				) . ';';
			}
			if ( ! empty( $tuning_css ) ) {
				echo ' style="' . esc_attr( $tuning_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap
		<?php
		if ( 'fullwidth' != $tuning_layout ) {
			echo ' content_wrap';
		}
		?>
		">
			<?php
			// Content wrap with title and description
			$tuning_caption     = tuning_get_theme_option( 'front_page_googlemap_caption' );
			$tuning_description = tuning_get_theme_option( 'front_page_googlemap_description' );
			if ( ! empty( $tuning_caption ) || ! empty( $tuning_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'fullwidth' == $tuning_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}
					// Caption
				if ( ! empty( $tuning_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo ! empty( $tuning_caption ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $tuning_caption, 'tuning_kses_content' );
					?>
					</h2>
					<?php
				}

					// Description (text)
				if ( ! empty( $tuning_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo ! empty( $tuning_description ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( wpautop( $tuning_description ), 'tuning_kses_content' );
					?>
					</div>
					<?php
				}
				if ( 'fullwidth' == $tuning_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$tuning_content = tuning_get_theme_option( 'front_page_googlemap_content' );
			if ( ! empty( $tuning_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'columns' == $tuning_layout ) {
					?>
					<div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} elseif ( 'fullwidth' == $tuning_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}

				?>
				<div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo ! empty( $tuning_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses( $tuning_content, 'tuning_kses_content' );
				?>
				</div>
				<?php

				if ( 'columns' == $tuning_layout ) {
					?>
					</div><div class="column-2_3">
					<?php
				} elseif ( 'fullwidth' == $tuning_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Widgets output
			?>
			<div class="front_page_section_output front_page_section_googlemap_output">
				<?php
				if ( is_active_sidebar( 'front_page_googlemap_widgets' ) ) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} elseif ( current_user_can( 'edit_theme_options' ) ) {
					if ( ! tuning_exists_trx_addons() ) {
						tuning_customizer_need_trx_addons_message();
					} else {
						tuning_customizer_need_widgets_message( 'front_page_googlemap_caption', 'ThemeREX Addons - Google map' );
					}
				}
				?>
			</div>
			<?php

			if ( 'columns' == $tuning_layout && ( ! empty( $tuning_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>
		</div>
	</div>
</div>
