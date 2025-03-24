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
                            $faqs = get_field('faq_display');
                            if( $faqs ):  $num = 0; ?>
                                <?php foreach( $faqs as $post ):
                                    $title = get_the_title( $post->ID );
                                    $content = $post->post_content;
                                ?>
                                <?php setup_postdata($post); ?>
                                    <div class="accordion-item">
                                        <button class="btn accordion-button <?php if($num!=0):?>collapsed<?php endif;?>" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse-<?=$num?>" aria-expanded="true" aria-controls="collapse-<?=$num?>">
                                            <?php echo $title; ?>
                                        </button>
                                        <div id="collapse-<?=$num?>" class="accordion-collapse collapse <?php if($num == 0): echo 'show'; endif;?>" aria-labelledby="headingOne"
                                             data-bs-parent="#faq-according">
                                            <div class="accordion-body paragraph">
                                                <?php echo $content; ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php $num++; endforeach; wp_reset_postdata(); endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </main>

<?php get_footer(); ?>
