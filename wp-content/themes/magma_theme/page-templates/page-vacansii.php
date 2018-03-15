<?php
	/*
	* Template Name: Вакансии
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



	<!--.vacancies-section-->
	<section class="vacancies-section">
		<div class="container">

			<?php  
				while( have_posts() ) : the_post(); 
				if( get_field('title_page') ) {
					$title = get_field('title_page');
				} else {
					$title = get_the_title();
				}
			?>

				<div class="title-section"><h2><?php echo $title; ?></h2></div>
				<div class="pre-title">
					<?php the_content(); ?>
				</div>
			<?php 
				endwhile; 
				wp_reset_query();
			?>


			<?php
				global $paged;

				$args = array(
					'post_type' => 'vacancies',
					'posts_per_page' => 8,
					'paged' => $paged
				);


				$blog = new WP_Query($args);

				if( $blog->have_posts() ) {

					echo '<div class="shell">';

					while( $blog->have_posts() ) : $blog->the_post(); 
			?>

			

				<!--.item-->
				<div class="item">
					<div class="date"><?php the_time('d.m.Y'); ?></div>
					<div class="status-user"><h3><?php the_title(); ?></h3></div>
					<div class="text"><?php the_content(); ?></div>
				</div><!--End .item-->

			<?php 
				endwhile;
				echo '</div>';
				wp_reset_query(); 
			} else {
				echo '<div class="no-post">На данный момент открытых вакансий нет. <a href="'.home_url('/').'">Вернуться на главную</a></div>';
			}   

				kama_pagenavi('', '', 1, array(), $blog);
			?>
			
		</div>
	</section><!--End .vacancies-section-->


<?php get_footer(); ?>