<?php 
	/*
	* Template Name: О нас
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



	
	<!--.about-section-->
	<section class="about-section">
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
				<div class="shell">
					<div class="row">
						<div class="col-lg-12">
							<article>
								<?php the_content(); ?>						
							</article>
						</div>
					</div>
				</div>

			<?php endwhile; ?>

		</div>
	</section><!--.about-section-->



<?php get_footer(); ?>