<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package TUNING
 * @since TUNING 1.0
 */

$tuning_template = apply_filters( 'tuning_filter_get_template_part', tuning_blog_archive_get_template() );

if ( ! empty( $tuning_template ) && 'index' != $tuning_template ) {

	get_template_part( $tuning_template );

} else {

	tuning_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$tuning_stickies   = is_home()
								|| ( in_array( tuning_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) tuning_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$tuning_post_type  = tuning_get_theme_option( 'post_type' );
		$tuning_args       = array(
								'blog_style'     => tuning_get_theme_option( 'blog_style' ),
								'post_type'      => $tuning_post_type,
								'taxonomy'       => tuning_get_post_type_taxonomy( $tuning_post_type ),
								'parent_cat'     => tuning_get_theme_option( 'parent_cat' ),
								'posts_per_page' => tuning_get_theme_option( 'posts_per_page' ),
								'sticky'         => tuning_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $tuning_stickies )
															&& count( $tuning_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		tuning_blog_archive_start();

		do_action( 'tuning_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'tuning_action_before_page_author' );
			get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'tuning_action_after_page_author' );
		}

		if ( tuning_get_theme_option( 'show_filters' ) ) {
			do_action( 'tuning_action_before_page_filters' );
			tuning_show_filters( $tuning_args );
			do_action( 'tuning_action_after_page_filters' );
		} else {
			do_action( 'tuning_action_before_page_posts' );
			tuning_show_posts( array_merge( $tuning_args, array( 'cat' => $tuning_args['parent_cat'] ) ) );
			do_action( 'tuning_action_after_page_posts' );
		}

		do_action( 'tuning_action_blog_archive_end' );

		tuning_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'tuning_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
