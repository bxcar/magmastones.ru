<?php

/**
 * Альтернатива wp_pagenavi. Создает ссылки пагинации на страницах архивов.
 *
 * @param string $before   - текст до навигации
 * @param string $after    - текст после навигации
 * @param bool   $echo     - возвращать или выводить результат
 * @param array  $args     - аргументы функции
 * @param array  $wp_query - объект WP_Query на основе которого строится пагинация. По умолчанию глобальная переменная $wp_query
 *
 * Версия: 2.5.1
 * Автор: Тимур Камаев
 * Ссылка на страницу функции: http://wp-kama.ru/?p=8
 */
function kama_pagenavi( $before = '', $after = '', $echo = true, $args = array(), $wp_query = null ) {
	if( ! $wp_query ){
		wp_reset_query();
		global $wp_query;
	}

	// параметры по умолчанию
	$default_args = array(
		'text_num_page'   => '', // Текст перед пагинацией. {current} - текущая; {last} - последняя (пр. 'Страница {current} из {last}' получим: "Страница 4 из 60" )
		'num_pages'       => 8, // сколько ссылок показывать
		'step_link'       => 0, // ссылки с шагом (значение - число, размер шага (пр. 1,2,3...10,20,30). Ставим 0, если такие ссылки не нужны.
		'dotright_text'   => '…', // промежуточный текст "до".
		'dotright_text2'  => '…', // промежуточный текст "после".
		'back_text'       => '<', // текст "перейти на предыдущую страницу". Ставим 0, если эта ссылка не нужна.
		'next_text'       => '>', // текст "перейти на следующую страницу". Ставим 0, если эта ссылка не нужна.
		'first_page_text' => '<<', // текст "к первой странице". Ставим 0, если вместо текста нужно показать номер страницы.
		'last_page_text'  => '>>', // текст "к последней странице". Ставим 0, если вместо текста нужно показать номер страницы.
	);

	$default_args = apply_filters('kama_pagenavi_args', $default_args ); // чтобы можно было установить свои значения по умолчанию

	$args = array_merge( $default_args, $args );

	extract( $args );

	$posts_per_page = (int) $wp_query->get('posts_per_page');
	$paged          = (int) $wp_query->get('paged');
	$max_page       = $wp_query->max_num_pages;

	//проверка на надобность в навигации
	if( $max_page <= 1 )
		return false;

	if( empty( $paged ) || $paged == 0 )
		$paged = 1;

	$pages_to_show = intval( $num_pages );
	$pages_to_show_minus_1 = $pages_to_show-1;

	$half_page_start = floor( $pages_to_show_minus_1/2 ); //сколько ссылок до текущей страницы
	$half_page_end = ceil( $pages_to_show_minus_1/2 ); //сколько ссылок после текущей страницы

	$start_page = $paged - $half_page_start; //первая страница
	$end_page = $paged + $half_page_end; //последняя страница (условно)

	if( $start_page <= 0 )
		$start_page = 1;
	if( ($end_page - $start_page) != $pages_to_show_minus_1 )
		$end_page = $start_page + $pages_to_show_minus_1;
	if( $end_page > $max_page ) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = (int) $max_page;
	}

	if( $start_page <= 0 )
		$start_page = 1;

	//выводим навигацию
	$out = '';

	// создаем базу чтобы вызвать get_pagenum_link один раз
	$link_base = str_replace( 99999999, '___', get_pagenum_link( 99999999 ) );
	$first_url = get_pagenum_link( 1 );
	if( false === strpos( $first_url, '?') )
		$first_url = user_trailingslashit( $first_url );

	$out .= $before . "<ul class='pagination'>\n";

		if( $text_num_page ){
			$text_num_page = preg_replace( '!{current}|{last}!', '%s', $text_num_page );
			$out.= sprintf( "<span class='pages'>$text_num_page</span> ", $paged, $max_page );
		}
		// в начало
		if ( $paged == 1 ) {
			$diss = 'class="disabled"';
			$first_url = 'javascript: void(0)';
		} else {
			$first_url = $first_url;
		}
			$out.= '<li><a '.$diss.' href="'. $first_url .'" aria-label="First"><span aria-hidden="true">'. ( $first_page_text ? $first_page_text : 1 ) .'</span></a></li> ';
			//if( $dotright_text && $start_page != 2 ) $out .= '<span class="extend">'. $dotright_text .'</span> ';

		// назад
		if ( $paged == 1 ) {
			$diss = 'class="disabled"';
			$prev_url = 'javascript: void(0)';
		} else {
			$prev_url = ( ($paged-1)==1 ? $first_url : str_replace( '___', ($paged-1), $link_base ) );
		}
			$out .= '<li><a '.$diss.' href="'. $prev_url .'" aria-label="Previous"><span aria-hidden="true">'. $back_text .'</span></a></li> ';
		
		// пагинация
		for( $i = $start_page; $i <= $end_page; $i++ ) {
			if( $i == $paged )
				$out .= '<li><a href="javascript: void(0)" class="active">'.$i.'</a></li> ';
			elseif( $i == 1 )
				$out .= '<li><a href="'. $first_url .'">1</a></li> ';
			else
				$out .= '<li><a href="'. str_replace( '___', $i, $link_base ) .'">'. $i .'</a></li> ';
		}

		//ссылки с шагом
		$dd = 0;
		if ( $step_link && $end_page < $max_page ){
			for( $i = $end_page+1; $i<=$max_page; $i++ ) {
				if( $i % $step_link == 0 && $i !== $num_pages ) {
					if ( ++$dd == 1 )
						$out.= '<span class="extend">'. $dotright_text2 .'</span> ';
					$out.= '<a href="'. str_replace( '___', $i, $link_base ) .'">'. $i .'</a> ';
				}
			}
		}

		
		// в конец
		if ( $paged == $max_page ) {
			$diss = 'class="disabled"';
			$last_link = 'javascript: void(0)';
			$next_link = 'javascript: void(0)';
		} else {
			$diss = 'class="actives"';
			$last_link = str_replace( '___', $max_page, $link_base );
			$next_link = str_replace( '___', ($paged+1), $link_base );
		}

		// вперед
		//if ( $next_text && $paged != $end_page )
			$out.= '<li><a '.$diss.' href="'. $next_link  .'" aria-label="Next"><span aria-hidden="true">'. $next_text .'</span></a></li> ';


			//if( $dotright_text && $end_page != ($max_page-1) )
				//$out.= '<span class="extend">'. $dotright_text2 .'</span> ';
			$out.= '<li><a '.$diss.' href="'. $last_link .'" aria-label="Last"><span aria-hidden="true">'. ( $last_page_text ? $last_page_text : $max_page ) .'</span></a></li> ';
		//}
		

	$out .= "</ul>". $after ."\n";

	$out = apply_filters('kama_pagenavi', $out );

	if( $echo )
		return print $out;

	return $out;
}
/**
 * 2.5 - 2.5.1 - автоматический сброс основного запроса.
 */

 ?>