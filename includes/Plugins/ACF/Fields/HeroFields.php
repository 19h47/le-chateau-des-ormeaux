<?php // phpcs:ignore
/**
 * Hero Fields
 *
 * @package WordPress
 * @subpackage LeChateauDesOrmeaux
 */

namespace LeChateauDesOrmeaux\Plugins\ACF\Fields;

/**
 * Hero Fields
 */
class HeroFields {
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
		$key            = 'hero';
		$hide_on_screen = array( 'the_content' );

		$location = array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'page',
				),
			),
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
				'key'          => 'field_' . $key,
				'label'        => __( 'Hero', 'le-chateau-des-ormeaux' ),
				'instructions' => __( 'Indicate the information to appear in the hero.', 'le-chateau-des-ormeaux' ),
				'name'         => 'hero',
				'type'         => 'group',
				'layout'       => 'block',
				'sub_fields'   => array(
					array(
						'key'          => 'field_' . $key . '_headline',
						'label'        => __( 'Headline', 'le-chateau-des-ormeaux' ),
						'name'         => 'headline',
						'type'         => 'textarea',
						'new_lines'    => 'br',
						'rows'         => 2,
						'instructions' => __( 'Indicate the headline of the hero. (Optional)', 'le-chateau-des-ormeaux' ),
						'placeholder'  => __( 'Headline', 'le-chateau-des-ormeaux' ),
					),
					array(
						'key'          => 'field_' . $key . '_text',
						'label'        => __( 'Text', 'le-chateau-des-ormeaux' ),
						'name'         => 'text',
						'type'         => 'textarea',
						'new_lines'    => 'br',
						'rows'         => 2,
						'instructions' => __( 'Indicate the text of the hero. (Optional)', 'le-chateau-des-ormeaux' ),
						'placeholder'  => __( 'Text', 'le-chateau-des-ormeaux' ),
					),
					array(
						'key'           => 'field_' . $key . '_link',
						'label'         => __( 'Link', 'le-chateau-des-ormeaux' ),
						'name'          => 'link',
						'type'          => 'link',
						'instructions'  => __( 'Indicate the link of the hero. (Optional)', 'le-chateau-des-ormeaux' ),
						'return_format' => 'array',
					),
					array(
						'key'           => 'field_' . $key . '_image',
						'label'         => __( 'Image', 'le-chateau-des-ormeaux' ),
						'name'          => 'image',
						'type'          => 'image',
						'return_format' => 'id',
						'library'       => 'all',
						'preview_size'  => 'medium',
						'instructions'  => __( 'Indicate the image of the hero. (Optional)', 'le-chateau-des-ormeaux' ),
					),
					array(
						'key'               => 'field_' . $key . '_cottages',
						'label'             => __( 'Cottages', 'le-chateau-des-ormeaux' ),
						'name'              => 'cottages',
						'type'              => 'relationship',
						'instructions'      => __( 'Indicate a maximum of two lodgings to highlight in the header. (Optional)', 'le-chateau-des-ormeaux' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'post_type'         => array( 'cottage' ),
						'post_status'       => array( 'publish' ),
						'taxonomy'          => '',
						'filters'           => array( 'search' ),
						'return_format'     => 'id',
						'min'               => 0,
						'max'               => 2,
					),
				),
			),
		);

		if ( function_exists( 'acf_add_local_field_group' ) ) {

			acf_add_local_field_group(
				array(
					'key'            => 'group_' . $key,
					'title'          => __( 'Hero Fields', 'le-chateau-des-ormeaux' ),
					'fields'         => $fields,
					'location'       => $location,
					'hide_on_screen' => $hide_on_screen,
					'menu_order'     => 0,
				)
			);

		}
	}
}
