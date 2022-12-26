<?php
/*
Template Name: FAQ
*/
?>

<?php get_header(); ?>

    <main>
        <div class="container-lg pt-3 pt-xl-4 mt-2 mt-lg-3 mb-3 mb-lg-5 pb-3 pb-lg-5">
            <div class="row  justify-content-lg-center mb-4 pb-xxl-3">
                <div class="col-auto mb-2 pb-1">
                    <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
                    }
                    ?>
                </div>
                <div class="col-12 ">
                    <h1 class="h1 text-md-center"><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xxl-8">
                    <div class="accordion" id="faq-according">
                        <?php
                        $args = array(
                            'posts_per_page' => -1,
                            'post_type' => 'faq',
                            'orderby' => 'date',
                            'order' => 'DESC',
                        );

                        $loop = new WP_Query( $args );
                        $num = 0;

                        if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <div class="accordion-item">
                                <button class="btn accordion-button <?php if($num!=0):?>collapsed<?php endif;?>" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-<?=$num?>" aria-expanded="true" aria-controls="collapse-<?=$num?>">
                                    <?php the_title(); ?>
                                </button>
                                <div id="collapse-<?=$num?>" class="accordion-collapse collapse <?php if($num == 0): echo 'show'; endif;?>" aria-labelledby="headingOne"
                                     data-bs-parent="#faq-according">
                                    <div class="accordion-body paragraph">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php $num++; endwhile; endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </main>

<?php get_footer(); ?>
