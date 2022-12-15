<?php
    if( function_exists('acf_add_options_page') ) {

		acf_add_options_page(array(
			'page_title' 	=> 'Theme general settings',
			'menu_title'	=> 'Theme general settings',
			'menu_slug' 	=> 'theme-general-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> '404 settings',
			'menu_title'	=> '404 settings',
			'parent_slug'	=> 'theme-general-settings',
		));

		acf_add_options_sub_page( array(
			'page_title'  => 'News settings',
			'menu_title'  => 'News settings',
			'parent_slug' => 'edit.php?post_type=news'
		) );

		acf_add_options_sub_page( array(
			'page_title'  => 'Partners settings',
			'menu_title'  => 'Partners settings',
			'parent_slug' => 'edit.php?post_type=partners'
		) );

		acf_add_options_sub_page( array(
			'page_title'  => 'FAQ settings',
			'menu_title'  => 'FAQ settings',
			'parent_slug' => 'edit.php?post_type=faq'
		) );

	}