<?php // phpcs:ignore
/**
 * Blocks Fields
 *
 * @package WordPress
 * @subpackage LeChateauDesOrmeaux
 */

namespace LeChateauDesOrmeaux\Plugins\ACF\Fields;

/**
 * Blocks  Fields
 */
class BlocksFields {
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
		$key            = 'blocks';
		$hide_on_screen = array();

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
				'key'     => 'field_' . $key,
				'label'   => __( 'Blocks', 'le-chateau-des-ormeaux' ),
				'name'    => 'blocks',
				'type'    => 'flexible_content',
				'layouts' => array(
					'layout_' . $key . '_carousel' => array(
						'key'        => 'layout_' . $key . '_carousel',
						'name'       => 'carousel',
						'label'      => __( 'Carousel', 'le-chateau-des-ormeaux' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'          => 'field_' . $key . '_carousel_images',
								'label'        => __( 'Images', 'le-chateau-des-ormeaux' ),
								'name'         => 'images',
								'type'         => 'repeater',
								'layout'       => 'block',
								'instructions' => __( 'Add as many images as the block contains.', 'le-chateau-des-ormeaux' ),
								'button_label' => __( 'Add Image', 'le-chateau-des-ormeaux' ),
								'sub_fields'   => array(
									array(
										'key'             => 'field_' . $key . '_carousel_images_image',
										'label'           => __( 'Image', 'le-chateau-des-ormeaux' ),
										'name'            => 'image',
										'type'            => 'image',
										'instructions'    => __( 'Indicate the image. (Required)', 'le-chateau-des-ormeaux' ),
										'required'        => 1,
										'return_format'   => 'id',
										'library'         => 'all',
										'preview_size'    => 'medium',
										'parent_repeater' => 'field_' . $key . '_carousel_images',
										'wrapper'         => array( 'width' => 6 / 12 * 100 ),
									),
									array(
										'key'             => 'field_' . $key . '_carousel_images_caption',
										'label'           => __( 'Caption', 'le-chateau-des-ormeaux' ),
										'le-chateau-des-ormeaux',
										'name'            => 'caption',
										'type'            => 'text',
										'instructions'    => __( 'Indicate the image caption. (Optional)', 'le-chateau-des-ormeaux' ),
										'placeholder'     => __( 'Caption', 'le-chateau-des-ormeaux' ),
										'parent_repeater' => 'field_' . $key . '_carousel_images',
										'wrapper'         => array( 'width' => 6 / 12 * 100 ),
									),
								),
							),
							array(
								'key'           => 'field_' . $key . '_carousel_background_color',
								'label'         => __( 'Background Color', 'le-chateau-des-ormeaux' ),
								'name'          => 'background_color',
								'type'          => 'color_picker',
								'instructions'  => __( 'Background color of the block. (Default grayish orange)', 'le-chateau-des-ormeaux' ),
								'return_format' => 'string',
								'default_value' => '#d1c3a6',
							),
						),
					),
					'layout_' . $key . '_content'  => array(
						'key'        => 'layout_' . $key . '_content',
						'name'       => 'content',
						'label'      => __( 'Content', 'le-chateau-des-ormeaux' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'          => 'field_' . $key . '_content_title',
								'label'        => __( 'Title', 'le-chateau-des-ormeaux' ),
								'name'         => 'title',
								'type'         => 'text',
								'placeholder'  => __( 'Title', 'le-chateau-des-ormeaux' ),
								'instructions' => __( 'Indicate the title of the block. (Optional)', 'le-chateau-des-ormeaux' ),
							),
							array(
								'key'          => 'field_' . $key . '_content_content',
								'label'        => __( 'Content', 'le-chateau-des-ormeaux' ),
								'name'         => 'content',
								'type'         => 'wysiwyg',
								'tabs'         => 'all',
								'toolbar'      => 'full',
								'media_upload' => 0,
								'instructions' => __( 'Indicate the content of the block. (Optional)', 'le-chateau-des-ormeaux' ),
							),
							array(
								'key'          => 'field_' . $key . '_content_links',
								'label'        => __( 'Links', 'le-chateau-des-ormeaux' ),
								'name'         => 'links',
								'type'         => 'repeater',
								'layout'       => 'block',
								'instructions' => __( 'Add as many links as the block contains. (Optional)', 'le-chateau-des-ormeaux' ),
								'button_label' => __( 'Add Link', 'le-chateau-des-ormeaux' ),
								'sub_fields'   => array(
									array(
										'key'             => 'field_' . $key . '_content_links_link',
										'label'           => 'Link',
										'name'            => 'link',
										'type'            => 'link',
										'return_format'   => 'array',
										'parent_repeater' => 'field_' . $key . '_content_links',
									),
								),
							),
							array(
								'key'          => 'field_' . $key . '_content_images',
								'label'        => __( 'Images', 'le-chateau-des-ormeaux' ),
								'name'         => 'images',
								'type'         => 'repeater',
								'layout'       => 'block',
								'instructions' => __( 'Add as many images as the block contains. (Optional)', 'le-chateau-des-ormeaux' ),
								'button_label' => __( 'Add Image', 'le-chateau-des-ormeaux' ),
								'sub_fields'   => array(
									array(
										'key'             => 'field_' . $key . '_content_images_image',
										'label'           => __( 'Image', 'le-chateau-des-ormeaux' ),
										'name'            => 'image',
										'type'            => 'image',
										'return_format'   => 'id',
										'library'         => 'all',
										'preview_size'    => 'medium',
										'parent_repeater' => 'field_' . $key . '_content_images',
										'wrapper'         => array( 'width' => 6 / 12 * 100 ),
										'instructions'    => __( 'Indicate the image. (Required)', 'le-chateau-des-ormeaux' ),

									),
									array(
										'key'             => 'field_' . $key . '_content_images_caption',
										'label'           => __( 'Caption', 'le-chateau-des-ormeaux' ),
										'name'            => 'caption',
										'type'            => 'text',
										'placeholder'     => __( 'Caption', 'le-chateau-des-ormeaux' ),
										'parent_repeater' => 'field_' . $key . '_content_images',
										'wrapper'         => array( 'width' => 6 / 12 * 100 ),
										'instructions'    => __( 'Indicate the image caption. (Optional)', 'le-chateau-des-ormeaux' ),
									),
								),
							),
							array(
								'key'           => 'field_' . $key . '_content_background_color',
								'label'         => __( 'Background Color', 'le-chateau-des-ormeaux' ),
								'name'          => 'background_color',
								'type'          => 'color_picker',
								'instructions'  => __( 'Background color of the block. (Default white)', 'le-chateau-des-ormeaux' ),
								'wrapper'       => array(
									'width' => 6 / 12 * 100,
								),
								'return_format' => 'string',
								'default_value' => '#ffffff',
							),
							array(
								'key'           => 'field_' . $key . '_content_font_color',
								'label'         => __( 'Font Color', 'le-chateau-des-ormeaux' ),
								'name'          => 'font_color',
								'instructions'  => __( 'Font color of the block. (Default black)', 'le-chateau-des-ormeaux' ),
								'type'          => 'color_picker',
								'wrapper'       => array(
									'width' => 6 / 12 * 100,
								),
								'return_format' => 'string',
								'default_value' => '#000000',
							),
							array(
								'key'           => 'field_' . $key . '_content_layout',
								'label'         => __( 'Layout', 'le-chateau-des-ormeaux' ),
								'instructions'  => __( 'Should the image be on the right or left of the block. (Default right)', 'le-chateau-des-ormeaux' ),
								'name'          => 'layout',
								'type'          => 'radio',
								'choices'       => array(
									'right' => __( 'Image on the right', 'le-chateau-des-ormeaux' ),
									'left'  => __( 'Image on the left', 'le-chateau-des-ormeaux' ),
								),
								'default_value' => 'right',
								'return_format' => 'value',
								'layout'        => 'horizontal',
							),
						),
					),
					'layout_' . $key . '_marquee'  => array(
						'key'        => 'layout_' . $key . '_marquee',
						'name'       => 'marquee',
						'label'      => __( 'Marquee', 'le-chateau-des-ormeaux' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'           => 'field_' . $key . '_marquee_images',
								'label'         => __( 'Images', 'le-chateau-des-ormeaux' ),
								'name'          => 'images',
								'type'          => 'gallery',
								'return_format' => 'id',
								'library'       => 'all',
							),
						),
					),
				),
			),
		);

		if ( function_exists( 'acf_add_local_field_group' ) ) {

			acf_add_local_field_group(
				array(
					'key'            => 'group_' . $key,
					'title'          => __( 'Blocks Fields', 'le-chateau-des-ormeaux' ),
					'fields'         => $fields,
					'location'       => $location,
					'hide_on_screen' => $hide_on_screen,
					'menu_order'     => 1,
				)
			);

		}
	}
}
