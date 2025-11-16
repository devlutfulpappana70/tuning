<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package TUNING
 * @since TUNING 1.0
 */

$tuning_args = get_query_var( 'tuning_logo_args' );

// Site logo
$tuning_logo_type   = isset( $tuning_args['type'] ) ? $tuning_args['type'] : '';
$tuning_logo_image  = tuning_get_logo_image( $tuning_logo_type );
$tuning_logo_text   = tuning_is_on( tuning_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$tuning_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $tuning_logo_image['logo'] ) || ! empty( $tuning_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $tuning_logo_image['logo'] ) ) {
			if ( empty( $tuning_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric($tuning_logo_image['logo']) && (int) $tuning_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$tuning_attr = tuning_getimagesize( $tuning_logo_image['logo'] );
				echo '<img src="' . esc_url( $tuning_logo_image['logo'] ) . '"'
						. ( ! empty( $tuning_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $tuning_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $tuning_logo_text ) . '"'
						. ( ! empty( $tuning_attr[3] ) ? ' ' . wp_kses_data( $tuning_attr[3] ) : '' )
						. '>';
			}
		} else {
			tuning_show_layout( tuning_prepare_macros( $tuning_logo_text ), '<span class="logo_text">', '</span>' );
			tuning_show_layout( tuning_prepare_macros( $tuning_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
