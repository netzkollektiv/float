<?php
/**
 * Global Notification
 *
 * @package WordPress
 * @subpackage pure-fashion
 * @since 1.0
 * @version 1.0
 */

$global_notification = thb_customizer( 'subheader', 1 );

if ( ! $global_notification ) {
	return;
}
?>
<aside class="subheader dark">
	<div class="row align-middle full-width-row">
		<div class="small-12 columns">
			<div><?php echo do_shortcode( thb_customizer( 'subheader_content' ) ); ?></div>
			<?php if ( is_active_sidebar( 'subheader_social' ) ) : ?>
				<?php dynamic_sidebar( 'subheader_social' ); ?>
			<?php endif; ?>
		</div>
	</div>
</aside>
