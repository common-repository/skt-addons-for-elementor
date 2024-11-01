<?php
namespace Skt_Addons_Elementor;

defined( 'ABSPATH' ) || die();

class Template_Query_Manager {

	/**
	 * Get Elementor template list as Select
	 *
	 * @param  string $type
	 * @return array
	 */
	public static function get_page_template_options( $type = '' ) {
		$page_templates = self::get_elementor_templates( $type );

		if ( count( $page_templates ) ) {
			foreach ( $page_templates as $id => $name ) {
				$options[$id] = $name;
			}
		} else {
			$options['no_template'] = __( 'No saved templates found!', 'skt-addons-for-elementor' );
		}

		return $options;
	}

	/**
	 * Get all WordPress registered widgets
	 *
	 * @return array
	 */
	public static function get_registered_sidebars() {
		global $wp_registered_sidebars;
		$options = [];

		if ( ! $wp_registered_sidebars ) {
			// $options[''] = __( 'No sidebars were found', 'skt-addons-for-elementor' );
		} else {
			// $options['---'] = __( 'Choose Sidebar', 'skt-addons-for-elementor' );

			foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
				$options[$sidebar_id] = $sidebar['name'];
			}
		}
		return $options;
	}

	/**
	 * Get all elementor page templates
	 *
	 * @param  null    $type
	 * @return array
	 */
	public static function get_elementor_templates( $type = null ) {
		$options = [];

		if ( $type ) {
			$args = [
			    'post_type'      => 'elementor_library',
			    'posts_per_page' => -1,
			    'elementor_library_type' => $type, // Query directly by taxonomy slug
			];

			$page_templates = get_posts( $args );

			if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ) {
				foreach ( $page_templates as $post ) {
					$options[$post->ID] = $post->post_title;
				}
			}
		} else {
			$options = self::get_query_post_list( 'elementor_library' );
		}

		return $options;
	}


    /**
     * Query Posts
     *
     * @param string $post_type
     * @param integer $limit
     * @param string $search
     * @return array
     */
	public static function get_query_post_list( $post_type = 'any', $limit = -1, $search = '' ) {
		global $wpdb;
		$where = '';
		$data  = [];

		if ( -1 == $limit ) {
			$limit = '';
		} elseif ( 0 == $limit ) {
			$limit = "limit 0,1";
		} else {
			$limit = $wpdb->prepare( " limit 0,%d", esc_sql( $limit ) );
		}

		if ( 'any' === $post_type ) {
			$in_search_post_types = get_post_types( ['exclude_from_search' => false] );
			if ( empty( $in_search_post_types ) ) {
				$where .= ' AND 1=0 ';
			} else {
				$where .= " AND {$wpdb->posts}.post_type IN ('" . join( "', '",
					array_map( 'esc_sql', $in_search_post_types ) ) . "')";
			}
		} elseif ( ! empty( $post_type ) ) {
			$where .= $wpdb->prepare( " AND {$wpdb->posts}.post_type = %s", esc_sql( $post_type ) );
		}

		if ( ! empty( $search ) ) {
			$where .= $wpdb->prepare( " AND {$wpdb->posts}.post_title LIKE %s", '%' . esc_sql( $search ) . '%' );
		}
		$args = array(
    'post_status'    => 'publish',
    'posts_per_page' => absint( $limit ), // Use the limit
    // Additional query arguments can be added here
);


add_filter( 'posts_where', function( $where_query ) use ( $where ) {
    $where_query .= " " . esc_sql( $where );
    return $where_query;
});

// Use WP_Query instead of a direct SQL query
$query = new WP_Query( $args );

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        // Access post data here
        $post_title = get_the_title();
        $post_id = get_the_ID();
        // Do something with the title and ID
    }
}

// Reset the post data after using WP_Query
wp_reset_postdata();



	}
}