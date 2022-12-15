<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>

    <main>
		<section class="pt-3 pt-xl-3 mt-2 mt-lg-3 mb-80">
			<div class="container-lg">
				<div class="row">
					<div class="col-12 col-lg-8 mb-4 mb-lg-0">
                        <?php
                            if ( function_exists('yoast_breadcrumb') ) {
                                yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
                            } 
                        ?>
						
						<h1 class="h1 my-3"><?php the_title(); ?></h1>
						<div class="row row-cols-1 row-cols-sm-2 mb-4 mb-xxl-5 gy-3 gy-sm-0">
							<div class="col">
							
								<div class="d-flex flex-column gap-2">
								
								<?php 
									$icon_phone = get_field('icon_phone');									
									$link_phone = get_field('link_phone');

									if( $link_phone ): 
										$link_phone_url = str_replace(' ', '', $link_phone['url']);
										$link_phone_title = $link_phone['title'];
										$link_phone_target = $link_phone['target'] ? $link_phone['target'] : '_self';
									?>
								
									<a href="tel:<?php echo $link_phone_url; ?>" class="d-flex align-items-center gap-1
										target="<?php echo esc_attr( $link_phone_target ); ?>">
										<img src="<?php echo esc_url($icon_phone['url']); ?>" width="24" height=24 alt="<?php echo esc_url($icon_phone['alt']); ?>">
										<span class="ps-1"><?php echo esc_html( $link_phone_title ); ?></span>
									</a>
									<?php endif; ?>


								<?php 
									$icon_mail = get_field('icon_mail');									
									$link_mail = get_field('link_mail');

									if( $link_mail ): 
										$link_mail_url = str_replace(' ', '', $link_mail['url']);
										$link_mail_title = $link_mail['title'];
										$link_mail_target = $link_mail['target'] ? $link_mail['target'] : '_self';
									?>
								
									<a href="mailto:<?php echo $link_mail_url; ?>" class="d-flex align-items-center gap-1
										target="<?php echo esc_attr( $link_mail_target ); ?>">
										<img src="<?php echo esc_url($icon_mail['url']); ?>" width="24" height=24 alt="<?php echo esc_url($icon_mail['alt']); ?>">
										<span class="ps-1"><?php echo esc_html( $link_mail_title ); ?></span>
									</a>
									<?php endif; ?>		
								</div>
							
							</div>

							
							<div class="col">
							<?php if( have_rows('main_social', 'option') ): ?>	
								<div class="d-flex flex-column gap-2">
								<?php while ( have_rows('main_social','option') ) : the_row(); ?>
								<?php 
									$social_icon = get_sub_field('main_social_icon', 'option');
									
									$social_link = get_sub_field('main_social_link', 'option');
									if( $social_link && $social_link["title"]=="Facebook" || $social_link["title"]=="Twitter"): 
										$social_link_url = $social_link['url'];
										$social_link_title = $social_link['title'];
										$social_link_target = $social_link['target'] ? $social_link['target'] : '_self';
									?>
									<a href="<?php echo esc_url($social_link_url); ?>" class="d-flex align-items-center gap-1"
										target="<?php echo esc_attr( $social_link_target ); ?>" >
										<?php if(!empty( $social_icon ) && $social_icon["ID"]==345 || $social_icon["ID"]==346): ?>
											<img src="<?php echo esc_url($social_icon['url']); ?>" width="24" height=24 alt="<?php echo esc_attr($social_icon['alt']); ?>">
										<?php endif; ?>										
										<span class="ps-1"><?php echo esc_html( $social_link_title ); ?></span>
									</a>			
									<?php endif; ?>
								<?php endwhile; ?>
								</div>
							<?php endif; ?>
							</div>
							
						</div>
						<div class="row row-cols-1 row-cols-xxl-2 gy-4 gy-lg-5">
						<?php if( have_rows('maps_box') ): ?>								
							<?php while ( have_rows('maps_box') ) : the_row(); ?>
							<div class="col d-flex flex-column">

								<?php if(get_sub_field('maps_box_title')): ?>
								<div class="subtitle-2">
									<?php the_sub_field('maps_box_title'); ?>
								</div>
								<?php endif; ?>

								<?php if(get_sub_field('maps_box_subtitle')): ?>
								<p class="my-2 py-1"><?php the_sub_field('maps_box_subtitle'); ?></p>
								<?php endif; ?>

								<?php if(get_sub_field('maps_box_map_iframe')): ?> 
								<div class="mt-auto">										
									<?php the_sub_field('maps_box_map_iframe'); ?>									
								</div>
								<?php endif; ?>
							</div>
							<?php endwhile; ?>							
						<?php endif; ?>
						<!--
							<div class="col d-flex flex-column">
								<div class="subtitle-2">
									Legal address
								</div>
								<p class="my-2 py-1">Harju maakond, Tallinn, Kesklinna linnaosa, Veskiposti 2-1002,
									10138</p>
								<div class="mt-auto">
									<iframe
										src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2540.4269871127344!2d30.52372311598412!3d50.45177307947542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4ce51cc422171%3A0x3a071b3501419f36!2sKhreschatyk%20St%2C%2010%2C%20Kyiv%2C%2002000!5e0!3m2!1sen!2sua!4v1669931290711!5m2!1sen!2sua"
										allowfullscreen="" loading="lazy" width="100%" height="280"
										style="border:0; border-radius:12px;"></iframe>
								</div>
							</div>
							<div class="col d-flex flex-column">
								<div class="subtitle-2">
									R&D Office
								</div>
								<p class="my-2 py-1">10, Khreshchatyk Str., Kyiv, Ukraine</p>
								<div class="mt-auto">
									<iframe
										src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2029.8299256592513!2d24.7519829364964!3d59.41923192312714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x469294bb1cabe175%3A0x5473071d039bfd0!2sVeskiposti%202%2C%20Kesklinna%20linnaosa%2C%20Kesklinna%2C%2010138%20Harju%20maakond%2C%20Estonia!5e0!3m2!1sen!2sua!4v1669931752939!5m2!1sen!2sua"
										allowfullscreen="" loading="lazy" width="100%" height="280"
										style="border:0; border-radius:12px"></iframe>
								</div>
							</div>
						-->
						</div>
					</div>
					<div class="col-12 col-lg-4 ps-lg-4">
						<div class="subtitle-1 mb-3">Contact with us</div> <!-- нужно ли динамически? -->
						<div class="form form-column">	
							<?php echo do_shortcode( '[contact-form-7 id="370" title="Form-page-contacts"]' );  ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>