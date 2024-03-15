<?php // phpcs:ignore
/**
 * Cottage Post Fields
 *
 * @package WordPress
 * @subpackage LeChateauDesOrmeaux
 */

namespace LeChateauDesOrmeaux\Plugins\ACF\IncludeFields;

/**
 * Cottage Post Fields
 */
class CottagePostFields {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'acf/include_fields', array( $this, 'fields' ) );
	}

	/**
	 * Registers the field group.
	 *
	 * @return void
	 */
	public function fields() {
		$key            = 'cottage_post';
		$hide_on_screen = array( 'the_content' );

		$location = array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'cottage',
				),
			),
		);

		$fields = array(
			array(
				'key'         => 'field_' . $key . '_prices',
				'label'       => __( 'Prices', 'le-chateau-des-ormeaux' ),
				'name'        => 'prices',
				'type'        => 'textarea',
				'rows'        => 2,
				'placeholder' => __( 'Prices', 'le-chateau-des-ormeaux' ),
				'new_lines'   => 'br',
			),
		);

		if ( function_exists( 'acf_add_local_field_group' ) ) {

			acf_add_local_field_group(
				array(
					'key'            => 'group_' . $key,
					'title'          => __( 'Cottage Post Fields', 'le-chateau-des-ormeaux' ),
					'fields'         => $fields,
					'location'       => $location,
					'hide_on_screen' => $hide_on_screen,
					'menu_order'     => 0,
				)
			);

		}
	}
}
