<?php get_header(); ?>

    <main>
        <div class="container-lg pt-3 pt-xl-4 mt-2 mt-lg-3 mb-3 mb-lg-5 pb-3 pb-lg-5">
            <div class="mb-3">
            <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
                }
            ?>
            </div>
           <div class="content">
                <?php the_content(); ?>
           </div
        </div>
    </main>

<?php get_footer(); ?>
