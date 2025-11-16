<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package TUNING
 * @since TUNING 1.0
 */

$tuning_template_args = get_query_var( 'tuning_template_args' );

if ( is_array( $tuning_template_args ) ) {
	$tuning_columns    = empty( $tuning_template_args['columns'] ) ? 2 : max( 1, $tuning_template_args['columns'] );
	$tuning_blog_style = array( $tuning_template_args['type'], $tuning_columns );
    $tuning_columns_class = tuning_get_column_class( 1, $tuning_columns, ! empty( $tuning_template_args['columns_tablet']) ? $tuning_template_args['columns_tablet'] : '', ! empty($tuning_template_args['columns_mobile']) ? $tuning_template_args['columns_mobile'] : '' );
} else {
	$tuning_template_args = array();
	$tuning_blog_style = explode( '_', tuning_get_theme_option( 'blog_style' ) );
	$tuning_columns    = empty( $tuning_blog_style[1] ) ? 2 : max( 1, $tuning_blog_style[1] );
    $tuning_columns_class = tuning_get_column_class( 1, $tuning_columns );
}
$tuning_expanded   = ! tuning_sidebar_present() && tuning_get_theme_option( 'expand_content' ) == 'expand';

$tuning_post_format = get_post_format();
$tuning_post_format = empty( $tuning_post_format ) ? 'standard' : str_replace( 'post-format-', '', $tuning_post_format );

?><div class="<?php
	if ( ! empty( $tuning_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( tuning_is_blog_style_use_masonry( $tuning_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $tuning_columns ) : esc_attr( $tuning_columns_class ) );
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $tuning_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $tuning_columns )
				. ' post_layout_' . esc_attr( $tuning_blog_style[0] )
				. ' post_layout_' . esc_attr( $tuning_blog_style[0] ) . '_' . esc_attr( $tuning_columns )
	);
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
								: explode( ',', $tuning_template_args['meta_parts'] )
								)
							: tuning_array_get_keys_by_value( tuning_get_theme_option( 'meta_parts' ) );

	tuning_show_post_featured( apply_filters( 'tuning_filter_args_featured',
		array(
			'thumb_size' => ! empty( $tuning_template_args['thumb_size'] )
				? $tuning_template_args['thumb_size']
				: tuning_get_thumb_size(
					'classic' == $tuning_blog_style[0]
						? ( strpos( tuning_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $tuning_columns > 2 ? 'big' : 'huge' )
								: ( $tuning_columns > 2
									? ( $tuning_expanded ? 'square' : 'square' )
									: ($tuning_columns > 1 ? 'square' : ( $tuning_expanded ? 'huge' : 'big' ))
									)
							)
						: ( strpos( tuning_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $tuning_columns > 2 ? 'masonry-big' : 'full' )
								: ($tuning_columns === 1 ? ( $tuning_expanded ? 'huge' : 'big' ) : ( $tuning_columns <= 2 && $tuning_expanded ? 'masonry-big' : 'masonry' ))
							)
			),
			'hover'      => $tuning_hover,
			'meta_parts' => $tuning_components,
			'no_links'   => ! empty( $tuning_template_args['no_links'] ),
        ),
        'content-classic',
        $tuning_template_args
    ) );

	// Title and post meta
	$tuning_show_title = get_the_title() != '';
	$tuning_show_meta  = count( $tuning_components ) > 0 && ! in_array( $tuning_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $tuning_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php

			// Post meta
			if ( apply_filters( 'tuning_filter_show_blog_meta', $tuning_show_meta, $tuning_components, 'classic' ) ) {
				if ( count( $tuning_components ) > 0 ) {
					do_action( 'tuning_action_before_post_meta' );
					tuning_show_post_meta(
						apply_filters(
							'tuning_filter_post_meta_args', array(
							'components' => join( ',', $tuning_components ),
							'seo'        => false,
							'echo'       => true,
						), $tuning_blog_style[0], $tuning_columns
						)
					);
					do_action( 'tuning_action_after_post_meta' );
				}
			}

			// Post title
			if ( apply_filters( 'tuning_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'tuning_action_before_post_title' );
				if ( empty( $tuning_template_args['no_links'] ) ) {
					the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				} else {
					the_title( '<h4 class="post_title entry-title">', '</h4>' );
				}
				do_action( 'tuning_action_after_post_title' );
			}

			if( !in_array( $tuning_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
				// More button
				if ( apply_filters( 'tuning_filter_show_blog_readmore', ! $tuning_show_title || ! empty( $tuning_template_args['more_button'] ), 'classic' ) ) {
					if ( empty( $tuning_template_args['no_links'] ) ) {
						do_action( 'tuning_action_before_post_readmore' );
						tuning_show_post_more_link( $tuning_template_args, '<div class="more-wrap">', '</div>' );
						do_action( 'tuning_action_after_post_readmore' );
					}
				}
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	if( in_array( $tuning_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
		ob_start();
		if (apply_filters('tuning_filter_show_blog_excerpt', empty($tuning_template_args['hide_excerpt']) && tuning_get_theme_option('excerpt_length') > 0, 'classic')) {
			tuning_show_post_content($tuning_template_args, '<div class="post_content_inner">', '</div>');
		}
		// More button
		if(! empty( $tuning_template_args['more_button'] )) {
			if ( empty( $tuning_template_args['no_links'] ) ) {
				do_action( 'tuning_action_before_post_readmore' );
				tuning_show_post_more_link( $tuning_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'tuning_action_after_post_readmore' );
			}
		}
		$tuning_content = ob_get_contents();
		ob_end_clean();
		tuning_show_layout($tuning_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->');
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
