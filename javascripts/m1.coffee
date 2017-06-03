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
        yaCounter44859640.reachGoal "CPA_ORDER" # Yandex
        ga 'send', 'event', 'order', 'send' # Google
        _tmr = window._tmr || (window._tmr = [])
        _tmr.push { id: "2905034", type: "reachGoal", goal: "CPA_ORDER" } # Mail.ru
        fbq 'track', 'Purchase', {value: '550.00', currency:'RUB'} # Facebook

      testResult

) jQuery