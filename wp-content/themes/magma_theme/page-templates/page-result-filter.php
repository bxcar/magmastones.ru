<?php
	/*
	* Template Name: Результат фильтра
	*/
	get_header();
?>




	<!--.breadcrumb-section-->
	<?php if( function_exists('kama_breadcrumbs') && !is_front_page() ) { ?>
	<section class="breadcrumb-section">
		<div class="container">
			<?php echo kama_breadcrumbs(' >> '); ?>
		</div> 
	</section>
	<?php } ?><!--End .breadcrumb-section-->




	<!--.catalog-section-->
	<section class="catalog-section">
		<div class="container">
	<!--		<div class="title-section"><h2>Каталог</h2></div> -->


			<div class="row">
				<div class="col-lg-3">
					<button class="btn tofilter" id="tofilter">Развернуть фильтр</button>
					<div class="filter-goods">
<!--
						<div class="item">
							<form action="<?php echo home_url('/'); ?>">
								<div class="form-group">
									<input type="search" name="s" placeholder="Поиск">
									<input type="submit" name="">
								</div>
							</form>
						</div>
-->


						<?php if( get_field('page_filter', 'option') ) { ?>
							<form action="<?php echo get_field('page_filter', 'option'); ?>" id="filter_form" method="GET">
								<div class="item">
									<div class="list-category" id="prod_category">
										<h4>Каталог камня</h4>
										<?php
										if ($_GET['cat_filter'] != '') {
											$thisCat = get_category($_GET['cat_filter'],false);

											$parent = $thisCat->parent;
											$parentCat = get_category($parent,false);

											echo '<ul>'; 
											if( $parent != '' ) { ?>
												<li><a href="javascript: void(0)" data-catID="<?php echo $parentCat->term_id; ?>"><?php echo $parentCat->name; ?> <?php (int)count_filter(); ?></a>
													<ul>
														<li class=" selected_cat"><a href="javascript: void(0)"><?php echo $thisCat->name; ?> <?php (int)count_filter(); ?></a></li>
													</ul>
												</li>
											<?php } else {
											?>
												<li class=" selected_cat"><a href="javascript: void(0)"><?php echo $thisCat->name; ?> <?php (int)count_filter(); ?></a></li>
											<?php }
												echo '</ul>';
										} else {
											wp_nav_menu( array(
											'theme_location'  => 'filter',
											'menu'            => 'filter', 
											'container'       => false, 
											'menu_class'      => '', 
											'fallback_cb'     => '__return_empty_string',
											'depth'           => 2,
											'walker'=> new Filter(),
										  ) );
										}
										?>

										<input type="hidden" id="cat_filter" class="each_filter" name="cat_filter" value="<?php echo $_GET['cat_filter']; ?>" />
									</div>
								</div>


								<?php
									$args = array(
										'type'         => 'post',
										'taxonomy'     => 'type_color',
									);
									$color = get_categories( $args );
									if( $color ){
								?>
									<div class="item color-goods">
										<h4>По цвету</h4>
										<div class="shell-color" id="color_select">
											<?php 
											$coun_f = $_GET['color_filter'];
											foreach( $color as $col ){ 
												if( $coun_f == $count->term_id ) {
													$select = 'class="selected_color"';
												} else {
													$select = '';
												}

												$bg_color = get_field('color_cat', 'type_color_'.$col->term_id);
												if( $bg_color ) {
													echo '<a href="#" data-colorid="'.$col->term_id.'" '.$select.' style="background: '.$bg_color.'"></a>';
												}
											} ?>
											<input type="hidden" id="color_filter" class="each_filter" name="color_filter" value="<?php echo $_GET['color_filter']; ?>" />
										</div>
									</div>
								<?php } ?>

								<?php
									$args = array(
										'type'         => 'post',
										'taxonomy'     => 'type_alphabet',
									);
									$letter = get_categories( $args );
									if( $letter ){
								?>
									<div class="item alphabet">
										<h4>По алфавиту</h4>
										<div class="alphabet-list" id="letter_select">
											<?php 
											$coun_l = $_GET['letter_filter'];
											foreach( $letter as $col_l ){
												if( $coun_l == $col_l->term_id ) {
													$select = 'class="selected_letter"';
												} else {
													$select = '';
												}
	
												if(preg_match('/^[a-zA-Z]$/', $col_l->name)){$eng .= '<a href="#" data-letterid="'.$col_l->term_id.'" '.$select.'>'.$col_l->name.'</a> '; }
								if(preg_match('/^[а-яА-Я]$/u', $col_l->name)){$rus .= '<a href="#" data-letterid="'.$col_l->term_id.'" '.$select.'>'.$col_l->name.'</a> '; }
													
											} echo $eng; if($eng){echo '<br><br>';} echo $rus; ?>
											<input type="hidden" id="letter_filter" class="each_filter" name="letter_filter" value="<?php echo $_GET['letter_filter']; ?>" />
										</div>
									</div>
								<?php } ?>

								<?php
									$args = array(
										'type'         => 'post',
										'taxonomy'     => 'prod_country',
									);
									$country = get_categories( $args );
									if( $country ){
								?>
									<div class="item country">
										<h4>По стране</h4>
										<div class="select-group">
											<select name="country_filter" id="country_filter" class="each_filter">
												<option>Выбрать страну</option>
												<?php 
												$coun_f = $_GET['country_filter'];
												foreach( $country as $count ){ 
													if( $coun_f == $count->term_id ) {
														$select = 'selected';
													} else {
														$select = '';
													}
													echo '<option value="'.$count->term_id.'" '.$select.'>'.$count->name.'</option>';
												} ?>
											</select>
										</div>	
									</div>
								<?php } ?>


								<?php
									$args = array(
										'type'         => 'post',
										'taxonomy'     => 'type_binding',
									);
									$fact = get_categories( $args );
									if( $fact ){
								?>
									<div class="item type-facture">
										<h4>ТИП фактуры</h4>
										<div class="select-group">
											<select name="facture_filter" id="facture_filter" class="each_filter">
												<option>Выбрать фактуру</option>
												<?php 
												$fact_f = $_GET['facture_filter'];
												foreach( $fact as $t ){ 
													if( $fact_f == $t->term_id ) {
														$select = 'selected';
													} else {
														$select = '';
													}
													echo '<option value="'.$t->term_id.'" '.$select.'>'.$t->name.'</option>';
												} ?>
											</select>
										</div>	
									</div>
								<?php } ?>



								<?php
									$args = array(
										'type'         => 'post',
										'taxonomy'     => 'type_material',
									);
									$type = get_categories( $args );
									if( $type ){
								?>
									<div class="item">
										<h4>материал</h4>
										<ul class="list-category" id="material_select">
											<?php 
											$mat_f = $_GET['material_filter'];
											foreach( $type as $t ){ 
												if( $mat_f == $t->term_id ) {
													$select = 'class="selected_cat"';
												} else {
													$select = '';
												}
												echo '<li '.$select.'><a href="#" data-material="'.$t->term_id.'">'.$t->name.'</a></li>';
											} ?>
										</ul>
										<input type="hidden" id="material_filter" class="each_filter" name="material_filter" value="<?php echo $_GET['material_filter']; ?>" />
									</div>
								<?php } ?>


								<!-- <button type="submit">ok</button> -->
								<?php if( get_field('page_catalog', 'option') ) { 
									$local = get_field('page_catalog', 'option'); 
								} ?>
								<input type="reset" class="btn bg-orange" id="reset_filter" data-local="<?php echo $local; ?>" value="СБРОСИТЬ ФИЛЬТР">						

							</form>
						<?php } else {
							echo '<div>Выберите страницу результатов фильтра в настройках вашей темы.</div>';
						} ?>

					</div>

				</div>





				<div class="col-lg-9">

					<?php
						global $paged;

						if ($_GET && !empty($_GET)) {

							$args = array(
								'posts_per_page' => 9,
								'paged' => $paged,
								'orderby' => 'title',
								'order' => 'ASC'
							);
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

								// Фильтр по алфавиту
								if($_GET['letter_filter']){
									$args['tax_query'][] = array(
									    'taxonomy'  => 'type_alphabet', // слаг таксономии, например category
									    'field'     => 'id', // по какому полю таксономии фильтровать можно slug или id
									    'terms' => array($_GET['letter_filter']), // пост должен принадлежать двум терминам с id 23 и 24
									    'operator' => 'AND', // одновременно, можно IN - тогда хотя бы одному термину
									    'include_children' => false // чтобы работало для иерархических таксономий
									);
								}

								if ($_GET['search'] != '') { // если передано поле "Ключевое слово"
									$args['s'] = $_GET['search']; // пешем значение в ключ "s" условий выборки, обратите внимание это уже не произвольное поле для meta_query, будет работать как обычный поиск + остальные условия
								}
			
						} else {
							
							$args = array(
								'post_type' => 'post',
								'posts_per_page' => 9,
								'paged' => $paged,
								'orderby' => 'title',
								'order' => 'ASC'
							);
						} // end if


						

						$filter = new WP_Query( $args ); 

						if( $filter->have_posts() ) {
					?>

					<div class="default-shell to-price">

						<?php 
							while( $filter->have_posts() ) : $filter->the_post(); 
								$thumb_id = get_post_thumbnail_id();
								$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
						?>

							<!--.view-box-->
							<div class="view-box active">
								<div class="inset-box">
									<div class="foto" style="background-image: url(<?php echo $thumb_url[0]; ?>)"><a href="<?php the_permalink(); ?>"></a><?php if(get_field('action')){ ?><div class="icon-action" style="<?php if(get_field('action') == 'action'){echo 'background-image: url(\'/wp-content/themes/magma_theme/img/action.png\');';} ?>"></div><?php } ?></div>
									<?php 
										$terms = get_the_term_list( $post->id, 'category', '', ', ', '' );
										if( $terms ) {
											echo '<div class="name-goods">';
											echo strip_tags($terms );
											echo '</div>';
										}
									?>
									<div class="title-goods"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
									<?php 
										if( get_field('sale_price') || get_field('sale_price_euro') ) {
											if( get_field('sale_price_euro') ){
												$price = get_conversion( 'number='.str_replace( " ", "", get_field('sale_price_euro')) );  $price = str_replace( ",", " ", $price);
											} else {
												$price = get_field('sale_price');
											}
										} else {
											if( get_field('price_euro') ){
												$price = get_conversion( 'number='.str_replace( " ", "", get_field('price_euro')) ); $price = str_replace( ",", " ", $price);
											} else {
												$price = get_field('price');
											}
										}

										if( $price ) { echo '<div class="price-goods">'.$price.' руб.</div>'; } 
									?>
								</div>
								<div class="more-inform-product"><a href="<?php the_permalink(); ?>" class="btn">подробнее</a></div>
							</div><!--End .view-box-->

						<?php endwhile; ?>
						

					</div>

					<?php } else {
						echo '<div class="no-post">Товаров с заданными параметрами не найдено.<br /><br />';
							if( get_field('page_catalog', 'option') ) {
								echo '<a href="'.get_field('page_catalog', 'option').'">Вернуться в каталог</a><br /><br />';
							}
							echo '<a href="'.home_url('/').'">Вернуться на главную</a>';
						echo '</div>';
					} ?>


					<!--.pagination-->
					<?php kama_pagenavi('', '', 1, array(), $filter); ?>
					<!--End.pagination-->
				</div>
			</div>
		</div>
	</section><!--End .catalog-section-->




<?php get_footer(); ?>