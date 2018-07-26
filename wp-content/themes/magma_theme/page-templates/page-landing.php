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


<div class="land-block container">
    <h2 class="land-block__title">Столешницы</h2>
    <div class="land-block__top-part">
        <div class="land-block__top-part-item">
            <img src="<?= get_template_directory_uri();?>/img/land-main-img.png" class="land-block__main-img">
        </div>
        <div class="land-block__top-part-item">
            <span class="land-block__top-part-title">Профиль кромки</span>
            <div class="land-block__top-part-subimg-wrapper">
                <div class="land-block__top-part-subimg">
                    <span class="land-block__top-part-subimg-title">А</span>
                    <img src="<?= get_template_directory_uri();?>/img/prof-img-1.png" class="land-block__top-part-subimg-img">
                </div>
                <div class="land-block__top-part-subimg">
                    <span class="land-block__top-part-subimg-title">B</span>
                    <img src="<?= get_template_directory_uri();?>/img/prof-img-2.png" class="land-block__top-part-subimg-img">
                </div>
                <div class="land-block__top-part-subimg">
                    <span class="land-block__top-part-subimg-title">C</span>
                    <img src="<?= get_template_directory_uri();?>/img/prof-img-3.png" class="land-block__top-part-subimg-img">
                </div>
            </div>
        </div>
        <div class="land-block__top-part-item">
            <span class="land-block__top-part-price">8999 руб*</span>
            <span class="land-block__top-part-price-subtext1">цена указана за изделие из материала<br>Крема Марфил Элегант</span>
            <span class="land-block__top-part-price-subtext2">Мотаж изделия</span>
            <span class="land-block__top-part-price-subtext3">5000 руб/пог.метр</span>
        </div>
    </div>
    <div class="land-block__middle-part">
        <span class="land-block__middle-title">Материал</span>
        <div class="land-block__middle-item-wrapper">
            <div class="land-block__middle-item">
                <span class="land-block__middle-subtitle">Мрамор</span>
                <div class="land-block__middle-subitem-wrapper">
                    <a href="#" class="land-block__middle-subitem">
                        <img src="<?= get_template_directory_uri();?>/img/land-circle-img-1.png" class="land-block__middle-subitem-img">
                        <span class="land-block__middle-subitem-title">Абсолют Вайт / Absolute White</span>
                        <span class="land-block__middle-subitem-price1-title">Цена у нас</span>
                        <span class="land-block__middle-subitem-price1">8999 руб</span>
                        <span class="land-block__middle-subitem-price2-title">Цена у конкурентов</span>
                        <span class="land-block__middle-subitem-price2">10999 руб</span>
                    </a>
                    <a href="#" class="land-block__middle-subitem">
                        <img src="<?= get_template_directory_uri();?>/img/land-circle-img-2.png" class="land-block__middle-subitem-img">
                        <span class="land-block__middle-subitem-title">Абсолют Вайт / Absolute White</span>
                        <span class="land-block__middle-subitem-price1-title">Цена у нас</span>
                        <span class="land-block__middle-subitem-price1">8999 руб</span>
                        <span class="land-block__middle-subitem-price2-title">Цена у конкурентов</span>
                        <span class="land-block__middle-subitem-price2">10999 руб</span>
                    </a>
                    <a href="#" class="land-block__middle-subitem">
                        <img src="<?= get_template_directory_uri();?>/img/land-circle-img-1.png" class="land-block__middle-subitem-img">
                        <span class="land-block__middle-subitem-title">Абсолют Вайт / Absolute White</span>
                        <span class="land-block__middle-subitem-price1-title">Цена у нас</span>
                        <span class="land-block__middle-subitem-price1">8999 руб</span>
                        <span class="land-block__middle-subitem-price2-title">Цена у конкурентов</span>
                        <span class="land-block__middle-subitem-price2">10999 руб</span>
                    </a>
                    <a href="#" class="land-block__middle-subitem">
                        <img src="<?= get_template_directory_uri();?>/img/land-circle-img-2.png" class="land-block__middle-subitem-img">
                        <span class="land-block__middle-subitem-title">Абсолют Вайт / Absolute White</span>
                        <span class="land-block__middle-subitem-price1-title">Цена у нас</span>
                        <span class="land-block__middle-subitem-price1">8999 руб</span>
                        <span class="land-block__middle-subitem-price2-title">Цена у конкурентов</span>
                        <span class="land-block__middle-subitem-price2">10999 руб</span>
                    </a>
                </div>
            </div>
            <div class="land-block__middle-item">
                <span class="land-block__middle-subtitle">Мрамор</span>
                <div class="land-block__middle-subitem-wrapper">
                    <a href="#" class="land-block__middle-subitem">
                        <img src="<?= get_template_directory_uri();?>/img/land-circle-img-1.png" class="land-block__middle-subitem-img">
                        <span class="land-block__middle-subitem-title">Абсолют Вайт / Absolute White</span>
                        <span class="land-block__middle-subitem-price1-title">Цена у нас</span>
                        <span class="land-block__middle-subitem-price1">8999 руб</span>
                        <span class="land-block__middle-subitem-price2-title">Цена у конкурентов</span>
                        <span class="land-block__middle-subitem-price2">10999 руб</span>
                    </a>
                    <a href="<?= get_template_directory_uri();?>/img/land-circle-img-2.png" class="land-block__middle-subitem">
                        <img src="#" class="land-block__middle-subitem-img">
                        <span class="land-block__middle-subitem-title">Абсолют Вайт / Absolute White</span>
                        <span class="land-block__middle-subitem-price1-title">Цена у нас</span>
                        <span class="land-block__middle-subitem-price1">8999 руб</span>
                        <span class="land-block__middle-subitem-price2-title">Цена у конкурентов</span>
                        <span class="land-block__middle-subitem-price2">10999 руб</span>
                    </a>
                    <a href="#" class="land-block__middle-subitem">
                        <img src="<?= get_template_directory_uri();?>/img/land-circle-img-1.png" class="land-block__middle-subitem-img">
                        <span class="land-block__middle-subitem-title">Абсолют Вайт / Absolute White</span>
                        <span class="land-block__middle-subitem-price1-title">Цена у нас</span>
                        <span class="land-block__middle-subitem-price1">8999 руб</span>
                        <span class="land-block__middle-subitem-price2-title">Цена у конкурентов</span>
                        <span class="land-block__middle-subitem-price2">10999 руб</span>
                    </a>
                    <a href="<?= get_template_directory_uri();?>/img/land-circle-img-2.png" class="land-block__middle-subitem">
                        <img src="#" class="land-block__middle-subitem-img">
                        <span class="land-block__middle-subitem-title">Абсолют Вайт / Absolute White</span>
                        <span class="land-block__middle-subitem-price1-title">Цена у нас</span>
                        <span class="land-block__middle-subitem-price1">8999 руб</span>
                        <span class="land-block__middle-subitem-price2-title">Цена у конкурентов</span>
                        <span class="land-block__middle-subitem-price2">10999 руб</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="land-block__bottom-part">
        <div class="land-block__bottom-part-top">
            <span class="land-block__bottom-part-top-item">Корректировка по длине - <span>Бесплатно</span></span>
            <span class="land-block__bottom-part-top-item">Замер (при заказе) - <span>Бесплатно</span></span>
            <span class="land-block__bottom-part-top-item">Доставка по Москве (до подъезда) - <span>Бесплатно</span></span>
        </div>
        <div class="land-block__bottom-part-bottom">
            <img src="<?= get_template_directory_uri();?>/img/land-gallery-img.png"  class="land-block__bottom-part-bottom-img">
            <img src="<?= get_template_directory_uri();?>/img/land-gallery-img.png"  class="land-block__bottom-part-bottom-img">
            <img src="<?= get_template_directory_uri();?>/img/land-gallery-img.png"  class="land-block__bottom-part-bottom-img">
            <img src="<?= get_template_directory_uri();?>/img/land-gallery-img.png"  class="land-block__bottom-part-bottom-img">
        </div>
    </div>
</div>




<?php get_footer(); ?>