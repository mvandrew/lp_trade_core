<?php
defined("_IN_INDEX") or die("Access Denied");
?>
<div class="m1-content">
	<div class="m1-top">
		<div class="m1-left">
			<h1>Бюстгальтер Fly Bra (Low price)</h1>
		</div><div class="m1-right">
			<div class="m1-wrap">
				<div class="m1-price">
					<div class="m1-wrap">
						<div class="m1-left m1-big-text">Цена</div>
						<div id="m1-top-price" class="m1-right m1-big-text">
							<span class="m1-strike-text">2200 р</span><br>990 р
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="m1-bottom">
		<div class="m1-wrap">
			<div class="m1-form">
				<form action="" method="POST" onsubmit="urlGen(this);">
					<div class="m1-row">
						<label for="m1-name">ФИО</label>
						<input id="m1-name" name="name" type="text" placeholder="Иванов Иван Иванович">
					</div>
					<div class="m1-row">
						<label for="m1-phone">Телефон</label>
						<input id="m1-phone" name="phone" type="text">
					</div>
					<div class="m1-row m1-price">
						<div class="m1-left">Стоимость заказа<br>Доставка</div>
						<div id="m1-price" class="m1-right">990 р<br>350 р</div>
					</div>
					<div class="m1-line"></div>
					<div class="m1-row m1-big-text">
						<div class="m1-left">ИТОГО</div>
						<div id="m1-total-price" class="m1-right">1340 р</div>
					</div>
					<div class="m1-row m1-align-center">
						<input type="hidden" name="product_id" value="3378">
						<input type="hidden" name="ref" value="12178">
						<input type="submit" value="ЗАКАЗАТЬ">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<style type="text/css">.m1-content, .m1-content *{font-family: Tahoma,Helvetica,sans-serif;outline: none;}.m1-content {max-width: 960px;margin: 0 auto;}.m1-content h1{font-size:1.5em;}.m1-left {float: left;}.m1-right {float: right;}.m1-big-text {font-size: 24px;line-height: 28px;}.m1-strike-text {text-decoration: line-through;color: #868686;}.m1-align-center {text-align: center;}@media only screen and (max-width: 768px) {.m1-big-text {font-size: 18px;line-height: 20px;}}.m1-top {height: 90px;width: 100%;margin: 30px 0;position: relative;}.m1-top .m1-left {width: 40%;}.m1-top .m1-left .m1-image {border: #999999 solid 1px;}.m1-top .m1-left .m1-image img {width: 100%;}.m1-top .m1-right {width: 56%;}.m1-top .m1-right h1 {font-weight: normal;font-size: 32px;line-height: 36px;margin: 20px 0;}.m1-top .m1-right .m1-price {clear: both;background: #eaeaea repeat;position: absolute;bottom: 0;width: 56%;}.m1-top .m1-right .m1-price .m1-wrap {padding: 20px;overflow: hidden;}.m1-top .m1-right .m1-price .m1-wrap .m1-right {text-align: right;}@media only screen and (max-width: 768px) {.m1-top .m1-right h1 {font-size: 24px;margin: 10px 0;}.m1-top .m1-right .m1-price .m1-wrap {padding: 10px;}}@media only screen and (max-width: 479px) {.m1-top > .m1-left, .m1-top > .m1-right {width: 100%;float: left}.m1-top .m1-right .m1-price {position: static;width: 100%;}}.m1-bottom {clear: both;background: #eaeaea repeat;}.m1-bottom .m1-wrap {overflow: hidden;padding: 20px;}.m1-bottom .m1-form .m1-row {clear: both;margin-bottom: 20px;float: left;width: 100%;}.m1-bottom .m1-form .m1-row:last-of-type {margin-bottom: 0;}.m1-bottom .m1-form .m1-row label {color: #868686;font-size: 14px;cursor: pointer;float: left;margin-bottom: 5px;}.m1-bottom .m1-form .m1-row input[name=name],.m1-bottom .m1-form .m1-row input[name=phone],.m1-bottom .m1-form .m1-row select[name=country] {clear: both;float: left;width: 97%;border-radius: 5px;border: 1px solid #dbd9d7;padding: 8px;box-shadow: -1px -1px 1px rgba(134,134,134,.5);}.m1-bottom .m1-form .m1-row select[name=country] {max-width: 220px;}.m1-bottom .m1-form .m1-line {height: 1px;border-top: #999999 solid 1px;width: 100%;clear: both;margin: 0 0 20px 0;float: left;}.m1-bottom .m1-form .m1-price .m1-right {text-align: right;}.m1-bottom .m1-form .m1-row input[type=submit] {max-width: 400px;margin-top: 20px;cursor: pointer;border: none;background: darkgreen repeat;color: #FFFFFF;font-size: 25px;padding: 10px 50px;}@media only screen and (max-width: 479px) {.m1-bottom .m1-form .m1-row input[type=submit] {padding: 10px 30px;}}</style>
<script>
  function WindowOnload() {
    // Проверка сабмита
    $("form").submit(function() {
      var obj = {}, val = {};
      obj.name = $(this).find("input[name=name]");
      obj.phone = $(this).find("input[name=phone]");

      val.name = obj.name.val().trim();
      val.phone = obj.phone.val().trim();

      obj.name.val(val.name);
      obj.phone.val(val.phone);

      if ( val.name.length == 0 ) {
        alert("Укажите корректные ФИО!");
        return false;
      }
      if ( val.phone.length < 7 ) {
        alert("Укажите корректный телефон!");
        return false;
      }
      return true;
    });

    $.ajax( {
      url: "http://m1-shop.ru/form_lending.js?p=3378",
      dataType: "json"
    }).done(function(data) {
      $("#m1-total-price").text(data.priceLand + data.deliverLand + " " + data.priceVal);
      $("#m1-price").html(data.priceLand + " " + data.priceVal + "<br>" + data.deliverLand + " " + data.priceVal);
      $("#m1-top-price").html('<span class="m1-strike-text">'+ data.priceOldLand + " " + data.priceVal +'</span><br>'+ data.priceLand + " " + data.priceVal);
    }).fail(function() {
      console.log("error");
    });

    if(location.hostname != "m1-shop.ru") {
      var m1_product_id = 3378, ref = 12178, lnk = "", script = document.createElement("script");
      script.src = "http://m1-shop.ru/send_order/?ref=" + ref + "&lnk=" + lnk + "&s=&w=&t=&product_id=" + m1_product_id + '&out=1';
      // http://m1-shop.ru/send_order/?ref=12178&lnk=&s=&w=&t=&product_id=3378&out=1
      document.body.appendChild(script);
    }
  }

  // Проверка на jQuery
  if (!window.jQuery) {
    var script = document.createElement("script");
    script.src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js";
    document.getElementsByTagName("head")[0].appendChild(script);
    script.addEventListener("load", function() {
      WindowOnload();
    });
  } else {
    $(function() {
      WindowOnload();
    });
  }
</script>
<script src="http://m1ccp.ru/js/m1ref.js"></script>