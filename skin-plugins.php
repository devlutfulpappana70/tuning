<?php
/**
 * Required plugins
 *
 * @package TUNING
 * @since TUNING 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$tuning_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'tuning' ),
	'page_builders' => esc_html__( 'Page Builders', 'tuning' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'tuning' ),
	'socials'       => esc_html__( 'Socials and Communities', 'tuning' ),
	'events'        => esc_html__( 'Events and Appointments', 'tuning' ),
	'content'       => esc_html__( 'Content', 'tuning' ),
	'other'         => esc_html__( 'Other', 'tuning' ),
);
$tuning_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'tuning' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'tuning' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $tuning_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'tuning' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'tuning' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $tuning_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'tuning' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'tuning' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $tuning_theme_required_plugins_groups['page_builders'],
	),
	'js_composer'                => array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'tuning' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'tuning' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'js_composer.jpg',
		'group'       => $tuning_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'tuning' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'tuning' ),
		'required'    => false,
		'logo'        => 'woocommerce.png',
		'group'       => $tuning_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'tuning' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'tuning' ),
		'required'    => false,
		'install'     => false, // TRX_addons has marked the "Elegro Crypto Payment" plugin as obsolete and no longer recommends it for installation, even if it had been previously recommended by the theme
		'logo'        => 'elegro-payment.png',
		'group'       => $tuning_theme_required_plugins_groups['ecommerce'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'tuning' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'tuning' ),
		'required'    => false,
		'logo'        => 'instagram-feed.png',
		'group'       => $tuning_theme_required_plugins_groups['socials'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'tuning' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'tuning' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $tuning_theme_required_plugins_groups['socials'],
	),
	'booked'                     => array(
		'title'       => esc_html__( 'Booked Appointments', 'tuning' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'booked.png',
		'group'       => $tuning_theme_required_plugins_groups['events'],
	),
	'quickcal'                     => array(
		'title'       => esc_html__( 'QuickCal', 'tuning' ),
		'description' => '',
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'quickcal.png',
		'group'       => $tuning_theme_required_plugins_groups['events'],
	),
	'the-events-calendar'        => array(
		'title'       => esc_html__( 'The Events Calendar', 'tuning' ),
		'description' => '',
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'the-events-calendar.png',
		'group'       => $tuning_theme_required_plugins_groups['events'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'tuning' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'tuning' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $tuning_theme_required_plugins_groups['content'],
	),
	'latepoint'                  => array(
		'title'       => esc_html__( 'LatePoint', 'tuning' ),
		'description' => '',
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => tuning_get_file_url( 'plugins/latepoint/latepoint.png' ),
		'group'       => $tuning_theme_required_plugins_groups['events'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'tuning' ),
		'description' => '',
		'required'    => false,
		'logo'        => tuning_get_file_url( 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $tuning_theme_required_plugins_groups['content'],
	),
	'devvn-image-hotspot'                  => array(
		'title'       => esc_html__( 'Image Hotspot by DevVN', 'tuning' ),
		'description' => '',
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => tuning_get_file_url( 'plugins/devvn-image-hotspot/devvn-image-hotspot.png' ),
		'group'       => $tuning_theme_required_plugins_groups['content'],
	),
	'ti-woocommerce-wishlist'                  => array(
		'title'       => esc_html__( 'TI WooCommerce Wishlist', 'tuning' ),
		'description' => '',
		'required'    => false,
		'logo'        => tuning_get_file_url( 'plugins/ti-woocommerce-wishlist/ti-woocommerce-wishlist.png' ),
		'group'       => $tuning_theme_required_plugins_groups['ecommerce'],
	),
	'woo-smart-quick-view'                  => array(
		'title'       => esc_html__( 'WPC Smart Quick View for WooCommerce', 'tuning' ),
		'description' => '',
		'required'    => false,
		'logo'        => tuning_get_file_url( 'plugins/woo-smart-quick-view/woo-smart-quick-view.png' ),
		'group'       => $tuning_theme_required_plugins_groups['ecommerce'],
	),
	'twenty20'                  => array(
		'title'       => esc_html__( 'Twenty20 Image Before-After', 'tuning' ),
		'description' => '',
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => tuning_get_file_url( 'plugins/twenty20/twenty20.png' ),
		'group'       => $tuning_theme_required_plugins_groups['content'],
	),
	'essential-grid'             => array(
		'title'       => esc_html__( 'Essential Grid', 'tuning' ),
		'description' => '',
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'essential-grid.png',
		'group'       => $tuning_theme_required_plugins_groups['content'],
	),
	'revslider'                  => array(
		'title'       => esc_html__( 'Revolution Slider', 'tuning' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'revslider.png',
		'group'       => $tuning_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'tuning' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'tuning' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $tuning_theme_required_plugins_groups['content'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'Cookie Information', 'tuning' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'tuning' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $tuning_theme_required_plugins_groups['other'],
	),
	'gdpr-framework'         => array(
		'title'       => esc_html__( 'The GDPR Framework', 'tuning' ),
		'description' => esc_html__( "Tools to help make your website GDPR-compliant. Fully documented, extendable and developer-friendly.", 'tuning' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gdpr-framework.png',
		'group'       => $tuning_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'tuning' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'tuning' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $tuning_theme_required_plugins_groups['other'],
	),
);

if ( TUNING_THEME_FREE ) {
	unset( $tuning_theme_required_plugins['js_composer'] );
	unset( $tuning_theme_required_plugins['booked'] );
	unset( $tuning_theme_required_plugins['quickcal'] );
	unset( $tuning_theme_required_plugins['the-events-calendar'] );
	unset( $tuning_theme_required_plugins['calculated-fields-form'] );
	unset( $tuning_theme_required_plugins['essential-grid'] );
	unset( $tuning_theme_required_plugins['revslider'] );
	unset( $tuning_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $tuning_theme_required_plugins['trx_updater'] );
	unset( $tuning_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
tuning_storage_set( 'required_plugins', $tuning_theme_required_plugins );
