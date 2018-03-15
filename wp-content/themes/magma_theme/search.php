<?php get_header(); ?>




	<!--.breadcrumb-section-->
	<?php if( function_exists('kama_breadcrumbs') && !is_front_page() ) { ?>
	<section class="breadcrumb-section">
		<div class="container">
			<?php echo kama_breadcrumbs(' >> '); ?>
		</div> 
	</section>
	<?php } ?><!--End .breadcrumb-section-->


	<!--.search-section-->
	<section class="search-section">
		<div class="container">
			<div class="title-section"><h2>Поиск</h2></div>
			<!--.shell-form-search-->
			<div class="shell-form-search">
				<form action="<?php echo home_url('/'); ?>">
					<div class="form-group">
						<input type="search" name="s" placeholder="Поиск" value="<?php the_search_query(); ?>">
						<input type="submit" name="">
						<!-- div class="help-block">Необходимо заполнить поле «Поиск»</div -->
					</div>
				</form>
				<?php if( !have_posts() ) { echo '<div class="resultsearch">По вашему запросу ничего не найдено</div>'; } ?>
			</div><!--End .shell-form-search-->

			<?php if( have_posts() ) { ?>
			<!--.shell-->
			<div class="shell">

				<?php while( have_posts() ) : the_post(); ?>

					<!--.item-->
					<div class="item">
						<div class="title"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
						<div class="text"><?php echo kama_excerpt(); ?></div>
					</div><!--End .item-->

				<?php 
					endwhile; 
					wp_reset_query();
				?>
				
			</div><!--End .shell-->
			<?php } ?>
			
			<?php kama_pagenavi(); ?>
			
		</div>
	</section><!--End .search-section-->


<?php get_footer(); ?>