<?php

/**
 * Google Font Select Custom Control
 *
 */
class THB_Google_Font_Select_Custom_Control extends WP_Customize_Control {
	/**
	 * The type of control being rendered
	 */
	public $type = 'google_fonts';
	/**
	 * The list of Google Fonts
	 */
	private $font_list = false;
	/**
	 * The saved font values decoded from json
	 */
	private $font_values = array();
	/**
	 * The index of the saved font within the list of Google fonts
	 */
	private $font_list_index = 0;
	/**
	 * The number of fonts to display from the json file. Either positive integer or 'all'. Default = 'all'
	 */
	private $font_count = 'all';
	/**
	 * The font list sort order. Either 'alpha' or 'popular'. Default = 'alpha'
	 */
	private $font_order_by = 'alpha';
	/**
	 * Get our list of fonts from the json file
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
		// Get the font sort order
		if ( isset( $this->input_attrs['orderby'] ) && strtolower( $this->input_attrs['orderby'] ) === 'popular' ) {
			$this->font_order_by = 'popular';
		}
		// Get the list of Google fonts
		if ( isset( $this->input_attrs['font_count'] ) ) {
			if ( 'all' !== strtolower( $this->input_attrs['font_count'] ) ) {
				$this->font_count = ( abs( (int) $this->input_attrs['font_count'] ) > 0 ? abs( (int) $this->input_attrs['font_count'] ) : 'all' );
			}
		}
		$this->font_list = $this->THB_getGoogleFonts( 'all' );
		// Decode the default json font value
		$this->font_values = json_decode( $this->value() );
		// Find the index of our default font within our list of Google fonts
		$this->font_list_index = $this->THB_getFontIndex( $this->font_list, $this->font_values->font );
	}
	/**
	 * Enqueue our scripts and styles
	 */
	public function enqueue() {
		wp_enqueue_script( 'thb-select2-js', esc_url( get_theme_file_uri( 'inc/framework/customizer/custom-controls/js/select2.full.min.js' ) ), array( 'jquery' ), '4.0.13', true );
		wp_enqueue_script( 'thb-custom-controls-js', esc_url( get_theme_file_uri( 'inc/framework/customizer/custom-controls/js/customizer.js' ) ), array( 'thb-select2-js' ), '1.0', true );
		wp_enqueue_style( 'thb-custom-controls-css', esc_url( get_theme_file_uri( 'inc/framework/customizer/custom-controls/css/customizer.css' ) ), array(), '1.1', 'all' );
		wp_enqueue_style( 'thb-select2-css', esc_url( get_theme_file_uri( 'inc/framework/customizer/custom-controls/css/select2.min.css' ) ), array(), '4.0.13', 'all' );
	}
	/**
	 * Export our List of Google Fonts to JavaScript
	 */
	public function to_json() {
		parent::to_json();
		$this->json['thb_fontslist'] = $this->font_list;
	}
	/**
	 * Render the control in the customizer
	 */
	public function render_content() {
		$font_counter    = 0;
		$is_font_in_list = false;
		$font_list_str   = '';

		if ( ! empty( $this->font_list ) ) {
			?>
			<div class="google_fonts_select_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-google-font-selection" <?php $this->link(); ?> />
				<div class="google-fonts">
					<select class="google-fonts-list" control-name="<?php echo esc_attr( $this->id ); ?>">
						<?php
						foreach ( $this->font_list as $key => $value ) {
							$font_counter++;
							?>
							<option value="<?php echo esc_attr( $value->family ); ?>" <?php selected( $this->font_values->font, $value->family, true ); ?>><?php echo esc_html( $value->family ); ?></option>
							<?php
							if ( $this->font_values->font === $value->family ) {
								$is_font_in_list = true;
							}
							if ( is_int( $this->font_count ) && $font_counter === $this->font_count ) {
								break;
							}
						}
						if ( ! $is_font_in_list && $this->font_list_index ) {
							// If the default or saved font value isn't in the list of displayed fonts, add it to the top of the list as the default font
							?>
							<option value="<?php echo esc_attr( $this->font_list[ $this->font_list_index ]->family ); ?>" <?php selected( $this->font_values->font, $this->font_list[ $this->font_list_index ]->family, true ); ?>><?php echo esc_html( $this->font_list[ $this->font_list_index ]->family ); ?> (default)</option>
							<?php
						}
						?>
					</select>
				</div>
				<div class="customize-control-description"><?php esc_html_e( 'Select weight & style for regular text', 'pure-fashion' ); ?></div>
				<div class="weight-style">
					<select class="google-fonts-regularweight-style">
						<?php
						foreach ( $this->font_list[ $this->font_list_index ]->variants as $key => $value ) {
							echo '<option value="' . esc_attr( $value ) . '" ' . selected( $this->font_values->regularweight, $value, false ) . '>' . esc_html( $value ) . '</option>';
						}
						?>
					</select>
				</div>
				<div class="customize-control-description"><?php esc_html_e( 'Select weight for', 'pure-fashion' ); ?> <italic><?php esc_html_e( 'italic text', 'pure-fashion' ); ?></italic></div>
				<div class="weight-style">
					<select class="google-fonts-italicweight-style" <?php disabled( in_array( 'italic', $this->font_list[ $this->font_list_index ]->variants ), false ); ?>>
						<?php
							$option_count = 0;
						foreach ( $this->font_list[ $this->font_list_index ]->variants as $key => $value ) {
							// Only add options that are italic
							if ( strpos( $value, 'italic' ) !== false ) {
								echo '<option value="' . esc_attr( $value ) . '" ' . selected( $this->font_values->italicweight, $value, false ) . '>' . esc_html( $value ) . '</option>';
								$option_count++;
							}
						}
						if ( 0 === $option_count ) {
							echo '<option value="">Not Available for this font</option>';
						}
						?>
					</select>
				</div>
				<div class="customize-control-description"><?php esc_html_e( 'Select weight for', 'pure-fashion' ); ?> <strong><?php esc_html_e( 'bold text', 'pure-fashion' ); ?></strong></div>
				<div class="weight-style">
					<select class="google-fonts-boldweight-style">
						<?php
							$option_count = 0;
						foreach ( $this->font_list[ $this->font_list_index ]->variants as $key => $value ) {
							// Only add options that aren't italic
							if ( strpos( $value, 'italic' ) === false ) {
								echo '<option value="' . esc_attr( $value ) . '" ' . selected( $this->font_values->boldweight, $value, false ) . '>' . esc_html( $value ) . '</option>';
								$option_count++;
							}
						}
							// This should never evaluate as there'll always be at least a 'regular' weight
						if ( 0 === $option_count ) {
							echo '<option value="">Not Available for this font</option>';
						}
						?>
					</select>
				</div>
				<input type="hidden" class="google-fonts-category" value="<?php echo esc_attr( $this->font_values->category ); ?>">
			</div>
			<?php
		}
	}

	/**
	 * Find the index of the saved font in our multidimensional array of Google Fonts
	 */
	public function THB_getFontIndex( $haystack, $needle ) {
		foreach ( $haystack as $key => $value ) {
			if ( $value->family === $needle ) {
				return $key;
			}
		}
		return false;
	}

	/**
	 * Return the list of Google Fonts from our json file. Unless otherwise specfied, list will be limited to 30 fonts.
	 */
	public function THB_getGoogleFonts( $count = 30 ) {
		// Google Fonts json generated from https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=YOUR-API-KEY
		$font_file = get_theme_file_uri( 'inc/framework/customizer/custom-controls/json/google-fonts-alphabetical.json' );
		if ( 'popular' === $this->font_order_by ) {
			$font_file = get_theme_file_uri( 'inc/framework/customizer/custom-controls/json/google-fonts-popularity.json' );
		}

		$request = wp_remote_get( $font_file );
		if ( is_wp_error( $request ) ) {
			return '';
		}

		$body    = wp_remote_retrieve_body( $request );
		$content = json_decode( $body );

		if ( 'all' === $count ) {
			return $content->items;
		} else {
			return array_slice( $content->items, 0, $count );
		}
	}
}
