<?php
    add_filter( 'pll_get_post_types', 'add_partners_to_pll', 10, 2 );
 
    function add_partners_to_pll( $post_types, $is_settings ) {
        if ( $is_settings ) {
            unset( $post_types['partners'] );
        } else {
            $post_types['partners'] = 'partners';
        }
        return $post_types;
    }

    add_filter( 'pll_get_taxonomies', 'add_partners_country_to_pll', 10, 2 );
 
    function add_partners_country_to_pll( $taxonomies, $is_settings ) {
        if ( $is_settings ) {
            unset( $taxonomies['partners_country'] );
        } else {
            $taxonomies['partners_country'] = 'partners_country';
        }
        return $taxonomies;
    }

    add_filter( 'pll_get_post_types', 'add_cases_to_pll', 10, 2 );
 
    function add_cases_to_pll( $post_types, $is_settings ) {
        if ( $is_settings ) {
            unset( $post_types['cases'] );
        } else {
            $post_types['cases'] = 'cases';
        }
        return $post_types;
    }

    add_filter( 'pll_get_post_types', 'add_faq_to_pll', 10, 2 );
 
    function add_faq_to_pll( $post_types, $is_settings ) {
        if ( $is_settings ) {
            unset( $post_types['faq'] );
        } else {
            $post_types['faq'] = 'faq';
        }
        return $post_types;
    }

    add_filter( 'pll_get_taxonomies', 'add_service_country_to_pll', 10, 2 );
 
    function add_service_country_to_pll( $taxonomies, $is_settings ) {
        if ( $is_settings ) {
            unset( $taxonomies['service_country'] );
        } else {
            $taxonomies['service_country'] = 'service_country';
        }
        return $taxonomies;
    }

    add_filter( 'pll_get_taxonomies', 'add_solution_country_to_pll', 10, 2 );
 
    function add_solution_country_to_pll( $taxonomies, $is_settings ) {
        if ( $is_settings ) {
            unset( $taxonomies['solution_country'] );
        } else {
            $taxonomies['solution_country'] = 'solution_country';
        }
        return $taxonomies;
    }