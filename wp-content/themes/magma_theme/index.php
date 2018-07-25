<?php get_header(); ?>




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

			<div class="row">
				<div class="col-lg-3">
					<button class="btn tofilter" id="tofilter">Развернуть фильтр</button>
					<div class="filter-goods">

						<div class="item">
							<form action="<?php echo home_url('/'); ?>">
								<div class="form-group">
									<input type="search" name="s" placeholder="Поиск">
									<input type="submit" name="">
								</div>
							</form>
						</div>

						<?php if( get_field('page_filter', 'option') ) { ?>
							<form action="<?php echo get_field('page_filter', 'option'); ?>" id="filter_form" method="GET">
								<div class="item">
									<div class="list-category" id="prod_category">
										<h4>Каталог камня</h4>
										<?php
											wp_nav_menu( array(
											'theme_location'  => 'filter',
											'menu'            => 'filter', 
											'container'       => false, 
											'menu_class'      => '', 
											'fallback_cb'     => '__return_empty_string',
											//'depth'           => 1,
											'walker'=> new Filter(),
										  ) );
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
												echo '<li '.$select.'><a href="#" data-material="'.$t->term_id.'">'.$t->name.' '.$t->count.'</a></li>';
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
						$args = array(
							'post_type' => 'post',
							//'post_status' => 'public',
							'posts_per_page' => 9,
							'paged' => $paged
						);

						$prod = new WP_Query($args);

						if( $prod->have_posts() ) {
					?>

					<div class="default-shell to-price">

						<?php 
							while( $prod->have_posts() ) : $prod->the_post(); 
								$thumb_id = get_post_thumbnail_id();
								$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
						?>

							<!--.view-box-->
							<div class="view-box active">
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
										if( get_field('sale_price') ) {
											$price = get_field('sale_price');
										} else {
											$price = get_field('price');
										}

										if( $price ) { /*echo '<div class="price-goods">'.$price.' руб.</div>';*/ } 
									?>
								</div>
								<div class="more-inform-product"><a href="<?php the_permalink(); ?>" class="btn">подробнее</a></div>
							</div><!--End .view-box-->

						<?php endwhile; ?>
						

					</div>

					<?php } else {
						echo '<div class="no-post">Записи отсутствуют. <a href="'.home_url('/').'">Вернуться на главную</a></div>';
					} ?>


					<!--.pagination-->
					<?php kama_pagenavi('', '', 1, array(), $prod); ?>
					<!--End.pagination-->
				</div>
			</div>
		</div>
	</section><!--End .catalog-section-->




<?php get_footer(); ?>