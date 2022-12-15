<?php get_header(); ?>

    <main>
		<div class="container-lg my-5 my-lg-4  py-5 py-lg-3">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-10 col-xxl-8 text-center">
					<h1 class="h1-xl mb-3">404</h1>
					<div class="h3  mb-4 pb-3">Page not found</div>
					<a href="/" class="btn btn-primary mb-5 mb-xl-0">Go to home page</a>
					<img src="<?php echo POCKET_IMG_DIR; ?>/404.png" srcset="<?php echo POCKET_IMG_DIR; ?>/404.png 1x, <?php echo POCKET_IMG_DIR; ?>/404@2x.png 2x" alt="age not found">
				</div>
			</div>
		</div>
	</main>

<?php get_footer(); ?>