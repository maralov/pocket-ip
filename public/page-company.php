<?php
/*
Template Name: Company
*/
?>

<?php get_header(); ?>

	<main>
		<section class="container-lg pt-3 pt-xxl-4 mt-2 mt-xxl-3 mb-0 mb-xxl-4 pb-0 pb-xxl-3">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-10 col-xxl-8">
					<div class="row">
						<div class="col-auto mb-2 pb-1">
							<?php
								if ( function_exists('yoast_breadcrumb') ) {
									yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
								} 
							?>
						</div>
						<div class="col-12 mb-3">
							<h1 class="h1"><?php the_title(); ?></h1>
						</div>
						<article class="col-12 content">
							<?php the_content(); ?>
						</article>
					</div>
				</div>
			</div>
		</section>
		<?php get_template_part( 'template-parts/flexible-content' ); ?>
	</main>

<?php get_footer(); ?>