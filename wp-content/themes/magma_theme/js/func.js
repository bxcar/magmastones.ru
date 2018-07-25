$(document).ready(function() {
	popupsShow();
	/*________MAIN	PAGE________*/
	$(".menu-top ul > li").has("ul").addClass('to-has-child')

	$("#slider-main-page").slick({
		dots: true,
		infinite: true,
		slidesToShow: 1,
		adaptiveHeight: true,
		speed:1700,
	  autoplay:true
	});

	if(window.matchMedia('(min-width: 768px)').matches){
    $('.default-shell .inset-box').matchHeight();
  }
  $(window).resize(function() {
   	if(window.matchMedia('(min-width: 768px)').matches){
    	$('.default-shell .inset-box').matchHeight();
  	}
  });
  

  $(".hamburger").click(function(event) {
  	$(this).toggleClass('active');
  	$(".menu-top").toggleClass('active');

  	if($(".menu-top").hasClass("active")){
  		$(".menu-top").slideDown();
  	}else{
  		$(".menu-top").slideUp();
  	}
  });

  if(window.matchMedia('(min-width: 992)').matches){
		$(".menu-top").removeAttr('style');
	}
	$(window).resize(function() {
   	if(window.matchMedia('(min-width: 992)').matches){
			$(".menu-top").removeAttr('style');
		}
  });

	if(window.matchMedia('(max-width: 992px)').matches){
		$(".menu-top").removeAttr('style');
	}
	$(window).resize(function() {
		if(window.matchMedia('(max-width: 992px)').matches){
			$(".menu-top").removeAttr('style');
		}
	});
	/*________MAIN	PAGE________*/

	/*________PAGE AKCII________*/
	$(".head_action li").click(function(event) {
		event.preventDefault();
		var ThisElement = $(this).closest('.akcii-view').find('.default-shell');
		var selected = $(this).parent('ul').find('li.selected');

		if (!ThisElement.hasClass('selected')){
			ThisElement.fadeTo(50, 0);
			selected.removeClass('selected');
			$(this).addClass('selected');
		}

		var data = {
			'action': 'loadprod',
			'id': $(this).find('a').data('catid'),
		};
		$.ajax({
			url:ajax.url,
			data:data,
			type:'POST',
			success:function(data){
				if( data ) { 
					console.log('data: ' +data);
					ThisElement.hide().html(data).fadeTo(350, 1);
				} else {
					ThisElement.hide().html('<div class="no-post">В этой категории нету акционных товаров...</div>').fadeTo(350, 1);
				}
			}
		});

		//ThisElement.fadeTo(600, 1);
	});
	/*________END PAGE AKCII________*/
	
	/*________PAGE PROJECT________*/
	$(document).on("click", ".head_project li", function(event) {
		event.preventDefault();
		var ThisElement = $(this).closest('.project-section').find('.default-shell');
		var selected = $(this).parent('ul').find('li.selected');

		if (!ThisElement.hasClass('selected')){
			ThisElement.fadeTo(350, 0);
			selected.removeClass('selected');
			$(this).addClass('selected');
		}

		var data = {
			'action': 'loadproject',
			'id': $(this).find('a').data('id'),
		};

		$.ajax({
			url:ajax.url,
			data:data,
			type:'POST',
			success:function(data){
				if( data ) { 
					$("#load_project").hide().html(data).fadeTo(350, 1);
				} 
			}
		});


		//ThisElement.fadeTo(600, 1);
	});
	/*________END PAGE PROJECT________*/	

	/*________PAGE GOODS________*/
		$(".nav-tabs li:first-child").addClass('selected');

		$(".main-container-tabs .tab:first").show();

		$(".nav-tabs li").click(function(event) {
			event.preventDefault();
			$(".main-container-tabs .tab").hide();
			$(".main-container-tabs .tab").eq($(this).index()).fadeIn("slow");
			$(".nav-tabs li").removeClass("selected");
			$(this).addClass("active");
		});
	/*________End PAGE GOODS________*/

	/*________tofilter________*/
	$(".tofilter").click(function(event) {
		$(".filter-goods").toggleClass('active');
		if ($(".filter-goods").hasClass('active')) {
			$(".filter-goods").slideDown();
			$(".tofilter").text("Свернуть фильтр");
		}else{
			$(".filter-goods").slideUp();
			$(".tofilter").text("Развернуть фильтр");
		}
	});

	$(".toproject").click(function(event) {
		$(".project-goods").toggleClass('active');
		if ($(".project-goods").hasClass('active')) {
			$(".project-goods").slideDown();
			$(".toproject").text("Свернуть категории");
		}else{
			$(".project-goods").slideUp();
			$(".toproject").text("Развернуть категории");
		}
	});

	if(window.matchMedia('(min-width: 1200px)').matches){
		$(".filter-goods").removeAttr('style');
	}
	$(window).resize(function() {
		if(window.matchMedia('(min-width: 1200px)').matches){
			$(".filter-goods").removeAttr('style');
		}
	});
	/*________End tofilter________*/
	
	//mask
	$("input[type='tel']").mask("+7 - (999) - 999 - 99 - 99");

	function popupsShow(){
		$(document).on('click', '.show_popup', function(event) {
			event.preventDefault();
			var target = $(this).data('target');
			$(target).fadeIn();
			$("body").css("overflow", "hidden");
		});

	$('.btn_order').click(function() {
		var title_order = $('.title-section h2').text();
		$('#order .title_order_prod').text(title_order);
		$('#order #orderTitle').val(title_order);
	});

	/*________По клику за пределы формы скрыть popup________*/
	$(".light-box").click(function(event){
    $(".light-box").fadeOut();
    $("body").css("overflow-y", "auto");
	});
	$('.modal').on('click', function(event){
	  event.stopPropagation();
	});
	$(".close-btn").click(function() {
   $(".light-box").fadeOut();
   $("body").css("overflow-y", "auto");
	});
	/*________END________*/
}


	$(".fancybox-button").fancybox({
		padding: 0,
		helpers		: {
			title	: { type : 'inside' },
			buttons	: {}
		}
	});



	// send contact form
	$('#contactSubmit').click(function(e) {
		e.preventDefault();
		if( $('#contactName').val() != '' && $('#contactTel').val() != '' && $('#contactEmail').val() != '' && $('#contactMess').val() != '' && $('#contactCaptcha').val() == '' ) {

			$('#contactSend_mess').html('');

			$.ajax({
				url: $('#contactForm').attr('action'),
				data: $('#contactForm').serialize(),
				type:'POST',
				success:function(data){

					if(data) {
						$('#contactForm').trigger('reset');
						$('#contactSend_mess').html(data);
					}
				}
			});

		} else {
			$('#contactSend_mess').html('Одно или несколько необходимых полей не заполнено.');
			$('#contactForm .requered').each(function() {
				if( $(this).val() == '' ) {
					$(this).css('border', '1px solid red');
				}
			});
		}
	});



	// send popup form
	$('#popupSubmit').click(function(e) {
		e.preventDefault();
		if( $('#popupName').val() != '' && $('#popupTel').val() != '' && $('#popupEmail').val() != '' && $('#popupCaptcha').val() == '' ) {

			$('#popupSend_mess').html('');

			$.ajax({
				url: $('#popupForm').attr('action'),
				data: $('#popupForm').serialize(),
				type:'POST',
				success:function(data){

					if(data) {
						$('#popupForm').trigger('reset');
						$('#popupSend_mess').html(data);
					}
				}
			});

		} else {
			$('#popupSend_mess').html('Одно или несколько необходимых полей не заполнено.');
			$('#popupForm .requered').each(function() {
				if( $(this).val() == '' ) {
					$(this).css('border', '1px solid red');
				}
			});
		}
	});



	// send cpopup order
	$('#orderSubmit').click(function(e) {
		e.preventDefault();
		if( $('#orderName').val() != '' && $('#orderTel').val() != '' && $('#orderEmail').val() != '' && $('#orderCaptcha').val() == '' ) {

			$('#orderSend_mess').html('');

			$.ajax({
				url: $('#orderForm').attr('action'),
				data: $('#orderForm').serialize(),
				type:'POST',
				success:function(data){

					if(data) {
						$('#orderSend_mess').html(data);
						setTimeout(function() {
							$('#order').fadeOut();
							$('#orderForm').trigger('reset');
						}, 3500);
					}
				}
			});

		} else {
			$('#orderSend_mess').html('Одно или несколько необходимых полей не заполнено.');
			$('#orderForm .requered').each(function() {
				if( $(this).val() == '' ) {
					$(this).css('border', '1px solid red');
				}
			});
		}
	});


	$('.requered').keypress(function() {
		$(this).removeAttr('style');
	});


	/*filter form */
	// cat filter
	$('#filter_form #prod_category a').click(function(e) {
		// e.preventDefault();
		if( $(this).parent().hasClass('selected_cat') ) {
			$('#cat_filter').val('');
		} else {
			var cat_id = $(this).data('catid');
			$('#cat_filter').val(cat_id);
		}
		$('.each_filter').each(function(){
			if( $(this).val() == '' || $(this).val() == 'Выбрать страну' || $(this).val() == 'Выбрать фактуру' ) {
				$(this).remove();
			}
		});
		$('#filter_form').submit();
	});

	// color filter
	$('#filter_form #color_select a').click(function(e) {
		e.preventDefault();
		var color_id = $(this).data('colorid');
		$('#color_filter').val(color_id);
		$('.each_filter').each(function(){
			if( $(this).val() == '' || $(this).val() == 'Выбрать страну' || $(this).val() == 'Выбрать фактуру' ) {
				$(this).remove();
			}
		});
		$('#filter_form').submit();
	});

	// alphabet filter
	$('#filter_form #letter_select a').click(function(e) {
		e.preventDefault();
		var color_id = $(this).data('letterid');
		$('#letter_filter').val(color_id);
		$('.each_filter').each(function(){
			if( $(this).val() == '' || $(this).val() == 'Выбрать страну' || $(this).val() == 'Выбрать фактуру' ) {
				$(this).remove();
			}
		});
		$('#filter_form').submit();
	});

	// country filter
	$('#filter_form #country_filter').change(function() {
		$('.each_filter').each(function(){
			if( $(this).val() == '' || $(this).val() == 'Выбрать страну' || $(this).val() == 'Выбрать фактуру' ) {
				$(this).remove();
			}
		});
		$('#filter_form').submit();
	});

	// facture filter
	$('#filter_form #facture_filter').change(function() {
		$('.each_filter').each(function(){
			if( $(this).val() == '' || $(this).val() == 'Выбрать страну' || $(this).val() == 'Выбрать фактуру' ) {
				$(this).remove();
			}
		});
		$('#filter_form').submit();
	});
	
	// material filter
	//var material = [];
	$('#filter_form #material_select a').click(function(e) {
		e.preventDefault();
		/*var temp_prod = $('#material_filter').val(),
			temp = temp_prod.split(' ');


		//if( $('#material_filter').val() != '' ) {

		//}
		console.log(temp);

		if(temp != '') {
			$.each(temp, function() {
		       material = "{'mat_id':" +this+"}";
		    });

			material = JSON.stringify(material);
			console.log('material: '+material);
		}

		// if(temp_prod == '') {
		// 	material.push({ mat_id: $(this).data('material') });
		// }


		material.push({ mat_id: $(this).data('material') });

		var mater = JSON.stringify(material);
		var mat = '';
	    var obj = $.parseJSON(mater);
	    $.each(obj, function() {
	        mat += this['mat_id']+" ";
	    });
	    console.log('pars: '+mater);
	*/
		if( $(this).parent().hasClass('selected_cat') ) {
			$('#material_filter').val('');
		} else {
			var mat = $(this).data('material');
			$('#material_filter').val(mat);
		}
		$('.each_filter').each(function(){
			if( $(this).val() == '' || $(this).val() == 'Выбрать страну' || $(this).val() == 'Выбрать фактуру' ) {
				$(this).remove();
			}
		});
		$('#filter_form').submit();
	});

	/* resel form filters */
	$('#reset_filter').click(function(e) {
		e.preventDefault();
		var local = $(this).data('local');
		if( local.length > 0 ) {
			window.location.replace(local);
		} else {
			$('.each_filter').each(function(){
				$(this).remove();
			});
			$('#filter_form').submit();
		}
	});


	/* submit form search */
	$('#list_cat_form a').click(function(e) {
		e.preventDefault();
		var cat = $(this).data('id');
		$('#cat_filter').val(cat);
		$('.each_filter').each(function(){
			if( $(this).val() == '' ) {
				$(this).remove();
			}
		});
		$('#custom_searsch_form').submit();
	});

	/* submit form search Enter */
	$('#custom_searsch_form').keydown(function(e){
        if(e.keyCode == 13) {
			$('.each_filter').each(function(){
				if( $(this).val() == '' ) {
					$(this).remove();
				}
			});
		}
		//$('#custom_searsch_form').submit();
	});


});//END document