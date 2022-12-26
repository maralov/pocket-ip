<?php
    const REWRITE_POST_TYPES = [
        'services' => 'service_type',
        'solutions' => 'solution_type'
    ];

    add_action( 'init', 'register_post_types' );
	function register_post_types(){
		register_post_type('services', array(
			'label'               => 'Services',
			'labels'              => array(
				'name'               => 'Services',
				'singular_name'      => 'Service',
				'add_new'            => 'Add new post',
				'add_new_item'       => 'Add new post',
				'edit_item'          => 'Edit post',
				'new_item'           => 'New post',
				'view_item'          => 'View post',
				'search_items'       => 'Search post',
				'not_found'          => 'No posts found',
				'not_found_in_trash' => 'No posts found in trash',
				'menu_name'          => 'Services',
			),
			'description'         => '',
			'menu_icon'			=> 'dashicons-admin-tools',
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_rest'        => true,
			'rest_base'           => '',
			'show_in_menu'        => true,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'hierarchical'        => false,
			'has_archive'         => false,
			'query_var'           => true,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' )
		) );

		register_taxonomy('service_type', array('services'), array(
			'label'                 => 'Services types',
			'labels'                => array(
				'name'              => 'Services types',
				'singular_name'     => 'Service type',
				'search_items'      => 'Search service types',
				'all_items'         => 'All service types',
				'parent_item'       => 'Parent service type',
				'parent_item_colon' => 'Parent service type:',
				'edit_item'         => 'Edit service type',
				'update_item'       => 'Update service type',
				'add_new_item'      => 'Add new service type',
				'new_item_name'     => 'New service type',
				'menu_name'         => 'Service types',
			),
			'description'           => '',
			'public'                => true,
			'show_in_nav_menus'     => true,
			'show_ui'               => true,
			'show_tagcloud'         => true,
			'show_in_rest'          => true,
			'hierarchical'          => true,
			'show_admin_column'     => true,
		) );

		register_taxonomy('service_country', array('services'), array(
			'label'                 => 'Services by country',
			'labels'                => array(
				'name'              => 'Services by country', 'taxonomy general name',
				'singular_name'     => 'Service by country', 'taxonomy singular name',
				'search_items'      => 'Search country',
				'all_items'         => 'All types of country',
				'parent_item'       => 'Parent country',
				'parent_item_colon' => 'Parent country:',
				'edit_item'         => 'Edit country',
				'update_item'       => 'Update country',
				'add_new_item'      => 'Add new country',
				'new_item_name'     => 'New country',
				'menu_name'         => 'Services by country',
			),
			'description'           => '',
			'public'                => false,
			'show_in_nav_menus'     => false,
			'show_ui'               => true,
			'show_tagcloud'         => true,
			'show_in_rest'        => true,
			'hierarchical'          => true,
			'rewrite'               => true,
			'show_admin_column'     => true,
		) );

		register_post_type('solutions', array(
			'label'               => 'Solutions',
			'labels'              => array(
				'name'               => 'Solutions',
				'singular_name'      => 'Solution',
				'add_new'            => 'Add new post',
				'add_new_item'       => 'Add new post',
				'edit_item'          => 'Edit post',
				'new_item'           => 'New post',
				'view_item'          => 'View post',
				'search_items'       => 'Search posts',
				'not_found'          => 'No posts found',
				'not_found_in_trash' => 'No posts found in trash',
				'menu_name'          => 'Solutions',
			),
			'description'         => '',
			'menu_icon'			=> 'dashicons-plugins-checked',
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_rest'        => true,
			'rest_base'           => '',
			'show_in_menu'        => true,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'hierarchical'        => false,
			'has_archive'         => false,
			'query_var'           => true,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' )
		) );

        register_taxonomy('solution_type', array('solutions'), array(
			'label'                 => 'Solutions type',
			'labels'                => array(
				'name'              => 'Solutions type', 'taxonomy general name',
				'singular_name'     => 'Solutions type', 'taxonomy singular name',
				'search_items'      =>  'Search solutions type',
				'all_items'         => 'All types of solutions',
				'parent_item'       => 'Parent solutions type',
				'parent_item_colon' => 'Parent solutions type:',
				'edit_item'         => 'Edit solutions type',
				'update_item'       => 'Update solutions type',
				'add_new_item'      => 'Add new solutions type',
				'new_item_name'     => 'New solutions type',
				'menu_name'         => 'Solutions type',
			),
			'description'           => '',
			'public'                => true,
			'show_in_nav_menus'     => true,
			'show_ui'               => true,
			'show_tagcloud'         => true,
			'show_in_rest'        => true,
			'hierarchical'          => true,
			'show_admin_column'     => true,
		) );

		register_taxonomy('solution_country', array('solutions'), array(
			'label'                 => 'Solutions by country',
			'labels'                => array(
				'name'              => 'Solutions by country', 'taxonomy general name',
				'singular_name'     => 'Solution by country', 'taxonomy singular name',
				'search_items'      =>  'Search country',
				'all_items'         => 'All types of country',
				'parent_item'       => 'Parent country',
				'parent_item_colon' => 'Parent country:',
				'edit_item'         => 'Edit country',
				'update_item'       => 'Update country',
				'add_new_item'      => 'Add new country',
				'new_item_name'     => 'New country',
				'menu_name'         => 'Solutions by country',
			),
			'description'           => '',
			'public'                => false,
			'show_in_nav_menus'     => false,
			'show_ui'               => true,
			'show_tagcloud'         => true,
			'show_in_rest'        => true,
			'hierarchical'          => true,
			'rewrite'               => true,
			'show_admin_column'     => true,
		) );

        register_post_type('partners', array(
			'label'               => 'Partners',
			'labels'              => array(
				'name'               => 'Partners',
				'singular_name'      => 'Partner',
				'add_new'            => 'Add new post',
				'add_new_item'       => 'Add new post',
				'edit_item'          => 'Edit post',
				'new_item'           => 'New post',
				'view_item'          => 'View post',
				'search_items'       => 'Search posts',
				'not_found'          => 'No posts found',
				'not_found_in_trash' => 'No posts found in trash',
				'menu_name'          => 'Partners',
			),
			'description'       	=> '',
			'menu_icon'				=> 'dashicons-groups',
			'public' 				=> false,
			'show_ui' 				=> true,
			'has_archive'         	=> false,
			'query_var'           	=> true,
			'supports'            	=> array( 'title', 'editor', 'thumbnail', 'custom-fields' )
		) );

        register_taxonomy('partners_country', array('partners'), array(
			'label'                 => 'Partners country',
			'labels'                => array(
				'name'              => 'Partners country', 'taxonomy general name',
				'singular_name'     => 'Partners country', 'taxonomy singular name',
				'search_items'      =>  'Search partners country',
				'all_items'         => 'All types of partners country',
				'parent_item'       => 'Parent partners country',
				'parent_item_colon' => 'Parent partners country:',
				'edit_item'         => 'Edit partners country',
				'update_item'       => 'Update partners country',
				'add_new_item'      => 'Add new partners country',
				'new_item_name'     => 'New partners country',
				'menu_name'         => 'Partners country',
			),
			'description'           => '',
			'public'                => false,
			'show_in_nav_menus'     => false,
			'show_ui'               => true,
			'show_tagcloud'         => true,
			'show_in_rest'        => true,
			'hierarchical'          => true,
			'rewrite'               => true,
			'show_admin_column'     => true,
		) );

        register_post_type('cases', array(
			'label'               => 'Cases',
			'labels'              => array(
				'name'               => 'Cases',
				'singular_name'      => 'Case',
				'add_new'            => 'Add new post',
				'add_new_item'       => 'Add new post',
				'edit_item'          => 'Edit post',
				'new_item'           => 'New post',
				'view_item'          => 'View post',
				'search_items'       => 'Search posts',
				'not_found'          => 'No posts found',
				'not_found_in_trash' => 'No posts found in trash',
				'menu_name'          => 'Cases',
			),
			'description'         => '',
			'menu_icon'			=> 'dashicons-portfolio',
			'public'              => false,
			'publicly_queryable'  => false,
			'show_ui'             => true,
			'show_in_rest'        => true,
			'rest_base'           => '',
			'show_in_menu'        => true,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'hierarchical'        => false,
			'rewrite'             => true,
			'has_archive'         => false,
			'query_var'           => true,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' )
		) );

        register_post_type('news', array(
			'label'               => 'News',
			'labels'              => array(
				'name'               => 'News',
				'singular_name'      => 'News',
				'add_new'            => 'Add new post',
				'add_new_item'       => 'Add new post',
				'edit_item'          => 'Edit post',
				'new_item'           => 'New post',
				'view_item'          => 'View post',
				'search_items'       => 'Search posts',
				'not_found'          => 'No post found',
				'not_found_in_trash' => 'No post found in trash',
				'menu_name'          => 'News',
			),
			'description'         => '',
			'menu_icon'			=> 'dashicons-media-document',
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_rest'        => true,
			'rest_base'           => '',
			'show_in_menu'        => true,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'hierarchical'        => false,
			'rewrite'             => array( 'slug'=>'news', 'with_front'=>false, 'pages'=>true, 'feeds'=>false, 'feed'=>false ),
			'has_archive'         => 'news',
			'query_var'           => true,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes','post-formats', 'excerpt' ),
		) );

        register_post_type('faq', array(
			'label'               => 'FAQ',
			'labels'              => array(
				'name'               => 'FAQ',
				'singular_name'      => 'FAQ',
				'add_new'            => 'Add new post',
				'add_new_item'       => 'Add new post',
				'edit_item'          => 'Edit post',
				'new_item'           => 'New post',
				'view_item'          => 'View post',
				'search_items'       => 'Search posts',
				'not_found'          => 'No posts found',
				'not_found_in_trash' => 'No posts found in trash',
				'menu_name'          => 'FAQ',
			),
			'description'         => '',
			'menu_icon'			=> 'dashicons-welcome-learn-more',
			'public' 				=> false,
			'show_ui' 				=> true,
			'show_in_nav_menus' 	=> true,
			'exclude_from_search' 	=> true,
			'publicly_queryable' 	=> true,
			'has_archive'         	=> false,
			'query_var'           	=> true,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' )
		) );
	}

	add_filter('post_type_link', 'cpt_permalinks', 1, 2);
	function cpt_permalinks($permalink, $post) {
        foreach (REWRITE_POST_TYPES as $type => $tax) {
            if (str_contains($permalink, $type)) {
                $terms = get_the_terms($post, $tax);

                if (!empty($terms)) {
                    $permalink = str_replace($type, $terms[0]->slug, $permalink);
                }
            }
        }

		return $permalink;
	}

    add_filter('request', 'change_term_request', 1, 1);
    function change_term_request($query_vars) {
        if (!empty($query_vars['attachment']) && empty($query_vars['post_type'])) {
            $slug = $query_vars['attachment'];

            $posts = get_posts([
                'name'        => $slug,
                'post_type'   => get_post_types(),
                'post_status' => 'publish',
                'numberposts' => 1
            ]);

            if (!empty($posts)) {
                $post = $posts[0];

                if (!empty(REWRITE_POST_TYPES[$post->post_type])) {
                    $query_vars[$post->post_type] = $slug;
                    $query_vars['post_type'] = $post->post_type;
                    $query_vars['name'] = $slug;
                }
            }
        }

        return $query_vars;
    }

    add_filter('term_link', 'cpt_term_link', 10, 3);
    function cpt_term_link( $url, $term, $taxonomy ) {
        foreach (REWRITE_POST_TYPES as $tax) {
            if ($taxonomy === $tax) {
                $url = str_replace('/' . $tax, '', $url);
            }
        }

        return $url;
    }
