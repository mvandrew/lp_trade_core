<?php
include "inc/common.php";
Page::start();
?><!doctype html>
<html lang="ru">
<head>

  <title>Политика конфиденциальности</title>

	<?php
	include ( _TEMPLATES_PATH . '/head-common.php' );
	include ( _TEMPLATES_PATH . '/head-desktop.php' );
	?>

  <link rel="stylesheet" href="stylesheets/thanks.css">

</head>
<body>
<?php Page::counters(); ?>
<div class="container">
  <div class="full_text">
    <h1>Политика конфиденциальности</h1>

    <p>Наш интернет-магазин уважительно относится к правам клиента. Соблюдается строгая конфиденциальность при
      оформлении заказа. Сведения надёжно сохраняются и защищены от передачи.</p>

    <p>Согласием на обработку данных клиента исключительно с целью оказания услуг является размещение заказа на
      сайте.</p>

    <p>К персональным данным относится личная информация о клиенте: домашний адрес; имя, фамилия, отчество; сведения о
      рождении; имущественное, семейное положение; личные контакты (телефон, электронная почта) и прочие сведения,
      которые перечислены в Законе РФ № 152-ФЗ «О персональных данных» от 27 июля 2006 г.</p>

    <p>Клиент вправе отказаться от обработки персональных данных. Нами в данном случае гарантируется удаление с сайта
      всех персональных данных в трёхдневный срок в рабочее время. Подобный отказ клиент может оформить простым
      электронным письмом на адрес, указанный на странице нашего сайта.</p>

  </div>
</div>

</body>
</html><?php
Page::finish();
?>