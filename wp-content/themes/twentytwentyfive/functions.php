<?php
/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

// Adds theme support for post formats.
if ( ! function_exists( 'twentytwentyfive_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_post_format_setup' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'twentytwentyfive_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_editor_style() {
		add_editor_style( get_parent_theme_file_uri( 'assets/css/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_editor_style' );

// Enqueues style.css on the front.
if ( ! function_exists( 'twentytwentyfive_enqueue_styles' ) ) :
	/**
	 * Enqueues style.css on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_enqueue_styles() {
		wp_enqueue_style(
			'twentytwentyfive-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles' );

// Registers custom block styles.
if ( ! function_exists( 'twentytwentyfive_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfive' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'twentytwentyfive_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label'       => __( 'Pages', 'twentytwentyfive' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfive' ),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label'       => __( 'Post formats', 'twentytwentyfive' ),
				'description' => __( 'A collection of post format patterns.', 'twentytwentyfive' ),
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'twentytwentyfive_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_register_block_bindings() {
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive' ),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'twentytwentyfive_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function twentytwentyfive_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;








// ===============================================================================
// ===============================================================================
// ===============================================================================

							// Ikonic Tasks Starts here


// enqueing external files and scripts starts here
function enqueue_ajax_script() {
    wp_enqueue_script('ajax-projects', get_template_directory_uri() . '/assets/js/ajax-projects.js', ['jquery'], null, true);
	wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.css' );
    wp_localize_script('ajax-projects', 'ajax_object', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_script');
// enqueing external files and scripts ends here


// redirection on ip starts here
function redirect_ip_starting_with_77_29() {
	// $user_ip = '77.29.123.45'; 
	$user_ip = $_SERVER['REMOTE_ADDR'];
    if (filter_var($user_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        if (strpos($user_ip, '77.29') === 0) {
            wp_redirect('https://www.google.com');
            exit;
        }
    }
}
add_action('template_redirect', 'redirect_ip_starting_with_77_29');
// redirection on ip ends here


// register custom post type projects starts here
function register_projects_post_type() {
    $labels = [
        'name'               => 'Projects',
        'singular_name'      => 'Project',
        'add_new'            => 'Add New Project',
        'add_new_item'       => 'Add New Project',
        'edit_item'          => 'Edit Project',
        'new_item'           => 'New Project',
        'view_item'          => 'View Project',
        'all_items'          => 'All Projects',
        'search_items'       => 'Search Projects',
        'not_found'          => 'No projects found',
        'not_found_in_trash' => 'No projects found in Trash',
        'menu_name'          => 'Projects',
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'projects'],
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],  // Ensure 'thumbnail' is here
        'menu_icon'          => 'dashicons-portfolio',
    ];

    register_post_type('projects', $args);
}
add_action('init', 'register_projects_post_type');
// register custom post type projects ends here


// registering custom taxonomy for custom post type projects starts here
function register_project_type_taxonomy() {
    $labels = [
        'name'              => 'Project Types',
        'singular_name'     => 'Project Type',
        'search_items'      => 'Search Project Types',
        'all_items'         => 'All Project Types',
        'parent_item'       => 'Parent Project Type',
        'parent_item_colon' => 'Parent Project Type:',
        'edit_item'         => 'Edit Project Type',
        'update_item'       => 'Update Project Type',
        'add_new_item'      => 'Add New Project Type',
        'new_item_name'     => 'New Project Type Name',
        'menu_name'         => 'Project Types',
    ];

    $args = [
        'labels'            => $labels,
        'hierarchical'      => true, // True for categories, false for tags
        'public'            => true,
        'show_in_rest'      => true, // Enable Gutenberg support
        'rewrite'           => ['slug' => 'project-type'],
    ];

    register_taxonomy('project_type', 'projects', $args);
}
add_action('init', 'register_project_type_taxonomy');
// registering custom taxonomy for custom post type projects ends here


// limiting the post page posts for custom post type projects starts here 
function set_projects_per_page($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('projects')) {
        $query->set('posts_per_page', 6);  // Limit to 6 projects per page
    }
}
add_action('pre_get_posts', 'set_projects_per_page');
// limiting the post page posts for custom post type projects ends here 


// Ajax handler for the architectutre taxonomy of custom post type projects starts here
function get_architecture_projects() {
    $is_logged_in = is_user_logged_in();
    $posts_per_page = $is_logged_in ? 6 : 3;
    $args = [
        'post_type'      => 'projects',
        'posts_per_page' => $posts_per_page,
        'tax_query'      => [
            [
                'taxonomy' => 'project_type',
                'field'    => 'slug',
                'terms'    => 'architecture',
                'operator' => 'IN',
            ]
        ],
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    $query = new WP_Query($args);

    // Prepare the response data
    if ($query->have_posts()) {
        $projects = [];
        while ($query->have_posts()) {
            $query->the_post();
            $projects[] = [
                'id'    => get_the_ID(),
                'title' => get_the_title(),
                'link'  => get_permalink(),
            ];
        }

        // Return the success response with the project data
        wp_send_json_success($projects);
    } else {
        // Return an error message if no projects found
        wp_send_json_error('No projects found.');
    }

    wp_reset_postdata();  // Reset post data after the query
}
add_action('wp_ajax_get_architecture_projects', 'get_architecture_projects');  
add_action('wp_ajax_nopriv_get_architecture_projects', 'get_architecture_projects');
// Ajax handler for the architectutre taxonomy of custom post type projects ends here











function enqueue_kanye_quotes_script() {
    if (is_page_template('page-kanye-quotes.php')) {
        wp_enqueue_script(
            'kanye-quotes',
            get_template_directory_uri() . '/assets/js/kanye-quotes.js',
            ['jquery'],
            '1.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_kanye_quotes_script');










function hs_give_me_coffee() {
    // Define the Coffee API JSON URL
    $api_url = 'https://coffee.alexflipnote.dev/random.json';

    // Perform a GET request using the WordPress HTTP API
    $response = wp_remote_get($api_url);

    // Check for errors in the response
    if (is_wp_error($response)) {
        return 'Error fetching coffee data.';
    }

    // Extract the response body
    $body = wp_remote_retrieve_body($response);

    // Decode the JSON response
    $data = json_decode($body, true);

    // Check if the 'file' key exists and contains a valid URL
    if (!empty($data['file']) && filter_var($data['file'], FILTER_VALIDATE_URL)) {
        return esc_url($data['file']); // Return the coffee image URL
    }

    // Return an error message if no valid URL is found
    return 'No valid coffee URL found.';
}



// <img decoding="async" src="' . esc_url($coffee_url) . '" alt="Random Coffee">

function hs_display_coffee_link() {
    $coffee_url = hs_give_me_coffee();
    if ($coffee_url !== 'Error fetching coffee data.' && $coffee_url !== 'No valid coffee URL found.') {
        // Return anchor with image
        return '<a href="' . esc_url($coffee_url) . '" target="_blank" rel="noopener noreferrer">coffee link here</a>';
    }
    return '<p>' . esc_html($coffee_url) . '</p>'; // Show error message if URL is invalid
}
add_shortcode('random_coffee_link', 'hs_display_coffee_link');



