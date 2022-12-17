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

				</div>

				<?php
				$current_taxonomy_term = get_queried_object_id();
				$terms = get_terms(array(
					'hide_empty'  => 0,
					'orderby'     => 'name',
					'order'       => 'ASC',
					'taxonomy'    => 'solution_type',
					'exclude'	=> $current_taxonomy_term
				));
				$terms = wp_list_filter($terms);
				?>
				<div class="d-none d-lg-block col-12 col-lg-3 ps-5">
                    <div class="subtitle-1"><?php pll_e('Other solutions'); ?></div>
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