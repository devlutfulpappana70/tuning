<?php
/**
 * The template to display single post
 *
 * @package TUNING
 * @since TUNING 1.0
 */

// Full post loading
$full_post_loading          = tuning_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = tuning_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = tuning_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$tuning_related_position   = tuning_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$tuning_posts_navigation   = tuning_get_theme_option( 'posts_navigation' );
$tuning_prev_post          = false;
$tuning_prev_post_same_cat = tuning_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( tuning_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	tuning_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'tuning_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $tuning_posts_navigation ) {
		$tuning_prev_post = get_previous_post( $tuning_prev_post_same_cat );  // Get post from same category
		if ( ! $tuning_prev_post && $tuning_prev_post_same_cat ) {
			$tuning_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $tuning_prev_post ) {
			$tuning_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $tuning_prev_post ) ) {
		tuning_sc_layouts_showed( 'featured', false );
		tuning_sc_layouts_showed( 'title', false );
		tuning_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $tuning_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/content', 'single-' . tuning_get_theme_option( 'single_style' ) ), 'single-' . tuning_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $tuning_related_position, 'inside' ) === 0 ) {
		$tuning_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'tuning_action_related_posts' );
		$tuning_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $tuning_related_content ) ) {
			$tuning_related_position_inside = max( 0, min( 9, tuning_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $tuning_related_position_inside ) {
				$tuning_related_position_inside = mt_rand( 1, 9 );
			}

			$tuning_p_number         = 0;
			$tuning_related_inserted = false;
			$tuning_in_block         = false;
			$tuning_content_start    = strpos( $tuning_content, '<div class="post_content' );
			$tuning_content_end      = strrpos( $tuning_content, '</div>' );

			for ( $i = max( 0, $tuning_content_start ); $i < min( strlen( $tuning_content ) - 3, $tuning_content_end ); $i++ ) {
				if ( $tuning_content[ $i ] != '<' ) {
					continue;
				}
				if ( $tuning_in_block ) {
					if ( strtolower( substr( $tuning_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$tuning_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $tuning_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $tuning_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$tuning_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $tuning_content[ $i + 1 ] && in_array( $tuning_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$tuning_p_number++;
					if ( $tuning_related_position_inside == $tuning_p_number ) {
						$tuning_related_inserted = true;
						$tuning_content = ( $i > 0 ? substr( $tuning_content, 0, $i ) : '' )
											. $tuning_related_content
											. substr( $tuning_content, $i );
					}
				}
			}
			if ( ! $tuning_related_inserted ) {
				if ( $tuning_content_end > 0 ) {
					$tuning_content = substr( $tuning_content, 0, $tuning_content_end ) . $tuning_related_content . substr( $tuning_content, $tuning_content_end );
				} else {
					$tuning_content .= $tuning_related_content;
				}
			}
		}

		tuning_show_layout( $tuning_content );
	}

	// Comments
	do_action( 'tuning_action_before_comments' );
	comments_template();
	do_action( 'tuning_action_after_comments' );

	// Related posts
	if ( 'below_content' == $tuning_related_position
		&& ( 'scroll' != $tuning_posts_navigation || tuning_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || tuning_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'tuning_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $tuning_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $tuning_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $tuning_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $tuning_prev_post ) ); ?>"
			<?php do_action( 'tuning_action_nav_links_single_scroll_data', $tuning_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
