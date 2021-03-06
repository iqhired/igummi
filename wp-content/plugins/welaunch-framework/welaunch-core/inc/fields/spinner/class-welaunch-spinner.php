<?php
/**
 * Spinner Field
 *
 * @package     weLaunch Framework/Fields
 * @author      Dovy Paukstys & Kevin Provance (kprovance)
 * @version     4.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'weLaunch_Spinner', false ) ) {

	/**
	 * Class weLaunch_Spinner
	 */
	class weLaunch_Spinner extends weLaunch_Field {

		/**
		 * Set field and value defaults.
		 */
		public function set_defaults() {
			$params = array(
				'min'     => '',
				'max'     => '',
				'step'    => '',
				'default' => '',
				'edit'    => true,
				'plus'    => '+',
				'minus'   => '-',
				'format'  => '',
				'prefix'  => '',
				'suffix'  => '',
				'point'   => '.',
				'places'  => null,
			);

			$this->field = wp_parse_args( $this->field, $params );
		}

		/**
		 * Field Render Function.
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since weLaunchFramework 3.0.0
		 */
		public function render() {
			$data_string = '';

			foreach ( $this->field as $key => $val ) {
				if ( in_array( $key, array( 'min', 'max', 'step', 'default', 'plus', 'minus', 'prefix', 'suffix', 'point', 'places' ), true ) ) {
					$data_string .= ' data-' . esc_attr( $key ) . '="' . esc_attr( $val ) . '" ';
				}
			}

			$data_string .= ' data-val=' . $this->value;

			// Don't allow input edit if there's a step.
			$readonly = '';
			if ( isset( $this->field['edit'] ) && false === $this->field['edit'] ) {
				$readonly = ' readonly="readonly"';
			}

			echo '<div id="' . esc_attr( $this->field['id'] ) . '-spinner" class="welaunch_spinner" rel="' . esc_attr( $this->field['id'] ) . '">';

			echo '<input type="text" ' . $data_string . ' name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '" id="' . esc_attr( $this->field['id'] ) . '" value="' . esc_attr( $this->value ) . '" class="mini spinner-input ' . esc_attr( $this->field['class'] ) . '"' . $readonly . '/>'; // phpcs:ignore WordPress.Security.EscapeOutput

			echo '</div>';
		}

		/**
		 * Clean the field data to the fields defaults given the parameters.
		 *
		 * @since weLaunch_Framework 3.1.1
		 */
		private function clean() {
			if ( empty( $this->field['min'] ) ) {
				$this->field['min'] = 0;
			} else {
				$this->field['min'] = intval( $this->field['min'] );
			}

			if ( empty( $this->field['max'] ) ) {
				$this->field['max'] = intval( $this->field['min'] ) + 1;
			} else {
				$this->field['max'] = intval( $this->field['max'] );
			}

			if ( empty( $this->field['step'] ) || $this->field['step'] > $this->field['max'] ) {
				$this->field['step'] = 1;
			} else {
				$this->field['step'] = intval( $this->field['step'] );
			}

			if ( empty( $this->value ) && ! empty( $this->field['default'] ) && intval( $this->field['min'] ) >= 1 ) {
				$this->value = intval( $this->field['default'] );
			}

			if ( empty( $this->value ) && intval( $this->field['min'] ) >= 1 ) {
				$this->value = intval( $this->field['min'] );
			}

			if ( empty( $this->value ) ) {
				$this->value = 0;
			}

			// Extra Validation.
			if ( $this->value < $this->field['min'] ) {
				$this->value = intval( $this->field['min'] );
			} elseif ( $this->value > $this->field['max'] ) {
				$this->value = intval( $this->field['max'] );
			}
		}

		/**
		 * Enqueue Function.
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since weLaunchFramework 3.0.0
		 */
		public function enqueue() {
			wp_enqueue_script(
				'welaunch-field-spinner-custom-js',
				weLaunch_Core::$url . 'inc/fields/spinner/vendor/jquery.ui.spinner' . weLaunch_Functions::is_min() . '.js',
				array( 'jquery', 'welaunch-js' ),
				$this->timestamp,
				true
			);

			wp_enqueue_script(
				'welaunch-field-spinner-js',
				weLaunch_Core::$url . 'inc/fields/spinner/welaunch-spinner' . weLaunch_Functions::is_min() . '.js',
				array( 'jquery', 'welaunch-field-spinner-custom-js', 'jquery-ui-core', 'jquery-ui-dialog', 'welaunch-js' ),
				$this->timestamp,
				true
			);

			if ( $this->parent->args['dev_mode'] ) {
				wp_enqueue_style(
					'welaunch-field-spinner-css',
					weLaunch_Core::$url . 'inc/fields/spinner/welaunch-spinner.css',
					array(),
					$this->timestamp,
					'all'
				);
			}
		}

		/**
		 * CSS/compiler output.
		 *
		 * @param string $style CSS styles.
		 */
		public function output( $style = '' ) {
			$style = '';

			if ( ! empty( $this->value ) ) {
				if ( ! empty( $this->field['output'] ) && is_array( $this->field['output'] ) ) {
					$css                      = $this->parse_css( $this->value, $this->field['output'] );
					$this->parent->outputCSS .= esc_attr( $css );
				}

				if ( ! empty( $this->field['compiler'] ) && is_array( $this->field['compiler'] ) ) {
					$css                        = $this->parse_css( $this->value, $this->field['compiler'] );
					$this->parent->compilerCSS .= esc_attr( $css );
				}
			}
		}

		/**
		 * Compile CSS data for output.
		 *
		 * @param mixed $value Value.
		 * @param array $output .
		 *
		 * @return string
		 */
		private function parse_css( $value, $output ) {
			// No notices.
			$css = '';

			$unit = isset( $this->field['output_unit'] ) ? $this->field['output_unit'] : 'px';

			// Must be an array.
			if ( is_array( $output ) ) {
				foreach ( $output as $selector => $mode ) {
					if ( '' !== $mode && '' !== $selector ) {
						$css .= $selector . '{' . $mode . ':' . $value . $unit . ';}';
					}
				}
			}

			return $css;
		}

		/**
		 * Enable output_variables to be generated.
		 *
		 * @since       4.0.3
		 * @return void
		 */
		public function output_variables() {
			// No code needed, just defining the method is enough.
		}
	}
}

class_alias( 'weLaunch_Spinner', 'weLaunchFramework_Spinner' );
