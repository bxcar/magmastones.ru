<?php get_header(); ?>


    <!--.breadcrumb-section-->
<?php if (function_exists('kama_breadcrumbs') && !is_front_page()) { ?>
    <section class="breadcrumb-section">
        <div class="container">
            <?php echo kama_breadcrumbs(' >> '); ?>
        </div>
    </section>
<?php } ?><!--End .breadcrumb-section-->


    <!--.goods-section-->
    <section class="goods-section">
        <div class="container">
            <?php
            while (have_posts()) : the_post();
                setPostViews(get_the_ID());
                $thumb_id = get_post_thumbnail_id();
                $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
                ?>

                <div class="title-section"><h1><?php the_title(); ?></h1></div>
                <!--.inform-goods-->
                <div class="inform-goods">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <!--<div class="foto" style="background-image: url(<?php echo $thumb_url[0]; ?>)"></div>-->
                            <img src="<?php echo $thumb_url[0]; ?>" class="foto">
                            <?php if (get_field('action')) { ?>
                            <div class="icon-action" style="<?php if (get_field('action') == 'action') {
                                echo 'background-image: url(\'/wp-content/themes/magma_theme/img/action.png\');';
                            } ?>"></div><?php } ?>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="description-goods">
                                <div class="text">
                                    <?php the_content(); ?>
                                </div>

                                <?php
                                if (get_field('sale_price') || get_field('sale_price_euro')) {
                                    if (get_field('sale_price_euro')) {
                                        $price = get_conversion('number=' . str_replace(" ", "", get_field('sale_price_euro')));
                                        $price = str_replace(",", " ", $price);
                                    } else {
                                        $price = get_field('sale_price');
                                    }
                                } else {
                                    if (get_field('price_euro')) {
                                        $price = get_conversion('number=' . str_replace(" ", "", get_field('price_euro')));
                                        $price = str_replace(",", " ", $price);
                                    } else {
                                        $price = get_field('price');
                                    }
                                }

                                if ($price) {
                                    echo '<div class="price">Цена: ' . $price . ' руб./кв.м</div>';
                                }
                                ?>
                                <a href="#" class="btn btn_order show_popup" data-target="#order">Заказать</a>
                            </div>
                        </div>
                    </div>
                </div><!--End .inform-goods-->

                <?php if (get_field('slab')) { ?>
                    <div class="slabs-table">
                        <table>
                            <caption>Слэбы</caption>
                            <tr>
                                <th>Название</th>
                                <th>Размер слэба</th>
                                <th>Цена</th>
                            </tr>
                            <?php foreach (get_field('slab') as $slab) { ?>
                                <tr>
                                    <td><?= $slab['title']; ?></td>
                                    <td><?= $slab['size']; ?></td>
                                    <td><?= $slab['price']; ?></td>
                                </tr>
                                <?php
                            } ?>
                        </table>
                    </div>
                <?php } ?>
                <!--THIS tabs-->


                <?php
                $name = get_field('name_primer');
                $gal = get_field('full_desc');
                ?>


                <!--.panel-list-goods-->
                <div class="panel-list-goods nav-tabs">
                    <?php /* ?><ul>
					<?php if( $name ) { echo '<li class="selected"><a href="#">Описание</a></li>'; } ?>
					<li><a href="#">Дополнительная информация</a></li>
				</ul><?php */ ?>
                </div><!--End .panel-list-goods-->


                      <!--.main-container-tabs-->
                <div class="main-container-tabs">
                    <div class="tab">
                        <?php //if( $name ) { echo '<h3>'.$name.'</h3>'; } ?>
                        <?php if ($gal) {
                            echo '<h3>Дополнительные изображения</h3>';
                            foreach ($gal as $item) {
                                echo '<div class="pic"><a href="' . $item['url'] . '" class="fancybox-button" rel="fancybox-button" ><img src="' . $item['sizes']['thumbnail'] . '" alt=""></a></div>';
                            }
                        } ?>
                    </div>
                    <?php /* ?><div class="tab">
					<h3>Дополнительная информация</h3>
					<div class="view-attributes">

						<?php 
						echo '<div class="attributes"><strong>Страна:</strong>';
						$terms_color = get_the_term_list( get_the_ID(), 'prod_country', '', ', ', '' );
						echo strip_tags($terms_color); echo '</div>';
						?>
						

					<?php 
						echo '<div class="attributes"><strong>Цвет:</strong>';
						$terms_color = get_the_term_list( get_the_ID(), 'type_color', '', ', ', '' );
						echo strip_tags($terms_color); echo '</div>';
					?>

					<?php 
						echo '<div class="attributes"><strong>Тип фактуры:</strong>';
						$terms_color = get_the_term_list( get_the_ID(), 'type_binding', '', ', ', '' );
						echo strip_tags($terms_color); echo '</div>';
					?>

					<?php 
						echo '<div class="attributes"><strong>Материал:</strong>';
						$terms_color = get_the_term_list( get_the_ID(), 'type_material', '', ', ', '' );
						echo strip_tags($terms_color); echo '</div>';
					?>

					</div>
				</div><?php */ ?>
                </div><!--.main-container-tabs-->
                <!--END THIS tabs-->


                <?php
            endwhile;
            wp_reset_query();
            ?>

        </div>
    </section><!--.goods-section-->


    <!--.search-section-link-->
    <section class="search-section-link tobg">
        <div class="container">
            <?php if (get_field('page_filter', 'option')) { ?>
                <form action="<?php echo get_field('page_filter', 'option'); ?>" id="custom_searsch_form" method="GET">
                    <input type="search" id="search" class="each_filter" name="search" placeholder="Введите название">
                    <input type="hidden" id="cat_filter" class="each_filter" name="cat_filter" value=""/>
                </form>

                <?php
                $args = array(
                    'taxonomy' => 'category',
                    'hide_empty' => false,
                    'order' => 'desc'
                );
                $terms = get_terms($args);

                if ($terms) {
                    echo '<ul id="list_cat_form" class="item-link">';
                    foreach ($terms as $t) {
                        if (get_field('show_form_cat', 'category_' . $t->term_id) == 1) {
                            echo '<li><a href="#" data-id="' . $t->term_id . '">' . $t->name . '</a></li>';
                        }
                    }
                    echo '</ul>';
                }
                ?>

            <?php } else {
                echo '<div>Выберите страницу результатов фильтра в настройках вашей темы.</div>';
            } ?>
        </div>
    </section><!--End .search-section-link-->


    <!--.popular-goods-section-->
<?php
$categories = get_the_category($post->ID);
if ($categories) {
    $category_ids = array();
    foreach ($categories as $individual_category) $category_ids[] = $individual_category->term_id;
    $args = array(
        'category__in' => $category_ids, // Сортировка Цпроизводится по категориям
        'orderby' => rand, // Условие сортировки рандом
        'post__not_in' => array($post->ID),
        'showposts' => 5, //Количество выводимых записей
        'caller_get_posts' => 1 // Запрещаем повторение ссылок
    );
    $my_query = new wp_query($args);
    if ($my_query->have_posts()) {
        ?>
        <section class="alternative-goods-section">
            <div class="container">
                <div class="title">
                    <h2><span>Возможно заинтересует</span></h2>
                    <?php if (get_field('page_catalog', 'option')) {
                        echo '<a href="' . get_field('page_catalog', 'option') . '" class="link-next">смотреть все</a>';
                    } ?>
                </div>

                <div class="default-shell to-price">

                    <?php
                    while ($my_query->have_posts()) : $my_query->the_post();
                        $thumb_id = get_post_thumbnail_id();
                        $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
                        ?>

                        <!--.view-box-->
                        <div class="view-box active">
                            <div class="inset-box">
                                <div class="foto" style="background-image: url(<?php echo $thumb_url[0]; ?>)"><a
                                            href="<?php the_permalink(); ?>"></a></div>
                                <?php
                                echo '<div class="name-goods">';
                                $terms = get_the_term_list(get_the_ID(), 'category', '', ', ', '');
                                echo strip_tags($terms);
                                echo '</div>';
                                ?>
                                <div class="title-goods"><h3><a
                                                href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
                                <?php
                                if (get_field('sale_price') || get_field('sale_price_euro')) {
                                    if (get_field('sale_price_euro')) {
                                        $price = get_conversion('number=' . str_replace(" ", "", get_field('sale_price_euro')));
                                        $price = str_replace(",", " ", $price);
                                    } else {
                                        $price = get_field('sale_price');
                                    }
                                } else {
                                    if (get_field('price_euro')) {
                                        $price = get_conversion('number=' . str_replace(" ", "", get_field('price_euro')));
                                        $price = str_replace(",", " ", $price);
                                    } else {
                                        $price = get_field('price');
                                    }
                                }

                                if ($price) {
                                    echo '<div class="price-goods">' . $price . ' руб.</div>';
                                }
                                ?>
                            </div>
                            <div class="more-inform-product"><a href="<?php the_permalink(); ?>"
                                                                class="btn">подробнее</a></div>
                        </div><!--End .view-box-->

                    <?php endwhile; ?>


                </div>

            </div>
        </section>
        <?php
    }
    wp_reset_query();
} ?><!--End .popular-goods-section-->





<?php get_footer(); ?>