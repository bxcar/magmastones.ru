<?php 
	/*
	* Template Name: Главная
	*/
	get_header(); 
?>


	<!--.slider-main-->
	<?php
		$args = array(
			'post_type' => 'slider',
			'posts_per_page' => -1
		);

		$slider = new WP_Query( $args );

		if( $slider->have_posts() ) {
	?>
	<section class="slider-main-page" id="slider-main-page">

		<?php while( $slider->have_posts() ) : $slider->the_post(); ?>

			<div class="item">
				<div class="slide" style="background-image: url(<?php echo get_field('bg_slider'); ?>)">
					<div class="slide-description">
						<h1><?php the_title(); ?></h1>
						<div class="pre-title">
							<?php the_content(); ?>
						</div>
						<?php if( get_field('link_slider') ) { echo '<a href="'.get_field('link_slider').'" class="btn">открыть каталог</a>'; } ?>
					</div>
				</div>
			</div>

		<?php 
			endwhile; 
			wp_reset_query();
		?>
		
	</section>
	<?php } ?><!--End.slider-main-->



<?php while( have_posts() ) : the_post(); ?>
	<!--.info-goods-section-->
	<section class="info-goods-section">
		<div class="container">
			<div class="title">
				<?php if( get_field('title_prod') ) { echo '<h2><span>'.get_field('title_prod').'</span></h2>'; } ?>
				<?php if( get_field('page_about', 'option') ) { echo '<a href="'.get_field('page_about', 'option').'" class="link-next">подробнее о нас</a>'; } ?>
			</div>
			<?php if( get_field('desc_prod') ) { echo get_field('desc_prod'); } ?>
		</div>
	</section><!--End .info-goods-section-->

	<!--.search-section-link-->
	<section class="search-section-link tobg">
		<div class="container">
			<?php if( get_field('page_filter', 'option') ) { ?>
				<form action="<?php echo get_field('page_filter', 'option'); ?>" id="custom_searsch_form" method="GET">
					<input type="search" id="search" class="each_filter" name="search" placeholder="Введите название">
					<input type="hidden" id="cat_filter" class="each_filter" name="cat_filter" value="" />
				</form>

				<?php 
					$args = array(
						'taxonomy' => 'category',
						'hide_empty'    => false,
						'order' => 'desc'
					);
					$terms = get_terms( $args );

					if( $terms ) {
						echo '<ul id="list_cat_form" class="item-link">';
							foreach( $terms as $t ){ 
								if( get_field('show_form_cat', 'category_'.$t->term_id) == 1 ) {
									echo '<li><a href="#" data-id="'.$t->term_id.'">'.$t->name.'</a></li>';
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
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 4,
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
		);

		$prod = new WP_Query( $args );

		if( $prod->have_posts() ) {
	?>
	<section class="popular-goods-section">
		<div class="container">
			<div class="title">
				<h2><span>Популярные товары</span></h2>
				<?php if( get_field('page_catalog', 'option') ) { echo '<a href="'.get_field('page_catalog', 'option').'" class="link-next">смотреть все</a>'; } ?>
			</div>

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

							echo '<div class="name-goods">';
							$terms = get_the_term_list( get_the_ID(), 'category', '', ', ', '' ); echo strip_tags($terms );
							echo '</div>';

							
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

				<?php 
					endwhile; 
					wp_reset_query();
				?>

			</div>

		</div>
	</section>
	<?php } ?><!--End .popular-goods-section-->



	<!--.our-projects-->
	<?php
		$args = array(
			'post_type' => 'project',
			'posts_per_page' => 4
		);

		$project = new WP_Query( $args );

		if( $project->have_posts() ) {
	?>
	<section class="our-projects-section">
		<div class="container">
			<div class="title">
				<h2><span>наши проекты</span></h2>
				<?php if( get_field('page_project', 'option') ) { echo '<a href="'.get_field('page_project', 'option').'" class="link-next">Смотреть еще</a>'; } ?>
			</div>
			<div class="default-shell project-inform">

				<?php 
					while( $project->have_posts() ) : $project->the_post(); 
						$thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
				?>
					<!--.view-box-->
					<div class="view-box">
						<div class="inset-box">
							<div class="foto" style="background-image: url(<?php echo $thumb_url[0]; ?>)"><a href="<?php the_permalink(); ?>"></a></div>
							<div class="description"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
							<?php if( get_field('materials') ) { echo '<div class="name-goods">'.get_field('materials').'</div>'; } ?>
						</div>
						<div class="more-inform-product"><a href="<?php the_permalink(); ?>" class="btn">подробнее</a></div>
					</div><!--End .view-box-->
				<?php 
					endwhile; 
					wp_reset_query();
				?>

			</div>
		</div>
	</section>
	<?php } ?><!--End .our-projects-->

	<!--.advantages-section-->
	<section class="advantages-section tobg">
		<div class="container">
		<?php if( get_field('title_sclad') ) { echo '<div class="title"><h2>'.get_field('title_sclad').'</h2></div>'; } ?>

		<?php if( have_rows('sclad_items') ) { ?>
		<div class="shell">
			<div class="row">
				<?php while( have_rows('sclad_items') ) : the_row(); ?>

					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="item">
							<?php if( get_sub_field('title_item') ) { echo '<h4>'.get_sub_field('title_item').'</h4>'; } ?>
							<?php if( get_sub_field('desc_item') ) { echo '<p>'.get_sub_field('desc_item').'</p>'; } ?>
						</div>
					</div>

				<?php endwhile; ?>
			</div>
		</div>
		<?php } ?>

		</div>
	</section><!--End .advantages-section-->


	<!--.advantages-company-section-->
	<section class="advantages-company-section">
		<div class="container">
			<div class="title">
				<?php if( get_field('title_preim') ) { echo '<h2><span>'.get_field('title_preim').'</span></h2>'; } ?>
				<?php if( get_field('page_about', 'option') ) { echo '<a href="'.get_field('page_about', 'option').'" class="link-next">подробнее о нас</a>'; } ?>
			</div>
			<?php if( have_rows('preims') ) { ?>
			<div class="shell">
				<div class="row">

					<?php while( have_rows('preims') ) : the_row(); ?>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="item">
								<?php if( get_sub_field('preim_icon') ) { echo '<div class="icon"><img src="'.get_sub_field('preim_icon').'" alt=""></div>'; } ?>
								<?php if( get_sub_field('preim_desc') ) { 
									$cont = get_sub_field('preim_desc');
									$cont = str_replace(array('<p>', '</p>'), '', $cont);
									echo '<div class="text">'.$cont.'</div>'; 
								} ?>
							</div>
						</div>
					<?php endwhile; ?>
					
				</div>
			</div>
			<?php } ?>

		</div>
	</section><!--End .advantages-company-section-->

<?php endwhile; ?>



	<?php
		$args = array(
			'post_type' => 'news',
			'post_status' => 'public',
			'posts_per_page' => 3,
		);


		$news = new WP_Query($args);

		if( $news->have_posts() ) {
	?>
	<!--.actual-news-section-->
	<section class="actual-news-section">
		<div class="container">
			<div class="title">
				<h2><span>актуальные новости</span></h2>
				<?php if( get_field('page_news', 'option') ) { echo '<a href="'.get_field('page_news', 'option').'" class="link-next">Смотреть еще</a>'; } ?>
			</div>
			<!--.default-shell-->
			<div class="default-shell md-size">

				<?php 
					while( $news->have_posts() ) : $news->the_post(); 
					$thumb_id = get_post_thumbnail_id();
					$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
				?>

					<!--.view-box-->
					<div class="view-box">
						<div class="inset-box">
							<div class="foto" style="background-image: url(<?php echo $thumb_url[0]; ?>)"><a href="#"></a></div>
							<div class="date"><?php the_time('d.m.Y'); ?></div>
							<div class="description"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
						</div>
						<div class="more-inform-product"><a href="<?php the_permalink(); ?>" class="btn">подробнее</a></div>
					</div><!--End .view-box-->
				
				<?php endwhile; ?>


			</div><!--End .default-shell-->
		</div>
	</section><!--End .actual-news-section-->
	<?php } ?>



<?php get_footer(); ?>