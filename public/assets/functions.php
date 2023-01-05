<?php

	define("POCKET_THEME_ROOT", get_template_directory_uri());
	define("POCKET_CSS_DIR", POCKET_THEME_ROOT . "/css");
	define("POCKET_JS_DIR", POCKET_THEME_ROOT . "/js");
	define("POCKET_IMG_DIR", POCKET_THEME_ROOT . "/img");


	add_action( 'wp_enqueue_scripts', 'up_style');

	function up_style(){
		wp_enqueue_style( 'my_main', POCKET_CSS_DIR . '/main.min.css', null, null, false);

		wp_enqueue_script( 'vendor', POCKET_JS_DIR . '/vendor.min.js', null, null, true);
        wp_enqueue_script( 'myjs', POCKET_JS_DIR . '/main.min.js', null, null, true);
	}

    add_theme_support( 'post-thumbnails' );

	require_once('functions/menu.php');

	require_once('functions/post_types.php');

	require_once('functions/options_page.php');

	require_once('functions/polylang_setting.php');

	require_once('functions/polylang_strings.php');

	require_once('functions/custom_excerpt.php');

    require_once('functions/yoast_sittings.php');
	