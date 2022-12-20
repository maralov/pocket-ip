<!DOCTYPE html>
<html lang="<?php bloginfo("language"); ?>">

<head>
    <base href="<?php echo get_home_url(); ?>"/>
	<meta charset="<?php bloginfo("charset"); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php wp_title(); ?></title>
	<meta name="theme-color" content="#fff">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" href="<?php echo esc_url(get_template_directory_uri()); ?>/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri()); ?>/favicon.ico"
          type="image/x-icon"/>
    <?php wp_head(); ?>
</head>

<body>
	<div class="info-panel js-info-panel">
		<div class="container-fluid">
			<div class="info-panel__container">
				<?php if(get_field('info_panel_txt', 'option')) : ?>
					<p class="info-panel__text"><?php the_field('info_panel_txt', 'option'); ?>
						<span class="d-none d-lg-inline-block pe-1"> - </span>
					</p>
				<?php endif; ?>
				<?php 
					$info_link = get_field('info_panel_btn', 'option');
					if( $info_link ): 
						$info_link_url = $info_link['url'];
						$info_link_title = $info_link['title'];
						$info_link_target = $info_link['target'] ? $info_link['target'] : '_self';
						?>
						<a class="info-panel__link" href="<?php echo esc_url( $info_link_url ); ?>" target="<?php echo esc_attr( $info_link_target ); ?>"><?php echo esc_html( $info_link_title ); ?></a>
				<?php endif; ?>
				<button type="button" aria-label="close"
					class="btn-close btn-close-white info-panel__close-btn js-info-panel-close">
					<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M9.66671 1.2735L8.72671 0.333496L5.00004 4.06016L1.27337 0.333496L0.333374 1.2735L4.06004 5.00016L0.333374 8.72683L1.27337 9.66683L5.00004 5.94016L8.72671 9.66683L9.66671 8.72683L5.94004 5.00016L9.66671 1.2735Z" />
					</svg>
				</button>
			</div>
		</div>
	</div>
	<header class="header js-header">
		<div class="container-xxl">
			<div class="header__container">
				<?php
					$image = get_field('main_logo', 'option');
					if (!empty($image)): ?>
					<div class="main-logo">
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
						</a>
					</div>
				<?php endif; ?>

				<nav class="header__nav js-header-nav">
					<button type="button" class="btn btn-nav-search header__nav-search ">Search</button>
					<ul>
					<?php
						$menu_name = 'Header menu ' . pll_current_language( 'name' );
                    	$menus = wp_get_menu_array($menu_name);					
							
						
						if ($menus) : 
							foreach ($menus as $menu) : ?>
								<?php if ($menu['children']): ?>								
									<li class="menu-item-has-children">
										<a><?php echo $menu['title']; ?></a>
										<ul class="sub-menu">

											<?php foreach ($menu['children'] as $children):
												$icon = get_field('category_icon', $children["term"] . '_' . $children["term_id"]);
	                                            $iconMenu = get_field('menu_icon', $children['ID']);
											?>
															
											<li>
												<a href="<?php echo $children['url']; ?>">
												<?php if($children["type"] == "taxonomy") : ?>
													<?php if( !empty( $icon ) ): ?>
														<img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
													<?php endif; ?>													
												<?php elseif($children["type"] == "custom" || $children["type"] == "post_type" ) : ?>
													<?php if(!empty(get_the_post_thumbnail( $children["term_id"] ))) : ?>
														<?php echo get_the_post_thumbnail($children["term_id"], 'full' ); ?>
													<?php endif; ?>
                                                <?php elseif($children["type"] == "post_type_archive") : ?>
                                                    <?php if( !empty( $iconMenu ) ): ?>
                                                        <img src="<?php echo esc_url($iconMenu['url']); ?>" alt="<?php echo esc_attr($iconMenu['alt']); ?>" />
                                                    <?php endif; ?>
												<?php endif; ?>
													<span><?php echo $children['title']; ?></span>
													<p><?php echo $children['description']; ?></p>
												</a>
											</li>
										<?php endforeach; ?>										
										</ul>
									</li>
								<?php else: ?>
									<li>
										<a href="<?php echo $menu['url']; ?>"><?php echo $menu['title']; ?></a>
									</li>
						<?php endif; endforeach; endif; ?>												
					</ul>
					<div class="d-flex justify-content-center d-lg-none mt-auto">
						<div class="px-2">
							<a href="https://my.pocketip.com/" target="_blank" class="btn btn-primary">Book a demo</a>
						</div>
						<div class="px-2">
							<a href="https://my.pocketip.com/" target="_blank" class="btn btn-primary-outline">Try for free</a>
						</div>
					</div>
				</nav>
				<div class="d-flex">
					<div class="d-none d-lg-flex me-2 me-xl-4 order-lg-first">
						<?php 
							$book_link = get_field('main_btn_book', 'option');
							if( $book_link ): 
								$book_link_url = $book_link['url'];
								$book_link_title = $book_link['title'];
								$book_link_target = $book_link['target'] ? $book_link['target'] : '_self';
								?>
								<div class="px-2">
									<a class="btn btn-primary" href="<?php echo esc_url( $book_link_url ); ?>" target="<?php echo esc_attr( $book_link_target ); ?>"><?php echo esc_html( $book_link_title ); ?></a>
								</div>
						<?php endif; ?>
						<?php 
							$try_link = get_field('main_btn_try', 'option');
							if( $try_link ): 
								$try_link_url = $try_link['url'];
								$try_link_title = $try_link['title'];
								$try_link_target = $try_link['target'] ? $try_link['target'] : '_self';
								?>
								<div class="px-2">
									<a class="btn btn-primary-outline" href="<?php echo esc_url( $try_link_url ); ?>" target="<?php echo esc_attr( $try_link_target ); ?>"><?php echo esc_html( $try_link_title ); ?></a>
								</div>
						<?php endif; ?>
					</div>
					<!-- polylang need to dev more-->
					<div class="lang-switcher d-flex align-items-center me-3 me-xl-4">
						<img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-lang.svg" alt="lang-switcher">
						<div class="ms-2 ps-1">
							<div class="lang-switcher-current">
								<?php echo pll_current_language(); ?>
							</div>
							<ul class="lang-switcher-list"></ul>
							<?php pll_the_languages( array( 'show_flags' => 0, 'show_names' => 0, 'hide_current' => false,'dropdown' => 1,'display_names_as'=>'slug' ) ); ?>
						</div>
					</div>
					<?php echo do_shortcode('[searchwp_modal_search_form engine="my_searchwp_engine" template="My Custom Template" text="Search" type="button" class="btn btn-nav-search d-none d-lg-inline-flex"]'); ?>
					<!-- <button type="button" class="btn btn-nav-search d-none d-lg-inline-flex">Search</button> -->
					<?php 
						$login_link = get_field('main_btn_login', 'option');
						if( $login_link ): 
							$login_link_url = $login_link['url'];
							$login_link_title = $login_link['title'];
							$login_link_target = $login_link['target'] ? $login_link['target'] : '_self';
							?>
							<a href="<?php echo esc_url( $login_link_url ); ?>"
								class="login-link d-flex align-items-center order-lg-first me-3 me-xl-4" target="<?php echo esc_attr( $login_link_target ); ?>">
								<img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-account.svg" alt="login account">
								<span class="d-none d-lg-inline-block ms-2 ps-1"><?php echo esc_html( $login_link_title ); ?></span>
							</a>
					<?php endif; ?>

					<button type="button" class="btn btn-menu header__btn-menu js-menu-btn">
						<img src="<?php echo POCKET_IMG_DIR; ?>/icons/ic-menu.svg" alt="menu">
					</button>
				</div>
			</div>
		</div>
	</header>
