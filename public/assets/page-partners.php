<?php
/*
Template Name: Partners
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
					<div class="content">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
			<div class="mt-4 pt-3 row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-6 g-4 g-md-3">
				<?php
					$args = array(
						'posts_per_page' => -1,
						'post_type' => 'partners',
						'orderby' => 'date',
						'order' => 'DESC',
					);

					$loop = new WP_Query( $args );

					if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<div class="col">
							<div class="box box--sm px-4 box--radius-md box--bordered d-flex flex-column align-items-center">
								<?php the_post_thumbnail('full'); ?>
								<div class="paragraph mt-1 mt-xl-2 mb-2"><?php the_title(); ?></div>
								<div class="country-tag country-tag--sm">
									<?php
										$cur_terms = get_the_terms( $loop->ID, 'partners_country' );
										if( is_array( $cur_terms ) ) :
											foreach( $cur_terms as $cur_term ) : ?>
												<?php
													$image = get_field('category_icon', $cur_term->taxonomy . '_' . $cur_term->term_id );
													if( !empty( $image ) ): ?>
														<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
												<?php endif; ?>
												<span><?php echo $cur_term->name; ?></span>
									<?php endforeach;
										endif;
									?>
								</div>
							</div>
						</div>
				<?php endwhile; endif; ?>
			</div>
		</div>
	</main>

<?php get_footer(); ?>