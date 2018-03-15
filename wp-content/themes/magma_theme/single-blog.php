<?php get_header(); ?>




	<!--.breadcrumb-section-->
	<?php if( function_exists('kama_breadcrumbs') && !is_front_page() ) { ?>
	<section class="breadcrumb-section">
		<div class="container">
			<?php echo kama_breadcrumbs(' >> '); ?>
		</div> 
	</section>
	<?php } ?><!--End .breadcrumb-section-->



	<!--.blog-section-->
	<section class="blog-section">
		<div class="container">

			<?php while( have_posts() ) : the_post(); ?>

			<div class="title-section"><h2><?php the_title(); ?></h2></div>
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
	</section><!--.blog-section-->


<?php get_footer(); ?>