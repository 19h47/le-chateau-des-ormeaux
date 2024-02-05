<?php // phpcs:ignore
/**
 * Init
 *
 * @package WordPress
 * @subpackage LeChateauDesOrmeaux/Plugins/ACF/Admin
 */

namespace LeChateauDesOrmeaux\Plugins\ACF\Admin;

use Timber\Timber;

/**
 * Init
 */
class Init {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'acf/init', array( $this, 'add_options_theme' ) );
	}

	/**
	 * Add options pages
	 */
	public function add_options_theme() {
		$parent = acf_add_options_page(
			array(
				'page_title' => __( 'Theme Settings', 'le-chateau-des-ormeaux' ),
				'menu_slug'  => 'theme-settings',
				'capability' => 'edit_posts',
				'icon_url'   => 'dashicons-admin-settings',
			)
		);
	}
}
