<?php 

/*-----------------------------------------------------------------------------------*/
/* Shortcodes
/*-----------------------------------------------------------------------------------*/



// Хуки
function true_add_mce_button() {
  // проверяем права пользователя - может ли он редактировать посты и страницы
  if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
    return; // если не может, то и кнопка ему не понадобится, в этом случае выходим из функции
  }
  // проверяем, включен ли визуальный редактор у пользователя в настройках (если нет, то и кнопку подключать незачем)
  if ( 'true' == get_user_option( 'rich_editing' ) ) {
    add_filter( 'mce_external_plugins', 'true_add_tinymce_script' );
    add_filter( 'mce_buttons', 'true_register_mce_button' );
  }
  ?>
  <style type="text/css">
    
  </style>
  <?php
}
add_action('admin_head', 'true_add_mce_button');

function wph_inline_css_admin() {
echo '<style>
  i.mce-i-short {
    background-image: url("/wp-content/themes/magma_theme/img/short_icon.png");
  }
 </style>';
}
add_action('admin_head', 'wph_inline_css_admin');

 
// В этом функции указываем ссылку на JavaScript-файл кнопки
function true_add_tinymce_script( $plugin_array ) {
  $plugin_array['true_mce_button'] = get_stylesheet_directory_uri() .'/js/button.js'; // true_mce_button - идентификатор кнопки
  return $plugin_array;
}
 
// Регистрируем кнопку в редакторе
function true_register_mce_button( $buttons ) {
  array_push( $buttons, 'true_mce_button' ); // true_mce_button - идентификатор кнопки
  return $buttons;
}





/*-----------------------------------------------------------------------------------*/
/* Modul image
/*-----------------------------------------------------------------------------------*/
function ws_col( $atts, $content = null ) {
  
  $ws_att = shortcode_atts( array(
    'id' => '#',
    'url' => '#'
  ), $atts );

  return '<div class="item">
          <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="foto" style="background-image: url('.$ws_att['url'].')"></div>
              '.do_shortcode( $content ).'
            </div>';
}
add_shortcode( 'Image', 'ws_col' );




/*-----------------------------------------------------------------------------------*/
/* Modul content
/*-----------------------------------------------------------------------------------*/
function ws_cont( $atts, $content = null ) {
  
  $ws_att = shortcode_atts( array(
    'id' => '#',
    'image' => '#'
  ), $atts );

  return '<div class="col-lg-8 col-md-8">
            <div class="detailed-item">
              '.do_shortcode( $content ).'
            </div>
          </div>
          </div>
        </div><!--End .item-->';
}
add_shortcode( 'Content', 'ws_cont' );




/*-----------------------------------------------------------------------------------*/
/* Modul text
/*-----------------------------------------------------------------------------------*/
function ws_text( $atts, $content = null ) {
  
  $ws_att = shortcode_atts( array(
    'id' => '#',
    'image' => '#'
  ), $atts );

  return '<div class="txt">'.do_shortcode( $content ).'</div><!--End .item-->';
}
add_shortcode( 'Text', 'ws_text' );



/*-----------------------------------------------------------------------------------*/
/* Modul FullImage
/*-----------------------------------------------------------------------------------*/
function ws_fullimg( $atts, $content = null ) {
  
  $ws_att = shortcode_atts( array(
    'id' => '#',
    'url' => '#'
  ), $atts );

  return '<div class="img-colum">
                  <div class="row">
                    <div class="col-lg-12"><div class="pic" style="background-image: url('.$ws_att['url'].')"></div></div>
                  </div>  
                </div>';
}
add_shortcode( 'FullImage', 'ws_fullimg' );




/*-----------------------------------------------------------------------------------*/
/* Modul galleryrow
/*-----------------------------------------------------------------------------------*/
function ws_galleryrow( $atts, $content = null ) {
  
  $ws_att = shortcode_atts( array(
    'id' => '#',
  ), $atts );

  return '<div class="row">'.do_shortcode( $content ).'</div>';
}
add_shortcode( 'ThreePicturesRow', 'ws_galleryrow' );





/*-----------------------------------------------------------------------------------*/
/* Modul FullImage
/*-----------------------------------------------------------------------------------*/
function ws_gallery( $atts, $content = null ) {
  
  $ws_att = shortcode_atts( array(
    'id' => '#',
    'url_1' => '#',
    'url_2' => '#',
    'url_3' => '#'
  ), $atts );

  return '<div class="col-lg-6 col-md-6">
                    <div class="img-colum">
                      <div class="pic" style="background-image: url('.$ws_att['url_1'].')"></div>
                      <div class="img-colum small-img">
                        <div class="view"><div class="pic" style="background-image: url('.$ws_att['url_2'].')"></div></div>
                        <div class="view"><div class="pic" style="background-image: url('.$ws_att['url_3'].')"></div></div>
                      </div>
                    </div>
                  </div>';
}
add_shortcode( 'ThreePictures', 'ws_gallery' );




/*-----------------------------------------------------------------------------------*/
/* Modul img_row
/*-----------------------------------------------------------------------------------*/
function ws_img_row( $atts, $content = null ) {
  
  $ws_att = shortcode_atts( array(
    'id' => '#',
  ), $atts );

  return '<div class="img-colum"><div class="row">'.do_shortcode( $content ).'</div></div>';
}
add_shortcode( 'ImageRow', 'ws_img_row' );


/*-----------------------------------------------------------------------------------*/
/* Modul blogImage
/*-----------------------------------------------------------------------------------*/
function ws_blogimage( $atts, $content = null ) {
  
  $ws_att = shortcode_atts( array(
    'id' => '#',
    'url' => '#',
  ), $atts );

  return '<div class="col-lg-6 col-md-6 col-sm-6"><div class="pic" style="background-image: url('.$ws_att['url'].')"></div></div>';
}
add_shortcode( 'BlogImage', 'ws_blogimage' );




/*-----------------------------------------------------------------------------------*/
/* Modul project_col
/*-----------------------------------------------------------------------------------*/
function ws_project_col( $atts, $content = null ) {
  
  $ws_att = shortcode_atts( array(
    'id' => '#',
  ), $atts );

  return '<div class="view">'.do_shortcode( $content ).'</div>';
}
add_shortcode( 'ProjectCol', 'ws_project_col' );


/*-----------------------------------------------------------------------------------*/
/* Modul projectImage
/*-----------------------------------------------------------------------------------*/
function ws_projectimage( $atts, $content = null ) {
  
  $ws_att = shortcode_atts( array(
    'id' => '#',
    'url' => '#',
  ), $atts );

  return '<div class="item" style="background-image: url('.$ws_att['url'].')"></div>';
}
add_shortcode( 'ProjectImage', 'ws_projectimage' );



?>