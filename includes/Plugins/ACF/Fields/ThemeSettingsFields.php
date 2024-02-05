<?php // phpcs:ignore
/**
 * Theme Settings Fields
 *
 * @package WordPress
 * @subpackage LeChateauDesOrmeaux
 */

namespace LeChateauDesOrmeaux\Plugins\ACF\Fields;

/**
 * Theme Settings Fields
 */
class ThemeSettingsFields {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'acf/init', array( $this, 'fields' ) );
	}

	/**
	 * Registers the field group.
	 *
	 * @return void
	 */
	public function fields() {
		$key            = 'theme_settings';
		$hide_on_screen = array();

		$location = array(
			array(
				array(
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'theme-settings',
				),
			),
		);

		$fields = array();

		if ( function_exists( 'acf_add_local_field_group' ) ) {

			acf_add_local_field_group(
				array(
					'key'            => 'group_' . $key,
					'title'          => __( 'Theme Settings Fields', 'le-chateau-des-ormeaux' ),
					'fields'         => $fields,
					'location'       => $location,
					'hide_on_screen' => $hide_on_screen,
					'menu_order'     => 0,
				)
			);

		}
	}
}
