<?php get_header(); ?>

<main>
	<section class="container-lg pt-3 pt-xl-3 mt-2 mt-lg-3 mb-80">
		<div class="container-lg">
			<div class="row mb-80">
				<div class="col-12 col-lg-9 pe-lg-4">
					<?php
					if (function_exists('yoast_breadcrumb')) {
						yoast_breadcrumb('<div class="breadcrumbs" id="breadcrumbs">', '</div>');
					}
					?>
					<!-- /.breadcrumps -->
					<h1 class="h1 my-3"><?php echo single_term_title();  ?></h1>

					<?php get_template_part('template-parts/flex-content-article'); ?>

					<?php   
						$cir_cat   = $wp_query->get_queried_object();
						$cat_slug  = $cir_cat->slug;

						$terms_county = get_terms(array(
							'hide_empty'  => 1,
							'orderby'     => 'name',
							'order'       => 'ASC',
							'taxonomy'    => 'service_country',
						));
						?>
						<?php if($cir_cat->count != 0) : ?>
							<section>
								<h3 class="h3 mb-3"><?php pll_e('The service is available for countries:'); ?></h3>
								<div class="d-flex flex-wrap gap-1 gap-xl-2 js-country-tags">
								<?php 
								foreach ($terms_county as $term_county) :
									$term_county_id = $term_county->term_id;
									$term_county_tax = $term_county->taxonomy;
									$term_county_name = $term_county->name;
									
									$args = array(
										'post_type' => 'services',
										'posts_per_page' => -1,
										'order' => 'DESC',
										'tax_query' => [
											'relation' => 'AND',
											[
												'taxonomy' => 'service_type',
												'field' => 'slug',
												'terms' => $cat_slug
											],
											[
												'taxonomy' => 'service_country',
												'field'    => 'id',
												'terms'    => $term_county_id,
											]
										],
									
									);
									$circular_query = new WP_Query( $args ); ?>
										<?php if ( $circular_query->have_posts() ) : while ( $circular_query->have_posts() ) : $circular_query->the_post(); ?>
											<a href="<?php the_permalink(); ?>" class="country-tag country-tag--lg">
												<?php
													$image = get_field('category_icon', $term_county_tax . '_' . $term_county_id );
													if( !empty( $image ) ): ?>
														<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="24" height="24" />
												<?php endif; ?>
												<span><?php echo $term_county_name; ?></span>
											</a>
										<?php endwhile; endif; ?>
								<?php endforeach; ?>
							</section>
						<?php endif; ?>
				</div>

				<?php
				$current_taxonomy_term = get_queried_object_id();
				$terms = get_terms(array(
					'hide_empty'  => 0,
					'orderby'     => 'name',
					'order'       => 'ASC',
					'taxonomy'    => 'service_type',
					'exclude'	=> $current_taxonomy_term
				));
				$terms = wp_list_filter($terms);
				?>
				<div class="d-none d-lg-block col-12 col-lg-3 ps-5">
                    <div class="subtitle-1"><?php pll_e('Other services'); ?></div>
                    <ul class="list list-divider">
						<?php foreach ($terms as $term) : ?>
						<li><a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo $term->name; ?></a></li>
						<?php endforeach; ?>
                    </ul>
                </div>				
			</div>



			<div class="mb-80">
				<?php get_template_part('template-parts/flexible-content'); ?>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>