<?php 
	/*
	* Template Name: Проекты
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




<!--.project-section-->
<section class="project-section">
	<div class="container">
		<div class="title-section"><h2>Проекты</h2></div>

		<!--.panel-list-goods-->
		<?php 
			$args = array(
				'taxonomy' => 'project_cat',
				//'hide_empty'    => false,
			);
			$terms = get_terms( $args );

			if( $terms ) {
		?>
		<div class="panel-list-goods">
			<ul>
				<li class="selected"><a href="#" data-id="all">Все</a></li>
				<?php foreach( $terms as $t ){ 
					if( get_field('show_project_cat', 'project_cat_'.$t->term_id) == 1 ) {
						echo '<li><a href="#" data-id="'.$t->term_id.'">'.$t->name.'</a></li>';
					}
				} ?>
			</ul>
		</div>
		<?php } ?><!--End .panel-list-goods-->


		<div class="row">
			<div class="col-lg-3">
				<button class="btn toproject" id="toproject">Развернуть категории</button>
				<div class="project-goods">
					<div class="item">
						<form action="<?php echo home_url('/'); ?>">
							<div class="form-group">
								<input type="search" name="s" placeholder="Поиск">
								<input type="submit" name="">
								
							</div>
						</form>
						<div class="list-category">
							<h4>Каталог камня</h4>
							<?php
								wp_nav_menu( array(
								'theme_location'  => 'catalog',
								'menu'            => 'catalog', 
								'container'       => false, 
								'menu_class'      => '', 
								'fallback_cb'     => '__return_empty_string',
								'depth'           => 1,
								'walker'=> new Count(),
							  ) );
							?>
						</div>
					</div>

					<?php 
						$args = array(
							'taxonomy' => 'project_cat',
							//'hide_empty'    => false,
						);
						$terms = get_terms( $args );

						if( $terms ) {
					?>
					<div class="item">
						<div class="list-category">
							<h4>ПРОЕКТЫ</h4>
							<ul>
								<?php foreach( $terms as $t ){ 
									echo '<li><a href="'.get_term_link($t->term_id).'">'.$t->name.'</a></li>';
								} ?>
								<li><a href="<?php echo home_url(); ?>/proektyi/">Все проекты</a></li>
							</ul>
						</div>
					</div>
					<?php } ?>


				</div>

			</div>



			<div id="load_project" class="col-lg-9">
				<div class="default-shell project-inform">

					<?php
						global $paged;

						$args = array(
							'post_type' => 'project',
							//'post_status' => 'public',
							'posts_per_page' => 9,
							'paged' => $paged
						);


						$project = new WP_Query($args);

						if( $project->have_posts() ) {
							while( $project->have_posts() ) : $project->the_post(); 
								$thumb_id = get_post_thumbnail_id();
								$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
					?>

						<!--.view-box-->
						<div class="view-box">
							<div class="inset-box" style="height: 262px;">
							<div class="foto" style="background-image: url(<?php echo $thumb_url[0]; ?>)"><a href="<?php the_permalink(); ?>"></a></div>
								<div class="description"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
								<?php if( get_field('materials') ) { echo '<div class="name-goods">'.get_field('materials').'</div>'; } ?>
							</div>
							<div class="more-inform-product"><a href="<?php the_permalink(); ?>" class="btn">подробнее</a></div>
					</div><!--End .view-box-->

					<?php endwhile; 
						wp_reset_query(); 
					} else {
						echo '<div class="no-post">Записи отсутствуют. <a href="'.home_url('/').'">Вернуться на главную</a></div>';
					}   
					?>

				</div>

				<!--.pagination-->
				<?php kama_pagenavi('', '', 1, array(), $project); ?>
				<!--End.pagination-->

			</div>
		</div>
	</div>
</section><!--End .project-section-->


<?php get_footer(); ?>