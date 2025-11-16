<?php
/**
 * The template to display the site logo in the footer
 *
 * @package TUNING
 * @since TUNING 1.0.10
 */

// Logo
if ( tuning_is_on( tuning_get_theme_option( 'logo_in_footer' ) ) ) {
	$tuning_logo_image = tuning_get_logo_image( 'footer' );
	$tuning_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $tuning_logo_image['logo'] ) || ! empty( $tuning_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $tuning_logo_image['logo'] ) ) {
					$tuning_attr = tuning_getimagesize( $tuning_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $tuning_logo_image['logo'] ) . '"'
								. ( ! empty( $tuning_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $tuning_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'tuning' ) . '"'
								. ( ! empty( $tuning_attr[3] ) ? ' ' . wp_kses_data( $tuning_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $tuning_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $tuning_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
