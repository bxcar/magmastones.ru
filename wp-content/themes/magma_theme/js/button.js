(function() {
	tinymce.PluginManager.add('true_mce_button', function( editor, url ) { // id кнопки true_mce_button должен быть везде один и тот же
		editor.addButton( 'true_mce_button', { // id кнопки true_mce_button
			icon: 'short', // мой собственный CSS класс, благодаря которому я задам иконку кнопки
			type: 'menubutton',
			title: 'Вставить элемент', // всплывающая подсказка при наведении
			menu: [ // тут начинается первый выпадающий список
				{
					text: 'Контент',
					menu: [
						
						{
							text: 'Картинка новостей',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Выберите нужную картинку',
									body: [
										{
										    type: 'textbox',
										    name: 'image',
										    label: 'Адрес картинки',
										    id: 'custom-image-box',
										    value: ''
										},
										{
										    type: 'button',
										    name: 'select-image',
										    text: 'Выбрать картинку',
										    onclick: function() {
										        window.mb = window.mb || {};

										        window.mb.frame = wp.media({
										            frame: 'post',
										            state: 'insert',
										            library : {
										                type : 'image'
										            },
										            multiple: false
										        });

										        window.mb.frame.on('insert', function() {
										            var json = window.mb.frame.state().get('selection').first().toJSON();
										            var $ = jQuery.noConflict();
										            if (0 > json.url.length ) {
										                return;
										            }

										            $('#custom-image-box').val(json.url);
										        });

										        window.mb.frame.open();
										    }
										}
									],
									onsubmit: function( e ) { // это будет происходить после заполнения полей и нажатии кнопки отправки
										editor.insertContent( '[Image url="' + e.data.image + '"]');
									}
								});
							}
						},
						{
							text: 'Контент',
							onclick: function() {
								editor.insertContent('[Content]Описание[/Content]');
							}
						},
						{
							text: 'Текстовый блок',
							onclick: function() {
								editor.insertContent('[Text]Описание[/Text]');
							}
						},
						{
							text: 'Фул картинка',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Выберите нужную картинку',
									body: [
										{
										    type: 'textbox',
										    name: 'full_image',
										    label: 'Адрес картинки',
										    id: 'full-image-box',
										    value: ''
										},
										{
										    type: 'button',
										    name: 'select-image',
										    text: 'Выбрать картинку',
										    onclick: function() {
										        window.mb = window.mb || {};

										        window.mb.frame = wp.media({
										            frame: 'post',
										            state: 'insert',
										            library : {
										                type : 'image'
										            },
										            multiple: false
										        });

										        window.mb.frame.on('insert', function() {
										            var json = window.mb.frame.state().get('selection').first().toJSON();
										            var $ = jQuery.noConflict();
										            if (0 > json.url.length ) {
										                return;
										            }

										            $('#full-image-box').val(json.url);
										        });

										        window.mb.frame.open();
										    }
										}
									],
									onsubmit: function( e ) { // это будет происходить после заполнения полей и нажатии кнопки отправки
										editor.insertContent( '[FullImage url="' + e.data.full_image + '"]');
									}
								});
							}
						},
						{
							text: 'Контейнер картинок блога',
							onclick: function() {
								editor.insertContent('[ImageRow]Картинки[/ImageRow]');
							}
						},
						{
							text: 'Картинка для блога',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Выберите нужную картинку',
									body: [
										{
										    type: 'textbox',
										    name: 'blog-image',
										    label: 'Адрес картинки',
										    id: 'blog_image',
										    value: ''
										},
										{
										    type: 'button',
										    name: 'select-image',
										    text: 'Выбрать картинку',
										    onclick: function() {
										        window.mb = window.mb || {};

										        window.mb.frame = wp.media({
										            frame: 'post',
										            state: 'insert',
										            library : {
										                type : 'image'
										            },
										            multiple: false
										        });

										        window.mb.frame.on('insert', function() {
										            var json = window.mb.frame.state().get('selection').first().toJSON();
										            var $ = jQuery.noConflict();
										            if (0 > json.url.length ) {
										                return;
										            }

										            $('#blog_image').val(json.url);
										        });

										        window.mb.frame.open();
										    }
										}
									],
									onsubmit: function( e ) { // это будет происходить после заполнения полей и нажатии кнопки отправки
										editor.insertContent( '[BlogImage url="' + e.data.blog_image + '"]');
									}
								});
							}
						},
					]
				},
				{
					text: 'Галерея',
					menu: [

						{
							text: 'Контейнер галереи',
							onclick: function() {
								editor.insertContent('[ThreePicturesRow]Шорткод[/ThreePicturesRow]');
							}
						},
						{
							text: 'Три картинки',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Выберите нужную картинку',
									body: [
										{
										    type: 'textbox',
										    name: 'image_1',
										    label: 'Адрес картинки 1',
										    id: 'full-image-box_1',
										    value: ''
										},
										{
										    type: 'button',
										    name: 'select-image-1',
										    text: 'Выбрать картинку',
										    onclick: function() {
										        window.mb = window.mb || {};

										        window.mb.frame = wp.media({
										            frame: 'post',
										            state: 'insert',
										            library : {
										                type : 'image'
										            },
										            multiple: false
										        });

										        window.mb.frame.on('insert', function() {
										            var json = window.mb.frame.state().get('selection').first().toJSON();
										            var $ = jQuery.noConflict();
										            if (0 > json.url.length ) {
										                return;
										            }

										            $('#full-image-box_1').val(json.url);
										        });

										        window.mb.frame.open();
										    }
										},
										{
										    type: 'textbox',
										    name: 'image_2',
										    label: 'Адрес картинки 2',
										    id: 'full-image-box_2',
										    value: ''
										},
										{
										    type: 'button',
										    name: 'select-image-2',
										    text: 'Выбрать картинку',
										    onclick: function() {
										        window.mb = window.mb || {};

										        window.mb.frame = wp.media({
										            frame: 'post',
										            state: 'insert',
										            library : {
										                type : 'image'
										            },
										            multiple: false
										        });

										        window.mb.frame.on('insert', function() {
										            var json = window.mb.frame.state().get('selection').first().toJSON();
										            var $ = jQuery.noConflict();
										            if (0 > json.url.length ) {
										                return;
										            }

										            $('#full-image-box_2').val(json.url);
										        });

										        window.mb.frame.open();
										    }
										},
										{
										    type: 'textbox',
										    name: 'image_3',
										    label: 'Адрес картинки 3',
										    id: 'full-image-box_3',
										    value: ''
										},
										{
										    type: 'button',
										    name: 'select-image-3',
										    text: 'Выбрать картинку',
										    onclick: function() {
										        window.mb = window.mb || {};

										        window.mb.frame = wp.media({
										            frame: 'post',
										            state: 'insert',
										            library : {
										                type : 'image'
										            },
										            multiple: false
										        });

										        window.mb.frame.on('insert', function() {
										            var json = window.mb.frame.state().get('selection').first().toJSON();
										            var $ = jQuery.noConflict();
										            if (0 > json.url.length ) {
										                return;
										            }

										            $('#full-image-box_3').val(json.url);
										        });

										        window.mb.frame.open();
										    }
										}
									],
									onsubmit: function( e ) { // это будет происходить после заполнения полей и нажатии кнопки отправки
										editor.insertContent( '[ThreePictures url_1="' + e.data.image_1 + '" url_2="' + e.data.image_2 + '" url_3="' + e.data.image_3 + '"]');
									}
								});
							}
						},

					]
				},
				{
					text: 'Проекти',
					menu: [

						{
							text: 'Колонка галереи проекта',
							onclick: function() {
								editor.insertContent('[ProjectCol]Шорткоды картинок галереи[/ProjectCol]');
							}
						},
						{
							text: 'Картинка галереи',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Выберите нужную картинку',
									body: [
										{
										    type: 'textbox',
										    name: 'project_image',
										    label: 'Адрес картинки',
										    id: 'project-image-box',
										    value: ''
										},
										{
										    type: 'button',
										    name: 'select-image',
										    text: 'Выбрать картинку',
										    onclick: function() {
										        window.mb = window.mb || {};

										        window.mb.frame = wp.media({
										            frame: 'post',
										            state: 'insert',
										            library : {
										                type : 'image'
										            },
										            multiple: false
										        });

										        window.mb.frame.on('insert', function() {
										            var json = window.mb.frame.state().get('selection').first().toJSON();
										            var $ = jQuery.noConflict();
										            if (0 > json.url.length ) {
										                return;
										            }

										            $('#project-image-box').val(json.url);
										        });

										        window.mb.frame.open();
										    }
										}
									],
									onsubmit: function( e ) { // это будет происходить после заполнения полей и нажатии кнопки отправки
										editor.insertContent( '[ProjectImage url="' + e.data.project_image + '"]');
									}
								});
							}
						}

					]
				},
				
			]
		});
	});
})();