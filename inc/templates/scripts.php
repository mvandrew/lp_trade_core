<?php
defined("_IN_INDEX") or die("Access Denied");
?>

<?php if ( Page::get_instance()->callback_enabled && Page::get_instance()->popup_enabled ) : // Подключение всплывающей формы ?>
  <div class="popup_section">
    <div class="pp_wrapper"></div>
    <div class="pp_form"><a class="pp_close"></a>
      <div class="pp_title">Вам понравилось это предложение?</div>
      <div class="pp_body">
        <p class="pp_about">Мы расскажем Вам все об этом товаре, предложим наилучшие условия и ознакомим с подходящими акционными
          предложениями!</p>

        <form class="order_form" action="/order.php" method="post">
          <input type="text" name="name" placeholder="Как Вас зовут?" required>
          <input type="text" name="phone" placeholder="Ваш номер телефона" required>

          <button class="pp_button"><span>Перезвоните мне</span></button>

	        <?php Order::order_form_fields(); ?>
        </form>

        <p class="pp_operator">Оператор перезвонит Вам через 5-10 минут</p>

      </div>
    </div>
  </div>
<?php endif; ?>

<?php if ( Page::get_instance()->callback_enabled ) : // Подключение кнопки обратного звонка ?>
    <div id="pop_callback_button">
      <div class="pop_pulse_one"></div>
      <div class="pop_pulse_two"></div>
      <div class="pop_call_cont pop_call_spinner">
        <div class="pop_call_front"></div>
        <div class="pop_call_back">Бесплатный звонок</div>
      </div>
    </div>
<?php endif; ?>

  <script type="text/javascript">
    window.pop_callback_enabled = <?php echo Page::get_instance()->callback_enabled ? 'true' : 'false'; ?>;
    window.pop_callback_timeout = <?php echo Page::get_instance()->callback_timeout; ?>;
    window.pop_callback_gender = <?php echo Page::get_instance()->callback_gender; ?>;
    window.pop_popup_enabled = <?php echo Page::get_instance()->popup_enabled ? 'true' : 'false'; ?>;
  </script>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="/javascripts/device.min.js"></script>
  <script type="text/javascript" src="/javascripts/script.main.min.js"></script>
  <script type="text/javascript" src="/javascripts/cpa.min.js"></script>
<?php if ( defined("_M1_ENABLED") && _M1_ENABLED ) : ?>
  <script type="text/javascript" src="/javascripts/m1.min.js"></script>
<?php endif; ?>