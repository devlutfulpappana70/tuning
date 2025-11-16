<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package TUNING
 * @since TUNING 1.0
 */

// Page (category, tag, archive, author) title

if ( tuning_need_page_title() ) {
	tuning_sc_layouts_showed( 'title', true );
	tuning_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								tuning_show_post_meta(
									apply_filters(
										'tuning_filter_post_meta_args', array(
											'components' => join( ',', tuning_array_get_keys_by_value( tuning_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', tuning_array_get_keys_by_value( tuning_get_theme_option( 'counters' ) ) ),
											'seo'        => tuning_is_on( tuning_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$tuning_blog_title           = tuning_get_blog_title();
							$tuning_blog_title_text      = '';
							$tuning_blog_title_class     = '';
							$tuning_blog_title_link      = '';
							$tuning_blog_title_link_text = '';
							if ( is_array( $tuning_blog_title ) ) {
								$tuning_blog_title_text      = $tuning_blog_title['text'];
								$tuning_blog_title_class     = ! empty( $tuning_blog_title['class'] ) ? ' ' . $tuning_blog_title['class'] : '';
								$tuning_blog_title_link      = ! empty( $tuning_blog_title['link'] ) ? $tuning_blog_title['link'] : '';
								$tuning_blog_title_link_text = ! empty( $tuning_blog_title['link_text'] ) ? $tuning_blog_title['link_text'] : '';
							} else {
								$tuning_blog_title_text = $tuning_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $tuning_blog_title_class ); ?>">
								<?php
								$tuning_top_icon = tuning_get_term_image_small();
								if ( ! empty( $tuning_top_icon ) ) {
									$tuning_attr = tuning_getimagesize( $tuning_top_icon );
									?>
									<img src="<?php echo esc_url( $tuning_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'tuning' ); ?>"
										<?php
										if ( ! empty( $tuning_attr[3] ) ) {
											tuning_show_layout( $tuning_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $tuning_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $tuning_blog_title_link ) && ! empty( $tuning_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $tuning_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $tuning_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'tuning_action_breadcrumbs' );
						$tuning_breadcrumbs = ob_get_contents();
						ob_end_clean();
						tuning_show_layout( $tuning_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
