<?php
/*
* Template Name: Landing
*/
get_header();
?>
    <!--.breadcrumb-section-->
<?php if (function_exists('kama_breadcrumbs') && !is_front_page()) { ?>
    <section class="breadcrumb-section">
        <div class="container">
            <?php echo kama_breadcrumbs(' >> '); ?>
        </div>
    </section>
<?php } ?><!--End .breadcrumb-section-->


<?php if (get_field('blocks')) {
    foreach (get_field('blocks') as $item) { ?>
        <div class="land-block container">
            <h2 class="land-block__title land-block__title-desktop"><?= $item['main_title'] ?></h2>
            <div class="land-block__title-mob">
                <h2 class="land-block__title"><?= $item['main_title'] ?></h2>
            </div>
            <div class="land-block__top-part">
                <div class="land-block__top-part-item">
                    <img src="<?= $item['main_img'] ?>" class="land-block__main-img">
                </div>
                <div class="land-block__top-part-item">
                    <span class="land-block__top-part-title"><?= $item['top_part_title'] ?></span>
                    <div class="land-block__top-part-subimg-wrapper">
                        <div class="land-block__top-part-subimg">
                            <span class="land-block__top-part-subimg-title"><?= $item['top_part_subtitle_1'] ?></span>
                            <img src="<?= $item['top_part_subimg_1'] ?>"
                                 class="land-block__top-part-subimg-img">
                        </div>
                        <div class="land-block__top-part-subimg">
                            <span class="land-block__top-part-subimg-title"><?= $item['top_part_subtitle_2'] ?></span>
                            <img src="<?= $item['top_part_subimg_2'] ?>"
                                 class="land-block__top-part-subimg-img">
                        </div>
                        <div class="land-block__top-part-subimg">
                            <span class="land-block__top-part-subimg-title"><?= $item['top_part_subtitle_3'] ?></span>
                            <img src="<?= $item['top_part_subimg_3'] ?>"
                                 class="land-block__top-part-subimg-img">
                        </div>
                    </div>
                </div>
                <div class="land-block__top-part-item">
                    <span class="land-block__top-part-price"><?= $item['main_price'] ?></span>
                    <span class="land-block__top-part-price-subtext1"><?= $item['main_price_subtext1'] ?></span>
                    <span class="land-block__top-part-price-subtext2"><?= $item['main_price_subtext2'] ?></span>
                    <span class="land-block__top-part-price-subtext3"><?= $item['main_price_subtext3'] ?></span>
                </div>
            </div>
            <div class="land-block__middle-part">
                <span class="land-block__middle-title"><?= $item['middle_part_title'] ?></span>
                <div class="land-block__middle-item-wrapper">
                    <?php if ($item['middle_part_items']) {
                        foreach ($item['middle_part_items'] as $item2) { ?>
                            <div class="land-block__middle-item">
                                <span class="land-block__middle-subtitle"><?= $item2['title'] ?></span>
                                <div class="land-block__middle-subitem-wrapper">
                                    <?php if ($item2['materials']) {
                                        foreach ($item2['materials'] as $item3) { ?>
                                            <a href="<?= $item3['link'] ?>" class="land-block__middle-subitem">
                                                <img src="<?= $item3['img'] ?>"
                                                     class="land-block__middle-subitem-img">
                                                <span class="land-block__middle-subitem-title"><?= $item3['title'] ?></span>
                                                <span class="land-block__middle-subitem-price1-title"><?= $item3['first_parice_text'] ?></span>
                                                <span class="land-block__middle-subitem-price1"><?= $item3['first_price'] ?></span>
                                                <span class="land-block__middle-subitem-price2-title"><?= $item3['second_parice_text'] ?></span>
                                                <span class="land-block__middle-subitem-price2"><?= $item3['second_price'] ?></span>
                                            </a>
                                        <?php }
                                    } ?>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
            <div class="land-block__bottom-part">
                <div class="land-block__bottom-part-top">
                    <span class="land-block__bottom-part-top-item"><?= $item['bottom_part_string_1'] ?>
                        <span><?= $item['bottom_part_string_1_price'] ?></span></span>
                    <span class="land-block__bottom-part-top-item"><?= $item['bottom_part_string_2'] ?>
                        <span><?= $item['bottom_part_string_2_price'] ?></span></span>
                    <span class="land-block__bottom-part-top-item"><?= $item['bottom_part_string_3'] ?>
                        <span><?= $item['bottom_part_string_3_price'] ?></span></span>
                </div>
                <div class="land-block__bottom-part-bottom">
                    <?php if ($item['bottom_part_images']) {
                        foreach ($item['bottom_part_images'] as $item2) { ?>
                            <div class="land-block__bottom-part-bottom-img">
                                <img src="<?= $item2['img'] ?>">
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>
    <?php }
} ?>

<?php get_footer(); ?>