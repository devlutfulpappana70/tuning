<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package TUNING
 * @since TUNING 1.0
 */

$tuning_template_args = get_query_var( 'tuning_template_args' );
$tuning_columns = 1;
if ( is_array( $tuning_template_args ) ) {
	$tuning_columns    = empty( $tuning_template_args['columns'] ) ? 1 : max( 1, $tuning_template_args['columns'] );
	$tuning_blog_style = array( $tuning_template_args['type'], $tuning_columns );
	if ( ! empty( $tuning_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $tuning_columns > 1 ) {
	    $tuning_columns_class = tuning_get_column_class( 1, $tuning_columns, ! empty( $tuning_template_args['columns_tablet']) ? $tuning_template_args['columns_tablet'] : '', ! empty($tuning_template_args['columns_mobile']) ? $tuning_template_args['columns_mobile'] : '' );
		?>
		<div class="<?php echo esc_attr( $tuning_columns_class ); ?>">
		<?php
	}
} else {
	$tuning_template_args = array();
}
$tuning_expanded    = ! tuning_sidebar_present() && tuning_get_theme_option( 'expand_content' ) == 'expand';
$tuning_post_format = get_post_format();
$tuning_post_format = empty( $tuning_post_format ) ? 'standard' : str_replace( 'post-format-', '', $tuning_post_format );
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_excerpt post_format_' . esc_attr( $tuning_post_format ) );
	tuning_add_blog_animation( $tuning_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$tuning_hover      = ! empty( $tuning_template_args['hover'] ) && ! tuning_is_inherit( $tuning_template_args['hover'] )
							? $tuning_template_args['hover']
							: tuning_get_theme_option( 'image_hover' );
	$tuning_components = ! empty( $tuning_template_args['meta_parts'] )
							? ( is_array( $tuning_template_args['meta_parts'] )
								? $tuning_template_args['meta_parts']
								: array_map( 'trim', explode( ',', $tuning_template_args['meta_parts'] ) )
								)
							: tuning_array_get_keys_by_value( tuning_get_theme_option( 'meta_parts' ) );
	tuning_show_post_featured( apply_filters( 'tuning_filter_args_featured',
		array(
			'no_links'   => ! empty( $tuning_template_args['no_links'] ),
			'hover'      => $tuning_hover,
			'meta_parts' => $tuning_components,
			'thumb_size' => ! empty( $tuning_template_args['thumb_size'] )
							? $tuning_template_args['thumb_size']
							: tuning_get_thumb_size( strpos( tuning_get_theme_option( 'body_style' ), 'full' ) !== false
								? 'full'
								: ( $tuning_expanded 
									? 'huge' 
									: 'big' 
									)
								),
		),
		'content-excerpt',
		$tuning_template_args
	) );

	// Title and post meta
	$tuning_show_title = get_the_title() != '';
	$tuning_show_meta  = count( $tuning_components ) > 0 && ! in_array( $tuning_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $tuning_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if ( apply_filters( 'tuning_filter_show_blog_title', true, 'excerpt' ) ) {
				do_action( 'tuning_action_before_post_title' );
				if ( empty( $tuning_template_args['no_links'] ) ) {
					the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				} else {
					the_title( '<h3 class="post_title entry-title">', '</h3>' );
				}
				do_action( 'tuning_action_after_post_title' );
			}
			?>
		</div><!-- .post_header -->
		<?php
	}

	// Post content
	if ( apply_filters( 'tuning_filter_show_blog_excerpt', empty( $tuning_template_args['hide_excerpt'] ) && tuning_get_theme_option( 'excerpt_length' ) > 0, 'excerpt' ) ) {
		?>
		<div class="post_content entry-content">
			<?php

			// Post meta
			if ( apply_filters( 'tuning_filter_show_blog_meta', $tuning_show_meta, $tuning_components, 'excerpt' ) ) {
				if ( count( $tuning_components ) > 0 ) {
					do_action( 'tuning_action_before_post_meta' );
					tuning_show_post_meta(
						apply_filters(
							'tuning_filter_post_meta_args', array(
								'components' => join( ',', $tuning_components ),
								'seo'        => false,
								'echo'       => true,
							), 'excerpt', 1
						)
					);
					do_action( 'tuning_action_after_post_meta' );
				}
			}

			if ( tuning_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'tuning_action_before_full_post_content' );
					the_content( '' );
					do_action( 'tuning_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'tuning' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'tuning' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				tuning_show_post_content( $tuning_template_args, '<div class="post_content_inner">', '</div>' );
			}

			// More button
			if ( apply_filters( 'tuning_filter_show_blog_readmore',  ! isset( $tuning_template_args['more_button'] ) || ! empty( $tuning_template_args['more_button'] ), 'excerpt' ) ) {
				if ( empty( $tuning_template_args['no_links'] ) ) {
					do_action( 'tuning_action_before_post_readmore' );
					if ( tuning_get_theme_option( 'blog_content' ) != 'fullpost' ) {
						tuning_show_post_more_link( $tuning_template_args, '<p>', '</p>' );
					} else {
						tuning_show_post_comments_link( $tuning_template_args, '<p>', '</p>' );
					}
					do_action( 'tuning_action_after_post_readmore' );
				}
			}

			?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
</article>
<?php

if ( is_array( $tuning_template_args ) ) {
	if ( ! empty( $tuning_template_args['slider'] ) || $tuning_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
