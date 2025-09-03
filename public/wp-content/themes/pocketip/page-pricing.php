<?php
/*
Template Name: Pricing
*/
?>

<?php get_header(); ?>

    <main>
        <div class="container-lg pt-3 pt-xl-4 mt-2 mt-lg-3 d-none d-md-block">
            <div class="row align-items-center">
                <div class="col-sm-7 col-lg-6 mb-5 mb-md-0">
                    <?php
                        if ( function_exists('yoast_breadcrumb') ) {
                            yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
                        }
                    ?>
                    <!-- /.breadcrumps -->
                    <div class="mt-2 mb-3">
                        <h1 class="h1"><?php the_title(); ?></h1>
                    </div>

                    <?php if(get_field('pricing_desc')) : ?>
                        <div class="content"><?php the_field('pricing_desc'); ?></div>
                    <?php endif; ?>
                </div>

                <?php
                    $image = get_field('pricing_img');
                    if( !empty( $image ) ): ?>
                    <div class="col-sm-5 col-lg-6">
                        <img src="<?php echo esc_url($image['url']); ?>" width="672" height="493" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <section class="page-section">
            <div class="container-lg">
                <h2 class="h2 mb-4"><?php the_field('advantage_block_title'); ?></h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4">
                    <?php if( have_rows('advantage_block_item') ): while ( have_rows('advantage_block_item') ): the_row(); ?>
                        <div class="col d-flex flex-column mb-4 mb-xl-0 justify-content-between">
                            <div class="d-flex mb-2">
                                <?php $item_icon = get_sub_field('advantage_block_item_icon');
                                    if(!empty($item_icon)): ?>
                                    <div class="me-3">
                                        <img src="<?php echo esc_url($item_icon['url']); ?>" width="40" alt="<?php echo esc_url($item_icon['alt']); ?>">
                                    </div>
                                <?php endif;?>
                                <?php if(get_sub_field('advantage_block_item_title')) : ?>
                                    <div class="h4"><?php the_sub_field('advantage_block_item_title'); ?></div>
                                <?php endif; ?>
                            </div>
                            <?php if(get_sub_field('advantage_block_item_text')) : ?>
                                <p class="m-0"><?php the_sub_field('advantage_block_item_text'); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </section>

        <?php get_template_part( 'template-parts/blocks/calculator' ); ?>

        <?php if( have_rows('roadmap_content') ): ?>
            <section class="page-section pb-0">
                <div class="roadmap">
                    <div class="container">
                        <div class="row justify-content-center">
                            <?php if(get_field('roadmap_title')): ?>
                                <div class="col col-xxl-6">
                                    <h2 class="h2 section-h2 mb-3 mb-xl-4 pb-xl-3"><?php the_field('roadmap_title'); ?></h2>
                                </div>
                            <?php endif;?>
                        </div>
                        <div class="roadmap__wrapper">
                            <?php while ( have_rows('roadmap_content') ): the_row(); ?>
                                <div class="roadmap__card">
                                    <?php if(get_sub_field('roadmap_content_title')): ?>
                                        <div class="roadmap__title d-none d-md-block"><?php the_sub_field('roadmap_content_title'); ?></div>
                                    <?php endif;?>
                                    <div class="roadmap__item">
                                        <div class="roadmap__step">
                                            <?php if(get_sub_field('roadmap_content_title')): ?>
                                                <div class="roadmap__title d-block d-md-none"><?php the_sub_field('roadmap_content_title'); ?></div>
                                            <?php endif;?>
                                            <?php if(get_sub_field('roadmap_content_subtitle')): ?>
                                                <div class="roadmap__step-title"><?php the_sub_field('roadmap_content_subtitle'); ?></div>
                                            <?php endif;?>
                                            <?php if(get_sub_field('roadmap_content_description')): ?>
                                                <div class="roadmap__step-text">
                                                    <?php the_sub_field('roadmap_content_description'); ?>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>

                <?php if(get_field('cf_true')) : ?>
                    <div class="bg-primary">
                        <div class="container-lg pb-5">
                            <div class="form form-row m-0">
                                <?php echo do_shortcode('[contact-form-7 id="d99027b" title="Contact form price page"]'); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </main>

<?php get_footer(); ?>
