<?php
	/*
	* Template Name: Акции
	*/
	get_header();
?>

	<!--.pre-header-->
	<section class="pre-header" style="background-image: url(<?php echo get_field('banner'); ?>);">
		<div class="container">
			<?php if( get_field('text_banner') ) {
				echo '<div class="view-title">';
					echo '<h1>'.get_field('text_banner').'</h1>';
				echo '</div>';
			} ?>
		</div>
	</section><!--.pre-header-->

	<!--.breadcrumb-section-->
	<?php if( function_exists('kama_breadcrumbs') && !is_front_page() ) { ?>
	<section class="breadcrumb-section">
		<div class="container">
			<?php echo kama_breadcrumbs(' >> '); ?>
		</div> 
	</section>
	<?php } ?><!--End .breadcrumb-section-->

	<!--.catalog-section-->
	<section class="catalog-section">
		<div class="container">
			<!--<div class="title-section"><h2>Каталог</h2></div>-->


			<div class="row">

				<div class="col-lg-9" style="float: none; margin: 0 auto;">

					<?php
						global $paged;
						$args = array(
							'post_type' => 'post',
							//'post_status' => 'public',
							'posts_per_page' => 9,
							'paged' => $paged,
							'orderby' => 'title',
							'order' => 'ASC',
							'meta_query' => array (
								array (
									'key' => 'action',
									'value' => array('action', 'hit', 'sale'),
									'compare' => 'IN'
								)
							)
						);

						$prod = new WP_Query($args);

						if( $prod->have_posts() ) {
					?>

					<div class="default-shell to-price">

						<?php 
							while( $prod->have_posts() ) : $prod->the_post(); 
								$thumb_id = get_post_thumbnail_id();
								$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
						?>

							<!--.view-box-->
							<div class="view-box active">
								<div class="inset-box">
									<div class="foto" style="background-image: url(<?php echo $thumb_url[0]; ?>)"><a href="<?php the_permalink(); ?>"></a><?php if(get_field('action')){ ?><div class="icon-action" style="<?php if(get_field('action') == 'action'){echo 'background-image: url(\'/wp-content/themes/magma_theme/img/action.png\');';} ?>"></div><?php } ?></div>
									<?php 
										$terms = get_the_term_list( $post->id, 'category', '', ', ', '' );
										if( $terms ) {
											echo '<div class="name-goods">';
											echo strip_tags($terms );
											echo '</div>';
										}
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

						<?php endwhile; ?>
						

					</div>

					<?php } else {
						echo '<div class="no-post">Записи отсутствуют. <a href="'.home_url('/').'">Вернуться на главную</a></div>';
					} ?>


					<!--.pagination-->
					<?php kama_pagenavi('', '', 1, array(), $prod); ?>
					<!--End.pagination-->
				</div>
			</div>
		</div>
	</section><!--End .catalog-section-->


	<?php //while( have_posts() ) : the_post(); ?>
		
		
		<?php /* <section class="akcii-section">
			<!--.container-->
			<div class="container">


			<?php 
				if( have_rows('block_actions') ) { 
					while( have_rows('block_actions') ) : the_row();
					$title = get_sub_field('name_block');
					$prod = get_sub_field('cat_action');
			?>

				<!--.akcii-view-->
				<div class="akcii-view">	

					<?php if( $title ) { echo '<div class="title-section"><h2>'.$title.'</h2></div>'; } ?>


					<?php //var_dump($prod); ?>

					<!--.panel-list-goods-->
					<?php if( $prod ) { ?>
						<div class="panel-list-goods head_action">
							<ul>
								<?php
								$count = 1;
								foreach( $prod as $p ) {
									if($count == 1 ) {
										$class = 'class="selected"';
										$first_cat = $p->term_id;
									} else {
										$class = '';
									}
									echo '<li '.$class.'><a href="#" data-catid="'.$p->term_id.'">'.$p->name.'</a></li>';
									$count++;
								} ?>
							</ul>
						</div><!--End .panel-list-goods-->

						<?php
						$args = array(
							'post_type' => 'post',
							'posts_per_page' => -1,
							'cat' => $first_cat,
							'meta_query' => array(
								array(
									'key' => 'sale_price',
									'value' => '0',
									'compare' => '>'
								)
							)
						);

						$action = new WP_Query($args);
						if( $action->have_posts() ) {
						?>
							

							<div class="default-shell to-price">
								<?php 
									while( $action->have_posts() ) { $action->the_post(); 
									if( get_field('sale_price') != '' ) {
										$thumb_id = get_post_thumbnail_id();
										$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
								?>
									<!--.view-box-->
									<div class="view-box">
										<div class="inset-box">
											<div class="foto" style="background-image: url(<?php echo $thumb_url[0]; ?>)"><a href="<?php the_permalink(); ?>"></a></div>
											<?php 
												$args = array(
													'taxonomy' => 'category',
												);
												$terms = get_terms( $args );
												if( $terms ) {
													echo '<div class="name-goods">';
													$count = 0;
													foreach( $terms as $t ){ 
														$count++;
														if( $count > 1 ) { $sep = ', '; } else { $sep = ''; }
														echo $sep . $t->name;
													}
													echo '</div>';
												}
											?>
											<div class="title-goods"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
											<?php 
												$price = get_field('sale_price');
												if( $price ) { echo '<div class="price-goods">'.$price.' руб.</div>'; } 
											?>
										</div>
										<div class="more-inform-product"><a href="<?php the_permalink(); ?>" class="btn">подробнее</a></div>
									</div><!--End .view-box-->
								<?php 
									} //end if field
									} //endwhile; 
									wp_reset_query(); 
								?>
								
							</div>
							<?php } ?><!-- // end if have_posts -->

					<?php } ?><!-- // end if $prod -->
				</div><!--End .akcii-view-->

			<?php 
					endwhile;
				}
			?>


			</div><!--End .container-->
			
		</section> */ ?>
	<?php //endwhile; ?>




<?php get_footer(); ?>