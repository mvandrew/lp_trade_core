(($) ->
  window.getCookeParam = (name) -> # Извлекает параметры из кукисов
    cookie = " " + document.cookie
    search = " " + name + "="
    setStr = ""
    offset = 0
    end = 0
    if cookie.length > 0
      offset = cookie.indexOf search
      if offset != -1
        offset += search.length
        end = cookie.indexOf ";", offset
        end = cookie.length if end == -1
        setStr = decodeURI cookie.substring(offset, end)
    result = setStr

  window.getQueryParam = (paramName) -> # Извлекает параметры из адресной строки
    queryString = document.location.search.split("+").join " "
    pattern = /[?&]?([^=]+)=([^&]*)/g
    params = {}
    params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]) while tokens = pattern.exec queryString
    paramValue = if params[paramName] == undefined or params[paramName] == "" then window.getCookeParam(paramName) else params[paramName]

  window.setQueryParam = (name, value, expires, path, domain, secure) -> # Записывает параметр в кукисы
    document.cookie = name + "=" + encodeURI(value) +
        (if expires then "; expires=" + expires else "") +
        (if path then "; path=" + path else "") +
        (if domain then "; domain=" + domain else "") +
        (if secure then "; secure" else "")

  window.getCPA_Label = (labelName) -> # Возвращает значение заданной метки для CPA сети
    labelValue = window.getQueryParam(labelName)
    if labelValue == ""
      switch labelName
        when "s" then labelValue = document.location.hostname
        when "w"
          labelValue = getQueryParam "utm_source"
          labelValue = "site" if labelValue == ""
        when "p" then labelValue = getQueryParam "utm_campaign"
        when "t" then labelValue = getQueryParam "utm_content"
        when "m" then labelValue = getQueryParam "utm_medium"
    if labelName == "s" and /mtproxy\.yandex\.net$/.test(labelValue)
      console.log labelValue
      labelValue = document.location.hostname
      console.log labelValue
    res = labelValue

  window.getCPA_Location = () -> # Формирование строки меток для CPA сети
    res = "s=" + window.getCPA_Label("s") +
      "&w=" + window.getCPA_Label("w") +
      "&p=" + window.getCPA_Label("p") +
      "&t=" + window.getCPA_Label("t") +
      "&m=" + window.getCPA_Label("m")
) jQuery