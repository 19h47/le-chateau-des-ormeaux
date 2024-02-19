<?php // phpcs:ignore
/**
 * Prepare Field
 *
 * @package WordPress
 * @subpackage LeChateauDesOrmeaux/Plugins/ACF/Admin
 */

namespace LeChateauDesOrmeaux\Plugins\ACF\Admin;

/**
 * Prepare Field
 */
class PrepareField {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_filter( 'acf/prepare_field/name=cottages', array( $this, 'cottages' ), 10, 1 );
	}

	/**
	 * Cottages
	 *
	 * @param array $field The field array containing all settings (including value).
	 */
	public function cottages( array $field ) {
		global $post;

		if ( 'cottage' === $post->post_type ) {
			return false;
		}

		return $field;
	}
}
