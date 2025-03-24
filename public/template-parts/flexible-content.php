
<?php
$queried_object = get_queried_object();
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;
$term =  $taxonomy . '_' . $term_id;

if(is_tax()) :
    if( have_rows('custom_blocks', $term) ): while ( have_rows('custom_blocks', $term) ) : the_row();
        require('blocks/full-width-blocks.php');
    wp_reset_query(); endwhile; endif;
else:
    if( have_rows('custom_blocks') ): while ( have_rows('custom_blocks') ) : the_row();
        require('blocks/full-width-blocks.php');
    wp_reset_query(); endwhile; endif;
endif;
