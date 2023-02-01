<?php
    $queried_object = get_queried_object();
    $taxonomy = $queried_object->taxonomy;
    $term_id = $queried_object->term_id;
    $term =  $taxonomy . '_' . $term_id;
if(is_tax()) :
    if( have_rows('flex_content_article',$term) ): while ( have_rows('flex_content_article',$term) ) : the_row();
        require('blocks/article-blocks.php');
    endwhile; endif;
else:
    if( have_rows('flex_content_article') ): while ( have_rows('flex_content_article') ) : the_row();
        require('blocks/article-blocks.php');
    endwhile; endif;
endif;