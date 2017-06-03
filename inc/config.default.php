<?php
defined("_IN_INDEX") or die("Access Denied");

define( "_CFG_COMPRESS_HTML",   true );                             // Отвечает за сжатие HTML страницы при выводе
define( "_CFG_PHONE",           "+7-977-748-2522" );                // Контактный номер телефона


// Идентификаторы счётчиков
define( "_COUNTER_YANDEX",      "" );                       // Яндекс Метрика
define( "_COUNTER_GOOGLE",      "" );                  // Google Analytics
define( "_COUNTER_MAIL",        "" );                        // TOP Mail.Ru


// Данные конверсий
define( "_GOAL_VALUE",          550 );                              // Стоимость цели
define( "_GOAL_YANDEX",         "CPA_ORDER" );                      // Идентификатор цели для Яндекс
define( "_GOAL_MAIL_RU",        "CPA_ORDER" );                      // Идентификатор цели для Mail.ru
define( "_GOAL_GA_CATEGORY",    "order" );                          // Категория цели для Google.Analytics
define( "_GOAL_GA_GOAL",        "send" );                           // Идентификатор цели для Google.Analytics
define( "_GOAL_FACEBOOK",       "Purchase" );                       // Тип цели для Facebook


// Параметры товара
define( "_INV_NAME",            "Defailt Item" );                        // Наименование товара
define( "_INV_QTY",             1);                                 // Количество
define( "_INV_PRICE",           10 );                              // Стоимость товара
define( "_INV_OLD_PRICE",       20 );                             // Старая цена товара
define( "_INV_DELIVERY",        350 );                              // Стоимость Доставки


// Параметры подключения к БД заказов
define( "_DB_USER",             "" );
define( "_DB_CATALOG",          "" );
define( "_DB_HOST",             "localhost" );
define( "_DB_PASSWORD",         "" );


// Параметры доступа к почтовому серверу
define( "_MAIL_HOST",           "smtp.yandex.ru" );                 // Сервер исходящей почты
define( "_MAIL_PORT",           "465" );                            // Порт сервера исходящей почты
define( "_MAIL_USER",           "robot@" );                  // Адрес отправителя
define( "_MAIL_PASS",           "" );                       // Пароль отправителя
define( "_MAIL_ORDER",          "" );      // Адрес получателя


// Параметры работы с партнёркой M1
define( "_M1_ENABLED",          false );                             // Признак работы с партнёрской сетью
define( "_M1_REF",              0 );                            // Партнёрский номер
define( "_M1_PRODUCT",          0 );                             // Идентификатор продукта
define( "_M1_LINK",             0 );                          // Идентификатор ссылки - нужен для срабатывания Postback

Page::include_template_local_file( __FILE__ );