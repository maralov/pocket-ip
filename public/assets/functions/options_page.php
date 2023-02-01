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

	}