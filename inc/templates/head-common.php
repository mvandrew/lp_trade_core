<?php
defined("_IN_INDEX") or die("Access Denied");
?>
<meta charset="utf-8">

<?php
// Подключение иконки
echo Page::favicon();

// Подключение локального файла
Page::include_template_local_file( __FILE__ );
?>