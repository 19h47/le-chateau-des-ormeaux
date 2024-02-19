<?php // phpcs:ignore
/**
 * Settings
 *
 * @package WordPress
 * @subpackage LeChateauDesOrmeaux
 */

namespace LeChateauDesOrmeaux\Setup;

/**
 * Supports
 */
class Settings {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'admin_init', array( $this, 'settings_api_init' ) );
		add_action( 'init', array( $this, 'register_settings' ) );
	}


	/**
	 * Register settings
	 *
	 * @return void
	 */
	public function settings_api_init(): void {
		add_settings_section(
			'contacts',
			'',
			array( $this, 'contacts_callback_function' ),
			'reading'
		);

		foreach ( pll_the_languages( array( 'raw' => 1 ) ) as $language ) {
			add_settings_field(
				'public_email_' . $language['slug'],
				sprintf( __( '%s Public Email Address', 'le-chateau-des-ormeaux' ), $language['name'] ),
				array( $this, 'email_callback_function' ),
				'reading',
				'contacts',
				array(
					'name'        => 'public_email_' . $language['slug'],
					'label'       => __( 'Email', 'le-chateau-des-ormeaux' ),
					'description' => __( 'This email address is used for public purposes.', 'le-chateau-des-ormeaux' ),
					'placeholder' => 'artvandelay@vandelayindustries.com',
				)
			);

			add_settings_field(
				'phones_numbers_' . $language['slug'],
				sprintf( __( '%s Phone Number', 'le-chateau-des-ormeaux' ), $language['name'] ),
				array( $this, 'text_callback_function' ),
				'reading',
				'contacts',
				array(
					'name'        => 'phones_numbers_' . $language['slug'],
					'label'       => __( 'Phones Numbers', 'le-chateau-des-ormeaux' ),
					'placeholder' => '087 123 4567, 087 123 4567',
					'description' => __( 'Theses phones numbers are used for public purposes. Separate phones numbers with commas.', 'le-chateau-des-ormeaux' ),
				)
			);

			add_settings_field(
				'address_' . $language['slug'],
				sprintf( __( '%s Address', 'le-chateau-des-ormeaux' ), $language['name'] ),
				array( $this, 'textarea_callback_function' ),
				'reading',
				'default',
				array(
					'id'          => 'address_' . $language['slug'],
					'name'        => 'address_' . $language['slug'],
					'rows'        => 3,
					'value'       => get_option( 'address_' . $language['slug'] ),
					'description' => __( 'This address is used for public purposes.', 'le-chateau-des-ormeaux' ),
					'placeholder' => __( 'Address', 'le-chateau-des-ormeaux' ),
				)
			);
		}

		add_settings_section(
			'socials',
			'',
			array( $this, 'socials_callback_function' ),
			'general'
		);

		add_settings_field(
			'linkedin',
			__( 'LinkedIn', 'le-chateau-des-ormeaux' ),
			array( $this, 'text_callback_function' ),
			'general',
			'socials',
			array(
				'type'        => 'url',
				'name'        => 'linkedin',
				'placeholder' => 'https://www.linkedin.com/artvandelay',
				'description' => __( 'Enter the LinkedIn URL here.', 'le-chateau-des-ormeaux' ),
			)
		);

		add_settings_field(
			'instagram',
			__( 'Instagram', 'le-chateau-des-ormeaux' ),
			array( $this, 'text_callback_function' ),
			'general',
			'socials',
			array(
				'type'        => 'url',
				'name'        => 'instagram',
				'placeholder' => 'https://instagram.com/artvandelay',
				'description' => __( 'Enter the Instagram URL here.', 'le-chateau-des-ormeaux' ),
			)
		);
	}


	/**
	 * Socials callback function
	 *
	 * @return void
	 */
	public function socials_callback_function(): void {
		echo '';
	}


	/**
	 * Contacts callback function
	 *
	 * @return void
	 */
	public function contacts_callback_function(): void {
		echo '';
	}


	/**
	 * Dropdown pages callback function
	 *
	 * @param array $args Arguments.
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_dropdown_pages/
	 *
	 * @return void
	 */
	public function dropdown_pages_callback_function( array $args ): void {
		wp_dropdown_pages(
			array(
				'selected' => get_option( $args['name'] ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				'name'     => $args['name'], // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			)
		);

		if ( $args['description'] ) {
			echo wp_kses_post( '<p class="description">' . $args['description'] . '</p>' );
		}
	}


	/**
	 * Text callback function
	 *
	 * @param array $args Args.
	 *
	 * @return void
	 */
	public function text_callback_function( array $args ): void {
		wp_form_controls_input(
			array(
				'type'        => isset( $args['type'] ) && ! empty( $args['type'] ) ? $args['type'] : 'text',
				'name'        => $args['name'],
				'value'       => get_option( $args['name'] ),
				'placeholder' => $args['placeholder'],
				'description' => isset( $args['description'] ) && ! empty( $args['description'] ) ? $args['description'] : $args['placeholder'],
			),
		);
	}


	/**
	 * Email callback function
	 *
	 * @param array $args Args.
	 *
	 * @return void
	 */
	public function email_callback_function( $args ): void {
		wp_form_controls_input(
			array(
				'type'        => 'email',
				'name'        => $args['name'],
				'value'       => get_option( $args['name'] ),
				'placeholder' => $args['placeholder'],
				'description' => $args['description'],
				'attributes'  => array(
					'pattern'      => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
					'autocomplete' => 'email',
					'aria-label'   => $args['label'],
				),
			)
		);
	}


	/**
	 * URL callback function
	 *
	 * @param array $args Args.
	 *
	 * @return void
	 */
	public function url_callback_function( $args ): void {
		wp_form_controls_input(
			array(
				'type'        => 'url',
				'name'        => $args['name'],
				'value'       => get_option( $args['name'] ),
				'placeholder' => $args['placeholder'],
				'description' => $args['description'],
			)
		);
	}


	/**
	 * Textarea callback function
	 *
	 * @param array $args Arguments.
	 *
	 * @see https://core.trac.wordpress.org/browser/tags/5.6/src/wp-includes/post-template.php#L1163
	 * @return void
	 */
	public function textarea_callback_function( array $args ): void {
		wp_form_controls_textarea( $args );
	}


	/**
	 * Register settings
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_setting/
	 *
	 * @return void
	 */
	public function register_settings(): void {
		$args = array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => null,
		);

		foreach ( array( 'linkedin', 'instagram' ) as $setting ) {
			register_setting( 'general', $setting, $args );
		}

		foreach ( pll_the_languages( array( 'raw' => 1 ) ) as $language ) {
			register_setting( 'reading', 'public_email_' . $language['slug'] );
			register_setting( 'reading', 'phones_numbers_' . $language['slug'] );
			register_setting( 'reading', 'address_' . $language['slug'] );
		}
	}
}
