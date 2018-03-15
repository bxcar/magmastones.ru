<?php 
	/*
	* Template Name: Блог
	*/
	get_header(); 
?>




	<!--.breadcrumb-section-->
	<section class="breadcrumb-section">
		<div class="container">
			<nav class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
				<a href="<?php echo home_url('/'); ?>" class="breadcrumb-item" itemtype="http://schema.org/ListItem" itemprop="item">Главная</a>
				<sep class="kb_sep"> &gt;&gt; </sep>
				<span class="kb_title breadcrumb-item active">Блог</span>
			</nav>
		</div> 
	</section>
	<!--End .breadcrumb-section-->


	<!--.blog-detailed-section-->
	<section class="blog-detailed-section">
		<div class="container">
			<div class="title-section"><h2>Блог</h2></div>
			<div class="shell-col">



				<?php
					global $paged;

					$args = array(
						'post_type' => 'blog',
						//'post_status' => 'public',
						'posts_per_page' => 4,
						'paged' => $paged
					);


					$blog = new WP_Query($args);

					if( $blog->have_posts() ) {
						while( $blog->have_posts() ) : $blog->the_post(); 
							$thumb_id = get_post_thumbnail_id();
							$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
				?>

					<!--.item-->
					<div class="item">
						<div class="row">
							<div class="col-lg-4 col-md-4">
								<div class="foto" style="background-image: url(<?php echo $thumb_url[0]; ?>)"></div>
							</div>
							<div class="col-lg-8 col-md-8">
								<div class="detailed-item">
									<div class="date"><?php the_time('d.m.Y'); ?></div>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									
									<?php echo kama_excerpt(); ?>

									<a href="<?php the_permalink(); ?>" class="btn more-link">подробнее</a>
								</div>
							</div>
						</div>
					</div><!--End .item-->

				<?php endwhile; 
					wp_reset_query(); 
				} else {
					echo '<div class="no-post">Записи отсутствуют. <a href="'.home_url('/').'">Вернуться на главную</a></div>';
				}   

					kama_pagenavi('', '', 1, array(), $blog);
				?>


			</div>
		</div>
	</section><!--End .blog-detailed-section-->




<?php get_footer(); ?>