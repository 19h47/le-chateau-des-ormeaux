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
				'main'   => __( 'Main Menu', 'le-chateau-des-ormeaux' ),
				'footer' => __( 'Footer Menu', 'le-chateau-des-ormeaux' ),
				'legals' => __( 'Legals Menu', 'le-chateau-des-ormeaux' ),
			)
		);
	}
}
