<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package TUNING
 * @since TUNING 1.0.50
 */

$tuning_template_args = get_query_var( 'tuning_template_args' );
if ( is_array( $tuning_template_args ) ) {
	$tuning_columns    = empty( $tuning_template_args['columns'] ) ? 2 : max( 1, $tuning_template_args['columns'] );
	$tuning_blog_style = array( $tuning_template_args['type'], $tuning_columns );
} else {
	$tuning_template_args = array();
	$tuning_blog_style = explode( '_', tuning_get_theme_option( 'blog_style' ) );
	$tuning_columns    = empty( $tuning_blog_style[1] ) ? 2 : max( 1, $tuning_blog_style[1] );
}
$tuning_blog_id       = tuning_get_custom_blog_id( join( '_', $tuning_blog_style ) );
$tuning_blog_style[0] = str_replace( 'blog-custom-', '', $tuning_blog_style[0] );
$tuning_expanded      = ! tuning_sidebar_present() && tuning_get_theme_option( 'expand_content' ) == 'expand';
$tuning_components    = ! empty( $tuning_template_args['meta_parts'] )
							? ( is_array( $tuning_template_args['meta_parts'] )
								? join( ',', $tuning_template_args['meta_parts'] )
								: $tuning_template_args['meta_parts']
								)
							: tuning_array_get_keys_by_value( tuning_get_theme_option( 'meta_parts' ) );
$tuning_post_format   = get_post_format();
$tuning_post_format   = empty( $tuning_post_format ) ? 'standard' : str_replace( 'post-format-', '', $tuning_post_format );

$tuning_blog_meta     = tuning_get_custom_layout_meta( $tuning_blog_id );
$tuning_custom_style  = ! empty( $tuning_blog_meta['scripts_required'] ) ? $tuning_blog_meta['scripts_required'] : 'none';

if ( ! empty( $tuning_template_args['slider'] ) || $tuning_columns > 1 || ! tuning_is_off( $tuning_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $tuning_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( ( tuning_is_off( $tuning_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $tuning_custom_style ) ) . "-1_{$tuning_columns}" );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $tuning_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $tuning_columns )
					. ' post_layout_' . esc_attr( $tuning_blog_style[0] )
					. ' post_layout_' . esc_attr( $tuning_blog_style[0] ) . '_' . esc_attr( $tuning_columns )
					. ( ! tuning_is_off( $tuning_custom_style )
						? ' post_layout_' . esc_attr( $tuning_custom_style )
							. ' post_layout_' . esc_attr( $tuning_custom_style ) . '_' . esc_attr( $tuning_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'tuning_action_show_layout', $tuning_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $tuning_template_args['slider'] ) || $tuning_columns > 1 || ! tuning_is_off( $tuning_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
