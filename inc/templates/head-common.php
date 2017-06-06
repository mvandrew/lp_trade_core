<?php
defined("_IN_INDEX") or die("Access Denied");
?>
  <meta charset="utf-8">

<?php
// Подключение иконки
echo Page::favicon();

// Подключение пикселя Facebook
Page::facebook_pixel();


//
// Подключение всплывающей формы
//
if ( Page::get_instance()->callback_enabled && Page::get_instance()->popup_enabled ) : ?>
  <link rel="stylesheet" type="text/css" href="/stylesheets/popup.css">
<?php endif;


// Подключение локального файла
Page::include_template_local_file( __FILE__ );
?>