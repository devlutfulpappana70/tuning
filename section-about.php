<div class="front_page_section front_page_section_about<?php
	$tuning_scheme = tuning_get_theme_option( 'front_page_about_scheme' );
	if ( ! empty( $tuning_scheme ) && ! tuning_is_inherit( $tuning_scheme ) ) {
		echo ' scheme_' . esc_attr( $tuning_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( tuning_get_theme_option( 'front_page_about_paddings' ) );
	if ( tuning_get_theme_option( 'front_page_about_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$tuning_css      = '';
		$tuning_bg_image = tuning_get_theme_option( 'front_page_about_bg_image' );
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
	$tuning_anchor_icon = tuning_get_theme_option( 'front_page_about_anchor_icon' );
	$tuning_anchor_text = tuning_get_theme_option( 'front_page_about_anchor_text' );
if ( ( ! empty( $tuning_anchor_icon ) || ! empty( $tuning_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_about"'
									. ( ! empty( $tuning_anchor_icon ) ? ' icon="' . esc_attr( $tuning_anchor_icon ) . '"' : '' )
									. ( ! empty( $tuning_anchor_text ) ? ' title="' . esc_attr( $tuning_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_about_inner
	<?php
	if ( tuning_get_theme_option( 'front_page_about_fullheight' ) ) {
		echo ' tuning-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$tuning_css           = '';
			$tuning_bg_mask       = tuning_get_theme_option( 'front_page_about_bg_mask' );
			$tuning_bg_color_type = tuning_get_theme_option( 'front_page_about_bg_color_type' );
			if ( 'custom' == $tuning_bg_color_type ) {
				$tuning_bg_color = tuning_get_theme_option( 'front_page_about_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$tuning_caption = tuning_get_theme_option( 'front_page_about_caption' );
			if ( ! empty( $tuning_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo ! empty( $tuning_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $tuning_caption, 'tuning_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$tuning_description = tuning_get_theme_option( 'front_page_about_description' );
			if ( ! empty( $tuning_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo ! empty( $tuning_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $tuning_description ), 'tuning_kses_content' ); ?></div>
				<?php
			}

			// Content
			$tuning_content = tuning_get_theme_option( 'front_page_about_content' );
			if ( ! empty( $tuning_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo ! empty( $tuning_content ) ? 'filled' : 'empty'; ?>">
					<?php
					$tuning_page_content_mask = '%%CONTENT%%';
					if ( strpos( $tuning_content, $tuning_page_content_mask ) !== false ) {
						$tuning_content = preg_replace(
							'/(\<p\>\s*)?' . $tuning_page_content_mask . '(\s*\<\/p\>)/i',
							sprintf(
								'<div class="front_page_section_about_source">%s</div>',
								apply_filters( 'the_content', get_the_content() )
							),
							$tuning_content
						);
					}
					tuning_show_layout( $tuning_content );
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
