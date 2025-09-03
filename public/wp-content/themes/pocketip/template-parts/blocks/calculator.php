<div class="container-lg">
    <?php 
    $args = array(
        'post_type' => 'services',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'service_type',
                'field'    => 'slug',
                'terms'    => array( 'trademark-application', 'trademark-renewal' ),
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

    $country_currency_map = array();
    foreach ($country_terms as $slug => $term) {
        $country_currency_map[$slug] = array("description" => "USD"); // або іншу валюту, якщо потрібно
    }

    $api_url = "https://dev.pocketip.com/api/task/task/cost-by-country";
    $body = json_encode(array(
        "countryCurrencyMap" => $country_currency_map,
        "classesQuantity" => 1
    ));

    // Виконання POST-запиту до API
    $response = wp_remote_post($api_url, array(
        'method' => 'POST',
        'body' => $body,
        'headers' => array(
            'Content-Type' => 'application/json',
        ),
    ));

    $api_data = array();

    if (is_wp_error($response)) {
    $error_message = $response->get_error_message();
    echo "Something went wrong: $error_message";
    } else {
        $api_data = json_decode(wp_remote_retrieve_body($response), true);
    }
    
    ?>
    <div class="tabs">
        <ul class="tab-list" role="tablist">
            <li role="presentation" class="active">
                <a href="#tab-1" role="tab" tabindex="0" aria-controls="tab-1" aria-selected="true" class="active"><?php pll_e('Trademark registration'); ?></a>
            </li>
            <li role="presentation">
                <a href="#tab-2" role="tab" tabindex="-1" aria-controls="tab-2" aria-selected="false"><?php pll_e('Trademark renewal'); ?></a>
            </li>
            <li role="presentation">
                <a href="#tab-3" role="tab" tabindex="-1" aria-controls="tab-3" aria-selected="false"><?php pll_e('Subscription services'); ?></a>
            </li>
        </ul>
        <!-- TAB 1 START -->
        <div id="tab-1" class="tab-content js-calc-form" role="tabpanel" aria-labelledby="tab-1" aria-hidden="false" >
            <!-- CALC BLOCK -->
            <div class="mb-80">
                <section>
                    <?php if (get_field('calc_reg_title', 'option')) : ?>
                        <h2 class="h2 text-center mb-2 mb-lg-3"><?php the_field('calc_reg_title', 'option'); ?></h2>
                    <?php endif; ?>

                    <div class="calc-form">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 col-sm-5 mb-3 mb-sm-0">
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
                                                )
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
                            <div class="col-12 col-sm-4 col-lg-3">
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
                            <!-- currency dropdown -->
                           <div class="col-12 col-sm-3">
                                <div class="d-flex flex-column flex-sm-row align-items-center gap-1 gap-sm-2">
                                    <div class="paragraph text-bold"><?php pll_e('Currency'); ?>:</div>
                                    <div class="custom-select">
                                        <button class="selected-values currency-select">
                                            <span class="selected-values__text">
                                                <?php pll_e('USD'); ?>
                                            </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                                                <path d="M7.5 10L12.5 15L17.5 10H7.5Z" fill="#999999" />
                                            </svg>
                                        </button>
                                        
                                        <!-- Дропдаун валют з пошуком -->
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
                                            
                                            <?php
                                                // Отримуємо доступні валюти з WordPress
                                                if (have_rows('avaible_currency', 'option')):
                                                    while (have_rows('avaible_currency', 'option')) : the_row();
                                                        $currency_code = get_sub_field('currency_code');
                                            ?>
                                                <label class="currency-option" data-currency-code="<?= esc_attr($currency_code); ?>">
                                                    <?= esc_html($currency_code); ?>
                                                </label>
                                            <?php
                                                    endwhile;
                                                endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- currency dropdown end-->

                            <!-- error start -->
                            <div class="col-12 text-danger paragraph-sm text-center text-error mt-1 js-calc-form-error d-none" >
                                <?php pll_e('Oops...Error fetch currency or price data try later'); ?>
                            </div>
                            <!-- error end -->
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
                                    $application_filing_stage_tooltip_text = get_field('application_filing_stage_tooltip', 'service_country_' . $term->term_id);
                                    $registration_stage_tooltip_text = get_field('registration_stage_tooltip', 'service_country_' . $term->term_id);

                                    $country_price_data = $api_data[strtoupper($slug)];
                                    $currency = $country_price_data["currency"]["description"];

                                    $application_cost = $country_price_data["application_cost"];
                                    $registration_cost = null;

                                    $card_total_sum = $application_cost["total_fee"];

                                    if (!empty($country_price_data["registration_cost"])) {
                                        $registration_cost = $country_price_data["registration_cost"];
                                        $card_total_sum += $registration_cost["total_fee"];
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
                                    <div class="col pt-3 pt-xl-4 js-price-card" style="display: none" data-country-code="<?php echo esc_attr($slug); ?>" data-country-type="registration">
                                        <div class="price-card">
                                            <div class="price-card__header">
                                                <a href="<?php echo esc_url($service_link); ?>" class="d-flex gap-1" target="_blank">
                                                    <?php if ($category_icon) : ?>
                                                        <img src="<?php echo esc_url($category_icon['url']); ?>" alt="<?php echo esc_attr($term->name); ?>" width="20" height="20" />
                                                    <?php endif; ?>
                                                    <span class="text-bold"><?php echo esc_html($term->name); ?></span>
                                                </a>
                                                <span class="text-bold" data-price-total> <?php echo $card_total_sum ?> <?php echo $currency ?> </span>
                                            </div>
                                            <!--  price-card__row start -->
                                            <div class="price-card__row" data-application-cost>
                                                <div class="d-flex text-bold paragraph price-card__row-item">
                                                    <?php pll_e('Application filing stage'); ?>
                                                    <div class="country-info ms-1">
                                                        <img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-info.svg" alt="" width="22" height="22" />
                                                        <div class="country-info__tooltip country-info__tooltip-right">
                                                            <?php
                                                                if (!empty($application_filing_stage_tooltip_text)) {
                                                                    echo esc_html($application_filing_stage_tooltip_text);
                                                                } else {
                                                                    pll_e('Includes 1 class');
                                                                }
                                                            ?>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between price-card__row-item" data-fee>
                                                    <div class="price-card__description">
                                                        <?php pll_e('Official fee'); ?>
                                                    </div>
                                                    <div class="price-card__value" data-price-value>
                                                        <span><?php echo $application_cost["fee"]?> <?php echo $currency ?></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex justify-content-between price-card__row-item" data-service-fee>
                                                    <div class="price-card__description">
                                                        <?php pll_e('Service fee'); ?>
                                                    </div>
                                                    <div class="price-card__value" data-price-value>
                                                        <span><?php echo $application_cost["service_fee"]?> <?php echo $currency ?></span>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between price-card__row-item">
                                                    <div class="price-card__description"><?php pll_e('Total'); ?></div>
                                                    <div class="price-card__value" data-price-summ>
                                                       <span><?php echo $application_cost["total_fee"]?> <?php echo $currency ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                             <!--  price-card__row end -->
                                            <?php if (!empty($registration_cost)) { ?>
                                                <!--  price-card__row start -->
                                                <div class="price-card__row" data-registration-cost>
                                                    <div class="d-flex text-bold paragraph price-card__row-item">
                                                        <?php pll_e('Registration stage (after examination decision)'); ?>
                                                        <div class="country-info ms-1">
                                                            <img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-info.svg" alt="" width="22" height="22" />
                                                            <div class="country-info__tooltip country-info__tooltip-right">
                                                                <?php
                                                                    if (!empty( $registration_stage_tooltip_text)) {
                                                                        echo esc_html( $registration_stage_tooltip_text);
                                                                    } else {
                                                                        pll_e('Includes 1 class');
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-between price-card__row-item" data-fee>
                                                        <div class="price-card__description"> <?php pll_e('Official fee'); ?> </div>
                                                        <div class="price-card__value" data-price-value>
                                                            <span><?php echo $registration_cost["fee"]?> <?php echo $currency ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-between price-card__row-item" data-service-fee>
                                                        <div class="price-card__description"><?php pll_e('Service fee'); ?></div>
                                                        <div class="price-card__value" data-price-value>
                                                            <span><?php echo $registration_cost["service_fee"]?> <?php echo $currency ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-between price-card__row-item">
                                                        <div class="price-card__description"><?php pll_e('Total'); ?></div>
                                                        <div class="price-card__value" data-price-summ>
                                                            <span><?php echo $registration_cost["total_fee"]?> <?php echo $currency ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--  price-card__row end -->
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                            </div>
                    </div>
                </section>
            </div>
            <!-- CALC BLOCK END -->

            <!-- CTA BLOCK -->
            <?php if( have_rows('calc_action_types_block', 'option') ): while( have_rows('calc_action_types_block', 'option') ): the_row(); ?>
                <?php if(get_sub_field('calc_action_block_title', 'option')) : ?>
                    <div class="mb-80">
                        <div class="cta-block">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto mb-3 mb-md-0 col-md-6">
                                    <p class="m-0 h2"><?php the_sub_field('calc_action_block_title', 'option'); ?></p>
                                </div>
                                <?php
                                    $link = get_sub_field('calc_action_block_button');
                                    if( $link ):
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                        <div class="col-auto">
                                            <a class="btn btn-danger" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                        </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; endif; ?>
            <!-- CTA BLOCK END-->

        
            <!-- COUNTRY SEARCH BLOCK -->
            <div class="js-content-search mb-80">
                <div class="mb-3">
                    <h2 class="h2 mb-2 mb-lg-3"><?php pll_e('Countries'); ?></h2>
                    <div class="form form-search form-search-iconed">
                        <form>
                            <div class="form-search__container">
                                <div class="form-search__icon">
                                    <img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-search-grey.svg" alt="" />
                                </div>
                                <input type="text" placeholder="<?php pll_e('Search'); ?>" />
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gap-y-2 js-countries-list">
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
                        uasort($country_terms, function ($a, $b) {
                            return strcmp($a->name, $b->name);
                        });

                        foreach ($country_terms as $slug => $term) {
                            $category_icon = get_field('category_icon', 'service_country_' . $term->term_id);
                            $link = get_field('link_to_file', 'service_country_' . $term->term_id);
                            $first_price_item_tooltip = get_field('price_item_txt_tooltip', 'service_country_' . $term->term_id); // Текст із адмінки
                            
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

                            $country_price_data = $api_data[strtoupper($slug)];
                            $currency = $country_price_data["currency"]["description"];
                            $application_cost = $country_price_data["application_cost"];
                            
                            $registration_cost = null;

                            $card_total_sum = $application_cost["total_fee"];

                            if (!empty($country_price_data["registration_cost"])) {
                                $registration_cost = $country_price_data["registration_cost"];
                                $card_total_sum += $registration_cost["total_fee"];
                            }
                            ?>
                            <div class="col">
                                <div class="country-card js-price-card" data-country-code="<?php echo esc_attr($slug); ?>" data-country-type="registration">
                                    <div class="row justify-content-between mb-2">
                                        <div class="col-auto d-flex gap-1">
                                            <?php if ($category_icon) : ?>
                                                <img src="<?php echo esc_url($category_icon['url']); ?>" alt="<?php echo esc_attr($term->name); ?>" width="20" height="20" />
                                            <?php endif; ?>
                                            <a href="<?php echo esc_url($service_link); ?>" target="_blank" class="js-country-name country-card__country-link"><?php echo esc_html($term->name); ?></a>
                                        </div>
                                        <div class="col-auto d-flex gap-1">
                                            <span data-price-total class="text-bold" id="price-<?php echo esc_attr($slug); ?>"><?php echo  $card_total_sum ?> <?php echo  $currency ?></span>
                                            <div class="country-info">
                                                <img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-info.svg" alt="" width="24" height="24" />
                                                <div class="country-info__tooltip">
                                                    <?php echo esc_html($first_price_item_tooltip ? $first_price_item_tooltip : pll__('Includes 1 class')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <a href="#<?php echo esc_attr($slug); ?>" class="js-price-modal link"><span><?php pll_e('Details'); ?></span></a>
                                        </div>

                                        <?php if ($link):
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <div class="col-auto">
                                                <a class="link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                    <span><?php echo esc_html($link_title); ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="modal details-modal js-modal-<?php echo esc_attr($slug); ?>">
                                            <div class="position-relative modal-submit__content">
                                                <button type="button" class="btn modal__btn-close js-modal-btn-close">
                                                    <img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-close-modal.svg" alt="menu" />
                                                </button>
                                                <div class="box box--white box--lg box--radius-lg">
                                                    <div class="price-card">
                                            <div class="price-card__header">
                                                <a href="<?php echo esc_url($service_link); ?>" class="d-flex gap-1" target="_blank">
                                                    <?php if ($category_icon) : ?>
                                                        <img src="<?php echo esc_url($category_icon['url']); ?>" alt="<?php echo esc_attr($term->name); ?>" width="20" height="20" />
                                                    <?php endif; ?>
                                                    <span class="text-bold"><?php echo esc_html($term->name); ?></span>
                                                </a>
                                                <span class="text-bold" data-price-total> <?php echo $card_total_sum ?> <?php echo $currency ?> </span>
                                            </div>
                                            <!--  price-card__row start -->
                                            <div class="price-card__row" data-application-cost>
                                                <div class="d-flex text-bold paragraph price-card__row-item">
                                                    <?php pll_e('Application filing stage'); ?>
                                                    <div class="country-info ms-1">
                                                        <img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-info.svg" alt="" width="22" height="22" />
                                                        <div class="country-info__tooltip country-info__tooltip-right">
                                                            <?php
                                                                if (!empty($application_filing_stage_tooltip_text)) {
                                                                    echo esc_html($application_filing_stage_tooltip_text);
                                                                } else {
                                                                    pll_e('Includes 1 class');
                                                                }
                                                            ?>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between price-card__row-item" data-fee>
                                                    <div class="price-card__description">
                                                        <?php pll_e('Official fee'); ?>
                                                    </div>
                                                    <div class="price-card__value" data-price-value>
                                                        <span><?php echo $application_cost["fee"]?> <?php echo $currency ?></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex justify-content-between price-card__row-item" data-service-fee>
                                                    <div class="price-card__description">
                                                        <?php pll_e('Service fee'); ?>
                                                    </div>
                                                    <div class="price-card__value" data-price-value>
                                                        <span><?php echo $application_cost["service_fee"]?> <?php echo $currency ?></span>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between price-card__row-item">
                                                    <div class="price-card__description"><?php pll_e('Total'); ?></div>
                                                    <div class="price-card__value" data-price-summ>
                                                       <span><?php echo $application_cost["total_fee"]?> <?php echo $currency ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                             <!--  price-card__row end -->
                                            <?php if (!empty($registration_cost)) { ?>
                                                <!--  price-card__row start -->
                                                <div class="price-card__row" data-registration-cost>
                                                    <div class="d-flex text-bold paragraph price-card__row-item">
                                                        <?php pll_e('Registration stage (after examination decision)'); ?>
                                                        <div class="country-info ms-1">
                                                            <img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-info.svg" alt="" width="22" height="22" />
                                                            <div class="country-info__tooltip country-info__tooltip-right">
                                                                <?php
                                                                    if (!empty( $registration_stage_tooltip_text)) {
                                                                        echo esc_html( $registration_stage_tooltip_text);
                                                                    } else {
                                                                        pll_e('Includes 1 class');
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-between price-card__row-item" data-fee>
                                                        <div class="price-card__description"> <?php pll_e('Official fee'); ?> </div>
                                                        <div class="price-card__value" data-price-value>
                                                            <span><?php echo $registration_cost["fee"]?> <?php echo $currency ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-between price-card__row-item" data-service-fee>
                                                        <div class="price-card__description"><?php pll_e('Service fee'); ?></div>
                                                        <div class="price-card__value" data-price-value>
                                                            <span><?php echo $registration_cost["service_fee"]?> <?php echo $currency ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-between price-card__row-item">
                                                        <div class="price-card__description"><?php pll_e('Total'); ?></div>
                                                        <div class="price-card__value" data-price-summ>
                                                            <span><?php echo $registration_cost["total_fee"]?> <?php echo $currency ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--  price-card__row end -->
                                            <?php } ?>
                                        </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
            <!-- COUNTRY SEARCH END -->


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
        <!-- TAB 1 END -->

        <!-- TAB 2 START -->
        <div id="tab-2" class="tab-content  js-calc-form" role="tabpanel" aria-labelledby="tab-2" aria-hidden="true" style="display: none">
            <!-- CALC BLOCK START -->
            <div class="mb-80">
                <section>
                    <?php if (get_field('calc_ren_reg_title', 'option')) : ?>
                        <h2 class="h2 text-center mb-2 mb-lg-3"><?php the_field('calc_ren_reg_title', 'option'); ?></h2>
                    <?php endif; ?>

                     <div class="calc-form">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 col-sm-5 mb-3 mb-sm-0">
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
                                                )
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
                            <div class="col-12 col-sm-4 col-lg-3">
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
                            <!-- currency dropdown -->
                           <div class="col-12 col-sm-3">
                                <div class="d-flex flex-column flex-sm-row align-items-center gap-1 gap-sm-2">
                                    <div class="paragraph text-bold"><?php pll_e('Currency'); ?>:</div>
                                    <div class="custom-select">
                                        <button class="selected-values currency-select">
                                            <span class="selected-values__text">
                                                USD
                                            </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                                                <path d="M7.5 10L12.5 15L17.5 10H7.5Z" fill="#999999" />
                                            </svg>
                                        </button>
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
                                            
                                            <?php
                                                // Отримуємо доступні валюти з WordPress
                                                if (have_rows('avaible_currency', 'option')):
                                                    while (have_rows('avaible_currency', 'option')) : the_row();
                                                        $currency_code = get_sub_field('currency_code');
                                            ?>
                                                <label class="currency-option" data-currency-code="<?= esc_attr($currency_code); ?>">
                                                    <?= esc_html($currency_code); ?>
                                                </label>
                                            <?php
                                                    endwhile;
                                                endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- currency dropdown end-->

                            <!-- error start -->
                            <div class="col-12 text-danger paragraph-sm text-center text-error mt-1 js-calc-form-error d-none" >
                                <?php pll_e('Oops...Error fetch currency or price data try later'); ?>
                            </div>
                            <!-- error end -->
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
                                    $link = get_field('link_to_file_ren', 'service_country_' . $term->term_id);
                                    $application_filing_stage_tooltip_text = get_field('trademark_renewal_tooltip', 'service_country_' . $term->term_id);

                                    $country_price_data = $api_data[strtoupper($slug)];
                                    $currency = $country_price_data["currency"]["description"];

                                     $renewal_cost = null;

                                    $card_total_sum = '---';

                                    if (!empty($country_price_data["renewal_cost"])) {
                                        $renewal_cost = $country_price_data["renewal_cost"];
                                        $card_total_sum = $renewal_cost["total_fee"];
                                    }

                                    $service_post_args = array(
                                        'post_type' => 'services',
                                        'posts_per_page' => 1,
                                        'tax_query' => array(
                                            'relation' => 'AND',
                                            array(
                                                'taxonomy' => 'service_type',
                                                'field'    => 'slug',
                                                'terms'    => 'trademark-renewal',
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
                                    <div class="col pt-3 pt-xl-4 js-price-card" style="display: none" data-country-code="<?php echo esc_attr($slug); ?>" data-country-type="renewal" >
                                        <div class="price-card">
                                            <div class="price-card__header">
                                                <a href="<?php echo esc_url($service_link); ?>" class="d-flex gap-1" target="_blank">
                                                    <?php if ($category_icon) : ?>
                                                        <img src="<?php echo esc_url($category_icon['url']); ?>" alt="<?php echo esc_attr($term->name); ?>" width="20" height="20" />
                                                    <?php endif; ?>
                                                    <span class="text-bold"><?php echo esc_html($term->name); ?></span>
                                                </a>
                                                <span class="text-bold" data-price-total> <?php echo $card_total_sum ?> <?php echo $currency ?> </span>
                                            </div>
                                            <!--  price-card__row start -->
                                            <div class="price-card__row" data-renewal-cost>
                                                <div class="d-flex text-bold paragraph price-card__row-item">
                                                    <?php pll_e('Trademark renewal'); ?>
                                                    <div class="country-info ms-1">
                                                        <img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-info.svg" alt="" width="22" height="22" />
                                                        <div class="country-info__tooltip country-info__tooltip-right">
                                                            <?php
                                                                if (!empty($application_filing_stage_tooltip_text)) {
                                                                    echo esc_html($application_filing_stage_tooltip_text);
                                                                } else {
                                                                    pll_e('Includes 1 class');
                                                                }
                                                            ?>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between price-card__row-item" data-fee>
                                                    <div class="price-card__description">
                                                        <?php pll_e('Official fee'); ?>
                                                    </div>
                                                    <div class="price-card__value" data-price-value>
                                                        <span><?php echo $renewal_cost["fee"]?> <?php echo $currency ?></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex justify-content-between price-card__row-item" data-service-fee>
                                                    <div class="price-card__description">
                                                        <?php pll_e('Service fee'); ?>
                                                    </div>
                                                    <div class="price-card__value" data-price-value>
                                                        <span><?php echo $renewal_cost["service_fee"]?> <?php echo $currency ?></span>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between price-card__row-item">
                                                    <div class="price-card__description"><?php pll_e('Total'); ?></div>
                                                    <div class="price-card__value" data-price-summ>
                                                       <span><?php echo $renewal_cost["total_fee"]?> <?php echo $currency ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                             <!--  price-card__row end -->
                                        
                                            <?php if (!empty($link)):
                                                $link_url = $link['url'];
                                                $link_title = $link['title'];
                                                $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-primary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                    <span><?php echo esc_html($link_title); ?></span>
                                                </a>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                            </div>
                    </div>
                </section>
            </div>
            <!-- CALC BLOCK END -->
            <!-- CTA BLOCK START-->
            <?php if( have_rows('calc_ren_action_types_block', 'option') ): while( have_rows('calc_ren_action_types_block', 'option') ): the_row(); ?>
                <?php if(get_sub_field('calc_ren_action_block_title', 'option')) : ?>
                    <div class="mb-80">
                        <div class="cta-block">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto mb-3 mb-md-0 col-md-6">
                                    <p class="m-0 h2"><?php the_sub_field('calc_ren_action_block_title', 'option'); ?></p>
                                </div>
                                <?php
                                $link = get_sub_field('calc_ren_action_block_button');
                                if( $link ):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                    <div class="col-auto">
                                        <a class="btn btn-danger" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; endif; ?>
            <!-- CTA BLOCK END-->

            <!-- COUNTRY SEARCH BLOCK -->
            <div class="js-content-search mb-80">
                <div class="mb-3">
                    <h2 class="h2 mb-2 mb-lg-3"><?php pll_e('Countries'); ?></h2>
                    <div class="form form-search form-search-iconed">
                        <form>
                            <div class="form-search__container">
                                <div class="form-search__icon">
                                    <img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-search-grey.svg" alt="" />
                                </div>
                                <input type="text" placeholder="<?php pll_e('Search'); ?>" />
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gap-y-2 js-countries-list">
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
                        uasort($country_terms, function ($a, $b) {
                            return strcmp($a->name, $b->name);
                        });

                         foreach ($country_terms as $slug => $term) {
                            $category_icon = get_field('category_icon', 'service_country_' . $term->term_id);
                            $link = get_field('link_to_file_ren', 'service_country_' . $term->term_id);
                            $first_price_item_tooltip = get_field('trademark_renewal_tooltip', 'service_country_' . $term->term_id); // Текст із адмінки
                            
                            $service_post_args = array(
                                'post_type' => 'services',
                                'posts_per_page' => 1,
                                'tax_query' => array(
                                    'relation' => 'AND',
                                    array(
                                        'taxonomy' => 'service_type',
                                        'field'    => 'slug',
                                        'terms'    => 'trademark-renewal',
                                    ),
                                    array(
                                        'taxonomy' => 'service_country',
                                        'field'    => 'slug',
                                        'terms'    => $slug,
                                    ),
                                ),
                            );

                            $service_query = new WP_Query($service_post_args);
                            $service_link = 'https://my.pocketip.com/';

                            if ($service_query->have_posts()) {
                                $service_query->the_post();
                                $service_link = get_permalink();
                                wp_reset_postdata();
                            }

                          $country_price_data = $api_data[strtoupper($slug)];
                            $currency = $country_price_data["currency"]["description"];

                            $renewal_cost = null;

                            $card_total_sum = '---';

                            if (!empty($country_price_data["renewal_cost"])) {
                                $renewal_cost = $country_price_data["renewal_cost"];
                                $card_total_sum = $renewal_cost["total_fee"];
                            }
                            ?>
                            <div class="col">
                                <div class="country-card js-price-card"  data-country-type="renewal" data-country-code="<?php echo esc_attr($slug); ?>">
                                    <div class="row justify-content-between mb-2">
                                        <div class="col-auto d-flex gap-1">
                                            <?php if ($category_icon) : ?>
                                                <img src="<?php echo esc_url($category_icon['url']); ?>" alt="<?php echo esc_attr($term->name); ?>" width="20" height="20" />
                                            <?php endif; ?>
                                            <a href="<?php echo esc_url($service_link); ?>" target="_blank" class="js-country-name country-card__country-link"><?php echo esc_html($term->name); ?></a>
                                        </div>
                                        <div class="col-auto d-flex gap-1">
                                            <span data-price-total class="text-bold" id="price-<?php echo esc_attr($slug); ?>"><?php echo  $card_total_sum ?> <?php echo  $currency ?></span>
                                            <div class="country-info">
                                                <img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-info.svg" alt="" width="24" height="24" />
                                                <div class="country-info__tooltip">
                                                    <?php echo esc_html($first_price_item_tooltip ? $first_price_item_tooltip : pll__('Includes 1 class')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <a href="#<?php echo esc_attr($slug); ?>" class="js-price-modal link"><span><?php pll_e('Details'); ?></span></a>
                                        </div>

                                        <?php if ($link):
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <div class="col-auto">
                                                <a class="link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                    <span><?php echo esc_html($link_title); ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="modal details-modal js-modal-<?php echo esc_attr($slug); ?>">
                                            <div class="position-relative modal-submit__content">
                                                <button type="button" class="btn modal__btn-close js-modal-btn-close">
                                                    <img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-close-modal.svg" alt="menu" />
                                                </button>
                                                <div class="box box--white box--lg box--radius-lg">
                                                    <div class="price-card">
                                                        <div class="price-card__header">
                                                            <a href="<?php echo esc_url($service_link); ?>" class="d-flex gap-1" target="_blank">
                                                                <?php if ($category_icon) : ?>
                                                                    <img src="<?php echo esc_url($category_icon['url']); ?>" alt="<?php echo esc_attr($term->name); ?>" width="20" height="20" />
                                                                <?php endif; ?>
                                                                <span class="text-bold"><?php echo esc_html($term->name); ?></span>
                                                            </a>
                                                            <span class="text-bold" data-price-total> <?php echo $card_total_sum ?> <?php echo $currency ?> </span>
                                                        </div>
                                                        <!--  price-card__row start -->
                                                        <div class="price-card__row" data-renewal-cost>
                                                            <div class="d-flex text-bold paragraph price-card__row-item">
                                                                <?php pll_e('Trademark renewal'); ?>
                                                                <div class="country-info ms-1">
                                                                    <img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-info.svg" alt="" width="22" height="22" />
                                                                    <div class="country-info__tooltip country-info__tooltip-right">
                                                                        <?php
                                                                            if (!empty($first_price_item_tooltip)) {
                                                                                echo esc_html($first_price_item_tooltip);
                                                                            } else {
                                                                                pll_e('Includes 1 class');
                                                                            }
                                                                        ?>
                                                                    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-between price-card__row-item" data-fee>
                                                                <div class="price-card__description">
                                                                    <?php pll_e('Official fee'); ?>
                                                                </div>
                                                                <div class="price-card__value" data-price-value>
                                                                    <span><?php echo $renewal_cost["fee"]?> <?php echo $currency ?></span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="d-flex justify-content-between price-card__row-item" data-service-fee>
                                                                <div class="price-card__description">
                                                                    <?php pll_e('Service fee'); ?>
                                                                </div>
                                                                <div class="price-card__value" data-price-value>
                                                                    <span><?php echo $renewal_cost["service_fee"]?> <?php echo $currency ?></span>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex justify-content-between price-card__row-item">
                                                                <div class="price-card__description"><?php pll_e('Total'); ?></div>
                                                                <div class="price-card__value" data-price-summ>
                                                                <span><?php echo $renewal_cost["total_fee"]?> <?php echo $currency ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  price-card__row end -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
            <!-- COUNTRY SEARCH END -->

            <!--PAYMENT START -->
            <?php if( have_rows('calc_payment_block', 'option') ): while( have_rows('calc_payment_block', 'option') ): the_row(); ?>
                <div class="row justify-content-center">
                    <div class="col-12 col-sm col-lg-5">
                        <?php if(get_sub_field('calc_payment_block_title', 'option')) : ?>
                            <div class="h2 mb-2 mb-lg-3"><?php the_sub_field('calc_payment_block_title', 'option'); ?></div>
                        <?php endif; ?>
                        <?php if(get_sub_field('calc_payment_block_subtitle', 'option')) : ?>
                            <p class="paragraph paragraph-lg"><?php the_sub_field('calc_payment_block_subtitle', 'option'); ?></p>
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
        <!-- TAB 2 END -->

        <!-- TAB 3 START -->
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

            <!-- CTA BLOCK -->

            <?php if( have_rows('calc_sub_action_types_block', 'option') ): while( have_rows('calc_sub_action_types_block', 'option') ): the_row(); ?>
                <?php if(get_sub_field('calc_sub_action_block_title', 'option')) : ?>
                    <div class="cta-block">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto mb-3 mb-md-0 col-md-6">
                                <p class="m-0 h2"><?php the_sub_field('calc_sub_action_block_title', 'option'); ?></p>
                            </div>
                            <?php
                            $link = get_sub_field('calc_sub_action_block_button');
                            if( $link ):
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <div class="col-auto">
                                    <a class="btn btn-danger" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; endif; ?>
            <!-- CTA BLOCK END-->
        </div>
        <!-- TAB 3 END -->
    </div>
</div>
