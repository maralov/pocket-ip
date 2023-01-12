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

    /*
     ==================
     Ajax Search
    ======================
    */
    // add the ajax fetch js


    // the ajax function
    add_action('wp_ajax_data_fetch' , 'data_fetch');
    add_action('wp_ajax_nopriv_data_fetch','data_fetch');
    function data_fetch(){

        $the_query = new WP_Query( array( 'posts_per_page' => -1, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => array('page','post', 'news', 'services', 'solutions') ) );
        if( $the_query->have_posts() ) :
            echo '<ul>';
            while( $the_query->have_posts() ): $the_query->the_post(); ?>

                <li class="modal-search__result-item">
                    <a  href="<?php echo esc_url( post_permalink() ); ?>">
                        <span class="h3 d-block mb-2"><?php the_title();?> </span>
                        <span><?php the_excerpt_max_charlength(150); ?></span>
                    </a>
                </li>

            <?php endwhile;
            echo '</ul>';
            wp_reset_postdata();
        endif;

        die();
    }
