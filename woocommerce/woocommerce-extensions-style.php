<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'tuning_woocommerce_extensions_get_css' ) ) {
	add_filter( 'tuning_filter_get_css', 'tuning_woocommerce_extensions_get_css', 10, 2 );
	function tuning_woocommerce_extensions_get_css( $css, $args ) {

		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS

.woocommerce-accordion.tuning_accordion .woocommerce-accordion-title {
	{$fonts['h5_font-family']}
	{$fonts['h5_font-weight']}
	{$fonts['h5_text-transform']}
	{$fonts['h5_letter-spacing']}
}
.single_product_custom_text_style {
	{$fonts['h5_font-family']}
}

CSS;
		}

		return $css;
	}
}