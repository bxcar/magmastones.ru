<?php get_header(); ?>




	<!--.breadcrumb-section-->
	<?php if( function_exists('kama_breadcrumbs') && !is_front_page() ) { ?>
	<section class="breadcrumb-section">
		<div class="container">
			<?php echo kama_breadcrumbs(' >> '); ?>
		</div> 
	</section>
	<?php } ?><!--End .breadcrumb-section-->


	<?php while( have_posts() ) : the_post(); ?>

	<!--.news-detailed-section-->
	<section class="news-detailed-section">
		<div class="container">
			<div class="title-section"><h2><?php the_title(); ?></h2></div>
			<div class="date-item"><?php the_time('d.m.Y'); ?></div>
			<div class="shell-col">
				<!--.item-->
				
						<?php the_content(); ?>
					
				


				<!-- div class="col-lg-4 col-md-4 ">
							<div class="foto" style="background-image: url(<?php //echo get_template_directory_uri(); ?>/img/new-1.jpg)"></div>
						</div>
						<div class="col-lg-8 col-md-8">
							<div class="detailed-item">
								<p><strong>Мрамор «Radica»</strong></p>
								<p><strong>Цвет: </strong>темно-коричневый с кружевным узором светлых и темных оттенков</p>
								<p><strong>Вид обработки: </strong>полировка</p>
								<p><strong>Размер плиты: </strong>2790*1220*20 мм</p>
								<p><strong>Количество: </strong>128 м2</p>
								<p><strong>Область применения: </strong> в интерьере в качестве облицовки стен, столешниц, подоконников, пола, ванных комнат, лестниц, барных стоек. Также этот мрамор популярен в интерьере в качестве декоративного панно.</p>
							</div>
						</div -->

			</div>
		</div>
	</section><!--End .news-detailed-section-->


	<?php endwhile; ?>




<?php get_footer(); ?>