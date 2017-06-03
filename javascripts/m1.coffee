(($) ->
  m1cpa_getRef = () -> # Получает идентификатор партнёра
    refId = $('body').attr 'data-ref'
    refId = "12178" if refId == undefined or refId == ""
    result = refId

  m1cpa_getProduct = () -> # Получает идентификатор продукта
    productId = $('body').attr 'data-product'

  m1cpa_getLink = () -> # Получает идентификатор ссылки
    productId = $('body').attr 'data-link'

  window.m1_cpaInit = () -> # Инициализация инстументов сети M1
    m1BaseDate = new Date();
    after30days = m1BaseDate.setDate(m1BaseDate.getDate() + 30);
    m1ExpDate = new Date(after30days)

    refId = m1cpa_getRef()
    productId = m1cpa_getProduct()
    linkId = m1cpa_getLink()
    lb_s = window.getCPA_Label("s");
    lb_w = window.getCPA_Label("w");
    lb_p = window.getCPA_Label("p");
    lb_t = window.getCPA_Label("t");
    lb_m = window.getCPA_Label("m");

    window.setQueryParam("ref", refId, m1ExpDate, "") if refId != undefined and refId != ""
    window.setQueryParam("product_id", productId, m1ExpDate, "") if productId != undefined and productId != ""
    window.setQueryParam("linkId", linkId, m1ExpDate, "") if linkId != undefined and linkId != ""
    window.setQueryParam("s", lb_s, m1ExpDate, "") if lb_s != undefined and lb_s != ""
    window.setQueryParam("w", lb_w, m1ExpDate, "") if lb_w != undefined and lb_w != ""
    window.setQueryParam("p", lb_p, m1ExpDate, "") if lb_p != undefined and lb_p != ""
    window.setQueryParam("t", lb_t, m1ExpDate, "") if lb_t != undefined and lb_t != ""
    window.setQueryParam("m", lb_m, m1ExpDate, "") if lb_m != undefined and lb_m != ""

    # Подключение счётчика партнёрской сети
    m1Counter = document.createElement "script"
    m1Counter.src = "http://m1-shop.ru/send_order/?ref=" + refId +
        "&lnk=" + linkId +
        "&s=" + lb_s +
        "&w=" + lb_w +
        "&p=" + lb_p +
        "&t=" + lb_t +
        "&m=" + lb_m +
        "&product_id=" + productId +
        "&out=1"
    document.body.appendChild m1Counter

    $("form.order_form").on "submit", (event) -> # Обработка формы заказа
      testResult = true

      # Проверка имени заказчика
      if @.name.value == ""
        alert "Введите Ваше имя"
        testResult = false
      if @.phone.value.length < 7
        alert "Введите корректный номер телефона"
        testResult = false

      if testResult
        # Отправка сведений на собственный сервер
        queryURL = "/order.php?" +
          "name=" + @.name.value +
          "&phone=" + @.phone.value +
          "&item=" + @.item.value +
          "&qty=" + @.qty.value +
          "&price=" + @.price.value +
          "&cpa=m1"
        queryURL = queryURL + "&mode=" + @.mode.value if @.mode != undefined and @.mode.value != ""
        queryURL = encodeURI queryURL
        $.ajax queryURL

        # Формирование строки запроса
        actionURL = "http://m1-shop.ru/send_my_order/?" +
          window.getCPA_Location()
        @.action = actionURL


        # Отправка данных о конверсии
        try # Yandex
          if window.goalData['yandex_counter'] != "" and window.goalData['yandex_goal'] != ""
            ya_goal = "yaCounter" + window.goalData['yandex_counter'] +
              ".reachGoal( '" + window.goalData['yandex_goal'] + "' );"
            eval ya_goal
        catch error
          console.log "Yandex Goal error: " + error

        try # Google
          if window.goalData['google_category'] != "" and window.goalData['google_goal'] != ""
            ga_goal = "ga( 'send', 'event', " +
              "'" + window.goalData['google_category'] + "', " +
              "'" + window.goalData['google_goal'] + "' );"
            eval ga_goal
        catch error
          console.log "Google Goal error: " + error

        try # Mail.ru
          if window.goalData['mail_ru_counter'] != "" and window.goalData['mail_ru_goal'] != ""
            ma_goal = "_tmr = window._tmr || (window._tmr = []); " +
              "_tmr.push({" +
              "   id: '" + window.goalData['mail_ru_counter'] + "'," +
              "   type: 'reachGoal'," +
              "   goal: '" + window.goalData['mail_ru_goal'] + "'});"
            eval ma_goal
        catch error
          console.log "Mail.ru Goal error: " + error

        try # Facebook
          if window.goalData['facebook_goal'] != "" and window.goalData['goal_value'] != ""
            fb_goal = "fbq('track', '" + window.goalData['facebook_goal'] + "', { " +
              "value: '" + window.goalData['goal_value'] + ".00', " +
              "currency: 'RUB' });"
            eval fb_goal
        catch error
          console.log "Facebook Goal error: " + error

      testResult

) jQuery