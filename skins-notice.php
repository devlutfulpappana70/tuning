<?php
/**
 * The template to display Admin notices
 *
 * @package TUNING
 * @since TUNING 1.0.64
 */

$tuning_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$tuning_skins_args = get_query_var( 'tuning_skins_notice_args' );
?>
<div class="tuning_admin_notice tuning_skins_notice notice notice-info is-dismissible" data-notice="skins">
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
		<?php esc_html_e( 'New skins are available', 'tuning' ); ?>
	</h3>
	<?php

	// Description
	$tuning_total      = $tuning_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$tuning_skins_msg  = $tuning_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $tuning_total, 'tuning' ), $tuning_total ) . '</strong>'
							: '';
	$tuning_total      = $tuning_skins_args['free'];
	$tuning_skins_msg .= $tuning_total > 0
							? ( ! empty( $tuning_skins_msg ) ? ' ' . esc_html__( 'and', 'tuning' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $tuning_total, 'tuning' ), $tuning_total ) . '</strong>'
							: '';
	$tuning_total      = $tuning_skins_args['pay'];
	$tuning_skins_msg .= $tuning_skins_args['pay'] > 0
							? ( ! empty( $tuning_skins_msg ) ? ' ' . esc_html__( 'and', 'tuning' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $tuning_total, 'tuning' ), $tuning_total ) . '</strong>'
							: '';
	?>
	<div class="tuning_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'tuning' ), $tuning_skins_msg ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="tuning_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $tuning_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'tuning' );
			?>
		</a>
	</div>
</div>
