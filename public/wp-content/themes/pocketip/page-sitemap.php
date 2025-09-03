<?php
/*
Template Name: Sitemap
*/
?>

<?php get_header(); ?>

<main>
    <section class="pt-3 pt-xl-3 mt-2 mt-lg-3 mb-80">
        <div class="container">
            <div class="sitemap">
                <?php
                    $sitemap_menu_name = 'Sitemap menu ' . pll_current_language( 'name' );
                    $sitemap_menus = wp_get_menu_array($sitemap_menu_name);

                    if ($sitemap_menus):
                        foreach ($sitemap_menus as $menu): ?>
                            <div class="sitemap__item">
                                <h3><?php echo $menu['title']; ?></h3>
                                <?php if ($menu['children']):
                                    foreach ($menu['children'] as $children): ?>

                                        <?php if ($children['children']): ?>
                                            <div class="sitemap__item-with-children">
                                                <a href="<?php echo $children['url']; ?>"><?php echo $children['title']; ?></a>
                                                <ul>
                                                    <?php
                                                        foreach ($children['children'] as $sub_children): ?>
                                                        <li style="color:blue; padding-left:10px;">
                                                            <a href="<?php echo $sub_children['url']; ?>"><?php echo $sub_children['title']; ?></a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php else: ?>
                                            <a href="<?php echo $children['url']; ?>"><?php echo $children['title']; ?></a>
                                        <?php endif; ?>
                                <?php endforeach;
                                endif; ?>
                            </div>
                        <?php endforeach;
                    endif;
                ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
