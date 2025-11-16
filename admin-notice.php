<?php
/**
 * The template to display Admin notices
 *
 * @package TUNING
 * @since TUNING 1.0.1
 */

$tuning_theme_slug = get_option( 'template' );
$tuning_theme_obj  = wp_get_theme( $tuning_theme_slug );
?>
<div class="tuning_admin_notice tuning_welcome_notice notice notice-info is-dismissible" data-notice="admin">
	<?php
	// Theme image
	$tuning_theme_img = tuning_get_file_url( 'screenshot.jpg' );
	if ( '' != $tuning_theme_img ) {
		?>
		<div class="tuning_notice_image"><img src="<?php echo esc_url( $tuning_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'tuning' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="tuning_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'tuning' ),
				$tuning_theme_obj->get( 'Name' ) . ( TUNING_THEME_FREE ? ' ' . __( 'Free', 'tuning' ) : '' ),
				$tuning_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="tuning_notice_text">
		<p class="tuning_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $tuning_theme_obj->description ) );
			?>
		</p>
		<p class="tuning_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'tuning' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="tuning_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=tuning_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'tuning' );
			?>
		</a>
	</div>
</div>
