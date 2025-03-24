
<?php if(get_field('show_tab1', 'option') || get_field('show_tab2', 'option') || get_field('show_tab3', 'option') ) : ?>
    <div class="container-lg mb-80">
        <?php
            $pricing_page_id = 3035; 
            $current_language_pricing_page_id = apply_filters( 'wpml_object_id', $pricing_page_id, 'page', true );
            $pricing_page = get_post($current_language_pricing_page_id);
            if ($pricing_page) {
                echo '<h2 class="h2 section-h2 mb-4 mb-xl-5">' . get_the_title($pricing_page->ID) . '</h2>';
            }
        ?>
        <div class="tabs">
            <ul class="tab-list" role="tablist">
                <?php if(get_field('show_tab1', 'option')) : ?>
                    <li role="presentation" class="active">
                        <a href="#tab-1" role="tab" tabindex="0" aria-controls="tab-1" aria-selected="true" class="active"><?php pll_e('Trademark registration'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if(get_field('show_tab2', 'option')) : ?>
                    <li role="presentation">
                        <a href="#tab-2" role="tab" tabindex="-1" aria-controls="tab-2" aria-selected="false"><?php pll_e('Trademark renewal'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if(get_field('show_tab3', 'option')) : ?>
                    <li role="presentation">
                        <a href="#tab-3" role="tab" ∂tabindex="-1" aria-controls="tab-3" aria-selected="false"><?php pll_e('Subscription services'); ?></a>
                    </li>
                <?php endif; ?>
            </ul>

            <?php if(get_field('show_tab1', 'option')) : ?>
                <div id="tab-1" class="tab-content" role="tabpanel" aria-labelledby="tab-1" aria-hidden="false">
                    <!-- CALC BLOCK -->
                    <div class="mb-80">
                        <div class="calc-form js-calc-form">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-12 col-sm-7 col-xl-5 mb-3 mb-sm-0">
                                    <div class="d-flex flex-column flex-sm-row align-items-center gap-1 gap-sm-2">
                                        <div class="paragraph text-bold"><?php pll_e('Countries'); ?>:</div>
                                        <div class="custom-select">
                                            <button class="selected-values">
                                                <span class="selected-values__text">
                                                    <?php pll_e('Choose country...'); ?>
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                                                    <path d="M7.5 10L12.5 15L17.5 10H7.5Z" fill="#999999" />
                                                </svg>
                                            </button>
                                            <?php
                                                $args = array(
                                                    'post_type' => 'services',
                                                    'posts_per_page' => -1,
                                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'service_type',
                                                            'field'    => 'slug',
                                                            'terms'    => 'trademark-application',
                                                        ),
                                                    ),
                                                );

                                                $query = new WP_Query($args);

                                                $country_terms = array();

                                                if ($query->have_posts()) {
                                                    while ($query->have_posts()) {
                                                        $query->the_post();

                                                        $terms = wp_get_post_terms(get_the_ID(), 'service_country');
                                                        foreach ($terms as $term) {
                                                            $country_terms[$term->slug] = $term->name;
                                                        }
                                                    }
                                                }

                                                wp_reset_postdata();
                                            ?>
                                            <?php if (!empty($country_terms)): ?>
                                                <?php asort($country_terms); ?>
                                                
                                                <div class="select-dropdown js-select-search">
                                                    <div class="form form-search form-search-iconed p-2">
                                                        <form>
                                                            <div class="form-search__container">
                                                                <div class="form-search__icon">
                                                                    <img src="<?= POCKET_IMG_DIR; ?>/icons/ic-search-grey.svg" alt="Search icon" />
                                                                </div>
                                                                <input type="text" placeholder="Search" class="py-2" />
                                                            </div>
                                                        </form>
                                                    </div>
                                                    
                                                    <?php foreach ($country_terms as $slug => $name): ?>
                                                        <label class="checkbox-container">
                                                            <input type="checkbox" name="countries" value="<?= esc_attr($slug); ?>" /><?= esc_html($name); ?>
                                                        </label>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="d-flex flex-column flex-sm-row align-items-center gap-1 gap-sm-2">
                                        <div class="paragraph text-bold">
                                            <?php pll_e('Number of Classes:'); ?>
                                        </div>
                                        <div class="counter">
                                            <button type="button" disabled class="btn counter-btn js-counter-decrement">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                                                    <path d="M15.5 10.8327H5.49996C5.04163 10.8327 4.66663 10.4577 4.66663 9.99935C4.66663 9.54102 5.04163 9.16602 5.49996 9.16602H15.5C15.9583 9.16602 16.3333 9.54102 16.3333 9.99935C16.3333 10.4577 15.9583 10.8327 15.5 10.8327Z" fill="white" />
                                                </svg>
                                            </button>
                                            <input class="js-counter-value" type="number" value="1" min="1" />
                                            <button type="button" class="btn counter-btn js-counter-increment">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                                                    <path d="M16.3333 10.8327H11.3333V15.8327H9.66663V10.8327H4.66663V9.16602H9.66663V4.16602H11.3333V9.16602H16.3333V10.8327Z" fill="white" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 js-price-cards">
                            <?php
                                $args = array(
                                    'post_type' => 'services',
                                    'posts_per_page' => -1,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'service_type',
                                            'field'    => 'slug',
                                            'terms'    => 'trademark-application',
                                        ),
                                    ),
                                );

                                $query = new WP_Query($args);

                                $country_terms = array();

                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post();

                                        $terms = wp_get_post_terms(get_the_ID(), 'service_country');
                                        foreach ($terms as $term) {
                                            $country_terms[$term->slug] = $term;
                                        }
                                    }
                                }

                                wp_reset_postdata();

                                if (!empty($country_terms)) {
                                    foreach ($country_terms as $slug => $term) {
                                        $category_icon = get_field('category_icon', 'service_country_' . $term->term_id);
                                        $price_items = get_field('price_items', 'service_country_' . $term->term_id);

                                        $total_sum_all_items = 0;
                                        if ($price_items) {
                                            foreach ($price_items as $price_item) {
                                                $price_item_services = $price_item['price_item_services'];
                                                $item_sum = 0;
                                                if ($price_item_services) {
                                                    foreach ($price_item_services as $service) {
                                                        $item_sum += (float) $service['price_item_service_price'];
                                                    }
                                                }
                                                $total_sum_all_items += $item_sum;
                                            }
                                        }

                                        $service_post_args = array(
                                            'post_type' => 'services',
                                            'posts_per_page' => 1,
                                            'tax_query' => array(
                                                'relation' => 'AND',
                                                array(
                                                    'taxonomy' => 'service_type',
                                                    'field'    => 'slug',
                                                    'terms'    => 'trademark-application',
                                                ),
                                                array(
                                                    'taxonomy' => 'service_country',
                                                    'field'    => 'slug',
                                                    'terms'    => $slug,
                                                ),
                                            ),
                                        );

                                        $service_query = new WP_Query($service_post_args);
                                        $service_link = '#';

                                        if ($service_query->have_posts()) {
                                            $service_query->the_post();
                                            $service_link = get_permalink();
                                            wp_reset_postdata();
                                        }
                                        ?>
                                        <div class="col pt-3 pt-xl-4 js-price-card" style="display: none" data-country-code="<?php echo esc_attr($slug); ?>">
                                            <div class="price-card">
                                                <div class="price-card__header">
                                                    <a href="<?php echo esc_url($service_link); ?>" class="d-flex gap-1" target="_blank">
                                                        <?php if ($category_icon) : ?>
                                                            <img src="<?php echo esc_url($category_icon['url']); ?>" alt="<?php echo esc_attr($term->name); ?>" width="20" height="20" />
                                                        <?php endif; ?>
                                                        <span class="text-bold"><?php echo esc_html($term->name); ?></span>
                                                    </a>
                                                    <span class="text-bold" data-price-total><span><?php echo esc_html($total_sum_all_items); ?></span>$</span>
                                                </div>
                                                <?php if ($price_items) {
                                                    foreach ($price_items as $price_item) {
                                                        $price_item_services = $price_item['price_item_services'];
                                                        $item_sum = 0;
                                                        $total_add_class = 0;
                                                        if ($price_item_services) {
                                                            foreach ($price_item_services as $service) {
                                                                $item_sum += (float) $service['price_item_service_price'];
                                                                $total_add_class += (float) $service['price_item_add_class'];
                                                            }
                                                        }
                                                        ?>
                                                        <div class="price-card__row">
                                                            <div class="d-flex text-bold paragraph price-card__row-item">
                                                                <?php echo esc_html($price_item['price_item_title']); ?>
                                                                <div class="country-info ms-1">
                                                                    <img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-info.svg" alt="" width="22" height="22" />
                                                                    <div class="country-info__tooltip country-info__tooltip-right">
                                                                        <?php
                                                                            if (!empty($price_item['price_item_txt_tooltip'])) {
                                                                                echo esc_html($price_item['price_item_txt_tooltip']);
                                                                            } else {
                                                                                pll_e('Includes 1 class, each additional class costs');
                                                                            }
                                                                        ?>
                                                                        <?php echo esc_html($total_add_class); ?>$.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php if ($price_item_services) {
                                                                foreach ($price_item_services as $service) {
                                                                    $price = !empty($service['price_item_service_price']) ? esc_html($service['price_item_service_price']) : 0;
                                                                    $add_price = !empty($service['price_item_add_class']) ? esc_html($service['price_item_add_class']) : 0; ?>
                                                                    <div class="d-flex justify-content-between price-card__row-item" data-price="<?php echo $price; ?>" data-add-price="<?php echo $add_price; ?>">
                                                                        <div class="price-card__description">
                                                                            <?php echo esc_html($service['price_item_service']); ?>
                                                                        </div>
                                                                        <div class="price-card__value" data-price-value>
                                                                            <span><?php echo $price; ?></span>$
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                            } ?>

                                                            <div class="d-flex justify-content-between price-card__row-item">
                                                                <div class="price-card__description"><?php pll_e('Total'); ?></div>
                                                                <div class="price-card__value" data-price-summ>
                                                                    <span><?php echo esc_html($item_sum); ?></span>$
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php }
                                                } ?>
                                            </div>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <!-- CALC BLOCK END -->

                    <!--PAYMENT START -->
                    <?php if( have_rows('calc_payment_block', 'option') ): while( have_rows('calc_payment_block', 'option') ): the_row(); ?>
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm col-lg-5">
                                <?php if(get_sub_field('calc_payment_block_title', 'option')) : ?>
                                    <div class="h2 mb-2 mb-lg-3"><?php the_sub_field('calc_payment_block_title', 'option'); ?></div>
                                <?php endif; ?>
                                <?php if(get_sub_field('calc_payment_block_subtitle', 'option')) : ?>
                                    <div class="content"><?php the_sub_field('calc_payment_block_subtitle', 'option'); ?></div>
                                <?php endif; ?>
                            </div>
                            <?php
                                $image = get_sub_field('calc_payment_block_img');
                                if( !empty( $image ) ): ?>
                                    <div class="col col-lg-3">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="321" height="151"/>
                                    </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; endif; ?>
                    <!--PAYMENT END -->
                </div>
            <?php endif; ?>

            <?php if(get_field('show_tab2', 'option')) : ?>
                <div id="tab-2" class="tab-content" role="tabpanel" aria-labelledby="tab-2" aria-hidden="true" style="display: none">
                    <!-- CALC BLOCK -->
                    <div class="mb-80">
                        <div class="calc-form js-calc-form">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-12 col-sm-7 col-xl-5 mb-3 mb-sm-0">
                                    <div class="d-flex flex-column flex-sm-row align-items-center gap-1 gap-sm-2">
                                        <div class="paragraph text-bold"><?php pll_e('Countries'); ?>:</div>
                                        <div class="custom-select">
                                            <button class="selected-values">
                                                <span class="selected-values__text">
                                                    <?php pll_e('Choose country...'); ?>
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                                                    <path d="M7.5 10L12.5 15L17.5 10H7.5Z" fill="#999999" />
                                                </svg>
                                            </button>
                                            <?php
                                                $args = array(
                                                    'post_type' => 'services',
                                                    'posts_per_page' => -1,
                                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'service_type',
                                                            'field'    => 'slug',
                                                            'terms'    => 'trademark-renewal',
                                                        ),
                                                    ),
                                                );

                                                $query = new WP_Query($args);

                                                $country_terms = array();

                                                if ($query->have_posts()) {
                                                    while ($query->have_posts()) {
                                                        $query->the_post();

                                                        $terms = wp_get_post_terms(get_the_ID(), 'service_country');
                                                        foreach ($terms as $term) {
                                                            $country_terms[$term->slug] = $term->name;
                                                        }
                                                    }
                                                }

                                                wp_reset_postdata();

                                                if (!empty($country_terms)) {
                                                    asort($country_terms);
                                        
                                                    echo '<div class="select-dropdown js-select-search">';
                                                    echo '<div
                                                            class="form form-search form-search-iconed p-2">
                                                            <form>
                                                                <div class="form-search__container">
                                                                    <div class="form-search__icon">
                                                                        <img
                                                                            src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-search-grey.svg"
                                                                            alt="" />
                                                                    </div>
                                                                    <input
                                                                        type="text"
                                                                        placeholder="Search"
                                                                        class="py-2" />
                                                                </div>
                                                            </form>
                                                        </div>';
                                                    foreach ($country_terms as $slug => $name) {
                                                        echo '<label class="checkbox-container">';
                                                        echo '<input type="checkbox" name="countries" value="' . esc_attr($slug) . '" />' . esc_html($name);
                                                        echo '</label>';
                                                    }
                                                    echo '</div>';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="d-flex flex-column flex-sm-row align-items-center gap-1 gap-sm-2">
                                        <div class="paragraph text-bold">
                                            <?php pll_e('Number of Classes:'); ?>
                                        </div>
                                        <div class="counter">
                                            <button type="button" disabled class="btn counter-btn js-counter-decrement">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                                                    <path d="M15.5 10.8327H5.49996C5.04163 10.8327 4.66663 10.4577 4.66663 9.99935C4.66663 9.54102 5.04163 9.16602 5.49996 9.16602H15.5C15.9583 9.16602 16.3333 9.54102 16.3333 9.99935C16.3333 10.4577 15.9583 10.8327 15.5 10.8327Z" fill="white" />
                                                </svg>
                                            </button>
                                            <input class="js-counter-value" type="number" value="1" min="1" />
                                            <button type="button" class="btn counter-btn js-counter-increment">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                                                    <path d="M16.3333 10.8327H11.3333V15.8327H9.66663V10.8327H4.66663V9.16602H9.66663V4.16602H11.3333V9.16602H16.3333V10.8327Z" fill="white" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 js-price-cards">
                            <?php
                                $args = array(
                                    'post_type' => 'services',
                                    'posts_per_page' => -1,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'service_type',
                                            'field'    => 'slug',
                                            'terms'    => 'trademark-renewal',
                                        ),
                                    ),
                                );

                                $query = new WP_Query($args);

                                $country_terms = array();

                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post();

                                        $terms = wp_get_post_terms(get_the_ID(), 'service_country');
                                        foreach ($terms as $term) {
                                            $country_terms[$term->slug] = $term;
                                        }
                                    }
                                }

                                wp_reset_postdata();

                                if (!empty($country_terms)) {
                                    foreach ($country_terms as $slug => $term) {
                                        $category_icon = get_field('category_icon', 'service_country_' . $term->term_id);
                                        $price_items = get_field('price_ren_items', 'service_country_' . $term->term_id);

                                        $total_sum_all_items = 0;
                                        if ($price_items) {
                                            foreach ($price_items as $price_item) {
                                                $price_item_services = $price_item['price_ren_item_services'];
                                                $item_sum = 0;
                                                if ($price_item_services) {
                                                    foreach ($price_item_services as $service) {
                                                        $item_sum += (float) $service['price_ren_item_service_price'];
                                                    }
                                                }
                                                $total_sum_all_items += $item_sum;
                                            }
                                        }

                                        $service_post_args = array(
                                            'post_type' => 'services',
                                            'posts_per_page' => 1,
                                            'tax_query' => array(
                                                'relation' => 'AND',
                                                array(
                                                    'taxonomy' => 'service_type',
                                                    'field'    => 'slug',
                                                    'terms'    => 'trademark-application',
                                                ),
                                                array(
                                                    'taxonomy' => 'service_country',
                                                    'field'    => 'slug',
                                                    'terms'    => $slug,
                                                ),
                                            ),
                                        );

                                        $service_query = new WP_Query($service_post_args);
                                        $service_link = '#';

                                        if ($service_query->have_posts()) {
                                            $service_query->the_post();
                                            $service_link = get_permalink();
                                            wp_reset_postdata();
                                        }
                                        ?>
                                        <div class="col pt-3 pt-xl-4 js-price-card" style="display: none" data-country-code="<?php echo esc_attr($slug); ?>">
                                            <div class="price-card">
                                                <div class="price-card__header">
                                                    <a href="<?php echo esc_url($service_link); ?>" class="d-flex gap-1" target="_blank">
                                                        <?php if ($category_icon) : ?>
                                                            <img src="<?php echo esc_url($category_icon['url']); ?>" alt="<?php echo esc_attr($term->name); ?>" width="20" height="20" />
                                                        <?php endif; ?>
                                                        <span class="text-bold"><?php echo esc_html($term->name); ?></span>
                                                    </a>
                                                    <span class="text-bold" data-price-total><span><?php echo esc_html($total_sum_all_items); ?></span>$</span>
                                                </div>
                                                <?php if ($price_items) {
                                                    foreach ($price_items as $price_item) {
                                                        $price_item_services = $price_item['price_ren_item_services'];
                                                        $item_sum = 0;
                                                        $total_add_class = 0;
                                                        if ($price_item_services) {
                                                            foreach ($price_item_services as $service) {
                                                                $item_sum += (float) $service['price_ren_item_service_price'];
                                                                $total_add_class += (float) $service['price_ren_item_add_class'];
                                                            }
                                                        }
                                                        ?>
                                                        <div class="price-card__row">
                                                            <div class="d-flex text-bold paragraph price-card__row-item">
                                                                <?php echo esc_html($price_item['price_ren_item_title']); ?>
                                                                <div class="country-info ms-1">
                                                                    <img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-info.svg" alt="" width="22" height="22" />
                                                                    <div class="country-info__tooltip country-info__tooltip-right">
                                                                        <?php
                                                                            if (!empty($price_item['price_ren_item_txt_tooltip'])) {
                                                                                echo esc_html($price_item['price_ren_item_txt_tooltip']);
                                                                            } else {
                                                                                pll_e('Includes 1 class, each additional class costs');
                                                                            }
                                                                        ?>
                                                                        <?php echo esc_html($total_add_class); ?>$.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php if ($price_item_services): ?>
                                                                <?php foreach ($price_item_services as $service):
                                                                    $price = !empty($service['price_ren_item_service_price']) ? esc_html($service['price_ren_item_service_price']) : 0;
                                                                    $add_price = !empty($service['price_ren_item_add_class']) ? esc_html($service['price_ren_item_add_class']) : 0;
                                                                ?>
                                                                    <div class="d-flex justify-content-between price-card__row-item"
                                                                        data-price="<?php echo $price; ?>"
                                                                        data-add-price="<?php echo $add_price; ?>">
                                                                        <div class="price-card__description">
                                                                            <?php echo esc_html($service['price_ren_item_service']); ?>
                                                                        </div>
                                                                        <div class="price-card__value" data-price-value>
                                                                            <span><?php echo $price; ?></span>$
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                            <div class="d-flex justify-content-between price-card__row-item">
                                                                <div class="price-card__description"><?php pll_e('Total'); ?></div>
                                                                <div class="price-card__value" data-price-summ>
                                                                    <span><?php echo esc_html($item_sum); ?></span>$
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php }
                                                } ?>
                                            </div>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <!-- CALC BLOCK END -->

                    <!--PAYMENT START -->
                    <?php if( have_rows('calc_payment_block', 'option') ): while( have_rows('calc_payment_block', 'option') ): the_row(); ?>
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm col-lg-5">
                                <?php if(get_sub_field('calc_payment_block_title', 'option')) : ?>
                                    <div class="h2 mb-2 mb-lg-3"><?php the_sub_field('calc_payment_block_title', 'option'); ?></div>
                                <?php endif; ?>
                                <?php if(get_sub_field('calc_payment_block_subtitle', 'option')) : ?>
                                    <div class="content"><?php the_sub_field('calc_payment_block_subtitle', 'option'); ?></div>
                                <?php endif; ?>
                            </div>
                            <?php
                                $image = get_sub_field('calc_payment_block_img');   
                                if( !empty( $image ) ): ?>
                                    <div class="col col-lg-3">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="321" height="151"/>
                                    </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; endif; ?>
                    <!--PAYMENT END -->
                </div>
            <?php endif; ?>

            <?php if(get_field('show_tab3', 'option')) : ?>
                <div id="tab-3" class="tab-content" role="tabpanel" aria-labelledby="tab-3" aria-hidden="true" style="display: none">
                    <?php if(get_field('price_block_title', 'option')) : ?>
                        <h2 class="h2 section-h2 mb-3 mb-lg-4"><?php the_field('price_block_title', 'option'); ?></h2>
                    <?php endif; ?>
                    <?php if(get_field('price_block_subtitle', 'option')) : ?>
                        <div class="paragraph text-md-center mb-3 mb-lg-4"><?php the_field('price_block_subtitle', 'option'); ?></div>
                    <?php endif; ?>
                    <!-- PRICE CARDS BLOCK-->
                    <div class="pricing mb-80" data-price="year">
                        <div class="row justify-content-md-center mb-4 mb-lg-5">
                            <div class="col-auto">
                                <div class="pricing-switcher js-pricing-switcher year-active">
                                    <?php if(get_field('price_block_month_tab', 'option')) : ?>
                                        <div class="pricing-switcher__month js-pricing-month"><?php the_field('price_block_month_tab', 'option'); ?></div>
                                    <?php endif; ?>
                                    <?php if(get_field('price_block_year_tab', 'option')) : ?>
                                        <div class="pricing-switcher__year js-pricing-year is-active">
                                            <?php the_field('price_block_year_tab', 'option'); ?>
                                            <?php if(get_field('price_block_sale', 'option')): ?>
                                                <div class="pricing-switcher__discount">
                                                    <?php the_field('price_block_discount', 'option'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if( have_rows('price_block_item', 'option') ): ?>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">
                                <?php while ( have_rows('price_block_item', 'option') ) : the_row(); $number=1; ?>
                                    <div class="col <?php if($number<=2):?> mb-4 mb-lg-0 <?php endif;?>">
                                        <div class="box box--shadow h-100 d-flex flex-column">
                                            <?php if(get_sub_field('price_block_item_name', 'option')): ?>
                                                <div class="h3 mb-1"><?php the_sub_field('price_block_item_name', 'option');?></div>
                                            <?php endif;?>
                                            <div class="price-month">
                                                <div>
                                                    <?php if(get_sub_field('price_block_item_cost_monthly', 'option')): ?>
                                                        <span class="h2 text-primary text-bold me-1"><?php the_sub_field('price_block_item_cost_monthly', 'option');?></span>
                                                    <?php endif;?>
                                                    <?php if(get_sub_field('price_block_item_period_month', 'option')): ?>
                                                        <span class="text-muted paragraph-sm"><?php the_sub_field('price_block_item_period_month', 'option');?></span>
                                                    <?php endif;?>
                                                </div>
                                                <?php if(get_sub_field('price_block_item_total_price_month', 'option')): ?>
                                                    <p class="paragraph mt-2"><?php the_sub_field('price_block_item_total_price_month', 'option');?></p>
                                                <?php endif;?>
                                            </div>
                                            <div class="price-year">
                                                <div>
                                                    <?php if(get_sub_field('price_block_item_cost_yearly', 'option')): ?>
                                                        <span class="h2 text-primary text-bold me-1"><?php the_sub_field('price_block_item_cost_yearly', 'option');?></span>
                                                    <?php endif;?>
                                                    <?php if(get_sub_field('price_block_item_period_year', 'option')): ?>
                                                        <span class="text-muted paragraph-sm"><?php the_sub_field('price_block_item_period_year', 'option');?></span>
                                                    <?php endif;?>
                                                </div>
                                                <?php if(get_sub_field('price_block_item_total_price_year', 'option')): ?>
                                                    <p class="paragraph mt-2"><?php the_sub_field('price_block_item_total_price_year', 'option');?></p>
                                                <?php endif;?>
                                            </div>
                                            <div class="pricing-list">
                                                <?php if( have_rows('price_block_item_list', 'option') ): ?>
                                                    <ul>
                                                        <?php while ( have_rows('price_block_item_list', 'option') ) : the_row(); ?>
                                                            <?php if(get_sub_field('price_block_item_list_line', 'option')): ?>
                                                                <li><?php the_sub_field('price_block_item_list_line', 'option');?></li>
                                                            <?php endif;?>
                                                        <?php endwhile; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                            <?php
                                            $free_link = get_sub_field('price_block_item_button', 'option');
                                            if( $free_link ):
                                                $free_link_url = $free_link['url'];
                                                $free_link_title = $free_link['title'];
                                                $free_link_target = $free_link['target'] ? $free_link['target'] : '_self';
                                                ?>
                                                <a href="<?php echo esc_url($free_link_url); ?>" target="<?php echo esc_attr($free_link_target); ?>"
                                                    class="btn btn-primary w-100 mt-auto"><?php echo esc_html( $free_link_title ); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- PRICE CARDS BLOCK END-->
                </div>
            <?php endif; ?>

        </div>
    </div>
<?php endif; ?>
