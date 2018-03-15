<?php get_header(); ?>




<!--.breadcrumb-section-->
	<?php if( function_exists('kama_breadcrumbs') && !is_front_page() ) { ?>
	<section class="breadcrumb-section">
		<div class="container">
			<?php echo kama_breadcrumbs(' >> '); ?>
		</div> 
	</section>
	<?php } ?><!--End .breadcrumb-section-->



<!--.project-inset-section-->
<section class="project-inset-section">
	<div class="container">

		<?php while( have_posts() ) : the_post(); ?>

			<div class="title-section"><h2><?php the_title(); ?></h2></div>
			<div class="pre-title">Кварцкерамика, мрамор</div>


			<div class="shell">
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


					<div class="col-lg-9">
						<!--.view-foto-project-->
						<div class="view-foto-project">

							<?php 
								//remove_filter( 'the_content', 'wpautop' );
								the_content(); 
							?>
							
						</div><!--End.view-foto-project-->
					</div>
				</div>
			</div>

		<?php endwhile; ?>

	</div>
</section><!--End .project-inset-section-->



<?php get_footer(); ?>