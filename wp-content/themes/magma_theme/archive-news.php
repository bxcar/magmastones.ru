
<?php 
	/*
	* Template Name: Новости
	*/
	get_header();
?>

	<!--.pre-header-->
	<section class="pre-header">
		<div class="container">
			<div class="view-title">
				<h1>Новости</h1>
			</div>
		</div>
	</section><!--.pre-header-->

	<!--.breadcrumb-section-->
	<section class="breadcrumb-section">
		<div class="container">
			<nav class="breadcrumb">
				<a class="breadcrumb-item" href="<?php echo home_url('/'); ?>">Главная</a>
				<span class="breadcrumb-item active">Новости</span>
			</nav>
		</div> 
	</section>
	<!--End .breadcrumb-section-->


	<section class="news-section">

		<!--.container-->
		<div class="container">

			<?php
				global $paged;

				$args = array(
					'post_type' => 'news',
					'post_status' => 'public',
					'posts_per_page' => 9,
					'paged' => $paged
				);


				$news = new WP_Query($args);

				if( $news->have_posts() ) {
			?>

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
									<div class="foto" style="background-image: url(<?php echo $thumb_url[0]; ?>)"><a href="<?php the_permalink(); ?>"></a></div>
									<div class="date"><?php the_time('d.m.Y'); ?></div>
									<div class="description"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
								</div>
								<div class="more-inform-product"><a href="<?php the_permalink(); ?>" class="btn">подробнее</a></div>
							</div><!--End .view-box-->
							
						<?php endwhile; wp_reset_query(); ?>

					</div><!--End .default-shell-->

			<?php } else {
				echo '<div class="no-post">Записи отсутствуют. <a href="'.home_url('/').'">Вернуться на главную</a></div>';
			} ?>


			<?php kama_pagenavi('', '', 1, array(), $news); ?>


		</div><!--End .container-->
		
	</section>




<?php get_footer(); ?>