<?php get_header(); ?>

    <main>
		<div class="container-lg pt-3 pt-xl-4 mt-2 mt-lg-3 mb-3 mb-lg-5 pb-3 pb-lg-5">
			<div class="row  justify-content-lg-center mb-4 pb-xxl-3">
				<div class="col-auto mb-2 p-1">
					<?php
						if ( function_exists('yoast_breadcrumb') ) {
							yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
						}
					?>
				</div>
				<?php if(get_field('news_title', 'option')) : ?>
					<div class="col-12 ">
						<h1 class="h1 text-md-center"><?php the_field('news_title', 'option'); ?></h1>
					</div>
				<?php endif; ?>
			</div>
			<div class="row gy-4">
				<?php
                    $args = array(
                        'posts_per_page' => 12,
                        'post_type' => 'news',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'paged' => get_query_var('paged') ?? 1
                    );

                    $loop = new WP_Query( $args );

                    if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<div class="col-12 col-md-6 col-lg-4">
							<div class="px-xl-1 h-100">
								<div class="card card-bordered h-100  d-flex flex-column">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('full', array('class' => 'card-img')); ?>
									</a>
									<div class="p-3 p-xxl-4 d-flex flex-column flex-grow-1">
										<div class="d-flex justify-content-end align-items-center mb-2 pb-xxl-1">
											<div class="card-date"><?php echo get_the_date("d.m.Y"); ?></div>
										</div>
										<h5 class="subtitle-2 mb-2 pb-xxl-1"><?php echo mb_strimwidth(get_the_title(), 0, 80, '...'); ?></h5>
										<p class="paragraph mb-2 pb-xxl-1"><?php the_excerpt_max_charlength(150); ?></p>
										<a href="<?php the_permalink(); ?>" class="link link-icon mt-auto">
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
							</div>
						</div>
				<?php endwhile; ?>
			</div>
			<div class="row justify-content-center  mt-4 pt-xxl-3">
				<div class="col-auto">
					<nav class="pagination" role="navigation">
						<?php
							echo paginate_links(
								$args = array(
									'show_all'     => false,
									'mid_size'     => 3,
									'prev_next'    => true,
									'prev_text'    => __('<-'),
									'next_text'    => __('->'),
									'total' => $loop->max_num_pages,
								)
							);
						endif; ?>
					</nav>
				</div>

			</div>
		</div>
	</main>

<?php get_footer(); ?>
