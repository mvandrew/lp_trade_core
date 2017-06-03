<?php
include "inc/common.php";
Page::start();
?><!doctype html>
<html lang="ru">
<head>

	<title>Спасибо за Ваше обращение</title>

	<?php
	include ( _TEMPLATES_PATH . '/head-common.php' );
	include ( _TEMPLATES_PATH . '/head-desktop.php' );
	?>

	<link rel="stylesheet" href="stylesheets/thanks.css">

</head>
<body>
<?php Page::counters(); ?>
<div class="thanks">
	<div class="container">
		<div class="thumb"><img src="/images/call-centre.jpg" alt="Спасибо за Ваше обращение"></div>
		<div class="confirm">
			<h1>Спасибо за Ваше обращение</h1>
			<p>В самое ближайшее время наш оператор свяжется с Вами.</p>
			<p>Если Вы ошиблись при указании номера телефона, можете <a href="/">заполнить заказ вновь</a>.</p>
		</div>
	</div>
</div>

</body>
</html><?php
Page::finish();
?>