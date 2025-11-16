<?php
$tuning_woocommerce_sc = tuning_get_theme_option( 'front_page_woocommerce_products' );
if ( ! empty( $tuning_woocommerce_sc ) ) {
	?><div class="front_page_section front_page_section_woocommerce<?php
		$tuning_scheme = tuning_get_theme_option( 'front_page_woocommerce_scheme' );
		if ( ! empty( $tuning_scheme ) && ! tuning_is_inherit( $tuning_scheme ) ) {
			echo ' scheme_' . esc_attr( $tuning_scheme );
		}
		echo ' front_page_section_paddings_' . esc_attr( tuning_get_theme_option( 'front_page_woocommerce_paddings' ) );
		if ( tuning_get_theme_option( 'front_page_woocommerce_stack' ) ) {
			echo ' sc_stack_section_on';
		}
	?>"
			<?php
			$tuning_css      = '';
			$tuning_bg_image = tuning_get_theme_option( 'front_page_woocommerce_bg_image' );
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
		$tuning_anchor_icon = tuning_get_theme_option( 'front_page_woocommerce_anchor_icon' );
		$tuning_anchor_text = tuning_get_theme_option( 'front_page_woocommerce_anchor_text' );
		if ( ( ! empty( $tuning_anchor_icon ) || ! empty( $tuning_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
			echo do_shortcode(
				'[trx_sc_anchor id="front_page_section_woocommerce"'
											. ( ! empty( $tuning_anchor_icon ) ? ' icon="' . esc_attr( $tuning_anchor_icon ) . '"' : '' )
											. ( ! empty( $tuning_anchor_text ) ? ' title="' . esc_attr( $tuning_anchor_text ) . '"' : '' )
											. ']'
			);
		}
	?>
		<div class="front_page_section_inner front_page_section_woocommerce_inner
			<?php
			if ( tuning_get_theme_option( 'front_page_woocommerce_fullheight' ) ) {
				echo ' tuning-full-height sc_layouts_flex sc_layouts_columns_middle';
			}
			?>
				"
				<?php
				$tuning_css      = '';
				$tuning_bg_mask  = tuning_get_theme_option( 'front_page_woocommerce_bg_mask' );
				$tuning_bg_color_type = tuning_get_theme_option( 'front_page_woocommerce_bg_color_type' );
				if ( 'custom' == $tuning_bg_color_type ) {
					$tuning_bg_color = tuning_get_theme_option( 'front_page_woocommerce_bg_color' );
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
			<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
				<?php
				// Content wrap with title and description
				$tuning_caption     = tuning_get_theme_option( 'front_page_woocommerce_caption' );
				$tuning_description = tuning_get_theme_option( 'front_page_woocommerce_description' );
				if ( ! empty( $tuning_caption ) || ! empty( $tuning_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					// Caption
					if ( ! empty( $tuning_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo ! empty( $tuning_caption ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( $tuning_caption, 'tuning_kses_content' );
						?>
						</h2>
						<?php
					}

					// Description (text)
					if ( ! empty( $tuning_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo ! empty( $tuning_description ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( wpautop( $tuning_description ), 'tuning_kses_content' );
						?>
						</div>
						<?php
					}
				}

				// Content (widgets)
				?>
				<div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs">
					<?php
					if ( 'products' == $tuning_woocommerce_sc ) {
						$tuning_woocommerce_sc_ids      = tuning_get_theme_option( 'front_page_woocommerce_products_per_page' );
						$tuning_woocommerce_sc_per_page = count( explode( ',', $tuning_woocommerce_sc_ids ) );
					} else {
						$tuning_woocommerce_sc_per_page = max( 1, (int) tuning_get_theme_option( 'front_page_woocommerce_products_per_page' ) );
					}
					$tuning_woocommerce_sc_columns = max( 1, min( $tuning_woocommerce_sc_per_page, (int) tuning_get_theme_option( 'front_page_woocommerce_products_columns' ) ) );
					echo do_shortcode(
						"[{$tuning_woocommerce_sc}"
										. ( 'products' == $tuning_woocommerce_sc
												? ' ids="' . esc_attr( $tuning_woocommerce_sc_ids ) . '"'
												: '' )
										. ( 'product_category' == $tuning_woocommerce_sc
												? ' category="' . esc_attr( tuning_get_theme_option( 'front_page_woocommerce_products_categories' ) ) . '"'
												: '' )
										. ( 'best_selling_products' != $tuning_woocommerce_sc
												? ' orderby="' . esc_attr( tuning_get_theme_option( 'front_page_woocommerce_products_orderby' ) ) . '"'
													. ' order="' . esc_attr( tuning_get_theme_option( 'front_page_woocommerce_products_order' ) ) . '"'
												: '' )
										. ' per_page="' . esc_attr( $tuning_woocommerce_sc_per_page ) . '"'
										. ' columns="' . esc_attr( $tuning_woocommerce_sc_columns ) . '"'
						. ']'
					);
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
