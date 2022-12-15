<?php get_header(); ?>

    <main>
		<section class="pt-3 pt-xl-3 mt-2 mt-lg-3 mb-80">
			<div class="container-lg">
				<div class="row">
					<div class="col-12 col-lg-4 ">
                        <?php
                            if ( function_exists('yoast_breadcrumb') ) {
                                yoast_breadcrumb( '<div class="breadcrumps d-block d-lg-none mb-2 mb-lg-0" id="breadcrumbs">','</div>' );
                            } 
                        ?>
						<div class="avatar avatar-xl">
                            <?php
                                $author_id = get_post_field( 'post_author', $post->ID );									
                                $author_avatar = get_field('user_photo', 'user_'. $author_id );
                            ?>
                            <img src="<?php echo esc_url($author_avatar['url']); ?>" alt="<?php echo esc_attr($author_avatar['alt']); ?>">
						</div>
                        <?php
                            $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
                        ?>
						<div class="h2 my-2 text-bolder"><?php echo $curauth->display_name; ?></div>
						<div class="paragraph"><?php echo $curauth->description; ?></div>
						<div class="d-flex align-items-center gap-2 mt-2 pt-1">
                            
                        <?php if(have_rows('social_media', 'user_'. $author_id) ): while( have_rows('social_media', 'user_'. $author_id) ) : the_row(); ?>
                            <?php 
                                $soc_link = get_sub_field('social_media_link', 'user_'. $author_id);
                                if( $soc_link ): 
                                    $soc_link_url = $soc_link['url'];
                                    $soc_link_title = $soc_link['title'];
                                    $soc_link_target = $soc_link['target'] ? $soc_link['target'] : '_self';
                                    ?>
							        <a href="<?php echo esc_url( $soc_link_url ); ?>" class="d-flex align-items-center gap-1" target="<?php echo esc_attr( $soc_link_target ); ?>">
                                        <?php 
                                        $image = get_sub_field('social_media_icon', 'user_'. $author_id);
                                        if( !empty( $image ) ): ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <?php endif; ?>
                                        <span class="ps-1"><?php echo esc_html( $soc_link_title ); ?></span>
                            <?php endif; ?>
							        </a>
                        <?php endwhile; endif; ?>
						</div>


					</div>
					<div class="col-12 col-lg-8">
                        <?php
                            if ( function_exists('yoast_breadcrumb') ) {
                                yoast_breadcrumb( '<div class="breadcrumps d-none d-lg-block mb-2 mb-lg-0" id="breadcrumbs">','</div>' );
                            } 
                        ?>
						<h1 class="h2 my-3"><?php pll_e('Last publications'); ?></h1>
						<div class="row row-cols-1 row-cols-md-2 gy-4">
							<!-- ON mobile display only 2 cols -->
                            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $i = 0; ?>
                                <div class="col <?php if($i == 2) : echo 'd-none d-md-block'; endif; ?>">
                                    <div class="card card-bordered">
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
                                                    <div><span><?php echo $curauth->display_name; ?></span></div>
                                                </div>
                                                <div class="card-date"><?php echo get_the_date("d.m.Y, H:i"); ?></div>
                                            </div>
                                            <h5 class="h3 mb-2 pb-xxl-1"><?php the_title(); ?></h5>
                                            <p class="paragraph mb-2 pb-xxl-1"><?php the_excerpt_max_charlength(140); ?></p>
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
                                </div>
                            <?php $i++; endwhile; endif; ?>
							<!-- ON mobile display only 2 cols -->
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>