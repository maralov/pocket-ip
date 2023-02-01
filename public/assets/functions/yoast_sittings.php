<?php
    function yoast_seo_breadcrumb_append_link( $links ) {
        if ( is_singular('news') ) {
            $breadcrumb[] = array(
                'url' => site_url( '/news/' ),
                'text' => 'News',
            );
            array_splice( $links, 1, -2, $breadcrumb );
        } elseif(is_singular('post')) {
            $breadcrumb[] = array(
                'url' => site_url( '/blogs/' ),
                'text' => 'Blogs',
            );
            array_splice( $links, 1, -2, $breadcrumb );
        }

        return $links;
    }

    add_filter( 'wpseo_breadcrumb_links', 'yoast_seo_breadcrumb_append_link' );