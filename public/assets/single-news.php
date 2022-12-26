<?php get_header(); ?>

    <main>
		<section class="pt-3 pt-xl-3 mt-2 mt-lg-3 mb-80">
			<div class="container-lg">
				<div class="row mb-80">
					<div class="col-12 col-lg-8">
                        <?php
                            if ( function_exists('yoast_breadcrumb') ) {
                                yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
                            }
                        ?>
						<h1 class="h1 my-3"><?php the_title(); ?></h1>
						<div class="paragraph"><?php the_excerpt_max_charlength(140); ?></div>
						<div class="d-flex justify-content-between align-items-center my-3 my-xxl-4">
                            <div class="avatar">
                                <?php
                                    $author_id = get_post_field( 'post_author', $post->ID );
                                    $author_avatar = get_field('user_photo', 'user_'. $author_id );
                                ?>
                                <?php if( !empty( $author_avatar ) ): ?>
                                    <img src="<?php echo esc_url($author_avatar['url']); ?>" alt="<?php echo esc_attr($author_avatar['alt']); ?>">
                                <?php endif; ?>
                                <div><?php if(get_the_author_posts_link()):  echo esc_html(the_author_posts_link()); endif; ?></div>
							</div>
							<div class="card-date"><?php echo get_the_date("d.m.Y"); ?></div>
						</div>
						<article class="content">
							<?php the_content(); ?>
						</article>
					</div>
					<div class="d-none d-lg-block col-12 col-lg-4 ps-4">
                        <?php
                            $the_query = new WP_Query( array(
                                'post_type' => 'news',
                                'posts_per_page' => 2,
                                'post__not_in'   => array( get_the_ID() )
                            ));

                            $i = 0;
                        ?>
                        <?php if ( $the_query->have_posts() ) : ?>
                            <div class="subtitle-1 mb-3"><?php pll_e('Other news'); ?></div>
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                <div class="card card-bordered  <?php if($i == 0) : echo 'mb-4'; endif;?>">
                                    <?php the_post_thumbnail('full', array('class' => 'card-img')); ?>
                                    <div class="p-3 p-xxl-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2 pb-xxl-1">
                                            <div class="avatar">
                                                <?php
													$author_id = get_post_field( 'post_author', $post->ID );
													$author_avatar = get_field('user_photo', 'user_'. $author_id );
												?>
												<?php if( !empty( $author_avatar ) ): ?>
													<img src="<?php echo esc_url($author_avatar['url']); ?>" alt="<?php echo esc_attr($author_avatar['alt']); ?>">
												<?php endif; ?>
												<div><?php if(get_the_author_posts_link()):  echo esc_html(the_author_posts_link()); endif; ?></div>
                                            </div>
                                            <div class="card-date"><?php echo get_the_date("d.m.Y"); ?></div>
                                        </div>
                                        <h5 class="subtitle-2 mb-2 pb-xxl-1"><?php echo mb_strimwidth(get_the_title(), 0, 80, '...'); ?></h5>
                                        <p class="paragraph mb-2 pb-xxl-1"><?php the_excerpt_max_charlength(150); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="link link-icon">
                                            <span><?php pll_e('Read more'); ?></span>
                                            <svg width="7" height="12" viewBox="0 0 7 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M0.37165 0.235013C0.684775 -0.0783368 1.18961 -0.0783368 1.50273 0.235012L6.81308 5.54916C7.06231 5.79856 7.06231 6.20144 6.81308 6.45084L1.50274 11.765C1.18961 12.0783 0.684776 12.0783 0.371651 11.765C0.0585251 11.4516 0.0585251 10.9464 0.371651 10.6331L4.99824 5.9968L0.36526 1.36051C0.0585257 1.05356 0.0585242 0.541967 0.37165 0.235013Z"
                                                    fill="#504EF3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            <?php $i++; endwhile; ?>
                        <?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>
