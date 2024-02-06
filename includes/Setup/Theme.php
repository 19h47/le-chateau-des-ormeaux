<?php // phpcs:ignore
/**
 * Themes
 *
 * @package WordPress
 * @subpackage LeChateauDesOrmeaux/Setup/Theme
 */

namespace LeChateauDesOrmeaux\Setup;

use Timber\{ Timber, Site };

Timber::init();
Timber::$dirname = array( 'views', 'templates', 'dist' );

/**
 * Theme
 */
class Theme extends Site {

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function run(): void {
		add_filter( 'timber/context', array( $this, 'add_socials_to_context' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/context', array( $this, 'add_to_theme' ) );
		add_filter( 'timber/post/classmap', array( $this, 'add_post_classmap' ) );
	}


	/**
	 * Add to theme
	 *
	 * @param array $context Timber context.
	 */
	public function add_to_theme( array $context ): array {
		$manifest = get_theme_manifest();

		$context['theme']->manifest = array();

		foreach ( $manifest as $label => $path ) {
			$context['theme']->manifest[ $label ] = get_template_directory_uri() . '/' . $path;
		}

		return $context;
	}


	/**
	 * Add socials to context
	 *
	 * @param array $context Timber context.
	 * @return array
	 */
	public function add_socials_to_context( array $context ): array {
		// Share and Socials links.
		$socials = array(
			array(
				'title' => __( 'Facebook', 'le-chateau-des-ormeaux' ),
				'slug'  => 'facebook',
				'name'  => __( 'Share on Facebook', 'le-chateau-des-ormeaux' ),
				'link'  => 'https://www.facebook.com/sharer.php?u=',
				'url'   => get_option( 'facebook' ),
				'color' => '#3b5998',
			),
			array(
				'title' => __( 'Instagram', 'le-chateau-des-ormeaux' ),
				'slug'  => 'instagram',
				'url'   => get_option( 'instagram' ),
			),
			array(
				'title' => __( 'YouTube', 'le-chateau-des-ormeaux' ),
				'slug'  => 'youtube',
				'url'   => get_option( 'youtube' ),
				'color' => '#ff0000',
			),
			array(
				'title' => __( 'Twitter', 'le-chateau-des-ormeaux' ),
				'slug'  => 'twitter',
				'name'  => __( 'Share on Twitter', 'le-chateau-des-ormeaux' ),
				'link'  => 'https://twitter.com/intent/tweet?url=',
				'url'   => get_option( 'twitter' ),
				'color' => '#1da1f2',
			),
			array(
				'title' => __( 'LinkedIn', 'le-chateau-des-ormeaux' ),
				'slug'  => 'linkedin',
				'name'  => __( 'Share on LinkedIn', 'le-chateau-des-ormeaux' ),
				'link'  => 'https://www.linkedin.com/sharing/share-offsite/?url=',
				'url'   => get_option( 'linkedin' ),
				'color' => '#0077b5',
			),

		);

		foreach ( $socials as $social ) {
			if ( ! empty( $social['url'] ) ) {
				$context['socials'][ $social['slug'] ] = $social;
			}

			if ( ! empty( $social['link'] ) ) {
				$context['shares'][ $social['slug'] ] = $social;
			}
		}

		return $context;
	}


	/**
	 * Add to context
	 *
	 * @param array $context Timber context.
	 *
	 * @return array
	 * @since  1.0.0
	 */
	public function add_to_context( array $context ): array {
		global $wp;

		$context['current_url']    = home_url( add_query_arg( array(), $wp->request ) );
		$context['public_email']   = get_option( 'public_email_' . pll_current_language() );
		$context['address']        = get_option( 'address_' . pll_current_language() );
		$context['phones_numbers'] = explode( ', ', get_option( 'phones_numbers_' . pll_current_language() ) );

		$context['privacy_policy_url'] = get_privacy_policy_url();

		$context['klaviyo'] = get_field( 'klaviyo', 'option' );

		return $context;
	}

	/**
	 * Add post classmap
	 *
	 * @param array $classmap Classmap.
	 *
	 * @return array
	 */
	public function add_post_classmap( $classmap ): array {
		$custom_classmap = array();

		return array_merge( $classmap, $custom_classmap );
	}
}
