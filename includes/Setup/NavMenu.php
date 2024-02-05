<?php // phpcs:ignore
/**
 * Nav Menu
 *
 * @package WordPress
 * @subpackage LeChateauDesOrmeaux
 */

namespace LeChateauDesOrmeaux\Setup;

use Timber\{ Timber };

/**
 * Nav menu
 */
class NavMenu {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'after_setup_theme', array( $this, 'register_menus' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
	}

	/**
	 * Register nav menus
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_nav_menus/
	 *
	 * @return void
	 */
	public function register_menus(): void {
		register_nav_menus(
			array(
				'main_left'  => __( 'Main Left Menu', 'le-chateau-des-ormeaux' ),
				'main_right' => __( 'Main Right Menu', 'le-chateau-des-ormeaux' ),
				'footer'     => __( 'Footer Menu', 'le-chateau-des-ormeaux' ),
			)
		);
	}


	/**
	 * Add to context
	 *
	 * @param array $context Timber context.
	 *
	 * @see https://developer.wordpress.org/reference/functions/get_registered_nav_menus/
	 * @since  1.0.0
	 *
	 * @return array
	 */
	public function add_to_context( array $context ): array {
		$menus = get_registered_nav_menus();

		foreach ( $menus as $menu => $value ) {
			$context['nav_menus'][ $menu ] = Timber::get_menu( $menu );
		}

		return $context;
	}
}
