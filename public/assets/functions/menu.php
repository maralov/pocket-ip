<?php   
    
    add_action( 'after_setup_theme', function(){
		register_nav_menus( [
			'header_menu' => 'Header menu',
			'footer_menu' => 'Footer menu',
			'line_menu' => 'Footer single line menu'
		] );
	} );

    function wp_get_menu_array($current_menu) {

		$array_menus = wp_get_nav_menu_items($current_menu);
		$menu = array();
	
		foreach ($array_menus as $array_menu) {
			if (empty($array_menu->menu_item_parent)){
				$curent_id = $array_menu->ID;
				$menu[$curent_id] = array(
					'ID'         =>   $curent_id,
					'title'      =>   $array_menu->title,
					'description'       =>   $array_menu->description,
					'url'        =>  $array_menu->url,
					'thumbnail'        =>  $array_menu->thumbnail,
					'term_id'			=> $array_menu->object_id,
					'term'			=> $array_menu->object,
					'type'			=> $array_menu->type,
					'children'    =>   array()
				);
			}
	
			if (isset($curent_id) && $curent_id == $array_menu->menu_item_parent) {
				$submenu_id = $array_menu->ID;
				$menu[$curent_id]['children'][$array_menu->ID] = array(
					'ID'         =>   $submenu_id,
					'title'      =>   $array_menu->title,
					'description'       =>   $array_menu->description,
					'url'        =>  $array_menu->url,
					'thumbnail'        =>  $array_menu->thumbnail,
					'term_id'			=> $array_menu->object_id,
					'term'			=> $array_menu->object,
					'type'			=> $array_menu->type,
					'children'    =>   array()
				);
			}
	
			if (isset($submenu_id) && $submenu_id == $array_menu->menu_item_parent) {
				$menu[$curent_id]['children'][$submenu_id]['children'][$array_menu->ID] = array(
					'ID'         =>   $array_menu->ID,
					'title'      =>   $array_menu->title,
					'description'       =>   $array_menu->description,
					'url'        =>  $array_menu->url,
					'thumbnail'        =>  $array_menu->thumbnail,
					'term_id'			=> $array_menu->object_id,
					'term'			=> $array_menu->object,
					'type'			=> $array_menu->type,
				);
			}
		}
	
		return $menu;   
	}
