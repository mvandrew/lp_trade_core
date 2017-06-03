(($) ->
  window.setCountDown = () -> # Интервал для таймера обратного отсчёта
    if $(".timer").length > 0 or $(".countbox").length > 0
      setInterval ->
        dateNow = new Date()
        # Вычисление абсолютных значений
        hours = 23 - dateNow.getHours()
        mins = 59 - dateNow.getMinutes()
        secs = 59 - dateNow.getSeconds()
        # Подготовка текстового представления
        hoursStr = if hours < 10 then "0" + hours.toString() else hours.toString()
        minsStr = if mins < 10 then "0" + mins.toString() else mins.toString()
        secsStr = if secs < 10 then "0" + secs.toString() else secs.toString()
        hours1 = if hours < 10 then "0" else hours.toString().charAt(0)
        hours2 = if hours < 10 then hours.toString().charAt(0) else hours.toString().charAt(1)
        mins1 = if mins < 10 then "0" else mins.toString().charAt(0)
        mins2 = if mins < 10 then mins.toString().charAt(0) else mins.toString().charAt(1)
        secs1 = if secs < 10 then "0" else secs.toString().charAt(0)
        secs2 = if secs < 10 then secs.toString().charAt(0) else secs.toString().charAt(1)
        resHtml = "<div class='countbox-num'><div class='countbox-hours1'><span></span>" + hours1 + "</div><div class='countbox-hours2'><span></span>" + hours2 + "</div><div class='countbox-hours-text'>часов</div></div>" + "</div><div class='countbox-hours-text'></div></div>" +
          "<div class='countbox-space'></div>" +
          "<div class='countbox-num'><div class='countbox-mins1'><span></span>" + mins1 + "</div><div class='countbox-mins2'><span></span>" + mins2 + "</div><div class='countbox-mins-text'>минут</div></div>" + "</div><div class='countbox-mins-text'></div></div>" +
          "<div class='countbox-space'></div>" +
          "<div class='countbox-num'><div class='countbox-secs1'><span></span>" + secs1 + "</div><div class='countbox-secs2'><span></span>" + secs2 + "</div><div class='countbox-secs-text'>секунд</div></div>"
        if $(".timer").length > 0
          $(".timer .hours").text hoursStr
          $(".timer .minutes").text minsStr
          $(".timer .seconds").text secsStr
        $(".countbox").each ->
          @.innerHTML = resHtml
      , 1e3

  window.anchorAnimate = () -> # Анимация перехода по якорям
    $("a[href^='#']").on "click", (event) ->
      hrefValue = $(@).attr "href"
      $("html, body").animate { scrollTop: $(hrefValue).offset().top + "px" }
      event.preventDefault()

  window.youtubeContainer = () -> # Формирование контейнера для youtube ролика
    $(".youtube").each ->
      # Подготовка превьюшки ролика
      youThumb = document.createElement "img"
      youThumb.setAttribute "src", "http://i.ytimg.com/vi/" + this.id + "/hqdefault.jpg"
      youThumb.setAttribute "class", "thumb"
      # Подготовка кнопки запуска
      youControl = document.createElement "div"
      youControl.setAttribute "class", "play"
      # Добавление новых элементов
      this.appendChild youThumb
      this.appendChild youControl
      # Обработка нажатия на контрол
      $(this).on "click", (event) ->
        youFrame = document.createElement "iframe"
        youFrame.setAttribute "src", "https://www.youtube.com/embed/" + @.id + "?autoplay=1&autohide=1&border=0&wmode=opaque&enablejsapi=1"
        youFrame.setAttribute "allowfullscreen", ""
        youFrame.style.width = @.style.width
        youFrame.style.height = @.style.height
        @.parentNode.replaceChild youFrame, @

  window.robotTest = () -> # Вставка проверки на робота
    setTimeout ->
      dateNow = new Date()
      $("form.order_form").each ->
        modeField = document.createElement "input"
        modeField.name = "mode"
        modeField.setAttribute "type", "hidden"
        curMonth = dateNow.getMonth() + 1
        curMonthStr = if curMonth < 10 then "0" + curMonth.toString() else curMonth.toString()
        curDay = dateNow.getDate()
        curDayStr = if curDay < 10 then "0" + curDay.toString() else curDay.toString()
        modeField.setAttribute "value", dateNow.getFullYear().toString() + curMonthStr + curDayStr
        @.appendChild modeField
    , 3e3

  window.validateOrderForm = () -> # Контроль заполнения формы для старых браузеров
    $("form.order_form").on "submit", (event) ->
      testResult = true
      # Проверка имени заказчика
      if @.name.value == ""
        alert "Введите Ваше имя"
        testResult = false
      if @.phone.value == ""
        alert "Введите Ваш номер телефона"
        testResult = false
      testResult

  window.checkMobile = () -> # Проверка на предмет мобильного устройства
    if window.device.mobile()
      mobURL = "http://fly-bra.eldoradosale.ru/mob1/" + document.location.search
      window.location.replace mobURL

  getGoalData = () -> # Загрузка данных о конверсиях
    $.getJSON "/get_data.php", (data) ->
      window.goalData = []
      $.each data, (key, value) ->
        window.goalData[key] = value

  getGoalData()

) jQuery