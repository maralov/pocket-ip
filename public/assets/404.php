<?php get_header(); ?>

    <main>
		<div class="container-lg my-5 my-lg-4  py-5 py-lg-3">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-10 col-xxl-8 text-center">
                    <?php if(get_field('404_title', 'option')) : ?>
					    <h1 class="h1-xl mb-3"><?php the_field('404_title', 'option'); ?></h1>
                    <?php endif; ?>
                    <?php if(get_field('404_subtitle', 'option')) : ?>
					    <div class="h3  mb-4 pb-3"><?php the_field('404_subtitle', 'option'); ?></div>
                    <?php endif; ?>
                    <?php
                        $back_link = get_field('404_btn', 'option');
                        if( $back_link ):
                            $back_link_url = $back_link['url'];
                            $back_link_title = $back_link['title'];
                            $back_link_target = $back_link['target'] ? $back_link['target'] : '_self';
                            ?>
                        <a class="btn btn-primary mb-5 mb-xl-0" href="<?php echo esc_url( $back_link_url ); ?>" target="<?php echo esc_attr( $back_link_target ); ?>"><?php echo esc_html( $back_link_title ); ?></a>
                    <?php endif; ?>
					<img src="<?php echo POCKET_IMG_DIR; ?>/404.png" srcset="<?php echo POCKET_IMG_DIR; ?>/404.png 1x, <?php echo POCKET_IMG_DIR; ?>/404@2x.png 2x" alt="age not found">
				</div>
			</div>
		</div>
	</main>

<?php get_footer(); ?>