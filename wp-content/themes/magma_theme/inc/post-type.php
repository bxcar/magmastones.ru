<?php

/* Slider post type */

$t_labels = array(
            'name'               => __('Слайдер','pe-magnetic'),
            'singular_name'      => __('Слайдер','pe-magnetic' ),
            'menu_name'          => _x( 'Слайдер', 'admin menu'),
            'name_admin_bar'     => _x( 'Слайд', 'add new on admin bar'),
            'add_new'            => __('Добавить слайд','pe-magnetic'),
            'add_new_item'       => __('Добавить новый слайд','pe-magnetic'),
            'new_item'           => __('Новый слайд','pe-magnetic'),
            'edit_item'          => __('Редактировать слайд','pe-magnetic'),
            'view_item'          => __('Смотреть слайд','pe-magnetic'),
            'all_items'          => __('Все слайды','pe-magnetic'),
            'search_items'       => __('Поиск слайда','pe-magnetic'),
            'not_found'          => __('Слайд не найден','pe-magnetic'),
            'not_found_in_trash' => __('Слайд в корзине не найден','pe-magnetic'),

        );

        $t_args = array(
            'labels'             => $t_labels,
            'public'             => true,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => false,
            'query_var'          => false,
            'rewrite'            => array( 'slug' => 'slider' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-slides',
            'supports'           => array( 'title', 'editor'),
        );

register_post_type( 'slider', $t_args );



/* Service post type */

$t_labels = array(
            'name'               => __('Новости','pe-magnetic'),
            'singular_name'      => __('Новости','pe-magnetic' ),
            'menu_name'          => _x( 'Новости', 'admin menu'),
            'name_admin_bar'     => _x( 'Новость', 'add new on admin bar'),
            'add_new'            => __('Добавить ноовсть','pe-magnetic'),
            'add_new_item'       => __('Добавить новую новость','pe-magnetic'),
            'new_item'           => __('Новая новость','pe-magnetic'),
            'edit_item'          => __('Редактировать новость','pe-magnetic'),
            'view_item'          => __('Смотреть новость','pe-magnetic'),
            'all_items'          => __('Все новости','pe-magnetic'),
            'search_items'       => __('Поиск новости','pe-magnetic'),
            'not_found'          => __('Новость не найден','pe-magnetic'),
            'not_found_in_trash' => __('Новость в корзине не найден','pe-magnetic'),

        );

        $t_args = array(
            'labels'             => $t_labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => false,
            'query_var'          => false,
            'rewrite'            => array( 'slug' => 'news' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-welcome-widgets-menus',
            'supports'           => array( 'title', 'editor', 'thumbnail'),
        );

register_post_type( 'news', $t_args );


/* Blog post type */

$t_labels = array(
            'name'               => __('Блог','pe-magnetic'),
            'singular_name'      => __('Блог','pe-magnetic' ),
            'menu_name'          => _x( 'Блог', 'admin menu'),
            'name_admin_bar'     => _x( 'Запись', 'add new on admin bar'),
            'add_new'            => __('Добавить запись','pe-magnetic'),
            'add_new_item'       => __('Добавить новую запись','pe-magnetic'),
            'new_item'           => __('Новая запись','pe-magnetic'),
            'edit_item'          => __('Редактировать запись','pe-magnetic'),
            'view_item'          => __('Смотреть запись','pe-magnetic'),
            'all_items'          => __('Все записи','pe-magnetic'),
            'search_items'       => __('Поиск записи','pe-magnetic'),
            'not_found'          => __('Запись не найдена','pe-magnetic'),
            'not_found_in_trash' => __('Запись в корзине не найдена','pe-magnetic'),

        );

        $t_args = array(
            'labels'             => $t_labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => false,
            'query_var'          => false,
            'rewrite'            => array( 'slug' => 'blog' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-megaphone',
            'supports'           => array( 'title', 'editor', 'thumbnail'),
        );

register_post_type( 'blog', $t_args );



/* Project post type */

$t_labels = array(
            'name'               => __('Проекты','pe-magnetic'),
            'singular_name'      => __('Проекты','pe-magnetic' ),
            'menu_name'          => _x( 'Проекты', 'admin menu'),
            'name_admin_bar'     => _x( 'Проект', 'add new on admin bar'),
            'add_new'            => __('Добавить проект','pe-magnetic'),
            'add_new_item'       => __('Добавить новый проект','pe-magnetic'),
            'new_item'           => __('Новый проект','pe-magnetic'),
            'edit_item'          => __('Редактировать проект','pe-magnetic'),
            'view_item'          => __('Смотреть проект','pe-magnetic'),
            'all_items'          => __('Все проекты','pe-magnetic'),
            'search_items'       => __('Поиск проекта','pe-magnetic'),
            'not_found'          => __('Проект не найдена','pe-magnetic'),
            'not_found_in_trash' => __('Проект в корзине не найдена','pe-magnetic'),

        );

        $t_args = array(
            'labels'             => $t_labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => false,
            'query_var'          => false,
            'rewrite'            => array( 'slug' => 'project' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-archive',
            'supports'           => array( 'title', 'editor', 'thumbnail'),
        );

register_post_type( 'project', $t_args );

/*  Add project_cat */
function add_project_cat() {   
    register_taxonomy('project_cat',
        array('project'),
        array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Категория проекта',
                'singular_name' => 'Категория проекта',
                'search_items' =>  'Найти категорию',
                'popular_items' => 'Популярная категорию',
                'all_items' => 'Все категории',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Редактировать категорию', 
                'update_item' => 'Обновить категорию',
                'add_new_item' => 'Добавить категорию',
                'new_item_name' => 'Название новой категории',
                'separate_items_with_commas' => 'Разделяйте категории запятыми',
                'add_or_remove_items' => 'Добавить или удалить категорию',
                'choose_from_most_used' => 'Вибрать из наиболее часто используемых категорий',
                'menu_name' => 'Категория проекта'
            ),
            'public' => true, 
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'show_tagcloud' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'project_cat',
                'hierarchical' => true
 
            ),
        )
    );
}
add_action( 'init', 'add_project_cat', 0 );





/* Project post type */

$t_labels = array(
            'name'               => __('Вакансии','pe-magnetic'),
            'singular_name'      => __('Вакансии','pe-magnetic' ),
            'menu_name'          => _x( 'Вакансии', 'admin menu'),
            'name_admin_bar'     => _x( 'Вакансию', 'add new on admin bar'),
            'add_new'            => __('Добавить вакансию','pe-magnetic'),
            'add_new_item'       => __('Добавить новую вакансию','pe-magnetic'),
            'new_item'           => __('Новая вакансию','pe-magnetic'),
            'edit_item'          => __('Редактировать вакансию','pe-magnetic'),
            'view_item'          => __('Смотреть вакансию','pe-magnetic'),
            'all_items'          => __('Все вакансии','pe-magnetic'),
            'search_items'       => __('Поиск вакансии','pe-magnetic'),
            'not_found'          => __('Вакансия не найдена','pe-magnetic'),
            'not_found_in_trash' => __('Вакансия в корзине не найдена','pe-magnetic'),

        );

        $t_args = array(
            'labels'             => $t_labels,
            'public'             => true,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => false,
            'query_var'          => false,
            'rewrite'            => array( 'slug' => 'vacancies' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-admin-users',
            'supports'           => array( 'title', 'editor'),
        );

register_post_type( 'vacancies', $t_args );






/*  Add country */
function add_country() {   
    register_taxonomy('prod_country',
        array('post'),
        array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Страна производитель',
                'singular_name' => 'Страна производитель',
                'search_items' =>  'Найти страну',
                'popular_items' => 'Популярная страна',
                'all_items' => 'Все страны',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Редактировать страну', 
                'update_item' => 'Обновить страну',
                'add_new_item' => 'Добавить страну',
                'new_item_name' => 'Название новой страны',
                'separate_items_with_commas' => 'Разделяйте страны запятыми',
                'add_or_remove_items' => 'Добавить или удалить страну',
                'choose_from_most_used' => 'Вибрать из наиболее часто используемых стран',
                'menu_name' => 'Страна производитель'
            ),
            'public' => false, 
            'show_in_nav_menus' => false,
            'show_ui' => true,
            'show_tagcloud' => false,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => false,
            'rewrite' => array(
                'slug' => 'prod_country',
                'hierarchical' => true
 
            ),
        )
    );
}
add_action( 'init', 'add_country', 0 );





/*  Add type_binding */
function add_type() {   
    register_taxonomy('type_binding',
        array('post'),
        array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'ТИП фактуры',
                'singular_name' => 'ТИП фактуры',
                'search_items' =>  'Найти страну',
                'popular_items' => 'Популярный тип',
                'all_items' => 'Все типы',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Редактировать тип', 
                'update_item' => 'Обновить тип',
                'add_new_item' => 'Добавить тип',
                'new_item_name' => 'Название нового типа',
                'separate_items_with_commas' => 'Разделяйте типы запятыми',
                'add_or_remove_items' => 'Добавить или удалить тип',
                'choose_from_most_used' => 'Вибрать из наиболее часто используемых типов',
                'menu_name' => 'ТИП фактуры'
            ),
            'public' => false, 
            'show_in_nav_menus' => false,
            'show_ui' => true,
            'show_tagcloud' => false,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => false,
            'rewrite' => array(
                'slug' => 'type_binding',
                'hierarchical' => true
 
            ),
        )
    );
}
add_action( 'init', 'add_type', 0 );






/*  Add type_binding */
function add_type_material() {   
    register_taxonomy('type_material',
        array('post'),
        array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Материал',
                'singular_name' => 'Материал',
                'search_items' =>  'Найти материал',
                'popular_items' => 'Популярный материал',
                'all_items' => 'Все материалы',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Редактировать материал', 
                'update_item' => 'Обновить материал',
                'add_new_item' => 'Добавить материал',
                'new_item_name' => 'Название нового материала',
                'separate_items_with_commas' => 'Разделяйте материалы запятыми',
                'add_or_remove_items' => 'Добавить или удалить материал',
                'choose_from_most_used' => 'Вибрать из наиболее часто используемых материалов',
                'menu_name' => 'Материал'
            ),
            'public' => false, 
            'show_in_nav_menus' => false,
            'show_ui' => true,
            'show_tagcloud' => false,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => false,
            'rewrite' => array(
                'slug' => 'type_material',
                'hierarchical' => true
 
            ),
        )
    );
}
add_action( 'init', 'add_type_material', 0 );






/*  Add type_binding */
function add_type_color() {   
    register_taxonomy('type_color',
        array('post'),
        array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Цвет',
                'singular_name' => 'Цвет',
                'search_items' =>  'Найти цвет',
                'popular_items' => 'Популярный цвет',
                'all_items' => 'Все цвета',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Редактировать цвет', 
                'update_item' => 'Обновить цвет',
                'add_new_item' => 'Добавить цвет',
                'new_item_name' => 'Название нового цвета',
                'separate_items_with_commas' => 'Разделяйте цвета запятыми',
                'add_or_remove_items' => 'Добавить или удалить цвет',
                'choose_from_most_used' => 'Вибрать из наиболее часто используемых цветов',
                'menu_name' => 'Цвет'
            ),
            'public' => false, 
            'show_in_nav_menus' => false,
            'show_ui' => true,
            'show_tagcloud' => false,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => false,
            'rewrite' => array(
                'slug' => 'type_color',
                'hierarchical' => true
 
            ),
        )
    );
}
add_action( 'init', 'add_type_color', 0 );


/*  Add type_binding */
function add_alphabet() {   
    register_taxonomy('type_alphabet',
        array('post'),
        array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Алфавит',
                'singular_name' => 'Алфавит',
                'search_items' =>  'Найти букву',
                'popular_items' => 'Популярный буква',
                'all_items' => 'Весь алфавит',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Редактировать букву', 
                'update_item' => 'Обновить букву',
                'add_new_item' => 'Добавить букву',
                'new_item_name' => 'Название новой буквы',
                'separate_items_with_commas' => 'Разделяйте буквы запятыми',
                'add_or_remove_items' => 'Добавить или удалить букву',
                'choose_from_most_used' => 'Вибрать из наиболее часто используемых букв',
                'menu_name' => 'Алфавит'
            ),
            'public' => false, 
            'show_in_nav_menus' => false,
            'show_ui' => true,
            'show_tagcloud' => false,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => false,
            'rewrite' => array(
                'slug' => 'type_alphabet',
                'hierarchical' => true
 
            ),
        )
    );
}
add_action( 'init', 'add_alphabet', 0 );


?>