<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
        <meta name="yandex-verification" content="ba9318cf07d2bba3" />
	<title><?php wp_title(); //bloginfo('name'); ?> <?php //is_home() ? bloginfo('description') : wp_title('|'); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php
	if( get_field('favicon', 'option') ) {
		echo '<link rel="shortcut icon" href="'.get_field('favicon', 'option').'" type="image/x-icon">';
	} else {
		echo'<link rel="shortcut icon" href="'.get_template_directory_uri().'/img/favicon/favicon.ico" type="image/x-icon">';
	}
	?>	
	
	<?php wp_head(); ?>
</head>
<link rel="stylesheet" href="https://cdn.envybox.io/widget/cbk.css">
<script type="text/javascript" src="https://cdn.envybox.io/widget/cbk.js?wcb_code=621bb02073bd51dd32482c68f9e69a73" charset="UTF-8" async></script>
<body <?php body_class(); ?> >
	<!--.header-->
	<header class="header">
		<!--.top-panel-->
		<div class="top-panel">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-6 col-sm-5 col-xs-12 hidden-xs" style="padding-top: 2px;">
						<div class="item">
							<?php if( get_field('address', 'option') ) { echo '<a href="'.get_page_link(21).'#contact" style="color: #fff; text-decoration: none;"><address>'.get_field('address', 'option').'</address></a>'; } ?>
							<?php if( get_field('time_work', 'option') ) { echo '<span>'.get_field('time_work', 'option').'</span>'; } ?>
						</div>
					</div>
					<div class="col-lg-7 col-md-6 col-sm-7 col-xs-12">
						<div class="item contact-inform">

							<?php if( get_field('email', 'option') ) { echo '<a href="mailto:'.get_field('email', 'option').'" class="mailto">'.get_field('email', 'option').'</a>'; } ?>

							<div class="call-box">
								<?php if( get_field('head_tel', 'option') ) { echo '<a href="tell:'.get_field('head_tel', 'option').'" class="number-call" style="margin-right: 10px;">'.get_field('head_tel', 'option').'</a>'; } ?>
								
							</div>

							<a  href="#feedback" data-target="#feedback" class="btn show_popup" id="header-feedback" style="margin: 0; padding: 3px 10px 4px 10px; font-size: 14px; border-radius: 5px; font-weight: normal; text-transform: none; margin-right: 5px; top: 1px;">заказать звонок</a>

							<div class="network-box">
								<?php if( get_field('vkontakte', 'option') ) { echo '<a href="'.get_field('vkontakte', 'option').'" target="_blank"><img src="'.get_template_directory_uri().'/img/vk.png" alt=""></a>'; } ?>
								<?php if( get_field('instagram', 'option') ) { echo '<a href="'.get_field('instagram', 'option').'" target="_blank"><img src="'.get_template_directory_uri().'/img/ins.png" alt=""></a>'; } ?>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div><!--End .top-panel-->
		<!--.bottom-panel-->
		<div class="bottom-panel">
			<div class="container">

				<!--.shell-item-->
				<div class="shell-item">
					
					<!--.item-->
					<div class="item">
						<div class="logo">
							<a href="<?php echo home_url('/'); ?>">
								<?php if( get_field('head_logo', 'option') ) { 
									echo '<img src="'.get_field('head_logo', 'option').'" alt="">';
								} else {
									echo '<img src="'.get_template_directory_uri().'/img/logo.png" alt="">';
								} ?>
							</a>
						</div>
						<!--.hamburger--> 
						<div class="hamburger">
							<span></span>
						</div><!--End .hamburger-->
					</div><!--End .item-->

					<!--.item-->
					<div class="item">
						<nav class="menu-top">
							<?php
								wp_nav_menu( array(
								'theme_location'  => 'primary',
								'menu'            => 'primary', 
								'container'       => false, 
								'menu_class'      => '', 
								'fallback_cb'     => '__return_empty_string',
								//'depth'           => 1,
							  ) );
							?>
						</nav>
					</div><!--End .item-->

					<!--.item-->
					<div class="item">
						<form action="<?php echo home_url('/'); ?>">
							<div class="form-group">
								<input type="search" id="s" name="s" placeholder="Поиск" style="padding: 8px 45px 8px 15px;">
								<input type="submit" name="" style="right: 13px; top: 8px;">
							</div>
						</form>
					</div><!--End .item-->

				</div><!--End.shell-item-->




			</div>
		</div><!--End .bottom-panel-->
	</header><!--End .header-->	
