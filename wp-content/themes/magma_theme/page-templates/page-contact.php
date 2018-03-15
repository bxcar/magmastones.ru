<?php
	/*
	* Template Name: Контакты
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


	<?php while( have_posts() ) : the_post(); ?>

	<!--.contact-section-->
	<section class="contact-section">
		<div class="container">
			<div class="title-section"><h2 id="contact"><?php the_title(); ?></h2></div>
				<div class="shell">
					<div class="row">
						<div class="col-lg-5 col-md-5">
							<div class="item contact-box">
								<address>
									<?php if( get_field('address') ) { echo '<p><strong>Адрес:</strong> <span>'.get_field('address').'</span></p>'; } ?>
									<?php if( have_rows('tels') ) { ?>
									<p>
										<strong>Телефоны:</strong>
										<span>
											<?php 
											$count = 0;
											while ( have_rows('tels') ) : the_row(); 
											$count++;
											if( $count > 1 ) {
												$br = '<br>';
											}
												echo $br.'<a href="tel:'.get_sub_field('tel').'">'.get_sub_field('tel').'</a>';
											endwhile; ?>
										</span>
									</p>
									<?php } ?>
									<?php if( get_field('email') ) { echo '<p><strong>E-mail:</strong><span><a href="mailto:'.get_field('email').'">'.get_field('email').'</a></span></p>'; } ?>
									<?php if( get_field('time') ) { echo '<p><strong>Время работы:</strong><span>'.get_field('time').'</span></p>'; } ?>
								</address>	
							</div>
			
			
							<div class="contact-form" style="border: 1px solid #C5C5C5;">
								<div class="contact-form-header"><p>Закажите обратный звонок специалиста:</p></div>
					<div class="contact-form-title">Оставьте свой контактный номер телефона и мы перезвоним вам в ближайшее время!</div>
					<div class="contact-form-title2">Ваш телефон:</div>
								<form action="<?php echo get_template_directory_uri(); ?>/inc/mail.php" id="contactForm">
									<div class="form-group"><input type="tel" class="requered" id="popupTel" name="popupTel" placeholder="+7 - (___) - ___ - __ - __"></div>
						<div class="form-group"><textarea class="requered" id="popupName" name="popupName" placeholder="Пожалуйста, представьтесь и опишите суть Вашего обращения"></textarea></div>
						<input type="hidden" id="popupCaptcha" name="popupCaptcha">
						<div class="form-group" id="popupSend_mess"></div>
						<div class="form-group-submit"><button class="submitBtn" id="popupSubmit">Заказать обратный звонок</button></div>
								</form>
							</div>


						</div>

						<?php
							$location = get_field('maps');
							if( !empty($location) ) {
						?>
							<div class="col-lg-7 col-md-7">
								<div class="item">
									<!--<div class="mapya" id="mapya" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>-->
									<div class="mapya" id="mapya"><script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ac219384b02dfaf76a0e9761f20221c24970c56240207d43c21ff9762b1d2efd7&amp;width=100%25&amp;height=656&amp;lang=ru_RU&amp;scroll=true"></script></div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
		</div>
	</section><!--End .contact-section-->
	<?php endwhile; ?>


	


<?php get_footer(); ?>
