<?php
/**
 * The template to display the background video in the header
 *
 * @package TUNING
 * @since TUNING 1.0.14
 */
$tuning_header_video = tuning_get_header_video();
$tuning_embed_video  = '';
if ( ! empty( $tuning_header_video ) && ! tuning_is_from_uploads( $tuning_header_video ) ) {
	if ( tuning_is_youtube_url( $tuning_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $tuning_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php tuning_show_layout( tuning_get_embed_video( $tuning_header_video ) ); ?></div>
		<?php
	}
}
