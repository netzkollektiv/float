<?php

/**
 * TinyMCE Custom Control
 *
 */
class THB_TinyMCE_Custom_Control extends WP_Customize_Control {
	/**
	 * The type of control being rendered
	 */
	public $type = 'tinymce_editor';
	/**
	 * Enqueue our scripts and styles
	 */
	public function enqueue() {
		wp_enqueue_script( 'thb-custom-controls-js', esc_url( get_theme_file_uri( 'inc/framework/customizer/custom-controls/js/customizer.js' ) ), array( 'jquery' ), '1.0', true );
		wp_enqueue_style( 'thb-custom-controls-css', esc_url( get_theme_file_uri( 'inc/framework/customizer/custom-controls/css/customizer.css' ) ), array(), '1.0', 'all' );
		wp_enqueue_editor();
	}
	/**
	 * Pass our TinyMCE toolbar string to JavaScript
	 */
	public function to_json() {
		parent::to_json();
		$this->json['thb_tinymcetoolbar1'] = 'bold italic bullist numlist alignleft aligncenter alignright link';
	}
	/**
	 * Render the control in the customizer
	 */
	public function render_content() {
		?>
		<div class="tinymce-control">
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if ( ! empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php } ?>
			<textarea id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_html( $this->value() ); ?></textarea>
		</div>
		<?php
	}
}
