<?php
/**
 * The Portfolio template to display the content
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

$tuning_post_format = get_post_format();
$tuning_post_format = empty( $tuning_post_format ) ? 'standard' : str_replace( 'post-format-', '', $tuning_post_format );

?><div class="
<?php
if ( ! empty( $tuning_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( tuning_is_blog_style_use_masonry( $tuning_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $tuning_columns ) : esc_attr( $tuning_columns_class ));
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $tuning_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $tuning_columns )
		. ( 'portfolio' != $tuning_blog_style[0] ? ' ' . esc_attr( $tuning_blog_style[0] )  . '_' . esc_attr( $tuning_columns ) : '' )
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

	$tuning_hover   = ! empty( $tuning_template_args['hover'] ) && ! tuning_is_inherit( $tuning_template_args['hover'] )
								? $tuning_template_args['hover']
								: tuning_get_theme_option( 'image_hover' );

	if ( 'dots' == $tuning_hover ) {
		$tuning_post_link = empty( $tuning_template_args['no_links'] )
								? ( ! empty( $tuning_template_args['link'] )
									? $tuning_template_args['link']
									: get_permalink()
									)
								: '';
		$tuning_target    = ! empty( $tuning_post_link ) && tuning_is_external_url( $tuning_post_link )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$tuning_components = ! empty( $tuning_template_args['meta_parts'] )
							? ( is_array( $tuning_template_args['meta_parts'] )
								? $tuning_template_args['meta_parts']
								: explode( ',', $tuning_template_args['meta_parts'] )
								)
							: tuning_array_get_keys_by_value( tuning_get_theme_option( 'meta_parts' ) );

	// Featured image
	tuning_show_post_featured( apply_filters( 'tuning_filter_args_featured',
        array(
			'hover'         => $tuning_hover,
			'no_links'      => ! empty( $tuning_template_args['no_links'] ),
			'thumb_size'    => ! empty( $tuning_template_args['thumb_size'] )
								? $tuning_template_args['thumb_size']
								: tuning_get_thumb_size(
									tuning_is_blog_style_use_masonry( $tuning_blog_style[0] )
										? (	strpos( tuning_get_theme_option( 'body_style' ), 'full' ) !== false || $tuning_columns < 3
											? 'masonry-big'
											: 'masonry'
											)
										: (	strpos( tuning_get_theme_option( 'body_style' ), 'full' ) !== false || $tuning_columns < 3
											? 'square'
											: 'square'
											)
								),
			'thumb_bg' => tuning_is_blog_style_use_masonry( $tuning_blog_style[0] ) ? false : true,
			'show_no_image' => true,
			'meta_parts'    => $tuning_components,
			'class'         => 'dots' == $tuning_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $tuning_hover
										? '<div class="post_info"><h5 class="post_title">'
											. ( ! empty( $tuning_post_link )
												? '<a href="' . esc_url( $tuning_post_link ) . '"' . ( ! empty( $target ) ? $target : '' ) . '>'
												: ''
												)
												. esc_html( get_the_title() ) 
											. ( ! empty( $tuning_post_link )
												? '</a>'
												: ''
												)
											. '</h5></div>'
										: '',
            'thumb_ratio'   => 'info' == $tuning_hover ?  '100:102' : '',
        ),
        'content-portfolio',
        $tuning_template_args
    ) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!