<?php
if(is_tax()) :
    $queried_object = get_queried_object();
    $taxonomy = $queried_object->taxonomy;
    $term_id = $queried_object->term_id;
    $term = $taxonomy . '_' . $term_id;
elseif(is_single('services') || is_single('solutions')) :
    $term = get_post_type() . '_' . get_the_ID();
endif;

if(is_tax()) :
    if( have_rows('flex_content_article',$term) ): while ( have_rows('flex_content_article',$term) ) : the_row();
        require('blocks/article-blocks.php');
    wp_reset_query(); endwhile; endif;
elseif(is_single('services') || is_single('solutions')):
    if( have_rows('flex_content_article',$term) ): while ( have_rows('flex_content_article',$term) ) : the_row();
        require('blocks/article-blocks.php');
    wp_reset_query(); endwhile; endif;
else:
    if( have_rows('flex_content_article') ): while ( have_rows('flex_content_article') ) : the_row();
        require('blocks/article-blocks.php');
    wp_reset_query(); endwhile; endif;
endif;