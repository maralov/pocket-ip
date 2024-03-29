<footer class="footer">
    <div class="container-lg">
        <div class="row justify-content-lg-between">
            <div class="col-12 col-lg-3 mb-4 mb-lg-0 d-lg-flex flex-lg-column">
                <div class="mb-4">
                    <?php
                        $image = get_field('main_logo', 'option');
                        if (!empty($image)): ?>
                        <div class="main-logo">
                            <a href="<?php echo home_url(); ?>">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row row-cols-2 row-cols-lg-1 g-2 mb-4">
                    <?php
                        $book_link = get_field('main_btn_book', 'option');
                        if( $book_link ):
                            $book_link_url = $book_link['url'];
                            $book_link_title = $book_link['title'];
                            $book_link_target = $book_link['target'] ? $book_link['target'] : '_self';
                            ?>
                            <div class="col">
                                <a class="btn btn-primary w-100" href="<?php echo esc_url( $book_link_url ); ?>" target="<?php echo esc_attr( $book_link_target ); ?>"><?php echo esc_html( $book_link_title ); ?></a>
                            </div>
                    <?php endif; ?>
                    <?php
                        $try_link = get_field('main_btn_try', 'option');
                        if( $try_link ):
                            $try_link_url = $try_link['url'];
                            $try_link_title = $try_link['title'];
                            $try_link_target = $try_link['target'] ? $try_link['target'] : '_self';
                            ?>
                            <div class="col">
                                <a class="btn btn-primary-outline w-100" href="<?php echo esc_url( $try_link_url ); ?>" target="<?php echo esc_attr( $try_link_target ); ?>"><?php echo esc_html( $try_link_title ); ?></a>
                            </div>
                    <?php endif; ?>
                </div>

                <?php
                if(get_field('images_footer', 'option')): while(have_rows('images_footer', 'option')): the_row();?>
                        <?php
                            $image_footer = get_sub_field('images_footer_item');
                            $image_footer_big = get_sub_field('images_footer_item_big');

                            if (!empty($image_footer)): ?>
                                <div class="d-none d-lg-block mt-auto">
                                    <img src="<?php echo esc_url($image['url']); ?>"
                                    <?php if(!empty($image_footer_big)) : ?>
                                        srcset="<?php echo esc_url($image_footer['url']); ?> 1x, <?php echo esc_url($image_footer_big['url']); ?> 2x"
                                    <?php endif; ?>
                                    alt="<?php echo esc_attr($image_footer['alt']); ?>">
                                </div>
                        <?php endif; ?>
                <?php  endwhile; endif; ?>
                <!--
                <div class="d-none d-lg-block mt-auto">
                    <img src="<?php // echo POCKET_IMG_DIR; ?>/five.png" SRCSET="<?php //echo POCKET_IMG_DIR; ?>/five.png, ../img/five@2x.png 2x" alt="">
                </div>
                -->
            </div>
            <div class="col-12 col-lg-8">
                <div class="footer-nav">
                    <ul>
                    <?php
                    $menu_name = 'Footer menu ' . pll_current_language( 'name' );
                    $footer_menus = wp_get_menu_array($menu_name);

                    if($footer_menus):
                        foreach($footer_menus as $menu): ?>
                        <li class="menu-item-has-children">
                            <a><?php echo $menu['title']; ?></a>
                            <ul class="sub-menu">
                            <?php foreach($menu['children'] as $children): ?>
                                <li><a href="<?php echo $children['url']; ?>"><?php echo $children['title']; ?></a></li>
                            <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; endif;?>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="d-lg-flex justify-content-between footer__copy">
                    <ul>
                        <li><?php pll_e('Copyright'); ?> <?php echo date('Y'); ?></li>
                        <li><?php pll_e('All Rights Reserved By PocketIP Ltd'); ?></li>

                        <?php
                        $menu_name_single = 'Footer single line menu ' . pll_current_language( 'name' );
                        $single_menus = wp_get_menu_array($menu_name_single);

                        if($single_menus):
                            foreach($single_menus as $menu): ?>
                        <li><a href="<?php echo $menu['url']; ?>"><?php echo $menu['title']; ?></a></li>
                        <?php endforeach; endif; ?>
                    </ul>

                    <?php if( have_rows('main_social', 'option') ): ?>
                    <div class="footer__social">
                    <?php while ( have_rows('main_social','option') ) : the_row(); ?>
                        <?php
                            $social_icon = get_sub_field('main_social_icon', 'option');

                            $social_link = get_sub_field('main_social_link', 'option');
                            if( $social_link ):
                                $social_link_url = $social_link['url'];
                                $social_link_title = $social_link['title'];
                                $social_link_target = $social_link['target'] ? $social_link['target'] : '_self';
                            ?>
                            <a href="<?php echo esc_url($social_link_url); ?>" class="footer__social-item"
                                style="background-image: url(<?php echo esc_url($social_icon['url']); ?>)" title="pocket-ip <?php echo esc_html(lcfirst($social_link_title)); ?>">
                                pocket-ip <?php echo esc_html(lcfirst($social_link_title)); ?>
                            </a>
                            <?php endif; ?>
                    <?php endwhile; ?>
                    </div>
                    <?php endif; ?>

                    <?php if(get_field('images_footer', 'option')): while(have_rows('images_footer', 'option')): the_row();?>
                        <?php
                            $image_footer = get_sub_field('images_footer_item');
                            $image_footer_big = get_sub_field('images_footer_item_big');

                            if (!empty($image_footer)): ?>
                                <div class="d-block d-lg-none mt-3 mt-lg-0">
                                    <img src="<?php echo esc_url($image['url']); ?>"
                                    <?php if(!empty($image_footer_big)) : ?>
                                        srcset="<?php echo esc_url($image_footer['url']); ?> 1x, <?php echo esc_url($image_footer_big['url']); ?> 2x"
                                    <?php endif; ?>
                                    alt="<?php echo esc_attr($image_footer['alt']); ?>">
                                </div>
                        <?php endif; ?>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>
    <!--	ренерить єту модалку только если в баннер у .btn-video передана сілка в data-video	-->
    <?php if( have_rows('custom_blocks') ): while ( have_rows('custom_blocks') ) : the_row(); ?>
        <?php if( get_row_layout() == 'banner_block' ): ?>
            <?php
            $login_link = get_sub_field('banner_block_button_watch');
            if( $login_link ): ?>
                <div class="modal js-modal-video">
                    <div class="position-relative">
                        <button type="button" class="btn modal__btn-close js-modal-btn-close">
                            <img src="<?php echo POCKET_IMG_DIR?>/icons/ic-close-modal.svg" alt="close-modal">
                        </button>

                        <iframe width="700"
                                height="400"
                                src=""
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endwhile; endif; ?>
    <div class="modal modal-submit js-modal-submit">
        <div class="position-relative modal-submit__content">
            <button type="button" class="btn modal__btn-close js-modal-btn-close">
                <img src="<?php echo POCKET_IMG_DIR?>/icons/ic-close-modal.svg" alt="close-modal">
            </button>
            <div class="box box--white box--lg box--radius-lg text-center">
                <div class="h2  mb-3"><?php pll_e('Thank you'); ?></div>
                <div class="paragraph  mb-4"><?php pll_e('We have received your message'); ?></div>
                <button type="button" class="btn btn-primary js-modal-btn-close"><?php pll_e('Okey'); ?></button>
            </div>
        </div>
    </div>
    <div class="modal modal-search js-modal-search">
    	<div class="position-relative modal-search__content box box--white box--radius-lg text-center">
    		<button type="button" class="btn modal__btn-close js-modal-btn-close">
    			<img src="<?php echo POCKET_IMG_DIR?>/icons/ic-close-modal.svg" alt="close-modal">
    		</button>
    		<div class="h2  mb-3"><?php pll_e('Search'); ?></div>
    		<div class="form form-search">
    			<form action="/" autocomplete="off" class="modal-search-form" data-url="<?php echo admin_url('admin-ajax.php'); ?>" >
    				<div class="form-search__container">
    					<input type="text" name="s" id="keyword" placeholder="<?php pll_e('Search'); ?>"/>
                        <button type="submit"><?php pll_e('Search'); ?></button>
    				</div>
    			</form>
    		</div>
    		<div class="modal-search__result" id="datafetch">
    		    <span class="js-modal-search-result-not-found text-error d-none"><?php pll_e('Nothing not found try change request'); ?></span>
    		    <span class="js-modal-search-result-error text-error d-none"><?php pll_e('Please enter at least 3 characters'); ?></span>
    		</div>
    	</div>
    </div>
	<?php wp_footer(); ?>
</body>

</html>
