<?php // phpcs:ignore
/**
 * Class Cottage
 *
 * @package WordPress
 * @subpackage LeChateauDesOrmeaux
 */

namespace LeChateauDesOrmeaux\Post;

use Timber\{ Timber };

/**
 * Cottage class
 */
class Cottage {

	/**
	 * Runs initialization tasks.
	 *
	 * @access public
	 */
	public function run() {
		add_action( 'init', array( $this, 'register' ), 10, 0 );
		add_action( 'admin_head', array( $this, 'css' ) );
		add_action( 'manage_cottage_posts_custom_column', array( $this, 'render_custom_columns' ), 10, 2 );

		add_filter( 'post_updated_messages', array( $this, 'updated_messages' ), 10, 1 );
		add_filter( 'bulk_post_updated_messages', array( $this, 'bulk_updated_messages' ), 10, 2 );
		add_filter( 'manage_cottage_posts_columns', array( $this, 'add_custom_columns' ) );
	}


	/**
	 * CSS
	 *
	 * @return bool
	 */
	public function css(): bool {
		global $typenow;

		if ( 'cottage' !== $typenow ) {
			return false;
		}

		?>
		<style>
			.fixed .column-thumbnail {
				vertical-align: top;
				width: 80px;
			}

			.column-thumbnail a {
				display: block;
			}
			.column-thumbnail a img {
				display: inline-block;
				vertical-align: middle;
				width: 80px;
				height: 80px;
				object-fit: cover;
				object-position: center;
				overflow: hidden;
			}

			.fixed .column-background_color {
				vertical-align: top;
				width: 80px;
			}

			.column-background_color div {
				display: block;
				height: 80px;
				width: 80px;
			}

		</style>
		<?php

		return true;
	}


	/**
	 * Add custom columns
	 *
	 * @param array $columns Array of columns.
	 * @return array $new_columns
	 * @link https://developer.wordpress.org/reference/hooks/manage_post_type_posts_columns/
	 */
	public function add_custom_columns( array $columns ): array {
		$new_columns = array();

		unset( $columns['date'] );

		foreach ( $columns as $key => $value ) {
			if ( 'title' === $key ) {
				$new_columns['thumbnail']        = __( 'Thumbnail', 'le-chateau-des-ormeaux' );
			}

			$new_columns[ $key ] = $value;
		}
		return $new_columns;
	}


	/**
	 * Render custom columns
	 *
	 * @param string $column_name The column name.
	 * @param int    $post_id The ID of the post.
	 * @link https://developer.wordpress.org/reference/hooks/manage_post-post_type_posts_custom_column/
	 *
	 * @return void
	 */
	public function render_custom_columns( string $column_name, int $post_id ): void {
		switch ( $column_name ) {
			case 'thumbnail':
				$thumbnail = get_post_thumbnail_id( $post_id );
				$html      = '—';

				if ( $thumbnail ) {
					$html = Timber::compile(
						'admin/column-thumbnail.html.twig',
						array(
							'href'      => get_edit_post_link( $post_id ),
							'thumbnail' => $thumbnail,
						)
					);
				}

				echo wp_kses_post( $html );

				break;
		}
	}


	/**
	 * Updated messages
	 *
	 * @param array $messages Post updated messages. For defaults see $messages declarations above.
	 * @return array $message
	 * @link https://developer.wordpress.org/reference/hooks/post_updated_messages/
	 * @access public
	 */
	public function updated_messages( array $messages ): array {
		global $post;

		$post_ID     = isset( $post_ID ) ? (int) $post_ID : 0;
		$preview_url = get_preview_post_link( $post );

		/* translators: Publish box date format, see https://secure.php.net/date */
		$scheduled_date = date_i18n( __( 'M j, Y @ H:i', 'le-chateau-des-ormeaux' ), strtotime( $post->post_date ) );

		$view_link_html = sprintf(
			' <a href="%1$s">%2$s</a>',
			esc_url( get_permalink( $post_ID ) ),
			__( 'View Cottage', 'le-chateau-des-ormeaux' )
		);

		$scheduled_link_html = sprintf(
			' <a target="_blank" href="%1$s">%2$s</a>',
			esc_url( get_permalink( $post_ID ) ),
			__( 'Preview Cottage', 'le-chateau-des-ormeaux' )
		);

		$preview_link_html = sprintf(
			' <a target="_blank" href="%1$s">%2$s</a>',
			esc_url( $preview_url ),
			__( 'Preview Cottage', 'le-chateau-des-ormeaux' )
		);

		$messages['cottage'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Cottage updated.', 'le-chateau-des-ormeaux' ) . $view_link_html,
			2  => __( 'Custom field updated.', 'le-chateau-des-ormeaux' ),
			3  => __( 'Custom field deleted.', 'le-chateau-des-ormeaux' ),
			4  => __( 'Cottage updated.', 'le-chateau-des-ormeaux' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Cottage restored to revision from %s.', 'le-chateau-des-ormeaux' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore
			6  => __( 'Cottage published.', 'le-chateau-des-ormeaux' ) . $view_link_html,
			7  => __( 'Cottage saved.', 'le-chateau-des-ormeaux' ),
			8  => __( 'Cottage submitted.', 'le-chateau-des-ormeaux' ) . $preview_link_html,
			9  => sprintf( __( 'Cottage scheduled for: %s.', 'le-chateau-des-ormeaux' ), '<strong>' . $scheduled_date . '</strong>' ) . $scheduled_link_html, // phpcs:ignore
			10 => __( 'Cottage draft updated.', 'le-chateau-des-ormeaux' ) . $preview_link_html,
		);

		return $messages;
	}


	/**
	 * Bulk updated messages
	 *
	 * @param array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
	 * @param array $bulk_counts Array of item counts for each message, used to build internationalized strings.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/bulk_post_updated_messages/
	 *
	 * @return array $bulk_counts
	 */
	public function bulk_updated_messages( array $bulk_messages, array $bulk_counts ): array {
		$bulk_counts_updated   = $bulk_counts['updated'];
		$bulk_counts_locked    = $bulk_counts['locked'];
		$bulk_counts_deleted   = $bulk_counts['deleted'];
		$bulk_counts_trashed   = $bulk_counts['trashed'];
		$bulk_counts_untrashed = $bulk_counts['untrashed'];

		$bulk_messages['cottage'] = array(
			/* translators: %s: Number of cottages. */
			'updated'   => _n( '%s cottage updated.', '%s cottages updated.', $bulk_counts_updated, 'le-chateau-des-ormeaux' ),
			'locked'    => ( 1 === $bulk_counts_locked ) ? __( '1 cottage not updated, somebody is editing it.', 'le-chateau-des-ormeaux' ) :
				/* translators: %s: Number of cottages. */
				_n( '%s cottage not updated, somebody is editing it.', '%s cottages not updated, somebody is editing them.', $bulk_counts_locked, 'le-chateau-des-ormeaux' ),
			/* translators: %s: Number of cottages. */
			'deleted'   => _n( '%s cottage permanently deleted.', '%s cottage permanently deleted.', $bulk_counts_deleted, 'le-chateau-des-ormeaux' ),
			/* translators: %s: Number of cottages.. */
			'trashed'   => _n( '%s cottage moved to the Trash.', '%s cottage moved to the Trash.', $bulk_counts_trashed, 'le-chateau-des-ormeaux' ),
			/* translators: %s: Number of cottages. */
			'untrashed' => _n( '%s cottage restored from the Trash.', '%s cottage restored from the Trash.', $bulk_counts_untrashed, 'le-chateau-des-ormeaux' ),
		);

		return $bulk_messages;
	}


	/**
	 * Register Custom Post Type
	 *
	 * @return void
	 * @access public
	 */
	public function register(): void {
		$labels = array(
			'name'                     => _x( 'Cottages', 'cttage type generale name', 'le-chateau-des-ormeaux' ),
			'singular_name'            => _x( 'Cottage', 'cttage type singular name', 'le-chateau-des-ormeaux' ),
			'add_new'                  => _x( 'Add New', 'cttage type', 'le-chateau-des-ormeaux' ),
			'add_new_item'             => __( 'Add New Cottage', 'le-chateau-des-ormeaux' ),
			'edit_item'                => __( 'Edit Cottage', 'le-chateau-des-ormeaux' ),
			'new_item'                 => __( 'New Cottage', 'le-chateau-des-ormeaux' ),
			'view_items'               => __( 'View Cottages', 'le-chateau-des-ormeaux' ),
			'view_item'                => __( 'View Cottage', 'le-chateau-des-ormeaux' ),
			'search_items'             => __( 'Search Cottages', 'le-chateau-des-ormeaux' ),
			'not_found'                => __( 'No cottages found.', 'le-chateau-des-ormeaux' ),
			'not_found_in_trash'       => __( 'No cottages found in Trash.', 'le-chateau-des-ormeaux' ),
			'parent_item_colon'        => __( 'Parent Cottage:', 'le-chateau-des-ormeaux' ),
			'all_items'                => __( 'All Cottages', 'le-chateau-des-ormeaux' ),
			'archives'                 => __( 'Cottage Archives', 'le-chateau-des-ormeaux' ),
			'attributes'               => __( 'Cottage Attributes', 'le-chateau-des-ormeaux' ),
			'insert_into_item'         => __( 'Insert into cottage', 'le-chateau-des-ormeaux' ),
			'uploaded_to_this_item'    => __( 'Uploaded to this cottage', 'le-chateau-des-ormeaux' ),
			'featured_image'           => _x( 'Featured Image', 'cottage', 'le-chateau-des-ormeaux' ),
			'set_featured_image'       => _x( 'Set featured image', 'cottage', 'le-chateau-des-ormeaux' ),
			'remove_featured_image'    => _x( 'Remove featured image', 'cottage', 'le-chateau-des-ormeaux' ),
			'use_featured_image'       => _x( 'Use as featured image', 'cottage', 'le-chateau-des-ormeaux' ),
			'items_list_navigation'    => __( 'Cottages list navigation', 'le-chateau-des-ormeaux' ),
			'items_list'               => __( 'Cottages list', 'le-chateau-des-ormeaux' ),
			'item_published'           => __( 'Cottage published.', 'le-chateau-des-ormeaux' ),
			'item_published_privately' => __( 'Cottage published privately.', 'le-chateau-des-ormeaux' ),
			'item_reverted_to_draft'   => __( 'Cottage reverted to draft.', 'le-chateau-des-ormeaux' ),
			'item_scheduled'           => __( 'Cottage scheduled.', 'le-chateau-des-ormeaux' ),
			'item_updated'             => __( 'Cottage updated.', 'le-chateau-des-ormeaux' ),
		);

		$rewrite = array(
			'slug'       => 'cottages',
			'with_front' => true,
		);

		$args = array(
			'label'               => __( 'Cottage', 'le-chateau-des-ormeaux' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'excerpt', 'thumbnail' ),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-admin-multisite',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'show_in_rest'        => true,
			'taxonomies'          => array(),
		);

		register_post_type( 'cottage', $args );
	}
}
