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
						<div class="mb-80">
							<?php get_template_part('template-parts/flex-content-article'); ?>
						</div>
					</div>

					<?php   
						$cir_cat   = $wp_query->get_queried_object();
						$cat_slug  = $cir_cat->slug;

						$terms_county = get_terms(array(
							'hide_empty'  => 1,
							'orderby'     => 'name',
							'order'       => 'ASC',
							'taxonomy'    => 'solution_country',
						));
						?>
						<?php if($cir_cat->count != 0) : ?>
							<div class="col-12 col-lg-4">
								<div class="subtitle-1 mb-2"><?php pll_e('Other countries'); ?></div>
								<div class="d-flex flex-wrap gap-1">
									<?php 
									foreach ($terms_county as $term_county) :
										$term_county_id = $term_county->term_id;
										$term_county_tax = $term_county->taxonomy;
										$term_county_name = $term_county->name;
										
										$args = array(
											'post_type' => 'solutions',
											'posts_per_page' => -1,
											'order' => 'DESC',
											'tax_query' => [
												'relation' => 'AND',
												[
													'taxonomy' => 'solution_type',
													'field' => 'slug',
													'terms' => $cat_slug
												],
												[
													'taxonomy' => 'solution_country',
													'field'    => 'id',
													'terms'    => $term_county_id,
												]
											],
										
										);
										$circular_query = new WP_Query( $args ); ?>
											<?php if ( $circular_query->have_posts() ) : while ( $circular_query->have_posts() ) : $circular_query->the_post(); ?>
												<a href="<?php the_permalink(); ?>" class="country-tag country-tag--sm">
													<?php
														$image = get_field('category_icon', $term_county_tax . '_' . $term_county_id );
														if( !empty( $image ) ): ?>
															<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="24" height="24" />
													<?php endif; ?>
													<span><?php echo $term_county_name; ?></span>
												</a>
											<?php endwhile; endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
				</div>
				<div class="mb-80">
					<?php get_template_part('template-parts/flexible-content'); ?>
				</div>
				<div class="mb-80">
					<div class="form form-row">
						<form>
							<div class="form-title">Contact with us</div>
							<input type="text" placeholder="Name" />
							<input type="text" placeholder="Email" />
							<textarea placeholder="Message"></textarea>
							<input type="submit" value="Send">
						</form>
					</div>
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>