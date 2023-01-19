<?php if( get_row_layout() == 'banner_block' ): ?>
    <section class="page-section page-section--pt-sm pb-0">
        <div class="container-xxl">
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <?php if(get_sub_field('banner_block_title')): ?>
                        <h1 class="h1 mb-3 pb-1">
                            <?php the_sub_field('banner_block_title'); ?>
                        </h1>
                    <?php endif; ?>
                    <?php if(get_sub_field('banner_block_description')) : ?>
                        <p class="pb-1 paragraph paragraph-lg mb-3">
                            <?php the_sub_field('banner_block_description'); ?>
                        </p>
                    <?php endif; ?>
                    <div class="d-flex">
                        <?php
                        $enter_link = get_sub_field('banner_block_button_enter');
                        if( $enter_link ):
                            $enter_link_url = $enter_link['url'];
                            $enter_link_title = $enter_link['title'];
                            $enter_link_target = $enter_link['target'] ? $enter_link['target'] : '_self';
                            ?>
                            <a class="btn btn-danger me-3" href="<?php echo esc_url( $enter_link_url ); ?>" target="<?php echo esc_attr( $enter_link_target ); ?>"><?php echo esc_html( $enter_link_title ); ?></a>
                        <?php endif; ?>
                        <?php
                        $login_link = get_sub_field('banner_block_button_watch');
                        if( $login_link ):
                            $login_link_url = $login_link['url'];
                            $login_link_title = $login_link['title'];
                            $login_link_target = $login_link['target'] ? $login_link['target'] : '_self';
                            ?>
                            <a class="btn btn-video ms-1 js-btn-video" data-video="<?php echo esc_url( $login_link_url ); ?>" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="12" fill="#D80202" />
                                    <path d="M9.59998 16.5V7.5L15.6 12L9.59998 16.5Z" fill="white" />
                                </svg>
                                <span class="ms-2"><?php echo esc_html( $login_link_title ); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php if( have_rows('banner_block_item') ): ?>
                        <div class="row d-none d-lg-flex mt-5 pt-xxl-2">
                            <?php while ( have_rows('banner_block_item') ): the_row();?>
                                <div class="col-auto">
                                    <?php
                                    $image = get_sub_field('banner_block_item_image');
                                    if( !empty( $image ) ): ?>
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="72" height="80" />
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
                $image_banner = get_sub_field('banner_block_image');
                $image_banner_big = get_sub_field('banner_block_image_big');
                if (!empty($image_banner)): ?>
                    <div class="col-12 col-md-6">
                        <img src="<?php echo esc_url($image_banner['url']); ?>"
                            <?php if(!empty($image_banner_big)) : ?>
                                srcset="<?php echo esc_url($image_banner['url']); ?> 1x, <?php echo esc_url($image_banner_big['url']); ?> 2x"
                            <?php endif; ?>
                             width="840" height="600" alt="<?php echo esc_attr($image_banner['alt']); ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif;?>

<?php if( get_row_layout() == 'software_block' ): ?>
    <section class="page-section <?php if(!is_front_page()) : ?>  p-0 mb-80 <?php endif; ?>">
        <div class="container-lg">
            <?php if(get_sub_field('software_block_title')) : ?>
                <div class="row ">
                    <div class="col-12 mb-sm-3 pb-sm-1 mb-lg-4 pb-lg-3 ">
                        <h2 class="h2 section-h2"><?php the_sub_field('software_block_title'); ?></h2>
                    </div>
                </div>
            <?php endif; ?>
            <?php if( have_rows('software_block_items') ): ?>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xxl-5 justify-content-center">
                    <?php
                    $counter = 1;
                    while ( have_rows('software_block_items') ): the_row(); ?>
                        <div class="col col-s mt-3 pt-1 <?php if($counter<=2):?>mt-sm-0 pt-sm-0<?php elseif($counter==3):?>mt-md-0 pt-md-0<?php elseif($counter>=4):?>mt-xxl-0 pt-xxl-0<?php endif;?> d-flex">
                            <div class="box box--radius-lg box--white box--shadow">
                                <?php if(get_sub_field('software_block_items_icon')): ?>
                                    <div class="box box--sm box--radius-sm box--red w-auto d-inline-flex justify-content-center mb-3">
                                        <img src="<?php echo get_sub_field('software_block_items_icon')['url'];?>" alt="<?php echo get_sub_field('software_block_items_icon')['alt'];?>">
                                    </div>
                                <?php endif; ?>
                                <?php if(get_sub_field('software_block_items_title')): ?>
                                    <p class="subtitle-2 mb-2"><?php the_sub_field('software_block_items_title');?></p>
                                <?php endif; ?>
                                <?php if(get_sub_field('software_block_items_description')): ?>
                                    <p class="paragraph-sm"><?php the_sub_field('software_block_items_description');?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php $counter++; endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif;?>

<?php if( get_row_layout() == 'why-us_block' ): ?>
    <section class="page-section page-section--bg-grey">
        <div class="container-lg">
            <div class="row row-cols-1 row-cols-md-2">
                <?php if(get_sub_field('why-us_block_title')): ?>
                    <div class="col d-flex mb-4">
                        <h2 class="h2 section-h2"><?php the_sub_field('why-us_block_title'); ?></h2>
                    </div>
                <?php endif; ?>
                <?php
                $solutions_types = get_sub_field('why-us_block_category');
                if( $solutions_types ): $num = 0; ?>
                    <?php foreach( $solutions_types as $solution_type ): $num++; ?>
                        <div class="col d-flex flex-column mb-4 <?php if($num<=3): ?>mb-xl-5<?php elseif($num==4): ?>mb-md-0<?php endif; ?> ">
                            <div class="d-flex mb-2">
                                <?php
                                $image = get_field('category_icon', $solution_type);
                                if( !empty( $image ) ): ?>
                                    <div class="me-3">
                                        <img src="<?php echo esc_url($image['url']); ?>" width="40" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    </div>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( get_term_link( $solution_type ) ); ?>" class="h3"><?php echo esc_html( $solution_type->name ); ?></a>
                            </div>
                            <p class="m-0"><?php echo esc_html( $solution_type->description ); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif;?>

<?php if( get_row_layout() == 'services_block' ): ?>
    <section class="page-section <?php if(!is_front_page()) : ?>  p-0 mb-80 <?php endif; ?> ">
        <div class="container-lg">
            <?php if(get_sub_field('services_block_title')) : ?>
                <h2 class="h2 section-h2 mb-4 mb-xl-5"><?php the_sub_field('services_block_title'); ?></h2>
            <?php endif; ?>
            <div class="row row-cols-1 row-cols-md-2">
                <?php
                $services_types = get_sub_field('services_block_category');
                if( $services_types ): $num = 0; ?>
                    <?php foreach( $services_types as $service_type ): $num++; ?>
                        <div class="col d-flex flex-column mb-4 <?php if($num==1 || $num==2): ?>mb-xl-5<?php elseif($num==3): ?>mb-md-0<?php endif; ?>  ">
                            <div class="d-flex mb-2">
                                <?php
                                $image = get_field('category_icon', $service_type);
                                if( !empty( $image ) ): ?>
                                    <div class="me-3">
                                        <img src="<?php echo esc_url($image['url']); ?>" width="40" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    </div>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( get_term_link( $service_type ) ); ?>" class="h3"><?php echo esc_html( $service_type->name ); ?></a>
                            </div>
                            <p class="m-0"><?php echo esc_html( $service_type->description ); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif;?>

<?php if( get_row_layout() == 'action_block' ): ?>
		<section class="page-section p-0 <?php if(!is_front_page()) : ?> mb-80 <?php endif; ?> ">
		    <div class="container-lg">
		        <div class="cta-block">
		            <div class="row justify-content-between align-items-center">
		                <?php if(get_sub_field('action_block_text')) : ?>
		                    <div class="col-auto mb-3 mb-md-0 col-md-6">
		                        <p class="m-0 h2"><?php the_sub_field('action_block_text'); ?></p>
		                    </div>
		                <?php endif; ?>
		                <?php
		                $action_link = get_sub_field('action_block_button');
		                if( $action_link ):
		                    $action_link_url = $action_link['url'];
		                    $action_link_title = $action_link['title'];
		                    $action_link_target = $action_link['target'] ? $action_link['target'] : '_self';
		                    ?>
		                    <div class="col-auto">
		                        <a class="btn btn-primary" href="<?php echo esc_url( $action_link_url ); ?>" target="<?php echo esc_attr( $action_link_target ); ?>"><?php echo esc_html( $action_link_title ); ?></a>
		                    </div>
		                <?php endif; ?>
		            </div>
		        </div>
		    </div>
		</section>
<?php endif;?>

<?php if( get_row_layout() == 'rs_image_block' ): ?>
    <section class="page-section <?php if(!is_front_page()) : ?>  p-0 mb-80 <?php endif; ?>">
        <div class="container-lg">
            <div class="row justify-content-between">
                <div class="col-6  d-none d-lg-block p-xxl-0 pe-xl-5">
                    <?php if(get_sub_field('rs_image_block_image')): ?>
                    <div class="stats-img">
                        <img src="<?php echo get_sub_field('rs_image_block_image')['url']; ?>" alt="" />
                    </div>
                </div>
                <?php endif;?>
                <div class="col-lg-6 ps-xl-5">
                    <div class="ps-xl-5">
                        <?php if(get_sub_field('rs_image_block_title')): ?>
                            <h2 class="h2 section-h2 mb-4 pb-xl-2"><?php the_sub_field('rs_image_block_title'); ?></h2>
                        <?php endif;?>
                        <?php if( have_rows('rs_image_block_content') ): while ( have_rows('rs_image_block_content') ): the_row(); ?>
                            <?php if(get_sub_field('rs_image_block_content_subtitle')): ?>
                                <div class="h3 mb-3"><?php the_sub_field('rs_image_block_content_subtitle'); ?></div>
                            <?php endif;?>
                            <?php if(get_sub_field('rs_image_block_content_description')): ?>
                                <div class="paragraph mb-4">
                                    <?php the_sub_field('rs_image_block_content_description'); ?>
                                </div>
                            <?php endif;?>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
            </div>
            <?php if( have_rows('rs_image_block_item') ): ?>
	            <div class="row row-cols-2 row-cols-lg-4 mt-xxl-n5">
	                <?php  while ( have_rows('rs_image_block_item') ): the_row(); ?>
	                    <div class="col mb-3">
	                        <div class="box box--white box--shadow d-flex align-items-center justify-content-center">
	                            <div class="text-center">
	                                <?php if(get_sub_field('rs_image_block_item_number')): ?>
	                                    <div class="h3 text-primary mb-2">
	                                        <?php the_sub_field('rs_image_block_item_number'); ?>
	                                    </div>
	                                <?php endif;?>
	                                <?php if(get_sub_field('rs_image_block_item_text')): ?>
	                                    <div class="paragraph"><?php the_sub_field('rs_image_block_item_text'); ?></div>
	                                <?php endif;?>
	                            </div>
	                        </div>
	                    </div>
	                <?php endwhile;?>
	            </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif;?>

<?php if( get_row_layout() == 'reviews_block' ): ?>
    <section class="page-section <?php if(!is_front_page()) : ?>  p-0 mb-80 <?php endif; ?> pt-0">
        <div class="container-lg">
            <div class="row justify-content-center">
                <?php if(get_sub_field('reviews_block_title')): ?>
                    <div class="col col-xxl-6">
                        <h2 class="h2 section-h2 mb-2 mb-xl-3 pb-xl-1"><?php the_sub_field('reviews_block_title'); ?></h2>
                    </div>
                <?php endif;?>
            </div>
            <div class="slider slider-card">
                <div class="slider__wrapper">
                    <?php if( have_rows('reviews_block_items') ): while ( have_rows('reviews_block_items') ): the_row(); ?>
                        <div class="box box--white box--shadow h-100 mb-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex">
                                    <div class="avatar avatar-lg">
                                        <?php
                                        $image = get_sub_field('reviews_block_items_avatar');
                                        if( !empty( $image ) ): ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <?php endif; ?>
                                        <div>
                                            <?php if(get_sub_field('reviews_block_items_name')): ?>
                                                <span><?php the_sub_field('reviews_block_items_name'); ?></span>
                                            <?php endif;?>
                                            <?php if(get_sub_field('reviews_block_items_position')): ?>
                                                <span class="text-bold"><?php the_sub_field('reviews_block_items_position'); ?></span>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                                <?php if(get_sub_field('reviews_block_items_url')): ?>
                                    <a href="<?php the_sub_field('reviews_block_items_url'); ?>">
                                        <?php
                                        $image = get_sub_field('reviews_block_items_icon');
                                        if( !empty( $image ) ): ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <?php endif; ?>
                                    </a>
                                <?php endif;?>
                            </div>
                            <?php if(get_sub_field('reviews_block_items_content')): ?>
                                <p><?php the_sub_field('reviews_block_items_content'); ?></p>
                            <?php endif;?>
                        </div>
                    <?php endwhile; endif; ?>
                </div>
                <div class="slider__controls">
                    <div class="slider__dots"></div>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>

<?php if( get_row_layout() == 'roadmap_block' ): ?>
    <section class="page-section <?php if(!is_front_page()) : ?>  p-0 mb-80 <?php endif; ?> pb-0">
        <div class="roadmap">
            <div class="container-lg">
                <div class="row justify-content-center">
                    <?php if(get_sub_field('roadmap_block_title')): ?>
                        <div class="col col-xxl-6">
                            <h2 class="h2 section-h2 mb-3 mb-xl-4 pb-xl-3"><?php the_sub_field('roadmap_block_title'); ?></h2>
                        </div>
                    <?php endif;?>
                </div>
                <div class="roadmap__wrapper">
                    <?php if( have_rows('roadmap_block_content') ): while ( have_rows('roadmap_block_content') ): the_row(); ?>
                        <div class="roadmap__card">
                            <?php if(get_sub_field('roadmap_block_content_title')): ?>
                                <div class="roadmap__title d-none d-md-block"><?php the_sub_field('roadmap_block_content_title'); ?></div>
                            <?php endif;?>
                            <div class="roadmap__item">
                                <div class="roadmap__step">
                                    <?php if(get_sub_field('roadmap_block_content_title')): ?>
                                        <div class="roadmap__title d-block d-md-none"><?php the_sub_field('roadmap_block_content_title'); ?></div>
                                    <?php endif;?>
                                    <?php if(get_sub_field('roadmap_block_content_subtitle')): ?>
                                        <div class="roadmap__step-title"><?php the_sub_field('roadmap_block_content_subtitle'); ?></div>
                                    <?php endif;?>
                                    <?php if(get_sub_field('roadmap_block_content_description')): ?>
                                        <div class="roadmap__step-text">
                                            <?php the_sub_field('roadmap_block_content_description'); ?>
                                        </div>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>

<?php if( get_row_layout() == 'rewards_block' ): ?>
    <section class="page-section <?php if(!is_front_page()) : ?>  p-0 mb-80 <?php endif; ?> ">
        <div class="container-lg">
            <div class="row justify-content-center">
                <?php if(get_sub_field('rewards_block_title')): ?>
                    <div class="col col-xxl-6">
                        <h2 class="h2 section-h2 mb-2 mb-xl-3 pb-xl-1"><?php the_sub_field('rewards_block_title'); ?></h2>
                    </div>
                <?php endif;?>
            </div>
            <div class="slider slider-rows">
                <div class="slider__wrapper">
                    <?php
                    if(have_rows('rewards_block_items')):
                        while ( have_rows('rewards_block_items') ) : the_row();

                            $rewards_image = get_sub_field('rewards_block_items_image'); ?>
                            <?php if(!empty($rewards_image)): ?>
                                <div class="box py-4 box--white box--shadow d-flex align-items-center justify-content-center">
                                    <img src="<?php echo $rewards_image['url']; ?>" alt="<?php echo $rewards_image['url']; ?>">
                                </div>
                            <?php endif;?>
                        <?php endwhile; endif; ?>
                </div>
                <div class="slider__controls">
                    <div class="slider__dots"></div>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>

<?php if( get_row_layout() == 'faq_block' ): ?>
    <section class="page-section page-section--bg-grey">
        <div class="container-lg">
            <?php if(get_sub_field('faq_block_title')): ?>
                <h2 class="h2 section-h2 mb-3 mb-xl-4  text-center">
                    <a href="/faq">
                        <?php the_sub_field('faq_block_title'); ?>
                    </a>
                </h2>
            <?php endif;?>
            <div class="row justify-content-center">
                <div class="col col-md-10 col-xl-8">
                    <div class="accordion" id="faq-according">
                        <?php
                        $FAQs = get_sub_field('faq_block_content');
                        if ($FAQs) : ?>
                            <?php
                            $num = 0;
                            foreach ($FAQs as $post) :
                                setup_postdata($post);
                                ?>

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
            </div>
        </div>
    </section>
<?php endif;?>

<?php if( get_row_layout() == 'partners_block' ): ?>
    <section class="page-section <?php if(!is_front_page()) : ?>  p-0 mb-80 <?php endif; ?> ">
        <div class="container-lg">
            <div class="row justify-content-center">
                <?php if(get_sub_field('partners_block_title')):?>
                    <div class="col col-xxl-6">
                        <h2 class="h2 section-h2 mb-2 mb-xl-3 pb-xl-1"><?php the_sub_field('partners_block_title'); ?></h2>
                    </div>
                <?php endif;?>
            </div>
            <div class="slider slider-rows">
                <div class="slider__wrapper">
                    <?php
                    $partners = get_sub_field('partners_block_content');
                    if ($partners) :
                        foreach ($partners as $post):
                            $thumbnail_id = get_post_thumbnail_id( $post->ID );
                            $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                            $thumbnail = get_the_post_thumbnail($post->ID, 'full', array( 'alt' => $alt ) );
                            setup_postdata($post); ?>
                            <div class="box py-4 box--white box--shadow d-flex align-items-center justify-content-center">
                                <?php echo $thumbnail; ?>
                            </div>
                        <?php endforeach; wp_reset_postdata(); endif; ?>
                </div>
                <div class="slider__controls">
                    <div class="slider__dots"></div>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>

<?php if( get_row_layout() == 'cases_block' ): ?>
    <section class="page-section page-section--bg-grey">
        <div class="container-lg">
            <?php if(get_sub_field('cases_block_title')): ?>
                <h2 class="h2 section-h2"><?php the_sub_field('cases_block_title'); ?></h2>
            <?php endif;?>
            <div class="slider slider-card">
                <div class="slider__wrapper">
                    <?php
                    $cases = get_sub_field('cases_block_posts');
                    if ($cases) :
                        foreach ($cases as $post):
                            $thumbnail_id = get_post_thumbnail_id( $post->ID );
                            $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                            $thumbnail = get_the_post_thumbnail($post->ID, 'full', array( 'alt' => $alt ) );
                            setup_postdata($post);	?>
                            <div class="box box--white box--shadow content h-100">
                                <div class="mb-3">
                                    <?php echo $thumbnail; ?>
                                </div>
                                <div class="subtitle-1 mb-2"><?php the_title(); ?></div>
                                <?php the_content(); ?>
                            </div>
                        <?php endforeach; wp_reset_postdata(); endif; ?>
                </div>
                <div class="slider__controls">
                    <div class="slider__dots"></div>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>

<?php if( get_row_layout() == 'price_block' ): ?>
    <section class="page-section <?php if(!is_front_page()) : ?>  p-0 mb-80 <?php endif; ?> ">
        <div class="container-lg">
            <?php if(get_sub_field('price_block_title')): ?>
                <h2 class="h2 section-h2 mb-3 mb-lg-4"><?php the_sub_field('price_block_title'); ?></h2>
            <?php endif;?>
            <?php if(get_sub_field('price_block_subtitle')): ?>
                <div class="paragraph text-md-center mb-3 mb-lg-4">
                    <?php the_sub_field('price_block_subtitle'); ?>
                </div>
            <?php endif;?>
            <div class="pricing mb-4" data-price="year">
                <div class="row justify-content-md-center mb-4 mb-lg-5">
                    <div class="col-auto">
                        <div class="pricing-switcher js-pricing-switcher year-active">
                            <?php if(get_sub_field('price_block_month_tab')): ?>
                                <div class="pricing-switcher__month js-pricing-month"><?php the_sub_field('price_block_month_tab'); ?></div>
                            <?php endif;?>
                            <?php if(get_sub_field('price_block_year_tab')): ?>
                                <div class="pricing-switcher__year js-pricing-year is-active">
                                    <?php the_sub_field('price_block_year_tab');?>
                                    <?php if(get_sub_field('price_block_sale')): ?>
                                        <div class="pricing-switcher__discount">
                                            <?php the_sub_field('price_block_discount'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <?php if( have_rows('price_block_item') ): ?>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center ">

                        <?php while ( have_rows('price_block_item') ) : the_row(); $number=1; ?>
                            <div class="col <?php if($number<=2):?> mb-4 mb-lg-0 <?php endif;?>"><!-- проверить -->
                                <div class="box box--shadow h-100 d-flex flex-column">
                                    <?php if(get_sub_field('price_block_item_name')): ?>
                                        <div class="h3 mb-1"><?php the_sub_field('price_block_item_name');?></div>
                                    <?php endif;?>
                                    <div class="price-month">
                                        <div>
                                            <?php if(get_sub_field('price_block_item_cost_monthly')): ?>
                                                <span class="h2 text-primary text-bold me-1"><?php the_sub_field('price_block_item_cost_monthly');?></span>
                                            <?php endif;?>
                                            <?php if(get_sub_field('price_block_item_period_month')): ?>
                                                <span class="text-muted paragraph-sm"><?php the_sub_field('price_block_item_period_month');?></span>
                                            <?php endif;?>
                                        </div>
                                        <p class="paragraph mt-2 "><?php the_sub_field('price_block_item_total_price_month');?></p>
                                    </div>
                                    <div class="price-year">
                                        <div>
                                            <?php if(get_sub_field('price_block_item_cost_yearly')): ?>
                                                <span class="h2 text-primary text-bold me-1"><?php the_sub_field('price_block_item_cost_yearly');?></span>
                                            <?php endif;?>
                                            <?php if(get_sub_field('price_block_item_period_year')): ?>
                                                <span class="text-muted paragraph-sm"><?php the_sub_field('price_block_item_period_year');?></span>
                                            <?php endif;?>
                                        </div>
                                        <?php if(get_sub_field('price_block_item_total_price_year')): ?>
                                            <p class="paragraph mt-2 "><?php the_sub_field('price_block_item_total_price_year');?></p>
                                        <?php endif;?>
                                    </div>
                                    <div class="pricing-list">
                                        <?php if( have_rows('price_block_item_list') ): ?>
                                            <ul>
                                                <?php while ( have_rows('price_block_item_list') ) : the_row(); ?>
                                                    <?php if(get_sub_field('price_block_item_list_line')): ?>
                                                        <li><?php the_sub_field('price_block_item_list_line');?></li>
                                                    <?php endif;?>
                                                <?php endwhile; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                    $free_link = get_sub_field('price_block_item_button');
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
                            <?php $number ++; endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif;?>

<?php if( get_row_layout() == 'subscribe_block' ): ?>
    <section class="page-section pb-0 <?php if(!is_front_page()) : ?>  p-0 mb-80 <?php endif; ?> ">
        <div class="container-lg">
            <div class="cta-block text-center p-md-4 p-lg-5">
                <div class="row justify-content-center py-xl-4">
                    <div class="col-12 col-md-10 col-lg-8 col-xxl-7 px-xxl-5">
                        <?php if(get_sub_field('subscribe_block_title')): ?>
                            <h2 class="h2 mb-3 mb-xxl-4"><?php the_sub_field('subscribe_block_title'); ?></h2>
                        <?php endif;?>
                        <?php if(get_sub_field('subscribe_block_description')): ?>
                            <p class="paragraph mb-3 mb-xxl-4">
                                <?php the_sub_field('subscribe_block_description'); ?>
                            </p>
                        <?php endif;?>
                        <div class="form form-search">
                            <?php echo do_shortcode('[contact-form-7 id="557" title="Subscribe"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>

<?php if( get_row_layout() == 'blog_slider_block' ): ?>
    <section class="page-section <?php if(!is_front_page()) : ?>  p-0 mb-80 <?php endif; ?> pt-0">
        <div class="container-lg">
            <div class="row align-items-center justify-content-between justify-content-lg-center  mb-2 mb-xxl-2">
                <?php if(get_sub_field('blog_slider_block_title')): ?>
                    <div class="col-auto">
                        <h2 class="h2 section-h2"><?php the_sub_field('blog_slider_block_title'); ?></h2>
                    </div>
                <?php endif;?>
                <div class="col-auto d-block d-lg-none">
                    <?php $blog_link = site_url() . '/' . pll_current_language( 'slug' ) . '/blogs/';
                    ?>
                    <a href="<?php echo $blog_link; ?>" class="link link-icon">
                        <span><?php pll_e('Read blog'); ?></span>
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.37165 0.235013C0.684775 -0.0783368 1.18961 -0.0783368 1.50273 0.235012L6.81308 5.54916C7.06231 5.79856 7.06231 6.20144 6.81308 6.45084L1.50274 11.765C1.18961 12.0783 0.684776 12.0783 0.371651 11.765C0.0585251 11.4516 0.0585251 10.9464 0.371651 10.6331L4.99824 5.9968L0.36526 1.36051C0.0585257 1.05356 0.0585242 0.541967 0.37165 0.235013Z"
                                fill="#504EF3" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="slider slider-card">
                <div class="slider__wrapper">

                    <?php
                    $myposts = get_posts( array(
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'taxonomy' => 'posts',
                    ) );


                    if(have_posts($myposts)):
                        foreach( $myposts as $post ): setup_postdata( $post );

                            $author_id = get_post_field( 'post_author', $post->ID );
                            $author_avatar = get_field('user_photo', 'user_'. $author_id );

                            $title = get_the_title($post->ID);
                            $link = str_replace(
                                $post->post_name,
                                'blogs/' . $post->post_name,
                                get_permalink($post->ID)
                            );
                            $date = get_the_date("d.m.Y",$post->ID);
                            $image_post_tag = get_the_post_thumbnail($post->ID, 'full', array('class' => 'card-img','alt' => 'Heading news' ));
                            ?>
                            <div class="card card-bordered h-100  d-flex flex-column"> <!-- card-bordered h-100  d-flex flex-column добавил эти классы -->
                                <?php if( !empty($image_post_tag) ): echo $image_post_tag; endif; ?>
                                <div class="p-3 p-xxl-4 d-flex flex-column flex-grow-1"> <!-- d-flex flex-column flex-grow-1 добавил тут -->
                                    <div class="d-flex justify-content-between align-items-center mb-2 pb-xxl-1">
                                        <div class="avatar">
                                            <?php if( !empty( $author_avatar ) ): ?>
                                                <img src="<?php echo esc_url($author_avatar['url']); ?>" alt="<?php echo esc_attr($author_avatar['alt']); ?>">
                                            <?php endif; ?>

                                            <div><?php if(get_the_author_posts_link()):  echo esc_html(the_author_posts_link()); endif; ?></div>
                                            <!--<a href="#"><span>Kate Kulikova</span></a>  -->
                                        </div>
                                        <div class="card-date"><?php echo esc_html($date); ?></div>
                                    </div>
                                    <h5 class="subtitle-2 mb-2 pb-xxl-1"><?php echo mb_strimwidth($title, 0, 80, '...'); ?></h5>
                                    <div class="mt-auto"> <!-- тут див -->
                                        <p class="paragraph mb-2 pb-xxl-1">
                                            <?php the_excerpt_max_charlength(140); ?>
                                        </p>
                                        <a href="<?php echo esc_url($link); ?>" class="link link-icon">
                                            <span><?php pll_e('Read blog'); ?></span>
                                            <svg width="7" height="12" viewBox="0 0 7 12" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M0.37165 0.235013C0.684775 -0.0783368 1.18961 -0.0783368 1.50273 0.235012L6.81308 5.54916C7.06231 5.79856 7.06231 6.20144 6.81308 6.45084L1.50274 11.765C1.18961 12.0783 0.684776 12.0783 0.371651 11.765C0.0585251 11.4516 0.0585251 10.9464 0.371651 10.6331L4.99824 5.9968L0.36526 1.36051C0.0585257 1.05356 0.0585242 0.541967 0.37165 0.235013Z"
                                                    fill="#504EF3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; wp_reset_postdata(); endif; ?>
                </div>
                <div class="slider__controls">
                    <div class="slider__dots"></div>
                </div>
            </div>
            <div class="row justify-content-center d-none d-lg-flex mt-3">
                <div class="col-auto">
                    <a href="<?php echo $blog_link; ?>" class="btn btn-primary"><?php pll_e('Read blog'); ?></a>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>

<?php if( get_row_layout() == 'gutenberg_content_block' ): ?>
    <section class="page-section <?php if(!is_front_page()) : ?>  p-0 mb-80 <?php endif; ?> content">
        <div class="container-lg">
            <?php the_sub_field('gutenberg_content_block_field'); ?>
        </div>
    </section>
<?php endif;?>
<!-- проверил досюда   -->
<?php if( get_row_layout() == 'team_block' ): ?>
    <div class="container-lg">
        <?php if(get_sub_field('team_block_title')) : ?>
            <h2 class="section-h2 mb-3 mb-xl-4 pb-xl-3"><?php the_sub_field('team_block_title'); ?></h2>
        <?php endif; ?>
        <div class="row row-cols-1 row-cols-md-3 gy-3 g-md-2 g-lg-3 mb-4 mb-xxl-5 pb-3 pb-xxl-4">
            <?php if( have_rows('team_block_items') ): while ( have_rows('team_block_items') ) : the_row(); ?>
                <div class="col d-flex flex-column">
                    <div class="box box--md box--bordered text-center h-100">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <?php
                            $image = get_sub_field('team_block_item_photo');
                            $image_big = get_sub_field('team_block_item_photo_big');
                            if (!empty($image)): ?>
                                <div class="avatar avatar-xl mb-1">
                                    <img src="<?php echo esc_url($image['url']); ?>"
                                        <?php if(!empty($image_big)) : ?>
                                            srcset="<?php echo esc_url($image['url']); ?> 1x, <?php echo esc_url($image_big['url']); ?> 2x"
                                        <?php endif; ?>
                                         alt="<?php echo esc_attr($image['alt']); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="h3"><?php the_sub_field('team_block_item_name'); ?></div>
                            <p><?php the_sub_field('team_block_item_position'); ?></p>
                            <?php if( have_rows('team_block_item_social') ): while ( have_rows('team_block_item_social') ) : the_row(); ?>
                                <?php
                                $social_link = get_sub_field('team_block_item_social_link');
                                if( $social_link ):
                                    $social_link_url = $social_link['url'];
                                    $social_link_title = $social_link['title'];
                                    $social_link_target = $social_link['target'] ? $social_link['target'] : '_self';
                                    ?>
                                    <a class="d-flex align-items-center gap-1" href="<?php echo esc_url( $social_link_url ); ?>" target="<?php echo esc_attr( $social_link_target ); ?>">
                                        <?php
                                        $image = get_sub_field('team_block_item_social_icon');
                                        if (!empty($image)): ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="20" height="20">
                                        <?php endif; ?>
                                        <p><?php echo esc_html( $social_link_title ); ?></p>
                                    </a>
                                <?php endif; ?>
                            <?php endwhile; endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php if( get_row_layout() == 'awards_block' ): ?>
    <div class="container-lg">
        <?php if(get_sub_field('awards_block_title')) : ?>
            <h2 class="section-h2 mb-3 mb-xl-4 pb-xl-3 pt-xxl-2"><?php the_sub_field('awards_block_title'); ?></h2>
        <?php endif; ?>
        <div class="row row-cols-1 row-cols-md-3 gy-3 g-md-2 g-lg-3 mb-4 mb-xxl-5 pb-3 pb-xxl-5">
            <?php if( have_rows('awards_block_items') ): while ( have_rows('awards_block_items') ) : the_row(); ?>
                <div class="col d-flex flex-column">
                    <div class="award box box--md box--bordered text-center h-100">
                        <div class="d-flex flex-column align-items-center gap-2">
                            <?php
                            $image = get_sub_field('awards_block_item_icon');
                            $image_big = get_sub_field('awards_block_item_icon_big');
                            if (!empty($image)): ?>
                                <div class="mb-1">
                                    <img src="<?php echo esc_url($image['url']); ?>"
                                        <?php if(!empty($image_big)) : ?>
                                            srcset="<?php echo esc_url($image['url']); ?> 1x, <?php echo esc_url($image_big['url']); ?> 2x"
                                        <?php endif; ?>
                                         alt="<?php echo esc_attr($image['alt']); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="h3"><?php the_sub_field('awards_block_item_title'); ?></div>
                        </div>
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php if(get_row_layout() == 'contact_form') : ?>
    <div class="mb-80">
        <div class="form form-row">
            <?php the_sub_field('contact_form_name'); ?>
        </div>
    </div>
<?php endif; ?>
