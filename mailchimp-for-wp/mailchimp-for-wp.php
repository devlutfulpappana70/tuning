<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'tuning_mailchimp_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'tuning_mailchimp_theme_setup9', 9 );
	function tuning_mailchimp_theme_setup9() {
		if ( tuning_exists_mailchimp() ) {
			add_action( 'wp_enqueue_scripts', 'tuning_mailchimp_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_mailchimp', 'tuning_mailchimp_frontend_scripts', 10, 1 );
			add_filter( 'tuning_filter_merge_styles', 'tuning_mailchimp_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'tuning_filter_tgmpa_required_plugins', 'tuning_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'tuning_mailchimp_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('tuning_filter_tgmpa_required_plugins',	'tuning_mailchimp_tgmpa_required_plugins');
	function tuning_mailchimp_tgmpa_required_plugins( $list = array() ) {
		if ( tuning_storage_isset( 'required_plugins', 'mailchimp-for-wp' ) && tuning_storage_get_array( 'required_plugins', 'mailchimp-for-wp', 'install' ) !== false ) {
			$list[] = array(
				'name'     => tuning_storage_get_array( 'required_plugins', 'mailchimp-for-wp', 'title' ),
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'tuning_exists_mailchimp' ) ) {
	function tuning_exists_mailchimp() {
		return function_exists( '__mc4wp_load_plugin' ) || defined( 'MC4WP_VERSION' );
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue styles for frontend
if ( ! function_exists( 'tuning_mailchimp_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'tuning_mailchimp_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_mailchimp', 'tuning_mailchimp_frontend_scripts', 10, 1 );
	function tuning_mailchimp_frontend_scripts( $force = false ) {
		tuning_enqueue_optimized( 'mailchimp', $force, array(
			'css' => array(
				'tuning-mailchimp-for-wp' => array( 'src' => 'plugins/mailchimp-for-wp/mailchimp-for-wp.css' ),
			)
		) );
	}
}

// Merge custom styles
if ( ! function_exists( 'tuning_mailchimp_merge_styles' ) ) {
	//Handler of the add_filter( 'tuning_filter_merge_styles', 'tuning_mailchimp_merge_styles');
	function tuning_mailchimp_merge_styles( $list ) {
		$list[ 'plugins/mailchimp-for-wp/mailchimp-for-wp.css' ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( tuning_exists_mailchimp() ) {
	$tuning_fdir = tuning_get_file_dir( 'plugins/mailchimp-for-wp/mailchimp-for-wp-style.php' );
	if ( ! empty( $tuning_fdir ) ) {
		require_once $tuning_fdir;
	}
}

