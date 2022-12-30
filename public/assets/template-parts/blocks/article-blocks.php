<?php if( get_row_layout() == 'article_block' ): ?>
    <div class="mb-80">
        <?php if(get_sub_field('article_block_content',$term)):?>
            <article class="col-12 content">
                <?php the_sub_field('article_block_content',$term);  ?>
            </article>
        <?php endif;?>
    </div>
<?php endif;?>

<?php if( get_row_layout() == 'why_trademark_block' ): ?>
    <div class="mb-80">
        <?php if(get_sub_field('why_trademark_block_title',$term)):?>
            <div class="h2 mb-4"><?php the_sub_field('why_trademark_block_title',$term); ?></div>
        <?php endif;?>

        <div class="row row-cols-1 row-cols-md-3 gy-4 gy-md-0">
            <?php if( have_rows('why_trademark_block_box',$term) ): ?>
                <?php while ( have_rows('why_trademark_block_box',$term) ): the_row();?>
                    <div class="col">
                        <div class="d-flex align-items-center gap-1 gap-xl-2 mb-2 mb-xl-3 ">
                         <?php $box_icon = get_sub_field('why_trademark_block_box_icon',$term);
                            if(!empty($box_icon)): ?>
                            <div class="box box--sm box--radius-sm box--red w-auto d-inline-flex justify-content-center ">
                                <img src="<?php echo esc_url($box_icon['url']); ?>" alt="<?php echo esc_url($box_icon['alt']); ?>">
                            </div>
                           <?php endif; ?>
                            <?php if(get_sub_field('why_trademark_block_box_title',$term)):?>
                                <div class="subtitle-2"><?php the_sub_field('why_trademark_block_box_title',$term); ?></div>
                            <?php endif; ?>
                        </div>
                        <?php if(get_sub_field('why_trademark_block_box_description',$term)):?>
                            <div class="w-100"><?php the_sub_field('why_trademark_block_box_description',$term); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
<?php endif;?>

<?php if( get_row_layout() == 'advantages_block' ): ?>
    <div class="mb-80">
        <?php if(get_sub_field('advantages_block_title',$term)):?>
            <div class="h2 mb-4"><?php the_sub_field('advantages_block_title',$term); ?></div>
        <?php endif; ?>
        <div class="row row-cols-1 row-cols-md-2 gy-3">

            <?php if( have_rows('advantages_block_item',$term) ): ?>
                <?php while ( have_rows('advantages_block_item',$term) ): the_row();?>
                    <div class="col">
                        <div class="d-flex align-items-center gap-1 gap-xl-2 mb-2 mb-xl-3 ">
                            <?php $item_icon = get_sub_field('advantages_block_item_icon',$term);
                            if(!empty($item_icon)): ?>
                                <img src="<?php echo esc_url($item_icon['url']); ?>" class="icon-lg" alt="<?php echo esc_url($item_icon['alt']); ?>">
                            <?php endif;?>
                            <div class="paragraph">
                                <?php the_sub_field('advantages_block_item_text',$term); ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; endif;?>
        </div>
    </div>
<?php endif;?>

<?php if( get_row_layout() == 'tools_block' ): ?>
    <div class="mb-80 content">
        <?php if(get_sub_field('tools_block_title',$term)):?>
            <div class="h2 mb-4"><?php the_sub_field('tools_block_title',$term); ?></div><!-- or tag H2 -->
        <?php endif;?>

        <?php the_sub_field('tools_block_contnent',$term); ?>

        <?php
        $image_tools = get_sub_field('tools_block_image');
        $image_tools_big = get_sub_field('tools_block_image_big');

        if (!empty($image_tools)): ?>
            <div class="col-12 col-md-6">
                <img src="<?php echo esc_url($image_tools['url']); ?>"
                    <?php if(!empty($image_tools_big)) : ?>
                        srcset="<?php echo esc_url($image_tools['url']); ?> 1x, <?php echo esc_url($image_tools_big['url']); ?> 2x"
                    <?php endif; ?>
                     alt="<?php echo esc_attr($image_tools['alt']); ?>">
            </div>
        <?php endif; ?>
    </div>
<?php endif;?>

<?php if( get_row_layout() == 'trademark_search_block' ): ?>
    <div class="mb-80 content">
        <?php if(get_sub_field('trademark_search_block_title',$term)):?>
            <div class="h2 mb-3"><?php the_sub_field('trademark_search_block_title',$term); ?></div><!-- or tag H2 -->
        <?php endif;?>
        <?php the_sub_field('trademark_search_block_contnent',$term); ?>


        <?php
        $image_trademark_search = get_sub_field('trademark_search_block_image');
        $image_trademark_search_big = get_sub_field('trademark_search_block_image_big');

        if (!empty($image_trademark_search)): ?>

            <img src="<?php echo esc_url($image_trademark_search['url']); ?>"
                <?php if(!empty($image_trademark_search_big)) : ?>
                    srcset="<?php echo esc_url($image_trademark_search['url']); ?> 1x, <?php echo esc_url($image_trademark_search_big['url']); ?> 2x"
                <?php endif; ?>
                 alt="<?php echo esc_attr($image_trademark_search['alt']); ?>">
        <?php endif; ?>
    </div>
<?php endif;?>

<?php if( get_row_layout() == 'action_types_block' ): ?>
    <div class="mb-80">
        <div class="cta-block cta-block-sm">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto mb-3 mb-md-0 col-md-7">
                    <?php if(get_sub_field('action_block_title',$term)):?>
                        <p class="mb-2 h3"><?php the_sub_field('action_block_title',$term); ?></p>
                    <?php endif;?>
                    <?php if(get_sub_field('action_block_text',$term)):?>
                        <p class="paragraph-lg"><?php the_sub_field('action_block_text',$term); ?></p>
                    <?php endif;?>
                </div>

                <?php
                $try_link = get_sub_field('action_block_button');
                if( $try_link ):
                    $try_link_url = $try_link['url'];
                    $try_link_title = $try_link['title'];
                    $try_link_target = $try_link['target'] ? $try_link['target'] : '_self';
                    ?>
                    <div class="col-auto">
                        <a class="btn btn-primary" href="<?php echo esc_url( $try_link_url ); ?>" target="<?php echo esc_attr( $try_link_target ); ?>"><?php echo esc_html( $try_link_title ); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif;?>

<?php if( get_row_layout() == 'faq_types_block' ): ?>
    <div class="mb-80">
        <?php if(get_sub_field('faq_block_title',$term)):?>
            <div class="h2 mb-3"><?php the_sub_field('faq_block_title',$term); ?></div>
        <?php endif;?>
        <div class="accordion" id="faq-according">
            <?php
            $FAQs = get_sub_field('faq_block_item');
            if ($FAQs) :
                $num = 0;
                foreach ($FAQs as $post) : setup_postdata($post); ?>

                    <div class="accordion-item">
                        <button class="btn accordion-button <?php if($num!=0):?>collapsed<?php endif;?>" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-<?=$num?>" aria-expanded="true" aria-controls="collapse-<?=$num?>">
                            <?php the_title(); ?>
                        </button>
                        <div id="collapse-<?=$num?>" class="accordion-collapse collapse
                            <?php if($num==0):?>show<?php endif;?> "
                             aria-labelledby="headingOne" data-bs-parent="#faq-according">
                            <div class="accordion-body paragraph">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>

                    <?php $num++; endforeach; wp_reset_postdata(); endif; ?>
        </div>
    </div>
<?php endif;?>

<?php if( get_row_layout() == 'other_services_county_block' ): ?>
    <?php
    $cir_cat   = $wp_query->get_queried_object();
    $cat_slug  = $cir_cat->slug;

    $terms_county = get_terms(array(
        'hide_empty'  => 1,
        'orderby'     => 'name',
        'order'       => 'ASC',
        'taxonomy'    => 'service_country',
    ));
    ?>
    <?php if($cir_cat->count != 0) : ?>
        <div class="mb-80">
            <h3 class="h3 mb-3"><?php pll_e('The service is available for countries:'); ?></h3>
            <div class="d-flex flex-wrap gap-1 gap-xl-2 js-country-tags">
                <?php
                foreach ($terms_county as $term_county) :
                    $term_county_id = $term_county->term_id;
                    $term_county_tax = $term_county->taxonomy;
                    $term_county_name = $term_county->name;

                    $args = array(
                        'post_type' => 'services',
                        'posts_per_page' => -1,
                        'order' => 'DESC',
                        'tax_query' => [
                            'relation' => 'AND',
                            [
                                'taxonomy' => 'service_type',
                                'field' => 'slug',
                                'terms' => $cat_slug
                            ],
                            [
                                'taxonomy' => 'service_country',
                                'field'    => 'id',
                                'terms'    => $term_county_id,
                            ]
                        ],

                    );
                    $circular_query = new WP_Query( $args ); ?>
                    <?php if ( $circular_query->have_posts() ) : while ( $circular_query->have_posts() ) : $circular_query->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="country-tag country-tag--lg">
                        <?php
                        $image = get_field('category_icon', $term_county_tax . '_' . $term_county_id );
                        if( !empty( $image ) ): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="24" height="24" />
                        <?php endif; ?>
                        <span><?php echo $term_county_name; ?></span>
                    </a>
                <?php endwhile; endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if( get_row_layout() == 'other_solutions_county_block' ): ?>
    <?php
    $cir_cat   = $wp_query->get_queried_object();
    $cat_slug  = $cir_cat->slug;

    $terms_county = get_terms(array(
        'hide_empty'  => 1,
        'orderby'     => 'name',
        'order'       => 'ASC',
        'taxonomy'    => 'solution_country',
    ));
    ?>
    <?php if($cir_cat->count != 0) : ?>
        <div class="mb-80">
            <h3 class="h3 mb-3"><?php pll_e('The solution is available for countries:'); ?></h3>
            <div class="d-flex flex-wrap gap-1 gap-xl-2 js-country-tags">
                <?php
                foreach ($terms_county as $term_county) :
                    $term_county_id = $term_county->term_id;
                    $term_county_tax = $term_county->taxonomy;
                    $term_county_name = $term_county->name;

                    $args = array(
                        'post_type' => 'solutions',
                        'posts_per_page' => -1,
                        'order' => 'DESC',
                        'tax_query' => [
                            'relation' => 'AND',
                            [
                                'taxonomy' => 'solution_type',
                                'field' => 'slug',
                                'terms' => $cat_slug
                            ],
                            [
                                'taxonomy' => 'solution_country',
                                'field'    => 'id',
                                'terms'    => $term_county_id,
                            ]
                        ],

                    );
                    $circular_query = new WP_Query( $args ); ?>
                    <?php if ( $circular_query->have_posts() ) : while ( $circular_query->have_posts() ) : $circular_query->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="country-tag country-tag--lg">
                        <?php
                        $image = get_field('category_icon', $term_county_tax . '_' . $term_county_id );
                        if( !empty( $image ) ): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="24" height="24" />
                        <?php endif; ?>
                        <span><?php echo $term_county_name; ?></span>
                    </a>
                <?php endwhile; endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
